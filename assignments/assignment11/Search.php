<?php include("Navbar.php"); ?>
<!DOCTYPE html>
<html>
	<head>


    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<title>Search Page</title>
		
		<link href="Search.css" rel="stylesheet">

		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
		<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="jquery.rateyo.min.css"> -->
		<script>
			var active = "body-part";

			window.onload = function() {
				document.querySelector("#nav-home").classList.add("nav-color");
				document.querySelector("#nav-search").classList.add("nav-active");

				document.querySelector(".equipment").style.display = "none";
				document.querySelector(".muscle").style.display = "none";

				const form = document.querySelector('#search');
				form.addEventListener('submit', (event) => {
					event.preventDefault();
					//alert(document.querySelector('input[name="' + active + '"]:checked').value);
					var link = document.createElement("a");
					link.href = "SearchResults.php";
					document.querySelector("body").append(link);
					link.click();
				});
			}

			function change(id) {
				if (active != id) {
					document.querySelector("#" + active).classList.remove("active");
					document.querySelector("#" + id).classList.add("active");
					document.querySelector("#dropdownMenuLink").innerHTML = document.querySelector("#" + id).innerHTML;
					document.querySelector("." + active).style.display = "none";
					document.querySelector("." + id).style.display = "";
					active = id;
				}
			}

			$(document).ready(
			function()
			    {
			        $(".option").click(
			            function(event)
			        {
			        	var options = document.querySelectorAll(".option").forEach(e =>
			        		e.classList.remove("active"));
			            $(this).addClass("active");
			        }
			        );
			    });

			// document.getElementById("search").addEventListener("submit", function(event){
			// 	console.log("Inside!");
			// 	event.preventDefault();
			// 	alert("HEYYY!");
			// });

		</script>  
	</head>

	<body>
		 <div class="dropdown show categories">
		 	<span>Search By: </span>
		  <a class="dropdown-toggle search-category" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Body Part
		  </a>

		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
		    <a class="dropdown-item search-category active" id="body-part" onclick="change(id)">Body Part</a>
		    <a class="dropdown-item search-category" id="equipment" onclick="change(id)">Equipment</a>
		    <a class="dropdown-item search-category" id="muscle" onclick="change(id)">Muscle</a>
		  </div>
		</div>

		<div class="options">
			<div class="header">
            <!-- <label for="display-name">Display Name:</label> <input id="display-name" type="text" name="userName"><br/><br/> -->
                    	<div class="container">
                    		<form id="search" name="Search" method="GET">
                    		<button id="submit" type="submit" class="btn btn-light search-btn">Search</button>
                    	<div class="body-part">
						  <div class="row">
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="pics btn btn-outline-light option" id="pic1">
                                <input type="radio" name="body-part" value="10">
								  <img class="card-img-top " src="images/abs.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Abs</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="pics btn btn-outline-light option">
                                <input type="radio" name="body-part" value="8">
								  <img class="card-img-top " src="images/arms.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Arms</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="pics btn btn-outline-light option">
                                <input type="radio" name="body-part" value="12">
								  <img class="card-img-top" src="images/back.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Back</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="pics btn btn-outline-light option">
                                <input type="radio" name="body-part" value="14">
								  <img class="card-img-top" src="images/calf.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Calves</h5>
								  </div>
                            	</label>
						    </div>
						  </div>
						  <div class="row">
						  	<div class="col-6 col-sm-6 col-md-3 offset-md-2 col-lg-3 offset-lg-2">
						      <label class="pics btn btn-outline-light option">
                                <input type="radio" name="body-part" value="11">
								  <img class="card-img-top" src="images/chest.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Chest</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="pics btn btn-outline-light option">
                                <input type="radio" name="body-part" value="9">
								  <img class="card-img-top" src="images/legs.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Legs</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 offset-3 col-sm-6 offset-sm-3 col-md-3 offset-md-0 col-lg-3">
						      <label class="pics btn btn-outline-light option">
                                <input type="radio" name="body-part" value="13">
								  <img class="card-img-top" src="images/shoulders.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Shoulders</h5>
								  </div>
                            	</label>
						    </div>
						  </div>
						</div>

						<div class="equipment">
						  <div class="row">
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="equipment" value="10">
								  <img class="card-img-top" src="images/barbell.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Barbell</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic2">
                                <input type="radio" name="equipment" value="8">
								  <img class="card-img-top" src="images/bench.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Bench</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="equipment" value="3">
								  <img class="card-img-top" src="images/dumbbell.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Dumbbell</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="equipment" value="4">
								  <img class="card-img-top" src="images/gym-mat.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Gym Mat</h5>
								  </div>
                            	</label>
						    </div>
						  </div>
						  <div class="row">
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="equipment" value="9">
								  <img class="card-img-top" src="images/incline-bench.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Incline Bench</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic2">
                                <input type="radio" name="equipment" value="10">
								  <img class="card-img-top" src="images/kettlebell.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Kettlebell</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="equipment" value="7">
								  <img class="card-img-top" src="images/bodyweight.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Bodyweight</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="equipment" value="6">
								  <img class="card-img-top" src="images/pullup.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Pull-up Bar</h5>
								  </div>
                            	</label>
						    </div>
						  </div>
						  <div class="row">
						    <div class="col-6 col-sm-6 col-md-3 offset-md-3 col-lg-3 offset-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="equipment" value="5">
								  <img class="card-img-top" src="images/swiss-ball.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Swiss Ball</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="equipment" value="2">
								  <img class="card-img-top" src="images/sz-bar.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">SZ-Bar</h5>
								  </div>
                            	</label>
						    </div>
						  </div>
						</div>

						<div class="muscle">
						  <div class="row">
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="muscle" value="2">
								  <img class="card-img-top" src="images/delts.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Anterior Deltoid</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic2">
                                <input type="radio" name="muscle" value="1">
								  <img class="card-img-top" src="images/biceps-brachii.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Biceps Brachii</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="muscle" value="11">
								  <img class="card-img-top" src="images/biceps-femoris.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Biceps Femoris</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="muscle" value="13">
								  <img class="card-img-top" src="images/brachialis.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Brachialis</h5>
								  </div>
                            	</label>
						    </div>
						  </div>
						  <div class="row">
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="muscle" value="7">
								  <img class="card-img-top" src="images/gastrocnemius.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Gastrocnemius</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3 check-size">
						      <label class="btn btn-outline-light option" id="pic2">
                                <input type="radio" name="muscle" value="8">
								  <img class="card-img-top" src="images/gluteus-maximus.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Gluteus Maximus</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="muscle" value="12">
								  <img class="card-img-top" src="images/lats.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Latissiumus Dorsi</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="muscle" value="14">
								  <img class="card-img-top" src="images/obliques.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title obliques">Obliquus Externus Abdominis</h5>
								  </div>
                            	</label>
						    </div>
						  </div>
						  <div class="row">
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="muscle" value="4">
								  <img class="card-img-top" src="images/pectoralis-major.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Pectoralis Major</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3 check-size">
						      <label class="btn btn-outline-light option" id="pic2">
                                <input type="radio" name="muscle" value="10">
								  <img class="card-img-top" src="images/pectoralis-major.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Quadriceps Femoris</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="muscle" value="6">
								  <img class="card-img-top" src="images/rectus-abdominis.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Rectus Abdominis</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="btn btn-outline-light option" id="pic1">
                                <input type="radio" name="muscle" value="3">
								  <img class="card-img-top" src="images/serratus-anterior.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title obliques">Serratus Anterior</h5>
								  </div>
                            	</label>
						    </div>
						  </div>
						  <div class="row">
						  	<div class="col-6 col-sm-6 col-md-3 offset-md-2 col-lg-3 offset-lg-2">
						      <label class="pics btn btn-outline-light option">
                                <input type="radio" name="muscle" value="15">
								  <img class="card-img-top" src="images/soleus.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Soleus</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
						      <label class="pics btn btn-outline-light option">
                                <input type="radio" name="muscle" value="9">
								  <img class="card-img-top" src="images/traps.jpg" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Trapezius</h5>
								  </div>
                            	</label>
						    </div>
						    <div class="col-6 offset-3 col-sm-6 offset-sm-3 col-md-3 offset-md-0 col-lg-3">
						      <label class="pics btn btn-outline-light option">
                                <input type="radio" name="muscle" value="5">
								  <img class="card-img-top" src="images/triceps.png" alt="Card image cap">
								  <div class="card-body">
								    <h5 class="card-title">Triceps Brachii</h5>
								  </div>
                            	</label>
						    </div>
						  </div>
       					 </form>
						</div>
		</div> 

		<script type="text/javascript" src="jquery.min.js"></script> 
		<script type="text/javascript" src="jquery.rateyo.min.js"></script> 
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	</body>
</html>