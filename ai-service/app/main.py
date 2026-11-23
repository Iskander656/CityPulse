from fastapi import FastAPI, HTTPException
from pydantic import BaseModel, Field

from app.services.classifier import classify_report
from app.services.duplicate_detector import detect_duplicates

from pydantic import BaseModel
from app.assignment import assign_officer


app = FastAPI(
    title="CityPulse AI",
    description="Intelligent analysis service for the CityPulse smart city platform.",
    version="1.0.0"
)


class ReportRequest(BaseModel):
    description: str = Field(
        min_length=5,
        max_length=2000,
        description="Description of the reported city problem"
    )


# Duplicate detection models
class ExistingReport(BaseModel):
    id: int
    description: str = Field(min_length=1, max_length=5000)
    category: str = Field(min_length=1, max_length=100)
    latitude: float = Field(ge=-90, le=90)
    longitude: float = Field(ge=-180, le=180)


class DuplicateDetectionRequest(BaseModel):
    description: str = Field(min_length=5, max_length=5000)
    category: str = Field(min_length=1, max_length=100)
    latitude: float = Field(ge=-90, le=90)
    longitude: float = Field(ge=-180, le=180)
    existing_reports: list[ExistingReport] = Field(default_factory=list, max_length=500)


@app.get("/")
def home():
    return {
        "application": "CityPulse AI",
        "status": "operational",
        "version": "1.0.0"
    }


@app.get("/health")
def health_check():
    return {
        "status": "healthy",
        "service": "CityPulse AI"
    }


@app.post("/predict")
def predict_report(request: ReportRequest):

    try:
        result = classify_report(request.description)

        return {
            "success": True,
            "input": request.description,
            "prediction": result
        }

    except Exception as error:
        raise HTTPException(
            status_code=500,
            detail="Report classification failed."
        )


# Duplicate detection endpoint
@app.post("/detect-duplicates")
def detect_report_duplicates(request: DuplicateDetectionRequest):
    try:
        new_report = {
            "description": request.description,
            "category": request.category,
            "latitude": request.latitude,
            "longitude": request.longitude,
        }

        existing_reports = [
            report.model_dump() for report in request.existing_reports
        ]

        matches = detect_duplicates(new_report, existing_reports)

        return {
            "success": True,
            "potential_duplicates": matches,
            "count": len(matches),
        }

    except Exception:
        raise HTTPException(
            status_code=500,
            detail="Duplicate report detection failed."
        )


class AssignmentRequest(BaseModel):
    complaint_category: str
    officers: list[dict]

@app.post("/assign-officer")
async def automatic_assignment(request: AssignmentRequest):

    result = assign_officer(
        complaint_category=request.complaint_category,
        officers=request.officers
    )

    return result
