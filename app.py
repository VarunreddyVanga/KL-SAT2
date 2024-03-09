# app.py
import requests
import time
from flask import Flask, render_template

app = Flask(__name__)

# Replace 'YOUR_API_KEY' with your actual APRS.fi API key
API_KEY = 'YOUR_API_KEY'
CALLSIGN = 'VU2LWI-12'

def fetch_location():
    api_url = f'https://api.aprs.fi/api/get?name={CALLSIGN}&what=loc&apikey={API_KEY}&format=json'
    response = requests.get(api_url)

    if response.status_code == 200:
        data = response.json()
        location = data['entries'][0]['lat'], data['entries'][0]['lng']
        return location
    else:
        return None

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/get_location')
def get_location():
    location = fetch_location()
    return {'location': location}

if __name__ == '__main__':
    app.run(debug=True)
