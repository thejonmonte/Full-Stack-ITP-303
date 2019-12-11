<?php include("Navbar.php"); ?>
<!DOCTYPE html>
<html>
	<head>


    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<title>Home Page</title>
		
		<link href="HomePage.css" rel="stylesheet">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
		<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="jquery.rateyo.min.css">
		<script>
			window.onload = function() {
				document.querySelector("#nav-home").classList.add("nav-active");
				document.querySelector("#nav-search").classList.add("nav-color");
			}
		</script>  
	</head>

	<body>
		<div class="title">To the Limit!</div>

		<div class="quote">You are... great</div>

		<div class="info">
			<div class="desc">
				<i>To the Limit!</i> is your best friend for all things workout-related. Plan out your workout days with state-of-the-art exercises that fit YOUR needs. Don't know where to start? We've got you covered! <i>To the Limit!</i> is here to help those of any experience level: from beginner to expert. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore Lorem ipsum dolor Lorem ipsum dolor sit amet, consectetur adip
			</div>

			<div class="reviews">
				<div class="review">
					<img class="review-img" src="images/default-img.jpg">
					<div class="review-text"><i>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </i></div>
					<div class="review-text">- John Smith</div>
					<div>
						<div id="rating1"></div>
					</div>
				</div>

				<div class="review">
					<img class="review-img" src="images/default-img.jpg">
					<div class="review-text"><i>My life has taken a 180 after this website. My body’s slimmed down and my wife has come back to me!</i></div>
					<div class="review-text">- John Smith</div>
				</div>
			</div>
		</div>

		<a href="Search.php" class="nostyle ready">
			Click Here to Get Started!
		</a>

		<div id="name"></div>
		<div id="email"></div>
		<div id="google-image"></div>

		<script type="text/javascript" src="jquery.min.js"></script> 
		<script type="text/javascript" src="jquery.rateyo.min.js"></script> 
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<script>
		</script>
		
	</body>
</html>