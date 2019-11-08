<?php
// Check that all required fields have been passed to this page
$isInserted = "";
if ( !isset($_POST['home_team']) || 
	empty($_POST['home_team']) || 
	!isset($_POST['away_team']) || 
	empty($_POST['away_team']) || 
	!isset($_POST['venue']) || 
	empty($_POST['venue']) || 
	!isset($_POST['day']) || 
	empty($_POST['day']) ) {
	$error = "Please fill out all required fields.";
}
else {
	// Connect to the db
	$host = "303.itpwebdev.com";
	$user = "jmontema_db_user";
	$pass = "usciscool2022";
	$db = "jmontema_football_schedule_db";

	// DB Connection.
	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}
	// Handle optional field of date
	if( isset($_POST["date"]) && !empty($_POST["date"]) ) {
		// user inputted a date
		$date = $_POST["date"];
	}
	else {
		// user did not select a date, so set it to null
		$date = "null";
	}
	
	// SQL statement to INSERT new record into the DB.
	$sql = "INSERT INTO schedule(date, day_id, venue_id, away_team_id, home_team_id)
		VALUES('" . $date . "', "
		. $_POST["day"]
		. ", "
		. $_POST["venue"]
		. ", "
		. $_POST["away_team"]
		. ", "
		. $_POST["home_team"]
		.");";
	$results = $mysqli->query($sql);
	if( !$results) {
		echo $mysqli->error;
		exit();
	}
	// If record has been inserted, mysqli->affected_rows will return 1.
	if( $mysqli->affected_rows == 1 ) {
		$isInserted = true;
	} else {
		$isInserted = false;
	}
	$mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | Footaball Schedule</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a Football Game</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if(isset($error) && !empty($error)) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>

				<?php if( $isInserted ) :?> 
					<div class="text-success">
						Game was successfully added.
					</div>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_form.php" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>