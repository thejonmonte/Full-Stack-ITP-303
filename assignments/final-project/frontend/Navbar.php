<?php
	session_start();

	if (isset($_POST["logout"])) {
		$check = "logging out";
		session_destroy();
		session_start();
	} else if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["image"]) && isset($_POST["userID"])) {
		$check = "logging in";
		$_SESSION["name"] = $_POST["name"];
		$_SESSION["email"] = $_POST["email"];
		$_SESSION["image"] = $_POST["image"];
		$_SESSION["userID"] = $_POST["userID"];
		$_SESSION["logged_in"] = "true";
	}
?>

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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<script>
			var googleUser = {};

			var onLoad = function() {
				gapi.load('auth2', function() {
					// Ready. Make a call to gapi.auth2.init or some other API 
					auth2 = gapi.auth2.init({
						client_id: '139604446031-7m29f56l6htu0a2rbkn265jujji656ug.apps.googleusercontent.com',
						cookiepolicy: 'single_host_origin'
					});
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
			        	signIn(googleUser);
			        }, function(error) {
			        	if (!error.error.includes("popup_closed_by_user")) {
			          		alert(error.error);
			      		}
			        });
			}

			function signIn(googleUser) {
				let name = googleUser.getBasicProfile().getName();
				let email = googleUser.getBasicProfile().getEmail();
				let image = googleUser.getBasicProfile().getImageUrl();

				// Add to the database
				let encodedImage = encodeURI(image);
				ajaxPost("../backend/Login.php", "name=" + name + "&email=" + email + "&image=" + encodedImage, function(results) {
					if (results.indexOf("ERROR") != -1) {
						alert("Error in database: Please try again");
						signOut();
					} else {
						let userID = results;

						let form = document.createElement("form");
						form.method = "POST";
						form.action = document.URL;
						let nameInput = document.createElement("input");
						nameInput.style.display = "none";
						nameInput.name = "name";
						nameInput.value = name;
						form.appendChild(nameInput);
						let emailInput = document.createElement("input");
						emailInput.style.display = "none";
						emailInput.name = "email";
						emailInput.value = email;
						form.appendChild(emailInput);
						let imageInput = document.createElement("input");
						imageInput.style.display = "none";
						imageInput.name = "image";
						imageInput.value = image;
						form.appendChild(imageInput);
						let idInput = document.createElement("input");
						idInput.style.display = "none";
						idInput.name = "userID";
						idInput.value = userID;
						form.appendChild(idInput);
						document.querySelector("body").appendChild(form);
						form.submit();
					}
				});
			}

			function signOut() {
				var auth2 = gapi.auth2.getAuthInstance();
				auth2.signOut().then(function() {
					console.log('User signed out.');
				});

				var form = document.createElement("form");
				form.method = "POST";
				form.action = document.URL;
				var input = document.createElement("input");
				input.style.display = "none";
				input.name = "logout";
				input.value = "true";
				form.appendChild(input);
				document.querySelector("body").appendChild(form);
				form.submit();
			}

			function ajaxGet(endpointUrl, returnFunction){
				var xhr = new XMLHttpRequest();
				xhr.open('GET', endpointUrl, true);
				xhr.onreadystatechange = function(){
					if (xhr.readyState == XMLHttpRequest.DONE) {
						if (xhr.status == 200) {
							// When ajax call is complete, call this function, pass a string with the response
							console.log(xhr.responseText);
							returnFunction( xhr.responseText );
						} else {
							alert('AJAX Error.');
							console.log(xhr.status);
						}
					}
				}
				xhr.send();
			};


			function ajaxPost(endpointUrl, postdata, returnFunction){
				var xhr = new XMLHttpRequest();
				xhr.open('POST', endpointUrl, true);
				// When sending POST requests, need to add some info in the header
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xhr.onreadystatechange = function(){
					if (xhr.readyState == XMLHttpRequest.DONE) {
						if (xhr.status == 200) {
							returnFunction( xhr.responseText );
						} else {
							alert('AJAX Error.');
							console.log(xhr.status);
						}
					}
				}
				// Send postdata separately
				xhr.send(postdata);
			};
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
			      <?php if( !isset( $_SESSION["logged_in"] ) || !$_SESSION["logged_in"] ) :?>
			      <span id="nav-profile"></span>
			      <?php else: ?>
			      <a class="nav-item nav-link" href="Profile.php"><span id="nav-profile">Profile</span></a>
			  	  <?php endif; ?>
    			</div>
  			</div>
  			<div class="collapse navbar-collapse pos-right" id="navbarNavAltMarkup">
  				<div class="navbar-nav">
  					<?php if( !isset( $_SESSION["logged_in"] ) || !$_SESSION["logged_in"] ) :?>
  						<a class="nav-item nav-link pointer"><span id="sign-in" class="nav-color customGPlusSignIn">Sign In</span></a>
  					<?php else: ?>
  						<span id="sign-in" style="display: none"></span>
  						<a class="nav-item nav-link pointer" onclick="signOut()"><span class="nav-color">Sign Out</span></a>
  					<?php endif; ?>
    			</div>
    		</div>
		</nav>
		
	</body>
</html>