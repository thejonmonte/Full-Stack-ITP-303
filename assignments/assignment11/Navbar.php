<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<meta charset="utf-8">

		<meta name="google-signin-client_id"
		content="877729501666-alvlvp4gogllj55cs5mb1nv39jcj03hl.apps.googleusercontent.com">
		<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="Navbar.css" rel="stylesheet">
		<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>

		<script>
			var googleUser = {};

			var startApp = function() {
				gapi.load('auth2', function() {
					// Ready. Make a call to gapi.auth2.init or some other API 
					auth2 = gapi.auth2.init({
						client_id: '139604446031-7m29f56l6htu0a2rbkn265jujji656ug.apps.googleusercontent.com',
						cookiepolicy: 'single_host_origin'
					});
					console.log("Hi!");
					attachSignin(document.querySelector("#sign-in"));
				});
			}

			function attachSignin(element) {
			    console.log(element.id);
			    auth2.attachClickHandler(element, {},
			        function(googleUser) {
			        	let name = googleUser.getBasicProfile().getName();
			        	if (name.indexOf(' ') != -1) {
			        		name = name.substr(0, name.indexOf(' '));
			        	}
			          document.getElementById('name').innerText = "Signed in: " +
			              name;
			          document.getElementById('email').innerText = "Email: " +
			              googleUser.getBasicProfile().getEmail();
			          let image = document.createElement('img');
			          image.src = googleUser.getBasicProfile().getImageUrl();
			          image.style.borderRadius = "50%";
			          alert("Image src is " + image.src);
			          document.querySelector("#google-image").appendChild(image);
			        }, function(error) {
			        	if (!error.error.includes("popup_closed_by_user")) {
			          		alert(error.error);
			      		}
			        });
			}
		</script>

	</head>

	<body>
		<div class="top">
			<img class="top-bg-image" src="images/plank.png" />
			<img class="top-bg-image" src="images/pushup.png" />
			<img class="top-bg-image" src="images/crunch.png" />
		</div>
		<nav class="navbar navbar-expand-lg navbar-expand-md navbar-light nav-background">
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-icon"></span>
  			</button>
  			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    			<div class="navbar-nav">
    			  <a class="navbar-brand mb-0 h1" href="HomePage.php"><span class="nav-title">To the Limit!</span></a>
			      <a class="nav-item nav-link" href="HomePage.php"><span id="nav-home">Home</span></a>
			      <a class="nav-item nav-link" href="Search.php"><span id="nav-search">Search</span></a>
    			</div>
  			</div>
  			<div class="collapse navbar-collapse pos-right" id="navbarNavAltMarkup">
  				<div class="navbar-nav">
    				<a class="nav-item nav-link" href="#"><span id="sign-in" class="nav-color customGPlusSignIn">Sign In</span></a>
    			</div>
    		</div>
		</nav>

		<!-- <script type="text/javascript" src="jquery.min.js"></script> 
		<script type="text/javascript" src="jquery.rateyo.min.js"></script> 
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

		<script>
			startApp();
		</script>
		
	</body>
</html>