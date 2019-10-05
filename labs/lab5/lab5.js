$.ajax({
	method: "GET",
	url: "https://api.weatherbit.io/v2.0/current",
	data: {
		key: "43a41be5410c45a5ab683b2e682ca2df",
		city: "Los+Angeles,California",
		units: "I"
	}
})
.done( function(results){
	displayResults(results);
})
.fail(function() {
	console.log("ERROR");
})

function displayResults(results) {
	console.log(results);
	let parseJSON = results['data'][0];
	let city = parseJSON['city_name'];
	let temp = parseJSON['temp'];
	let feelLike = parseJSON['app_temp'];
	let desc = parseJSON['weather']['description'];
	console.log(city);
	console.log(temp);
	console.log(feelLike);
	console.log(desc);
	$('#weather').html("Today's weather in " + city + ": " + temp + "° " + desc + ". Feels like " + feelLike + "°");
}
// 43a41be5410c45a5ab683b2e682ca2df API Key
// https://api.weatherbit.io/v2.0/current