console.log("Live data console");
fetch('https://api.aprs.fi/api/get?name=VU2LWI-12&apikey=194964.xPjRJblFC7JwIN16')
      .then(response => response.json())
      .then(json => console.log(json))
