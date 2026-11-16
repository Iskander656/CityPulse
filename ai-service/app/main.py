from fastapi import FastAPI, HTTPException
from pydantic import BaseModel, Field

from app.services.classifier import classify_report


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