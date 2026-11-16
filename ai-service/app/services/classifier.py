import joblib
from pathlib import Path


BASE_DIR = Path(__file__).resolve().parent.parent
MODEL_PATH = BASE_DIR / "models" / "report_classifier.joblib"


# Load the trained model
model = joblib.load(MODEL_PATH)


def classify_report(description: str):
    prediction = model.predict([description])[0]

    probabilities = model.predict_proba([description])[0]

    confidence = float(max(probabilities))

    return {
        "category": prediction,
        "confidence": round(confidence, 4)
    }