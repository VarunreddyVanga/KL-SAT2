
console.log("Live data console");
fetch("https://api.aprs.fi/api/get?name=VU2LWI-12&what=loc&apikey=https://api.aprs.fi/api/get?name=VU2LWI-12&what=loc&apikey= 194964.xPjRJblFC7JwIN16&format=json").then
(function (res) {
    console.log(res.json());
});
/*https://api.aprs.fi/api/get?name=OH7RDA&what=loc&apikey=APIKEY&format=json

{
	"command":"get",
	"result":"ok",
	"what":"loc",
	"found":1,
	"entries": [
		{
			"name":"OH7RDA",
			"type":"l",
			"time":"1267445689",
			"lasttime":"1270580127",
			"lat":"63.06717",
			"lng":"27.66050",
			"symbol":"\/#",
			"srccall":"OH7RDA",
			"dstcall":"APND12",
			"phg":"44603",
			"comment":"\/R,W,Wn,Tn Siilinjarvi",
			"path":"WIDE2-2,qAR,OH7AA"
		}
	]
}