<?php include("Navbar.php"); ?>
<!DOCTYPE html>
<html>
	<head>
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<title>Search Page</title>
		<link href="Search.css" rel="stylesheet">
		<script>
			var active = null;

			window.onload = function() {
				document.querySelector("#nav-home").classList.add("nav-color");
				document.querySelector("#nav-search").classList.add("nav-active");
				document.querySelector("#nav-profile").classList.add("nav-color");

				change("exercisecategory");

				const form = document.querySelector('#search');
				form.addEventListener('submit', (event) => {
					event.preventDefault(); 
					if (document.querySelector('input[name="id"]:checked') == null) {
						alert("Please choose an option!");
					} else {
						let value = document.querySelector('input[name="id"]:checked').value;
						let type = document.createElement("input");
						type.style.display = "none";
						type.name = "type";
						type.value = active;
						let pageNum = document.createElement("input");
						pageNum.style.display = "none";
						pageNum.name = "pageNum";
						pageNum.value = 1;
						form.appendChild(type);
						form.appendChild(pageNum);
						form.submit();
					}
				});
			}

			function change(id) {
				if (active != id) {
					ajaxGet("../backend/APISearch.php?page=Search.php&type=" + id, function(results) {
						if (results.indexOf("Error") != -1) {
							document.querySelector("#error").innerHTML = results;
						} else {
							console.log(results);
							results = JSON.parse(results);
							displayResults(results);
						}
					});
					if (active != null) {
						document.querySelector("#" + active).classList.remove("active");
						document.querySelector("#" + id).classList.add("active");
						document.querySelector("#dropdownMenuLink").innerHTML = document.querySelector("#" + id).innerHTML;
					}
					active = id;
				}
			}

			function displayResults(results) {
				results = results.results;
				let remaining = 0;
				if (results.length % 4 != 0) {
					remaining = results.length % 4;
				}
				let resultsStr = "";
				console.log("Remaining to do: " + results.length-remaining);
				for (let i = 0; i < (results.length-remaining); i++) {
					if (i % 4 == 0) {
						if (i != 0) {
							resultsStr += '</div>';
						}
						resultsStr += '<div class="row">';
					}
					resultsStr += '<div class="col-6 col-sm-6 col-md-3 col-lg-3">';
					resultsStr += '<label class="pics btn btn-outline-light option">';
					resultsStr += '<input type="radio" name="id" value="' + results[i].id + '">';
					let imageName = results[i].name.replace(/\s+/g, '-').toLowerCase();
					resultsStr += '<img class="card-img-top" src="images/' + imageName + '.png" alt="Card image cap">';
					if (results[i].name.indexOf("bodyweight exercise") != -1) {
						resultsStr += '<div class="card-body"><h5 class="card-title">Bodyweight</h5></div>';
					} else {
						resultsStr += '<div class="card-body"><h5 class="card-title">' + results[i].name + '</h5></div>';
					}
					resultsStr += '</label></div>';
				}
				resultsStr += "</div>";

				if (remaining != 0) {
					resultsStr += '<div class="row">';
					for (let i = results.length-remaining; i < results.length; i++) {
						if (remaining == 3) {
							if (results.length-i == 3) {
								resultsStr += '<div class="col-6 col-sm-6 col-md-3 offset-md-2 col-lg-3 offset-lg-2">'
							} else if (results.length-i == 2) {
								resultsStr += '<div class="col-6 col-sm-6 col-md-3 col-lg-3">';
							} else if (results.length-i == 1) {
								resultsStr += '<div class="col-6 offset-3 col-sm-6 offset-sm-3 col-md-3 offset-md-0 col-lg-3">';
							}
						} else if (remaining == 2) {
							if (results.length-i == 2) {
								resultsStr += '<div class="col-6 col-sm-6 col-md-3 offset-md-3 col-lg-3 offset-lg-3">';
							} else {
								resultsStr += '<div class="col-6 col-sm-6 col-md-3 col-lg-3">';
							}
						} else if (remaining == 1) {
							resultsStr += '<div class="col-6 offset-3 col-sm-6 offset-sm-3 col-md-3 offset-md-4 col-lg-3 offset-lg-4">'
						}
						resultsStr += '<label class="pics btn btn-outline-light option">';
						resultsStr += '<input type="radio" name="id" value="' + results[i].id + '">';
						let imageName = results[i].name.replace(/\s+/g, '-').toLowerCase();
						resultsStr += '<img class="card-img-top" src="images/' + imageName + '.png" alt="Card image cap">';
						if (results[i].name.includes("bodyweight exercise")) {
							resultsStr += '<div class="card-body"><h5 class="card-title">Bodyweight</h5></div>';
						} else {
							resultsStr += '<div class="card-body"><h5 class="card-title">' + results[i].name + '</h5></div>';
						}
						resultsStr += '</label></div>';
					}
					resultsStr += '</div>';
				}

				console.log("Here's results String!");
				console.log(resultsStr);

				$("#options").html("");
				$("#options").append(resultsStr);
				configureOptions();
			}

			function configureOptions() {
		        $(".option").click(
		            function(event)
		        {
		        	var options = document.querySelectorAll(".option").forEach(e =>
		        		e.classList.remove("active"));
		            $(this).addClass("active");
		        }
		        );
		    };

		</script>  
	</head>

	<body>
		 <div class="dropdown show categories">
		 	<span>Search By: </span>
		  <a class="dropdown-toggle search-category" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Body Part
		  </a>

		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
		    <a class="dropdown-item search-category active" id="exercisecategory" onclick="change(id)">Body Part</a>
		    <a class="dropdown-item search-category" id="equipment" onclick="change(id)">Equipment</a>
		    <a class="dropdown-item search-category" id="muscle" onclick="change(id)">Muscle</a>
		  </div>

		  <span id="error" style="color: red"></span>
		</div>

			<div class="header">
            	<div class="container">
            		<form id="search" name="Search" method="GET" action="SearchResults.php">
            			<button type="submit" class="btn btn-light search-btn">Search</button>
            			<div id="options"></div>
					 </form>
				</div>
			</div> 
			
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	</body>
</html>