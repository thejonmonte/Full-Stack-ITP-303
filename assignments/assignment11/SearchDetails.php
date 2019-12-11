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

				$("#description").append("<p>Place a barbell on the floor at your feet.</p>\n<p>Bending at the waist, grip the barbell with a shoulder with overhand grip.</p>\n<p>With a slow controlled motion, roll the bar out so that your back is straight.</p>\n<p>Roll back up raising your hips and butt as you return to the starting position.</p>");
			}

			function goBack() {
				window.history.back();
			}


		</script>  
	</head>

	<body>
		<button type="button" class="btn btn-light custom-btn" onclick="goBack()">Back to Search Results</button>
				  <div class="column left-side">
				  	<img class="resize-main-image" src="https://wger.de/media/exercise-images/4/Crunches-1.png">
				  	<button type="button" class="btn btn-light custom-btn">Save To Exercises</button>
				  </div>
				  <div class="column right-side">
				  	<h1 class="title">Crunch</h1>
				  	<div id="small-size">
					  	<img class="resize-main-image" src="https://wger.de/media/exercise-images/4/Crunches-1.png">
					  	<button type="button" class="btn btn-light custom-btn">Save To Exercises</button>
					 </div>
				  	<h4 id="description"></h4>
		  			<div class="container">
		  				<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-3 resize-large">
					  			<h3 class="center">Category:</h3>
					  			<div class="container">
		  							<div class="row space">
		  								<div class="col-9">
		  									<img class="resize-image" src="images/shoulders.jpg">
		  								</div>
		  								<div class="col-3">
		  									<span>Shoulders</span>
		  								</div>
					  				</div>
					  			</div>
					  		</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-3 offset-lg-1 resize-large">
								<h3 class="center">Equipment:</h3>
								<div class="container">
		  							<div class="row space">
		  								<div class="col-9">
		  									<img class="resize-image" src="images/incline-bench.jpg">
		  								</div>
		  								<div class="col-3">
		  									<span>Incline Bench</span>
		  								</div>
					  				</div>
					  			</div>
					  			<div class="container">
		  							<div class="row space">
		  								<div class="col-9">
		  									<img class="resize-image" src="images/kettlebell.jpg">
		  								</div>
		  								<div class="col-3">
		  									<span>Kettlebell</span>
		  								</div>
					  				</div>
					  			</div>
					  		</div>
					  		<div class="col-12 col-sm-12 col-md-12 col-lg-3 offset-lg-1 resize-large">
					  			<h3 class="center">Muscles:</h3>
					  			<div class="container">
		  							<div class="row space">
		  								<div class="col-9">
		  									<img class="resize-image" src="images/obliques.png">
		  								</div>
		  								<div class="col-3">
		  									<span>Obliquus Externus Abdominis</span>
		  								</div>
					  				</div>
					  			</div>
					  			<div class="container">
		  							<div class="row space">
		  								<div class="col-9">
		  									<img class="resize-image" src="images/kettlebell.jpg">
		  								</div>
		  								<div class="col-3">
		  									<span>Kettlebell</span>
		  								</div>
					  				</div>
					  			</div>
					  		</div>
					  	</div>
		  			</div>
		  		</div>
		  			<!-- <span class="first">Abs</span>
		  			
		  			<img class="resize-image" src="images/abs.png"><span>Abs</span>
				  </div>
				</div> -->
		
	</body>
</html>