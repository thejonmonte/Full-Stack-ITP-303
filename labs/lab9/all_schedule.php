<?php
	// TODO: Establish DB connection, submit SQL query here. Remember to check for any MySQLi errors.

	// We will be using MySQLi, a PHP extension that allows us to interact w/ the database

	// Step 1: Establish DB connection
	$host = "303.itpwebdev.com";
	$user = "jmontema_db_user";
	$password = "usciscool2022";
	$db = "jmontema_football_schedule_db";

	// Connect to the DB by creating an instance of the MySQLI class
	$mysqli = new mysqli($host, $user, $password, $db);

	if ( $mysqli->connect_errno) {
		echo $mysqli->connect_error;
		// Exit the program if there's an error. There's no reason to continue the program.
		exit();
	}

	$mysqli->set_charset('utf8');
	
	$sql = "SELECT days.day, schedule.date, home.team AS home, away.team AS away, venues.venue
	FROM schedule
	JOIN days
		ON schedule.day_id = days.id
	JOIN teams as home
		ON schedule.home_team_id = home.id
	JOIN teams as away
		ON schedule.away_team_id = away.id
	JOIN venues
		ON schedule.venue_id = venues.id
	ORDER BY date;";

	// Send the query off to the DB and save the results in variable $results
	$results = $mysqli->query($sql);
	// If some kind of SQL error occurs, $results will return false
	if ( !$results) {
		echo $mysqli->error;
		// Exit the program if there's an error. There's no reason to continue the program.
		exit();
	}

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

	$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Football Database Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">Football Schedule</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4">
			<div class="col-12 mt-4">
				<a href="index.php" role="button" class="btn btn-primary">Back to Home</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				<!-- TODO: Replace '1' with actual number of results -->
				Showing <?php echo $results->num_rows; ?> result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Date</th>
							<th>Day</th>
							<th>Home Team</th>
							<th>Away Team</th>
							<th>Venue</th>
						</tr>
					</thead>
					<tbody>

						<!-- TODO: Loop through DB results and output them here. Modify or remove hard-coded <tr> below. -->
					<?php while ( $row = $results->fetch_assoc() ) : ?>
						<tr>
							<td><?php echo $row['date']; ?></td>
							<td><?php echo $row['day']; ?></td>
							<td><?php echo $row['home']; ?></td>
							<td><?php echo $row['away']; ?></td>
							<td><?php echo $row['venue']; ?></td>
						</tr>
					<?php endwhile; ?>

					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="index.php" role="button" class="btn btn-primary">Back to Home</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>