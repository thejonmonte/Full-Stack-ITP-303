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
			window.onload = function() {
				document.querySelector("#nav-home").classList.add("nav-color");
				document.querySelector("#nav-search").classList.add("nav-active");
			}

			function goToSearchDetails() {
				//alert(document.querySelector('input[name="' + active + '"]:checked').value);
				var link = document.createElement("a");
				link.href = "SearchDetails.php";
				document.querySelector("body").append(link);
				link.click();
			}

		</script>  
	</head>

	<body>
		<div id="results-container">
			<div id="results-num"><h1>Results: 50</h1></div>
			<div class="results">
				<div class="container">
					<div class="row">
					    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
					      <label class="pics btn btn-outline-light click" onclick="goToSearchDetails()">
								<h1 class="card-title">Deadlift</h1>
								<h5 class="card-text">Category:&nbsp&nbsp 
									<span>
										<img class="resize-image" src="images/abs.png"></span>
									</span>
								</h5>
								<h5 class="card-text">Equipment:
									<span>
										<img class="resize-image" src="images/gym-mat.jpg">
										<img class="resize-image" src="images/kettlebell.jpg">
									</span>
								</h5>
								<h5 class="card-text">Muscles:&nbsp&nbsp&nbsp&nbsp&nbsp
									<span>
										<img class="resize-image" src="images/soleus.jpg"></span>
										<img class="resize-image" src="images/obliques.png"></span>
										<img class="resize-image" src="images/serratus-anterior.jpg"></span>
									</span>
								</h5>
		                	</label>
					    </div>
					   	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
					      <label class="pics btn btn-outline-light click" onclick="goToSearchDetails()">
								<h1 class="card-title">Deadlift</h1>
								<h5 class="card-text">Category:&nbsp&nbsp 
									<span>
										<img class="resize-image" src="images/abs.png"></span>
									</span>
								</h5>
								<h5 class="card-text">Equipment:
									<span>
										<img class="resize-image" src="images/gym-mat.jpg"></span>
										<img class="resize-image" src="images/kettlebell.jpg"></span>
									</span>
								</h5>
								<h5 class="card-text">Muscles:&nbsp&nbsp&nbsp&nbsp&nbsp
									<span>
										<img class="resize-image" src="images/soleus.jpg"></span>
										<img class="resize-image" src="images/obliques.png"></span>
										<img class="resize-image" src="images/serratus-anterior.jpg"></span>
									</span>
								</h5>
		                	</label>
					    </div>
					</div>
					<div class="row">
					    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
					      <label class="pics btn btn-outline-light click" onclick="goToSearchDetails()">
								<h1 class="card-title">Deadlift</h1>
								<h5 class="card-text">Category:&nbsp&nbsp 
									<span>
										<img class="resize-image" src="images/abs.png"></span>
									</span>
								</h5>
								<h5 class="card-text">Equipment:
									<span>
										<img class="resize-image" src="images/gym-mat.jpg"></span>
										<img class="resize-image" src="images/kettlebell.jpg"></span>
									</span>
								</h5>
								<h5 class="card-text">Muscles:&nbsp&nbsp&nbsp&nbsp&nbsp
									<span>
										<img class="resize-image" src="images/soleus.jpg"></span>
										<img class="resize-image" src="images/obliques.png"></span>
										<img class="resize-image" src="images/serratus-anterior.jpg"></span>
									</span>
								</h5>
		                	</label>
					    </div>
					   	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
					      <label class="pics btn btn-outline-light click" onclick="goToSearchDetails()">
								<h1 class="card-title">Deadlift</h1>
								<h5 class="card-text">Category:&nbsp&nbsp 
									<span>
										<img class="resize-image" src="images/abs.png"></span>
									</span>
								</h5>
								<h5 class="card-text">Equipment:
									<span>
										<img class="resize-image" src="images/gym-mat.jpg"></span>
										<img class="resize-image" src="images/kettlebell.jpg"></span>
									</span>
								</h5>
								<h5 class="card-text">Muscles:&nbsp&nbsp&nbsp&nbsp&nbsp
									<span>
										<img class="resize-image" src="images/soleus.jpg"></span>
										<img class="resize-image" src="images/obliques.png"></span>
										<img class="resize-image" src="images/serratus-anterior.jpg"></span>
									</span>
								</h5>
		                	</label>
					    </div>
					</div>
					<div class="row">
					    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
					      <label class="pics btn btn-outline-light click" onclick="goToSearchDetails()">
								<h1 class="card-title">Deadlift</h1>
								<h5 class="card-text">Category:&nbsp&nbsp 
									<span>
										<img class="resize-image" src="images/abs.png"></span>
									</span>
								</h5>
								<h5 class="card-text">Equipment:
									<span>
										<img class="resize-image" src="images/gym-mat.jpg"></span>
										<img class="resize-image" src="images/kettlebell.jpg"></span>
									</span>
								</h5>
								<h5 class="card-text">Muscles:&nbsp&nbsp&nbsp&nbsp&nbsp
									<span>
										<img class="resize-image" src="images/soleus.jpg"></span>
										<img class="resize-image" src="images/obliques.png"></span>
										<img class="resize-image" src="images/serratus-anterior.jpg"></span>
									</span>
								</h5>
		                	</label>
					    </div>
					   	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
					      <label class="pics btn btn-outline-light click" onclick="goToSearchDetails()">
								<h1 class="card-title">Deadlift</h1>
								<h5 class="card-text">Category:&nbsp&nbsp 
									<span>
										<img class="resize-image" src="images/abs.png"></span>
									</span>
								</h5>
								<h5 class="card-text">Equipment:
									<span>
										<img class="resize-image" src="images/gym-mat.jpg"></span>
										<img class="resize-image" src="images/kettlebell.jpg"></span>
									</span>
								</h5>
								<h5 class="card-text">Muscles:&nbsp&nbsp&nbsp&nbsp&nbsp
									<span>
										<img class="resize-image" src="images/soleus.jpg"></span>
										<img class="resize-image" src="images/obliques.png"></span>
										<img class="resize-image" src="images/serratus-anterior.jpg"></span>
									</span>
								</h5>
		                	</label>
					    </div>
					</div>
					<div class="row">
					    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
					      <label class="pics btn btn-outline-light click" onclick="goToSearchDetails()">
								<h1 class="card-title">Deadlift</h1>
								<h5 class="card-text">Category:&nbsp&nbsp 
									<span>
										<img class="resize-image" src="images/abs.png"></span>
									</span>
								</h5>
								<h5 class="card-text">Equipment:
									<span>
										<img class="resize-image" src="images/gym-mat.jpg"></span>
										<img class="resize-image" src="images/kettlebell.jpg"></span>
									</span>
								</h5>
								<h5 class="card-text">Muscles:&nbsp&nbsp&nbsp&nbsp&nbsp
									<span>
										<img class="resize-image" src="images/soleus.jpg"></span>
										<img class="resize-image" src="images/obliques.png"></span>
										<img class="resize-image" src="images/serratus-anterior.jpg"></span>
									</span>
								</h5>
		                	</label>
					    </div>
					   	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
					      <label class="pics btn btn-outline-light click" onclick="goToSearchDetails()">
								<h1 class="card-title">Deadlift</h1>
								<h5 class="card-text">Category:&nbsp&nbsp 
									<span>
										<img class="resize-image" src="images/abs.png"></span>
									</span>
								</h5>
								<h5 class="card-text">Equipment:
									<span>
										<img class="resize-image" src="images/gym-mat.jpg"></span>
										<img class="resize-image" src="images/kettlebell.jpg"></span>
									</span>
								</h5>
								<h5 class="card-text">Muscles:&nbsp&nbsp&nbsp&nbsp&nbsp
									<span>
										<img class="resize-image" src="images/soleus.jpg"></span>
										<img class="resize-image" src="images/obliques.png"></span>
										<img class="resize-image" src="images/serratus-anterior.jpg"></span>
									</span>
								</h5>
		                	</label>
					    </div>
					</div>
					<div class="row">
					    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
					      <label class="pics btn btn-outline-light click" onclick="goToSearchDetails()">
								<h1 class="card-title">Deadlift</h1>
								<h5 class="card-text">Category:&nbsp&nbsp 
									<span>
										<img class="resize-image" src="images/abs.png"></span>
									</span>
								</h5>
								<h5 class="card-text">Equipment:
									<span>
										<img class="resize-image" src="images/gym-mat.jpg"></span>
										<img class="resize-image" src="images/kettlebell.jpg"></span>
									</span>
								</h5>
								<h5 class="card-text">Muscles:&nbsp&nbsp&nbsp&nbsp&nbsp
									<span>
										<img class="resize-image" src="images/soleus.jpg"></span>
										<img class="resize-image" src="images/obliques.png"></span>
										<img class="resize-image" src="images/serratus-anterior.jpg"></span>
									</span>
								</h5>
		                	</label>
					    </div>
					   	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
					      <label class="pics btn btn-outline-light click" onclick="goToSearchDetails()">
								<h1 class="card-title">Deadlift</h1>
								<h5 class="card-text">Category:&nbsp&nbsp 
									<span>
										<img class="resize-image" src="images/abs.png"></span>
									</span>
								</h5>
								<h5 class="card-text">Equipment:
									<span>
										<img class="resize-image" src="images/gym-mat.jpg"></span>
										<img class="resize-image" src="images/kettlebell.jpg"></span>
									</span>
								</h5>
								<h5 class="card-text">Muscles:&nbsp&nbsp&nbsp&nbsp&nbsp
									<span>
										<img class="resize-image" src="images/soleus.jpg"></span>
										<img class="resize-image" src="images/obliques.png"></span>
										<img class="resize-image" src="images/serratus-anterior.jpg"></span>
									</span>
								</h5>
		                	</label>
					    </div>
					</div>
				</div>
			</div>

			<div class="custom-pagination">
			  	<button type="button" class="btn btn-light pagination-btn">Previous</button>
			  	<button type="button" class="btn btn-light pagination-btn">Next</button>
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