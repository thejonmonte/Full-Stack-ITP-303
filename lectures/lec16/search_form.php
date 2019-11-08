<?php
	// We will be using MySQLi, a PHP extension that allows us to interact w/ the database

	// Step 1: Establish DB connection
	$host = "303.itpwebdev.com";
	$user = "jmontema_db_user";
	$password = "usciscool2022";
	$db = "jmontema_song_db";

	// Connect to the DB by creating an instance of the MySQLI class
	$mysqli = new mysqli($host, $user, $password, $db);

	if ( $mysqli->connect_errno) {
		echo $mysqli->connect_error;
		// Exit the program if there's an error. There's no reason to continue the program.
		exit();
	}

	// Step 2: Generate and submit SQL query

	// Get ALL genres from database
	$sql = "SELECT * FROM genres;";
	echo $sql;
	echo "<hr>";

	// Send the query off to the DB and save the results in variable $results
	$results = $mysqli->query($sql);
	// If some kind of SQL error occurs, $results will return false
	if ( !$results) {
		echo $mysqli->error;
		// Exit the program if there's an error. There's no reason to continue the program.
		exit();
	}
	// quickly dump out what results I get back
	var_dump($results);
	echo "<hr>";
	echo "Number of results: " . $results->num_rows;
	echo "<hr>";

	// Get individual results as an associative array
	// fetch_assoc() only gives back one result at a time.
	// When it reaches the end of results, it will return NULL
	// var_dump($results->fetch_assoc() );
	// var_dump($results->fetch_assoc() );
	// var_dump($results->fetch_assoc() );

	// Use while loop to get all the results.
	// fetch_assoc() will return NULL when all results are returned,
	// thus ending the while loop.
	// while( $row = $results->fetch_assoc() ) {
	// 	var_dump($row);
	// 	echo "<br>" . $row["name"] . "<hr>";
	// }

	// Step 3: Display results
	// Step 4: Close the DB connection

	$sql_media_types = "SELECT * FROM media_types;";
	echo $sql_media_types . "<hr>";

	$results_media_types = $mysqli->query($sql_media_types);
	// Check that no errors occurred when query is submitted. $results will return false if an error occureed
	if( !$results_media_types ) {
		echo $mysqli->error;
		// Exit the program if there is an error. No reason to continue on.
		exit();
	}

	$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Song Search Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<form action="search_results.php" method="GET">

			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">Track Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name-id" name="track_name">
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
				<div class="col-sm-9">
					<select name="genre" id="genre-id" class="form-control">
						<option value="" selected>-- All --</option>
						<?php
							// This is the normal way to write PHP / HTML together
							while($row = $results->fetch_assoc()) {
								echo "<option value='" . $row["genre_id"] . "'>" . $row["name"] . "</option>";
							}
						?>

						<!-- Alternative syntax. Separates out PHP and HTML so it's cleaner -->
						<?php while( $row = $results->fetch_assoc() ) : ?>
							<option value="<?php echo $row['genre_id'] ?> "> <?php echo $row["name"] ?> </option>
						<?php endwhile; ?>
						<!-- <option value='1'>Rock</option>
						<option value='2'>Jazz</option>
						<option value='3'>Metal</option>
						<option value='4'>Alternative & Punk</option>
						<option value='5'>Rock And Roll</option> -->

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="media-type-id" class="col-sm-3 col-form-label text-sm-right">Media Type:</label>
				<div class="col-sm-9">
					<select name="media_type" id="media-type-id" class="form-control">
						<option value="" selected>-- All --</option>

						<option value='1'>MPEG audio file</option>
						<option value='2'>Protected AAC audio file</option>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>