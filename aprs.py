from flask import Flask, render_template
from datetime import datetime
import requests
import time

app = Flask(__name__)

callsign = 'VU2LWI-12'
apikey = '194964.xPjRJblFC7JwIN16'

@app.route('/')
def index():
    return render_template('index.html', location=get_location())

def get_location():
    url = f'https://api.aprs.fi/api/get?name={callsign}&what=loc&apikey={apikey}&format=json'
    response = requests.get(url=url)
    data = response.json()['entries'][0]
    name = data['name']
    lat = data['lat']
    long = data['lng']
    timefirst = datetime.fromtimestamp(int(data['time'])).strftime('%Y-%m-%d %H:%M:%S')
    timelast = datetime.fromtimestamp(int(data['lasttime'])).strftime('%Y-%m-%d %H:%M:%S')

    return {
        'name': name,
        'lat': lat,
        'long': long,
        'timefirst': timefirst,
        'timelast': timelast
    }

if __name__ == '__main__':
    app.run(debug=True)

while True:
    time.sleep(30)
    with app.app_context():
        print(get_location())
