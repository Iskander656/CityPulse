import csv
import time
from pathlib import Path

import joblib
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import accuracy_score, classification_report
from sklearn.model_selection import train_test_split
from sklearn.pipeline import Pipeline


BASE_DIR = Path(__file__).resolve().parent.parent
DATASET_PATH = BASE_DIR / "data" / "reports.csv"
MODEL_PATH = BASE_DIR / "app" / "models" / "report_classifier.joblib"


def load_dataset():
    descriptions = []
    categories = []

    with open(DATASET_PATH, "r", encoding="utf-8", newline="") as file:
        reader = csv.DictReader(file)

        for row in reader:
            descriptions.append(row["description"])
            categories.append(row["category"])

    return descriptions, categories


def train_model():
    descriptions, categories = load_dataset()
    start_time = time.perf_counter()

    X_train, X_test, y_train, y_test = train_test_split(
        descriptions,
        categories,
        test_size=0.2,
        random_state=42,
        stratify=categories
    )

    model = Pipeline([
        (
            "tfidf",
            TfidfVectorizer(
                lowercase=True,
                ngram_range=(1, 2),
                strip_accents="unicode"
            )
        ),
        (
            "classifier",
            LogisticRegression(
                max_iter=1000,
                class_weight="balanced",
                random_state=42
            )
        )
    ])

    print("Training CityPulse classification model...")

    model.fit(X_train, y_train)

    predictions = model.predict(X_test)

    accuracy = accuracy_score(y_test, predictions)

    print("\nMODEL EVALUATION")
    print("----------------")
    print(f"Training examples: {len(X_train)}")
    print(f"Testing examples: {len(X_test)}")
    print(f"Accuracy: {accuracy:.2%}")

    print("\nCLASSIFICATION REPORT")
    print("---------------------")
    print(classification_report(y_test, predictions, zero_division=0))

    MODEL_PATH.parent.mkdir(parents=True, exist_ok=True)

    joblib.dump(model, MODEL_PATH)

    print(f"\nModel saved successfully: {MODEL_PATH}")
    end_time = time.perf_counter()
    training_time = end_time - start_time

    print(f"Training time: {training_time:.2f} seconds")


if __name__ == "__main__":
    train_model()
