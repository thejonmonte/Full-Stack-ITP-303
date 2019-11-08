<?php

	// Get the values of the fields that user typed in from the form using $_GET
	var_dump($_GET);
	echo "<hr>";
	echo $_GET["track_name"];

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

	// Set character set
	$mysqli->set_charset('utf8');

	// Step 2: Generate and submit SQL query
	$sql = "SELECT tracks.track_id, tracks.name AS track, genres.name AS genre, media_types.name AS media_type
		FROM tracks
			JOIN genres
				ON genres.genre_id = tracks.genre_id
			JOIN media_types
				ON media_types.media_type_id = tracks.media_type_id
		WHERE 1 = 1";
		// 1 = 1 used as a placeholder: if user inputs things, it's easier to append to this WHERE clause instead
		// of having to make a new one

		// Depending on what user filled out in the form, need to add stuff to SQL statement
		if (isset($_GET["track_name"]) && !empty($_GET["track_name"]) ) {
			$sql = $sql . " AND tracks.name LIKE '%" . $_GET["track_name"] . "%'";
		}

		if (isset($_GET["genre"]) && !empty($_GET["genre"])) {
			$sql = $sql . " AND tracks.genre_id = " . $_GET['genre'];
		}

		if (isset($_GET["media_type"]) && !empty($_GET["media_type"])) {
			$sql = $sql . " AND tracks.media_type_id = " . $_GET["media_type"];
		}

		$sql = $sql. ";";

		var_dump($sql);

		$results = $mysqli->query($sql);
		if (!$results) {
			echo $mysqli->error;
			exit();
		}

		$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">Song Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4 mt-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">
				
				<?php echo "Showing " . $results->num_rows . " result(s)." ?>

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Track</th>
							<th>Genre</th>
							<th>Media Type</th>
						</tr>
					</thead>
					<tbody>

						<?php while($row = $results->fetch_assoc() ) : ?>

							<tr>
								<td> <?php echo $row["track"] ?> </td>
								<td> <?php echo $row["genre"] ?></td>
								<td> <?php echo $row["media_type"] ?></td>
							</tr>

						<?php endwhile; ?>
						<!-- <tr>
							<td>For Those About To Rock (We Salute You)</td>
							<td>Rock</td>
							<td>MPEG audio file</td>
						</tr>

						<tr>
							<td>Put The Finger On You</td>
							<td>Rock</td>
							<td>MPEG audio file</td>
						</tr> -->

					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>