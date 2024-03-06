// Install required packages using: npm install express axios

const express = require('express');
const axios = require('axios');

const app = express();
const port = 3000;

// Replace 'YOUR_API_KEY' with your actual API key
const apiKey = 'YOUR_API_KEY';
const apiUrl = `https://api.aprs.fi/api/get?name=VU2LWI-12&what=loc&apikey=${apiKey}`;

app.get('/api/data', async (req, res) => {
  try {
    const response = await axios.get(apiUrl);
    res.json(response.data);
  } catch (error) {
    console.error('Error fetching data:', error.message);
    res.status(500).send('Internal Server Error');
  }
});

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
