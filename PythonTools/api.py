from fastapi import FastAPI, Header, HTTPException, Query
import subprocess
import os
import sys

app = FastAPI(title="TITAN CENTRAL API")

# Basic Config
API_TOKEN = os.getenv("API_TOKEN") # Set this in your environment
BASE_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
DATA_PROCESSOR_PATH = os.path.join(os.path.dirname(__file__), 'process_data.py')
SOURCE_CSV = os.path.join(BASE_DIR, 'data', 'country_data.csv') 
OUTPUT_DIR = os.path.join(BASE_DIR, 'data', 'outputs')

@app.get("/api/health")
async def health():
    return {"status": "ok", "system": "TITAN CENTRAL"}

@app.post("/api/v1/recompute")
async def recompute(
    x_api_token: str = Header(None),
    dry_run: bool = Query(False, alias="dry-run")
):
    if x_api_token != API_TOKEN:
        raise HTTPException(status_code=401, detail="Unauthorized")
    
    # Launch background job (conceptually)
    try:
        cmd = [sys.executable, DATA_PROCESSOR_PATH, '--source', SOURCE_CSV, '--out', OUTPUT_DIR]
        
        if not dry_run:
            # Run blocking for simplicity in this example, or use subprocess.Popen for async
            result = subprocess.run(cmd, capture_output=True, text=True)
            if result.returncode != 0:
                 raise HTTPException(status_code=500, detail={"error": "Computation Failed", "details": result.stderr})
            
        return {"status": "Recomputation Complete", "mode": "dry-run" if dry_run else "live"}
        
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

if __name__ == '__main__':
    import uvicorn
    uvicorn.run(app, port=8000)
