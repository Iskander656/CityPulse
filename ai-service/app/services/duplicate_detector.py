

import math
from typing import Any

from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity


# Initial review thresholds. These are heuristic values and should be tuned
# using real CityPulse reports before being relied on operationally.
MAX_DISTANCE_METERS = 500
MIN_TEXT_SIMILARITY = 0.15


def calculate_distance_meters(
    latitude_1: float,
    longitude_1: float,
    latitude_2: float,
    longitude_2: float,
) -> float:
    """Calculate the distance between two coordinates using the Haversine formula."""
    earth_radius_meters = 6_371_000

    lat_1 = math.radians(latitude_1)
    lat_2 = math.radians(latitude_2)
    delta_lat = math.radians(latitude_2 - latitude_1)
    delta_lon = math.radians(longitude_2 - longitude_1)

    a = (
        math.sin(delta_lat / 2) ** 2
        + math.cos(lat_1)
        * math.cos(lat_2)
        * math.sin(delta_lon / 2) ** 2
    )
    central_angle = 2 * math.atan2(math.sqrt(a), math.sqrt(1 - a))

    return earth_radius_meters * central_angle


def detect_duplicates(
    new_report: dict[str, Any],
    existing_reports: list[dict[str, Any]],
) -> list[dict[str, Any]]:
    """Return nearby, textually similar reports for human review.

    Required new_report keys: description, category, latitude, longitude.
    Each existing report additionally needs an id.
    """
    if not existing_reports:
        return []

    new_description = str(new_report["description"]).strip()
    descriptions = [new_description] + [
        str(report["description"]).strip() for report in existing_reports
    ]

    # Fit the vectorizer to this comparison batch, then compare the new report
    # (the first document) with each existing report.
    try:
        vectors = TfidfVectorizer(
            lowercase=True,
            ngram_range=(1, 2),
            strip_accents="unicode",
        ).fit_transform(descriptions)
        similarities = cosine_similarity(vectors[0:1], vectors[1:]).flatten()
    except ValueError:
        # For example, every description may be empty or contain only stop words.
        similarities = [0.0] * len(existing_reports)

    matches = []

    for existing_report, similarity in zip(existing_reports, similarities):
        distance = calculate_distance_meters(
            float(new_report["latitude"]),
            float(new_report["longitude"]),
            float(existing_report["latitude"]),
            float(existing_report["longitude"]),
        )
        category_matches = (
            str(new_report["category"]).strip().casefold()
            == str(existing_report["category"]).strip().casefold()
        )

        if (
            category_matches
            and distance <= MAX_DISTANCE_METERS
            and float(similarity) >= MIN_TEXT_SIMILARITY
        ):
            matches.append(
                {
                    "report_id": existing_report["id"],
                    "category": existing_report["category"],
                    "text_similarity": round(float(similarity), 4),
                    "distance_meters": round(distance, 2),
                    "category_matches": category_matches,
                }
            )

    return sorted(
        matches,
        key=lambda match: (
            -match["text_similarity"],
            match["distance_meters"],
        ),
    )