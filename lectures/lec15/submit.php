<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Intro to PHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Intro to PHP</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4 mb-3">PHP Output</h2>

			<div class="col-12">
				<!-- Display Test Output Here -->

				<?php
					// Write PHP here!
					echo "<strong>Hello World</strong>";
					echo "<hr>";

					// Variables
					$name = "Hello World";
					$age = 18;

					// Conditional statements
					// isset() - does a variable $name exist?
					// empty() - is a variable empty?
					if( isset($name) && !empty($name) ) {
						echo $name;
					}
					else {
						echo $age;
					}

					echo "<hr>";
					// Another useful method var_dump() - prints out
					// more information about the variable than echo
					var_dump($name);
					echo "<hr>";

					// Concatenation - use period (.) to add strings
					echo "My name is " . $name;
					echo "<hr>";

					// With double quotes, you can utilize variable
					// interpolation.
					echo "My name is $name";
			echo "<hr>";
					// However, with single quotes around a string turns off
					// variable interpolation
					echo 'My name is $name';

					// W/ double I can also use escape sequences
					echo "<hr>";
					echo "My name is <br />";
					echo $name;

					echo "<hr>";

					echo "My name is \"Jonathan\" ";

					// Can use print, but echo is more common and can do a more than print can
					// print "My name "

					echo "<hr>";
					// Date/Time
					date_default_timezone_set('America/Los_Angeles');
					echo date("m-d-y H:i");
					echo "<hr>";

					// Arrays!
					$colors = ["red", "blue", "green"];
					echo $colors[0];

					echo "<hr>";

					// Loop through the array using a for loop
					for($i = 0; $i < sizeof($colors); $i++) {
						echo $colors[$i] . ", ";
					}

					// Associative arrays - arrays w/ string keys
					$courses = [
						"ITP 303" => "Full-Stack Web Development",
						"ITP 404" => "Advanced Front-End",
						"ITP 405" => "Advanced Back-End"
					];
					$states = [
						"CA" => "California",
						"AZ" => "Arizona",
						"NY" => "New York"
					];

					echo "<hr>";
					echo $courses["ITP 303"];

					$tmpVar = "ITP 404";
					echo "<hr>";
					echo $courses[$tmpVar];

					echo "<hr>";

					// Loop through the associative array
					foreach( $courses as $courseNumber => $courseName) {
						echo $courseNumber . ": " . $courseName;
						echo "<br />";
					}

					echo "<hr>";
					// Also common - loop through & only print out the values
					foreach( $courses as $courseName) {
						echo $courseName;
						echo "<br />";
					}

					// Another way to see data in array:
					echo "<hr>";
					var_dump($courses);

					// Older way to create arrays
					$numbers = array(1,2,3,4);

					// SUPERGLOBALS - a variable that is always available.
					echo "<hr>";
					var_dump( $_SERVER );
					echo "<hr>";
					echo $_SERVER["HTTP_HOST"];

					echo "<hr>";
					echo "<strong> GET superglobal:</strong><br />";
					var_dump($_GET);

					echo "<hr>";
					echo "<strong> POST superglobal:</strong><br />";
					var_dump($_POST);

					echo "<hr>";
					echo $_POST["name"];

				?>

			</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4">Form Data</h2>

		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-3 text-right">Name:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php
					// Validate
					if(isset($_POST["name"]) && !empty($_POST["name"])) {
						echo $_POST["name"];
					} else {
						echo "<div class='text-danger'>Not provided.</div>";
					}
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Email:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Current Student:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subscribe:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
			<?php
				// validate
				// echo out ALL the subscribe checkboxes that user checked
			foreach($_POST["subscribe"] as $subscribe) {
				echo $subscribe . ", ";
			}

			?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subject:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Message:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->
	
</body>
</html>