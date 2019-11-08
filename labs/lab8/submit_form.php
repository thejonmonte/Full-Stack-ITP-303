<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Confirmation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-5 mb-3">Order Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	
	<div class="container">

		<div class="row mt-3">
			<div>
				<!-- Change this to date/time that this was submitted. -->
				<?php
					date_default_timezone_set('America/Los_Angeles');
					$date = getdate();
					echo "This form was submitted on " . $date["weekday"] . ", " . $date["month"] . " " . $date["mday"] .
					", " . $date["year"];

					$time = $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"];
					echo " at " . date("g:i:s a", strtotime($time));
				?>
			</div>
		</div>

		<div class="row mt-4">
			<div class="col-4 text-right">Full Name:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				
				<?php
					// Validate
					$first = $_POST["fname"];
					$last = $_POST["lname"];
					if (!isset($first) || empty($first) || !isset($last) || empty($last)) {
						echo "<div class='text-danger'>Not provided.</div>";
					} else {
						echo $first . " " . $last;
					}
				?>

			</div>
		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-4 text-right">Phone Number Match:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					// Validate
					$phone = $_POST["phone"];
					$phoneconf = $_POST["phone-confirm"];
					if (!isset($phone) || empty($phone)) {
						echo "<div class='text-danger'>Not provided.</div>";
					} else if($phone == $phoneconf) {
						echo "<div class='text-success'>Phone Numbers match.</div>";
						echo "<div>" . $phone . "</div>";
					} else {
						echo "<div class='text-danger'>Phone Numbers do not match.</div>";
					}
				?>
			</div>
		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-4 text-right">Order:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					// Validate
					if (isset($_POST["order"])) {
						$order = $_POST["order"];
						if (empty($order)) {
							echo "<div class='text-danger'>Not provided.</div>";
						} else {
							echo "<div>" . $order . "</div>";
						}
					} else {
						echo "<div class='text-danger'>Not provided.</div>";
					}
				?>
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-4 text-right">Size:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					// Validate
					if (isset($_POST["size"])) {
						$size = $_POST["size"];
						if (empty($size)) {
							echo "<div class='text-danger'>Not provided.</div>";
						} else {
							echo "<div>" . $size . "</div>";
						}
					} else {
						echo "<div class='text-danger'>Not provided.</div>";
					}
				?>
			</div>
		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-4 text-right">Flavor shot(s): </div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					// Validate
					if (isset($_POST["flavor"])) {
						foreach($_POST["flavor"] as $flavor) {
							echo $flavor . " ";
						}
					} else {
						echo "<div>None.</div>";
					}
				?>
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->

</body>
</html>