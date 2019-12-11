<?php include("Navbar.php"); ?>
<!DOCTYPE html>
<html>
	<head>


    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<title>Home Page</title>
		
		<link href="SearchDetails.css" rel="stylesheet">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
		<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="jquery.rateyo.min.css">
		<script>
			window.onload = function() {

				document.querySelector("#nav-search").classList.add("nav-active");
				document.querySelector("#nav-home").classList.add("nav-color");
				document.querySelector("#nav-profile").classList.add("nav-color");

				let id = "<?=$_GET["id"]?>";

				if (id == "" || id == null) {
					alert("Error in getting Search Details Data");
					window.history.back();
				}

				getResult(id);
			}

			function getResult(id) {
				ajaxGet("../backend/APISearch.php?page=SearchDetails.php&id=" + id, function(results) {
					if (results.indexOf("Error") != -1) {
						document.querySelector("#error").innerHTML = results;
					} else {
						results = JSON.parse(results);
						console.log(results);
						displayResult(results);
					}
				});
			}

			function displayResult(results) {
				document.querySelector("#title").innerHTML = results.name;
				document.querySelector("#exercise-modal-title").innerHTML = "Add " + results.name;
				document.querySelector("#big-image").src = results.image;
				document.querySelector("#small-image").src = results.image;
				if (results.description != null) {
					$("#description").append(results.description);
				} else {
					$("#description").html("Description Not Available.");
				}
				let infoStr = "";
				// Category Str
				if (results.category != null) {
					infoStr += '<div class="container">';
					infoStr += '<div class="row space">';
					infoStr += '<div class="col-9">';
					let categoryPic = results.category.name.replace(/\s+/g, '-').toLowerCase();
					infoStr += '<img class="resize-image" src="images/' + categoryPic + '.png">';
					infoStr += '</div>';
					infoStr += '<div class="col-3 label">';
					infoStr += '<span>' + results.category.name + '</span>';
					infoStr += '</div></div></div>';
				} else {
					infoStr += '<div class="container">';
					infoStr += '<div class="row space">';
					infoStr += '<div class="col-9">';
					infoStr += '<img class="resize-image" src="images/not_available.png">';
					infoStr += '</div>';
					infoStr += '<div class="col-3">';
					infoStr += '<span>Category N/A</span>';
					infoStr += '</div></div></div>';
				}

				$("#category-list").append(infoStr);

				console.log(infoStr);

				infoStr = "";
				if (results.equipment.length > 0) {
					for (let i = 0; i < results.equipment.length; i++) {
						infoStr += '<div class="container">';
						infoStr += '<div class="row space">';
						infoStr += '<div class="col-9">';
						let equipmentPic = results.equipment[i].name.replace(/\s+/g, '-').toLowerCase();
						infoStr += '<img class="resize-image" src="images/' + equipmentPic + '.png">'; 
						infoStr += '</div>';
						infoStr += '<div class="col-3 label">';
						let name = results.equipment[i].name;
						if (name.indexOf("(bodyweight exercise)") != -1) {
							name = "Bodyweight";
						}
						infoStr += '<span>' + name + '</span>';
						infoStr += '</div></div></div>';
					}
				} else {
					infoStr += '<div class="container">';
					infoStr += '<div class="row space">';
					infoStr += '<div class="col-9">';
					infoStr += '<img class="resize-image" src="images/not_available.png">';
					infoStr += '</div>';
					infoStr += '<div class="col-3">';
					infoStr += '<span>N/A</span>';
					infoStr += '</div></div></div>';
				}

				$("#equipment-list").append(infoStr);

				infoStr = "";

				if (results.muscles.length > 0) {
					for (let i = 0; i < results.muscles.length; i++) {
						infoStr += '<div class="container">';
						infoStr += '<div class="row space">';
						infoStr += '<div class="col-9">';
						let musclesPic = results.muscles[i].name.replace(/\s+/g, '-').toLowerCase();
						infoStr += '<img class="resize-image" src="images/' + musclesPic + '.png">'; 
						infoStr += '</div>';
						infoStr += '<div class="col-3 label">';
						let name = results.muscles[i].name;
						infoStr += '<span>' + name + '</span>';
						infoStr += '</div></div></div>';
					}
				} else {
					infoStr += '<div class="container">';
					infoStr += '<div class="row space">';
					infoStr += '<div class="col-9">';
					infoStr += '<img class="resize-image" src="images/not_available.png">';
					infoStr += '</div>';
					infoStr += '<div class="col-3">';
					infoStr += '<span>N/A</span>';
					infoStr += '</div></div></div>';
				}
				$("#muscles-list").append(infoStr);
			}

			function goBack() {
				window.history.back();
			}

			function addExercise() {
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
					// Add to database
					let exercise = document.querySelector("#title").innerHTML;
					exercise = exercise.replace(/\s+/g, '-');
					ajaxPost("../backend/Database.php", "function=create&exercise=" + exercise + "&sets=" + sets + "&reps=" + reps + "&userID=" + "<?php echo $_SESSION["userID"] ?>", function (results) {
						if (results.indexOf("ERROR") != -1) {
							let response = document.querySelector("#exercise-errors");
							response.classList = "";
							response.classList.add("text-fail");
							response.innerHTML = "Error saving. Try again.";
						} else if (results.indexOf("Already added") != -1) {
							let response = document.querySelector("#exercise-errors");
							response.classList = "";
							response.classList.add("text-fail");
							response.innerHTML = "You've already saved this.";
						} else {
							let response = document.querySelector("#exercise-errors");
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
		<button type="button" class="btn btn-light custom-btn" onclick="goBack()">Back to Search Results</button>
				  <div class="column left-side">
				  	<img class="resize-main-image" id="big-image" src="images/detail_img_not_available.png">
				  	<?php if( !isset( $_SESSION["logged_in"] ) || !$_SESSION["logged_in"] ) :?>
				  	<?php else: ?>
				  	<button type="button" class="btn btn-light custom-btn" data-toggle="modal"
					data-target="#exercise-modal" href="#exercise-modal">Save To Workout</button>
					<?php endif; ?>
				  </div>
				  <div class="column right-side">
				  	<h1 class="title" id="title">&nbsp</h1>
				  	<div id="small-size">
					  	<img class="resize-main-image" id="small-image" src="images/detail_img_not_available.png">
					  	<?php if( !isset( $_SESSION["logged_in"] ) || !$_SESSION["logged_in"] ) :?>
					  	<?php else: ?>
					  	<button type="button" class="btn btn-light custom-btn" data-toggle="modal"
						data-target="#exercise-modal" href="#exercise-modal">Save To Workout</button>
						<?php endif; ?>
					 </div>
				  	<h4 id="description"></h4>
		  			<div class="container">
		  				<div class="row category-list">
							<div class="col-12 col-sm-12 col-md-12 col-lg-3 resize-large" id="category-list">
					  			<h3 class="center">Category:</h3>
					  		</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-3 offset-lg-1 resize-large" id="equipment-list">
								<h3 class="center">Equipment:</h3>
					  		</div>
					  		<div class="col-12 col-sm-12 col-md-12 col-lg-3 offset-lg-1 resize-large" id="muscles-list">
					  			<h3 class="center">Muscles:</h3>
					  		</div>
					  	</div>
		  			</div>
		  		</div>

		  		<!-- Modal for adding to exercises-->
				<div class="modal fade" id="exercise-modal" tabindex="-1" role="dialog"
					aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exercise-modal-title"></h5>
								<button type="button" class="close" data-dismiss="modal"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<input type="text" id="sets" name="sets" placeholder="Enter # of sets" />
								<br /><br />
								<input type="text" id="reps" name="reps" placeholder="Enter # of reps" />
							</div>
							<div class="modal-footer">
								<div id="exercise-errors"></div>
								<button type="button" class="btn btn-light add-btn"
									onclick="addExercise()">Add</button>
								<button type="button" class="btn btn-light close-btn"
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
		
	</body>
</html>