// server.mjs
import express from 'express';
import fetch from 'node-fetch';

const app = express();
const port = 3000;

app.use(express.static('public'));

app.get('/api/data', async (req, res) => {
  const apiKey = '194964.xPjRJblFC7JwIN16';
  const apiUrl = `https://api.aprs.fi/api/get?name=VU2LWI-12&what=loc&apikey=${apiKey}`;

  try {
    const response = await fetch(apiUrl);
    const data = await response.json();

    res.json(data);
  } catch (error) {
    console.error('Error fetching data from API:', error);
    res.status(500).json({ error: 'Internal Server Error' });
  }
});

app.listen(port, () => {
  console.log(`Server is running at http://localhost:${port}`);
});
