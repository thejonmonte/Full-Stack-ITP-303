<?php include("Navbar.php"); ?>

<?php
	if( !isset( $_SESSION["logged_in"] ) || !$_SESSION["logged_in"] ) {
		// Redirect to Home Page
		header("Location: ./HomePage.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>


    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<title>Profile Page</title>
		
		<link href="Profile.css" rel="stylesheet">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script>
			var currID = -1;
			var deleted = 0;
			var numItems = 0;
			var review1checked = false;
			var rating = -1;
			window.onload = function() {
				document.querySelector("#nav-home").classList.add("nav-color");
				document.querySelector("#nav-search").classList.add("nav-color");
				document.querySelector("#nav-profile").classList.add("nav-active");

				initRatings();

				let reviewText = document.getElementById("review-text");
					reviewText.onkeydown = function(event) {
					console.log(document.querySelector("#review-text").value.length);
					let key = event.which || event.keyCode;
					let response = document.querySelector("#review-errors");
					if (document.querySelector("#review-text").value.length >= 100 && key != 8) {
						event.preventDefault();
						response.classList = "";
						response.classList.add("text-fail");
						response.innerHTML = "Only 100 characters!";
					} else {
						response.innerHTML = "";
					}
				}

				// Get items from database
				ajaxPost("../backend/Database.php", "function=read&userID=" + "<?php echo $_SESSION["userID"] ?>", function (results) {
						if (results.indexOf("ERROR") != -1) {
							let errorStr = '<h3 class= "response text-fail">Error in getting data</h1>';
							$("#info").append(errorStr);
						} else if (results.indexOf("No results") != -1) {
							let errorStr = '<h3 class="response">No results. Add to your workout!</h3>';
							$("#info").append(errorStr);
						} else {
							results = JSON.parse(results);
							console.log(results);
							displayResults(results);
						}
					});
			}

			function initRatings() {
				let ratings = document.querySelectorAll(".review");
				for (let i = 0; i < ratings.length; i++) {
					ratings[i].onmouseenter = function() {
						for (let j = 0; j < ratings.length; j++) {
							if (j > i) {
								ratings[j].classList.remove("checked");
							} else {
								ratings[j].classList.add("checked");
							}
						}
					}

					ratings[i].onclick = function() {
						review1checked = true;
						rating = i;
					};

					ratings[i].onmouseleave = function() {
						for (let j = 0; j <= i; j++) {
							ratings[j].classList.remove("checked");
						}
					}
				}
				document.querySelector("#reviews").onmouseleave =function() {
						if (review1checked) {
							for (let i = 0; i < ratings.length; i++) {
								if (i > rating) {
									ratings[i].classList.remove("checked");
								} else {
									ratings[i].classList.add("checked");
								}
							}
						}
					}
			}

			function displayResults(results) {
				let resultsStr = "";
				numItems = results.length;
				for (let i = 0; i < results.length; i++) {
					resultsStr += '<div id="' + results[i].workoutID + '" class="workout btn btn-outline-light">';
					resultsStr += '<h3 id="name' + results[i].workoutID + '" class="item-title">' + results[i].exerciseName + '</h3>';
					resultsStr += '<div class="container">';
					resultsStr += '<div class="row">';
					resultsStr += '<div class="col-12 col-sm-12 col-md-6 col-lg-6">';
					resultsStr += '<h4>Sets: <span id="sets' + results[i].workoutID + '">' + results[i].sets + '</span></h4>';
					resultsStr += '</div>';
					resultsStr += '<div class="col-12 col-sm-12 col-md-6 col-lg-6">';
					resultsStr += '<h4>Reps: <span id="reps' + results[i].workoutID + '">' + results[i].reps + '</span></h4>';
					resultsStr += '</div>';
					resultsStr += '</div>';
					resultsStr += '<div class="row">';
					resultsStr += '<div class="col-12 col-sm-12 col-md-8 offset-md-6 offset-lg-6 col-lg-8">';
					resultsStr += '<button type="button" class="btn edit-btn" onclick="edit(' + results[i].workoutID + ')">Edit</button>';
					resultsStr += '<button type="button" class="btn btn-danger delete-btn" onclick="deleteItem(' + results[i].workoutID + ')">Delete</button>';
					resultsStr += '</div></div></div></div>';
				}
				$("#info").append(resultsStr);
			}

			function edit(id) {
				currID = id;
				// Database call to get sets and reps
				let sets = document.querySelector("#sets" + id).innerHTML;
				let reps = document.querySelector("#reps" + id).innerHTML;
				let name = document.querySelector("#name" + id).innerHTML;
				document.querySelector("#sets").value = sets;
				document.querySelector("#reps").value = reps;
				document.querySelector("#exercise-modal-title").innerHTML = "Edit " + name;
				document.querySelector("#exercise-errors").innerHTML = "";
				$('#exercise-modal').modal('show');
			}

			function deleteItem(id) {
				// Database call to delete item
				ajaxPost("../backend/Database.php", "function=delete&workoutID=" + id, function (results) {
						if (results.indexOf("ERROR") != -1) {
							alert("Error deleting. Please try again.");
						} else {
							document.getElementById(id).remove();
							alert("Exercise successfully deleted!");
							deleted++;
							if (deleted == numItems) {
								let errorStr = '<h3 class="response">No results. Add to your workout!</h3>';
								$("#info").append(errorStr);
							}
						}
					});
			}

			function finishEdit() {
				// Add to database
				console.log("Done!");
				let sets = document.querySelector("#sets").value;
				let reps = document.querySelector("#reps").value;
				if (!sets || sets == "" || !reps || reps == "") {
					let response = document.querySelector("#exercise-errors");
					response.classList = "";
					response.classList.add("text-fail");
					response.innerHTML = "Fill out all fields.";
				} else if (isNaN(sets) || isNaN(reps)) {
					let response = document.querySelector("#exercise-errors");
					response.classList = "";
					response.classList.add("text-fail");
					response.innerHTML = "Enter only numbers.";
				} else {
					// Edit to database
					ajaxPost("../backend/Database.php", "function=update&workoutID=" + currID + "&sets=" + sets + "&reps=" + reps, function (results) {
						if (results.indexOf("ERROR") != -1) {
							let response = document.querySelector("#exercise-errors");
							response.classList = "";
							response.classList.add("text-fail");
							response.innerHTML = "Error editing. Try again.";
						} else {
							let response = document.querySelector("#exercise-errors");
							response.classList = "";
							response.classList.add("text-success");
							response.innerHTML = "Successfully edited!";
							document.querySelector("#sets" + currID).innerHTML = document.querySelector("#sets").value;

							document.querySelector("#reps" + currID).innerHTML = document.querySelector("#reps").value;
						}
					});
				}
			}

			function submitReview() {
				let reviewText = document.getElementById("review-text");
				if (reviewText.value.trim().length == 0) {
					let response = document.querySelector("#review-errors");
					response.classList = "";
					response.classList.add("text-fail");
					response.innerHTML = "Please enter a review.";
				} else if (rating == -1) {
					let response = document.querySelector("#review-errors");
					response.classList = "";
					response.classList.add("text-fail");
					response.innerHTML = "Please choose a rating.";
				} else {
					console.log(rating);
					let actualRating = rating+1;
					let reviewForURL = reviewText.value.trim().replace(/\s+/g, '-');
					ajaxPost("../backend/Database.php", "function=addRating&userID=" + "<?php echo $_SESSION["userID"] ?>" + "&rating=" + actualRating + "&review=" + reviewForURL, function (results) {
						console.log(results);
						if (results.indexOf("ERROR") != -1) {
							let response = document.querySelector("#review-errors");
							response.classList = "";
							response.classList.add("text-fail");
							response.innerHTML = "Error adding review. Try again.";
						} else {
							let response = document.querySelector("#review-errors");
							response.classList = "";
							response.classList.add("text-success");
							response.innerHTML = "Successfully added!";
						}
					});
				}
			}
		</script>  
	</head>

	<body>
		<img class="rounded" src="<?php echo $_SESSION["image"]?>" />
		<h2 class="title"><?php echo $_SESSION["name"]?>'s Workout</h2>
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#review-modal">Add Review</button>
		<div id="info">
		</div>

		<div class="modal fade" id="review-modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="review-modal-title">Add Review</h5>
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="text" id="review-text" name="review-text" placeholder="Add Review Here!" />
						<div id="reviews">
							<span class="fa fa-star review"></span>
							<span class="fa fa-star review"></span>
							<span class="fa fa-star review"></span>
							<span class="fa fa-star review"></span>
							<span class="fa fa-star review"></span>
						</div>
					</div>
					<div class="modal-footer">
						<div id="review-errors"></div>
						<button type="button" class="btn edit-btn"
							onclick="submitReview()">Submit</button>
						<button type="button" class="btn close-btn"
							data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="exercise-modal" tabindex="-1" role="dialog"
			aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exercise-modal-title">Edit Workout</h5>
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="text" id="sets" name="sets" placeholder="0" />
						<br /><br />
						<input type="text" id="reps" name="reps" placeholder="0" />
					</div>
					<div class="modal-footer">
						<div id="exercise-errors"></div>
						<button type="button" class="btn edit-btn"
							onclick="finishEdit()">Save</button>
						<button type="button" class="btn close-btn"
							data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
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