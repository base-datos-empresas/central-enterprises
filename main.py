from fastapi import FastAPI
app = FastAPI()

@app.get("/")
def root():
    return {"status": "ok", "service": "myapi"}

@app.get("/health")
def health():
    return {"ok": True}
