import express from 'express';
import cors from 'cors';
import fetch from 'node-fetch';

const app = express();
const PORT = process.env.PORT || 3000;

// Enable CORS for all routes
app.use(cors());

// API endpoint to fetch data from APRS API
app.get('/api/location', async (req, res) => {
    const apiURL = 'https://api.aprs.fi/api/get?name=VU2LWI-12&what=loc&apikey=194964.xPjRJblFC7JwIN16&format=json';

    try {
        // Fetch data from the APRS API using node-fetch
        const response = await fetch(apiURL);
        const data = await response.json();

        // Set CORS headers
        res.header('Access-Control-Allow-Origin', 'http://127.0.0.1:5501');
        res.header('Access-Control-Allow-Methods', 'GET');
        res.header('Access-Control-Allow-Headers', 'Content-Type');

        // Send the data to the client
        res.json(data);
    } catch (error) {
        console.error('Error fetching data:', error);
        res.status(500).send('Internal Server Error');
    }
});

// Start the server
app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});
