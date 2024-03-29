function ajax(endpoint, returnFunction) {
	let xhr = new XMLHttpRequest(); // xhr means XMLHttpRequest
	xhr.open("GET", endpoint);
	xhr.send();
	xhr.onreadystatechange = function() {
		console.log(this);

		// When iTunes gives us some kind of response, this code will get run
		if (xhr.readyState == this.DONE) {
			if (xhr.status == 200) {
				// Successfully received a response
				returnFunction(xhr.responseText);
			}
			else {
				alert("AJAX error!");
				console.log(xhr.status);
			}
		}

	}
}

function displayResults(res) {

	// Convert JSON into JS objects
	res = JSON.parse(res);
	console.log(res);
	console.log(res.results[0].overview);
	document.querySelector("#num-results").innerHTML = res.results.length;
	document.querySelector("#total-results").innerHTML = res.total_results;

	for (let i = 0; i < res.results.length; i++) {
		let outerDiv = document.createElement("outerDiv");
		outerDiv.classList.add("col-lg-3", "col-md-4", "col-sm-6", "col-6", "center");
		let img = document.createElement("img");

		if (res.results[i].poster_path == null) {
			img.src = "images/NoImage.png";
		}
		else {
			img.src = "https://image.tmdb.org/t/p/w500/" + res.results[i].poster_path;
		}
		img.classList.add("resize");
		
		let overlayDiv = document.createElement("div");
		overlayDiv.classList.add("overlay");
		let overlayRating = document.createElement("div");
		overlayRating.classList.add("text");
		overlayRating.innerHTML = "Rating: " + res.results[i].vote_average;
		let overlayVoters = document.createElement("div");
		overlayVoters.classList.add("text");
		overlayVoters.innerHTML = "Number of Voters: " + res.results[i].vote_count;
		let overlayDesc = document.createElement("div");
		overlayDesc.classList.add("text");
		if (res.results[i].overview.length > 200) {
			let substr = res.results[i].overview.substring(0, 200);
			overlayDesc.innerHTML = substr + "...";
		}
		else {
			overlayDesc.innerHTML = res.results[i].overview;
		}
		overlayDiv.appendChild(overlayRating);
		overlayDiv.appendChild(overlayVoters);
		overlayDiv.appendChild(overlayDesc);
		
		let title = document.createElement("div");
		title.innerHTML = res.results[i].title;
		let releaseDate = document.createElement("div");
		releaseDate.innerHTML = res.results[i].release_date;

		outerDiv.appendChild(img);
		outerDiv.appendChild(overlayDiv);
		outerDiv.appendChild(title);
		outerDiv.appendChild(releaseDate);

		document.querySelector(".movies").appendChild(outerDiv);
		console.log(res.results.length);
		console.log(res.total_results);
	}
}

window.onload = function() {
	let currDate = new Date();
	let year = currDate.getFullYear();
	let month = currDate.getMonth()+1;
	if (month < 10) {
		month = "0" + month;
	}
	console.log(month);
	let date = currDate.getDate();
	if (date < 10) {
		date = "0" + date;
	}
	let endpoint = "https://api.themoviedb.org/3/discover/movie?api_key=6a7d0b4cbbd64232a93192c3e433cd45&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&primary_release_date.gte=" + year + "-" + month + "-" + date;
	console.log(endpoint);

	ajax(endpoint, displayResults);
}

function clearResults() {
	let oldResults = document.querySelector(".movies");
	console.log(oldResults.length);
	while(oldResults.firstChild) oldResults.removeChild(oldResults.firstChild);
}

document.querySelector("#search-form").onsubmit = e => {
	e.preventDefault();
	let title = document.querySelector("#search-id").value.trim();
	let endpoint = "https://api.themoviedb.org/3/search/movie?api_key=6a7d0b4cbbd64232a93192c3e433cd45&language=en-US&query=" + title + "&page=1&include_adult=false";
	console.log(endpoint);
	clearResults();
	ajax(endpoint, displayResults);

	console.log("at the end of onsubmit");
}