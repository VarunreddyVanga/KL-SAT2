import express from 'express';
import fetch from 'node-fetch';
import cors from 'cors';

const app = express();
const port = 3000;

let cachedData = null;
const apiKey = '194964.xPjRJblFC7JwIN16';

// Fetch data initially and then schedule periodic updates
async function fetchData() {
  try {
    const response = await fetch(`https://api.aprs.fi/api/get?name=VU2LWI-12&what=loc&apikey=${apiKey}`);
    cachedData = await response.json();
  } catch (error) {
    console.error('Error fetching data from API:', error);
  }
}

// Fetch data initially
fetchData();

// Schedule periodic updates (every hour in this example)
setInterval(fetchData, 3600000); // Fetch data every hour

// Enable CORS
app.use(cors());

app.get('/api/data', (req, res) => {
  if (cachedData) {
    res.json(cachedData);
  } else {
    res.status(500).json({ error: 'Data not available' });
  }
});

app.listen(port, () => {
  console.log(`Server is running at http://localhost:${port}`);
});
