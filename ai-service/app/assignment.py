

from typing import Any


def assign_officer(
    complaint_category: str,
    officers: list[dict[str, Any]],
) -> dict[str, Any]:
    """Select the eligible officer with the lowest relative workload."""

    if not officers:
        return {
            "success": False,
            "message": "No officers available.",
        }

    category = complaint_category.strip().casefold()
    eligible_officers: list[dict[str, Any]] = []

    for officer in officers:
        if not officer.get("is_active", True):
            continue
        if not officer.get("is_available", True):
            continue

        department = str(officer.get("department", "")).strip().casefold()
        if department != category:
            continue

        try:
            active_complaints = int(officer.get("active_complaints", 0))
            max_capacity = int(officer.get("max_capacity", 10))
        except (TypeError, ValueError):
            continue

        if active_complaints < 0 or max_capacity <= 0:
            continue
        if active_complaints >= max_capacity:
            continue

        eligible_officers.append(
            {
                **officer,
                "active_complaints": active_complaints,
                "max_capacity": max_capacity,
            }
        )

    if not eligible_officers:
        return {
            "success": False,
            "message": "No eligible officers available for this category.",
        }

    selected = min(
        eligible_officers,
        key=lambda officer: (
            officer["active_complaints"] / officer["max_capacity"],
            officer["active_complaints"],
            officer.get("id", 0),
        ),
    )

    active = selected["active_complaints"]
    capacity = selected["max_capacity"]
    workload_percentage = round((active / capacity) * 100, 2)
    officer_name = str(selected.get("name", "The selected officer"))

    return {
        "success": True,
        "officer": {
            "id": selected["id"],
            "name": officer_name,
            "department": selected["department"],
            "active_complaints": active,
            "max_capacity": capacity,
        },
        "reason": (
            f"{officer_name} was selected because they had the lowest "
            "relative workload among eligible officers in this department."
        ),
        "assignment_details": {
            "department_match": True,
            "availability": "available",
            "active_complaints": active,
            "capacity": capacity,
            "workload_percentage": workload_percentage,
            "eligible_officers_evaluated": len(eligible_officers),
            "selection_method": "lowest_relative_workload",
        },
    }