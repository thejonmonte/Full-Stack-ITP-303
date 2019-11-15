<?php
	require "config/config";
	$isInserted = "";
	// Check that all required fields have been passed to this page
	if ( !isset($_POST['title']) || empty($_POST['title'])) {
		$error = "Please fill in a title.";
	} else {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}
		// Set the character set
		$mysqli->set_charset('utf-8');

		if( isset($_POST["release_date"]) && !empty($_POST["release_date"]) ) {
			// user inputted a release date
			$release_date = $_POST["release_date"];
		}
		else {
			// user did not input a release date, so set it to null
			$release_date = null;
		}
		if( isset($_POST["album_id"]) && !empty($_POST["album_id"]) ) {
			// user selected an album
			$album_id = $_POST["album_id"];
		}
		else {
			// user did not select an album, so set it to null
			$album_id = null;
		}
		if( isset($_POST["label_id"]) && !empty($_POST["label_id"]) ) {
			// user selected a label
			$label_id = $_POST["label_id"];
		}
		else {
			// user did not select a label, so set it to null
			$label_id = null;
		}
		if( isset($_POST["sound_id"]) && !empty($_POST["sound_id"]) ) {
			// user selected a sound
			$sound_id = $_POST["sound_id"];
		}
		else {
			// user did not select a sound, so set it to null
			$sound_id = null;
		}
		if( isset($_POST["genre_id"]) && !empty($_POST["genre_id"]) ) {
			// user selected a genre
			$genre_id = $_POST["genre_id"];
		}
		else {
			// user did not select a genre, so set it to null
			$genre_id = null;
		}
		if( isset($_POST["rating_id"]) && !empty($_POST["rating_id"]) ) {
			// user selected a rating
			$rating_id = $_POST["rating_id"];
		}
		else {
			// user did not select a rating, so set it to null
			$rating_id = null;
		}
		if( isset($_POST["format_id"]) && !empty($_POST["format_id"]) ) {
			// user selected a format
			$format_id = $_POST["format_id"];
		}
		else {
			// user did not select a format, so set it to null
			$format_id = null;
		}
		if( isset($_POST["award"]) && !empty($_POST["award"]) ) {
			// user inputted an award
			// Escape special characters like single quote, double quote, etc 
			$award = $mysqli->real_escape_string( $_POST["award"] );
		}
		else {
			$award = null;
		}
		$title = $mysqli->real_escape_string($_POST["title"]);
		// SQL statement to INSERT new record into the DB.
		// Using prepared statements instead (to prevent SQL injections)
		$sql_prepared = "INSERT INTO dvd_titles(title, release_date, award, label_id, sound_id, genre_id, rating_id, format_id)
			VALUES(?, ?, ?, ?, ?, ?, ?, ?);";
		$statement = $mysqli->prepare($sql_prepared);
		// First parameter is data types, the rest are variables that will fill in the ? placeholders
		$statement->bind_param("sssiiiii", $title, $release_date, $award, $label_id, $sound_id, 
			$genre_id, $rating_id, $format_id);
		$executed = $statement->execute();
		// execute() will return false if there's an error
		if(!$executed) {
			echo $mysqli->error;
		}
		// affected_rows returns how many records were affected (updated/deleted/inserted)
		if( $statement->affected_rows == 1 ) {
			$isInserted = true;
		}
		$statement->close();
		$mysqli->close();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | DVD Database</title>
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
			<h1 class="col-12 mt-4">Add a DVD</h1>
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

				<?php if($isInserted) : ?>
					<div class="text-success">
						<span class="font-italic">
							<?php echo $_POST["title"]; ?>
						</span> was successfully added.
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