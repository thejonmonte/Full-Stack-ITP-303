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

	//for (let i = 0; i < res.results.length)

	console.log(res.results[0].overview);
	document.querySelector("#num-results").innerHTML = res.results.length;
	document.querySelector("#total-results").innerHTML = res.total_results;

	for (let i = 0; i < res.results.length; i++) {
		let outerDiv = document.createElement("outerDiv");
		outerDiv.classList.add("col-lg-3", "col-md-4", "col-sm-6", "col-6", "center");
		let img = document.createElement("img");

		//testImage(res.results[i].poster_path, img);
		img.src = "https://image.tmdb.org/t/p/w500/" + res.results[i].poster_path;
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

	// // Create a bunch of HTML elements so we can show the results on the browser in a nicely formatted way
	// let tbodyElement = document.querySelector("tbody");

	// while(tbodyElement.hasChildNodes()) {
	// 	tbodyElement.removeChild(tbodyElement.lastChild);
	// }

	// // Update the result count
	// document.querySelector("#num-results").innerHTML = resultObject.resultCount;

	// // Run through the results and create a <tr> element for each result
	// for (let i = 0; i < resultObject.results.length; i++) {
	// 	let trElement = document.createElement("tr");

	// 	let cellCover = document.createElement("td");
	// 	let cellArtist = document.createElement("td");
	// 	let cellTrack = document.createElement("td");
	// 	let cellAlbum = document.createElement("td");
	// 	let cellPreview = document.createElement("td");

	// 	// Create <img> tag for cover image
	// 	let imgElement = document.createElement("img");
	// 	imgElement.src = resultObject.results[i].artworkUrl100;

	// 	// Append the <img> tag to its <td> tag
	// 	cellCover.appendChild(imgElement);

	// 	console.log(cellCover);

	// 	cellArtist.innerHTML = resultObject.results[i].artistName;
	// 	cellTrack.innerHTML = resultObject.results[i].trackName;
	// 	cellAlbum.innerHTML = resultObject.results[i].collectionName;

	// 	// Create <audio> tag for preview
	// 	let audioElement = document.createElement("audio");
	// 	audioElement.src = resultObject.results[i].previewUrl;
	// 	audioElement.controls = true;
	// 	// Controls: allow you to turn on and turn off the sound

	// 	// Append the <audio> tag to its <td> tag
	// 	cellPreview.appendChild(audioElement);

	// 	// Append <td> tags to the <tr> tag
	// 	trElement.appendChild(cellCover);
	// 	trElement.appendChild(cellArtist);
	// 	trElement.appendChild(cellTrack);
	// 	trElement.appendChild(cellAlbum);
	// 	trElement.appendChild(cellPreview);

	// 	console.log(trElement);

	// 	// Append the tr tag to the tbody
	// 	tbodyElement.appendChild(trElement);
	// }

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