<?php include("Navbar.php"); ?>

<!DOCTYPE html>
<html>
	<head>

    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<title>Home Page</title>
		
		<link href="SearchResults.css" rel="stylesheet">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
		<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="jquery.rateyo.min.css">
		<script>
			var type = null;
			var id = null;
			var pageNum = 1;
			var resultsStr = null;
			window.onload = function() {
				document.querySelector("#nav-home").classList.add("nav-color");
				document.querySelector("#nav-search").classList.add("nav-active");
				document.querySelector("#nav-profile").classList.add("nav-color");
				type = "<?=$_GET["type"]?>";
				id = "<?=$_GET["id"]?>";
				if (type == "" || id == "" || type == null || id == null) {
					alert("Error in getting Search Results Data");
					window.history.back();
				}
				getResults();
			}

			function getResults() {
				// Note: ajaxGet is included in the Navbar.php
				ajaxGet("../backend/APISearch.php?pageNum=" + pageNum + "&page=SearchResults.php&type=" + type + "&id=" + id, function(results) {
					if (results.indexOf("Error") != -1) {
						document.querySelector("#error").innerHTML = results;
					} else {
						results = JSON.parse(results);
						console.log(results);
						displayResults(results);
					}
				});
			}

			function displayResults(results) {
				document.querySelector("#add-results-num").innerHTML = results.count;
				if (results.count > 0) {
					let resultsArray = results.results;
					resultsStr = "";
					for (let i = 0; i < resultsArray.length; i++) {
						if (i % 2 == 0) {
							if (i != 0) {
								resultsStr += '</div>';
							}
							resultsStr += '<div class="row">';
						}
						if (i == resultsArray.length-1 && resultsArray.length % 2 != 0) {
							resultsStr += '<div class="col-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3">';
						} else {
							resultsStr += '<div class="col-12 col-sm-12 col-md-6 col-lg-6">';
						}
						resultsStr += '<label class="pics btn btn-outline-light click" onclick="goToSearchDetails(' + resultsArray[i].id + ')">';
						resultsStr += '<h4 class="card-title">' + resultsArray[i].name + '</h4>';
						resultsStr += '<h5 class="card-text">Category:&nbsp&nbsp&nbsp';
						resultsStr += '<span>';
						let categoryPic = resultsArray[i].category.name.replace(/\s+/g, '-').toLowerCase();
						resultsStr += '<img class="resize-image" src="images/' + categoryPic + '.png">';
						resultsStr += '</span>';
						resultsStr += '</h5>';
						resultsStr += '<h5 class="card-text">Equipment:&nbsp';
						resultsStr += '<span>';
						if (resultsArray[i].equipment.length > 0) {
							for (let j = 0; j < resultsArray[i].equipment.length; j++) {
								let equipmentPic = resultsArray[i].equipment[j].name.replace(/\s+/g, '-').toLowerCase();
								resultsStr += '<img class="resize-image" src="images/' + equipmentPic + '.png">'; 
							}
						} else {
							resultsStr += '<img class="resize-image" src="images/not_available.png">';
						}
						resultsStr += '</span>';
						resultsStr += '</h5>';
						resultsStr += '<h5 class="card-text">Muscles:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
						resultsStr += '<span>';
						if (resultsArray[i].muscles.length > 0) {
							for (let j = 0; j < resultsArray[i].muscles.length; j++) {
								let musclePic = resultsArray[i].muscles[j].name.replace(/\s+/g, '-').toLowerCase();
								resultsStr += '<img class="resize-image" src="images/' + musclePic + '.png">'; 
							}
						} else {
							resultsStr += '<img class="resize-image" src="images/not_available.png">';
						}
						resultsStr += '</span>';
						resultsStr += '</h5>';
						resultsStr += '</label>';
						resultsStr += '</div>';

					}

					resultsStr += '</div>';

					resultsStr += '<div class="col-6 offset-3 col-sm-6 offset-sm-4 col-md-6 offset-md-4 col-lg-6 offset-lg-5">';
					if (results.previous == null) {
						resultsStr += '<button type="button" style="visibility: hidden" class="btn btn-light pagination-btn" onclick="checkPrev()">Previous</button>';
					} else {
						resultsStr += '<button type="button" class="btn btn-light pagination-btn" onclick="checkPrev()">Previous</button>';
					}

					if (results.next == null) {
						resultsStr += '<button type="button" style="visibility: hidden" class="btn btn-light pagination-btn" onclick="checkNext()">Next</button>';
					} else {
						resultsStr += '<button type="button" class="btn btn-light pagination-btn" onclick="checkNext()">Next</button>';
					}
					resultsStr += '</div>';

					$("#results-list").html("");
						$("#results-list").append(resultsStr);
				} else {
					document.querySelector("#error").innerHTML = "No results could be found.";
				}
			}

			function checkPrev() {
				pageNum--;
				getResults();
			}

			function checkNext() {
				pageNum++;
				getResults();
			}

			function goToSearchDetails(id) {
				var link = document.createElement("a");
				link.href = "SearchDetails.php?id=" + id;
				document.querySelector("body").append(link);
				link.click();
			}

		</script>  
	</head>

	<body>
		<div id="results-container">
			<div id="results-num"><h1>Results: <span id="add-results-num"></span></h1></div>
			<h3 style="color: red; text-align: center;" id="error"></h3>
			<div class="results">
				<div id="results-list" class="container">
				
				</div>
			</div>

			

			<div id="name"></div>
			<div id="email"></div>
			<div id="google-image"></div>
		</div>

		<script type="text/javascript" src="jquery.min.js"></script> 
		<script type="text/javascript" src="jquery.rateyo.min.js"></script> 
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<script>
		</script>
		
	</body>
</html>