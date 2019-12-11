<?php include("Navbar.php"); ?>
<!DOCTYPE html>
<html>
	<head>


    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<title>Home Page</title>
		
		<link href="HomePage.css" rel="stylesheet">
		<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
		<script>
			window.onload = function() {
				onLoad();
				document.querySelector("#nav-home").classList.add("nav-active");
				document.querySelector("#nav-search").classList.add("nav-color");
				document.querySelector("#nav-profile").classList.add("nav-color");
				getRatings();
			}

			function getRatings() {
				ajaxPost("../backend/Database.php", "function=getRatings", function (results) {
					console.log(results);
					if (results.indexOf("ERROR") != -1) {
						alert("Error in getting reviews");
					} else {
						results = JSON.parse(results);
						displayReviews(results);
					}
				});
			}

			function displayReviews(results) {
				reviewsStr = "";
				console.log(results.length);
				for (let i = 0; i < results.length; i++) {
					reviewsStr += '<div class="review">';
					reviewsStr += '<img class="review-img" src="' + results[i].image + '">';
					reviewsStr += '<div class="review-text"><i>' + results[i].review + '</i></div>';
					reviewsStr += '<div class="review-text>- ' + results[i].name + '</div>';
					reviewsStr += '<div class="rating-header">';
					for (let j = 0; j < results[i].rating; j++) {
						reviewsStr += '<span class="fa fa-star checked"></span>';
					}
					for (let j = results[i].rating; j < 5; j++) {
						reviewsStr += '<span class="fa fa-star"></span>';
					}
					reviewsStr += '</div></div>';
					console.log(reviewsStr);
				}
				$("#reviews").html("");
				$("#reviews").append(reviewsStr);
			}
		</script>  
	</head>

	<body>
		<div class="title">To the Limit!</div>

		<div class="info">
			<div class="desc">
				<i>To the Limit!</i> is your best friend for all things workout-related. Plan out your workout days with state-of-the-art exercises that fit YOUR needs. <br /><br />Don't know where to start? We've got you covered! <i>To the Limit!</i> is here to help those of any experience level: from beginner to expert. <br /><br />Filter your searches through a wide range of choices: either through the primary body part, equipment used, or muscles trained!
			</div>


			<div id="reviews" class="reviews">
				<div class="review">
					<img class="review-img-hardcode" src="images/default-img.jpg">
					<div class="review-text"><i>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </i></div>
					<div class="review-text">- John Smith</div>
					<div class="rating-header">
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star"></span>
					</div>
				</div>

				<div class="review">
					<img class="review-img-hardcode" src="images/default-img.jpg">
					<div class="review-text"><i>My life has taken a 180 after this website. My body’s slimmed down and my wife has come back to me!</i></div>
					<div class="review-text">- John Smith</div>
					<div class="rating-header">
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star"></span>
					</div>
				</div>
			</div>
		</div>

		<a href="Search.php" class="nostyle ready">
			Click Here to Get Started!
		</a>

		<div id="name"></div>
		<div id="email"></div>
		<div id="google-image"></div>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<script>
		</script>
		
	</body>
</html>