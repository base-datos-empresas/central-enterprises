from flask import Flask, jsonify, request
import subprocess
import os
import sys

app = Flask(__name__)

# Basic Config
API_TOKEN = os.getenv("API_TOKEN", "titan-secret-key")
DATA_PROCESSOR_PATH = os.path.join(os.path.dirname(__file__), 'process_data.py')
SOURCE_CSV = os.path.join(os.path.dirname(__file__), '../data/country_data.csv') 
OUTPUT_DIR = os.path.join(os.path.dirname(__file__), '../data/outputs')

@app.route('/api/health', methods=['GET'])
def health():
    return jsonify({"status": "ok", "system": "TITAN CENTRAL"}), 200

@app.route('/api/v1/recompute', methods=['POST'])
def recompute():
    token = request.headers.get('X-API-Token')
    if token != API_TOKEN:
        return jsonify({"error": "Unauthorized"}), 401
    
    # Launch background job (conceptually)
    try:
        # Check if dry-run
        dry_run = request.args.get('dry-run', 'false').lower() == 'true'
        
        cmd = [sys.executable, DATA_PROCESSOR_PATH, '--source', SOURCE_CSV, '--out', OUTPUT_DIR]
        
        if not dry_run:
            # Run blocking for simplicity in this example, or use subprocess.Popen for async
            result = subprocess.run(cmd, capture_output=True, text=True)
            if result.returncode != 0:
                 return jsonify({"error": "Computation Failed", "details": result.stderr}), 500
            
        return jsonify({"status": "Recomputation Complete", "mode": "dry-run" if dry_run else "live"}), 200
        
    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(port=5000)
