<?php

	// Get the values of the fields that user typed in from the form using $_GET

	// Step 1: Establish DB connection
	$host = "303.itpwebdev.com";
	$user = "jmontema_db_user";
	$password = "usciscool2022";
	$db = "jmontema_dvd_db";

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

	$sql = "SELECT dvd_titles.dvd_title_id, dvd_titles.title, dvd_titles.release_date, genres.genre, ratings.rating 
		FROM dvd_titles
			LEFT JOIN genres
				ON genres.genre_id = dvd_titles.genre_id
			LEFT JOIN ratings
				ON ratings.rating_id = dvd_titles.rating_id
		WHERE 1 = 1";
		// 1 = 1 used as a placeholder: if user inputs things, it's easier to append to this WHERE clause instead
		// of having to make a new one

		// Depending on what user filled out in the form, need to add stuff to SQL statement
		if (isset($_GET["title"]) && !empty($_GET["title"]) ) {
			$sql = $sql . " AND dvd_titles.title LIKE '%" . $_GET["title"] . "%'";
		}

		if (isset($_GET["genre"]) && !empty($_GET["genre"])) {
			$sql = $sql . " AND dvd_titles.genre_id = " . $_GET['genre'];
		}

		if (isset($_GET["rating"]) && !empty($_GET["rating"])) {
			$sql = $sql . " AND dvd_titles.rating_id = " . $_GET["rating"];
		}
		if (isset($_GET["label"]) && !empty($_GET["label"]) ) {
			$sql = $sql . " AND dvd_titles.label_id = " . $_GET["label"];
		}
		if (isset($_GET["format"]) && !empty($_GET["format"])) {
			$sql = $sql . " AND dvd_titles.format_id = " . $_GET["format"];
		}
		if (isset($_GET["sound"]) && !empty($_GET["sound"])) {
			$sql = $sql . " AND dvd_titles.sound_id = " . $_GET["sound"];
		}
		if (isset($_GET["award"]) && !empty($_GET["award"])) {
			if ("yes" === $_GET["award"]) {
				$sql = $sql . " AND dvd_titles.award IS NOT NULL";
			}
			else if ("no" === $_GET["award"]) {
				$sql = $sql . " AND dvd_titles.award IS NULL";
			}
		}
		if (isset($_GET["release_date_from"]) && !empty($_GET["release_date_from"]) &&
			isset($_GET["release_date_to"]) && !empty($_GET["release_date_to"])) {
			$sql = $sql . " AND dvd_titles.release_date BETWEEN '" . $_GET["release_date_from"] .
			"' AND '" . $_GET["release_date_to"] . "' ORDER BY dvd_titles.release_date DESC, dvd_titles.title ASC";
		} else if (isset($_GET["release_date_from"]) && !empty($_GET["release_date_from"])) {
			$sql = $sql . " AND dvd_titles.release_date >= '" . $_GET["release_date_from"] . 
			"' ORDER BY dvd_titles.release_date DESC, dvd_titles.title ASC";
		} else if (isset($_GET["release_date_to"]) && !empty($_GET["release_date_to"])) {
			$sql = $sql . " AND dvd_titles.release_date <= '" . $_GET["release_date_to"] . 
			"' ORDER BY dvd_titles.release_date DESC, dvd_titles.title ASC";
		} else {
			$sql = $sql . " ORDER BY dvd_titles.title ASC";
		}

		$sql = $sql . ";";

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
	<title>DVD Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item active">Results</li>
	</ol>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4">
			<div class="col-12 mt-4">
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
							<th>DVD Title</th>
							<th>Release Date</th>
							<th>Genre</th>
							<th>Rating</th>
						</tr>
					</thead>
					<tbody>

						<?php while($row = $results->fetch_assoc() ) : ?>

							<tr>
								<td>
									<!-- Append dvd title id and dvd title name to the end of this link -->
									<a href="delete.php?dvd_title_id=<?php echo $row['dvd_title_id']?>&dvd_title=<?php echo $row['title']?>" class="btn btn-outline-danger delete-btn">
										Delete
									</a>
								</td>
								<td> <a href="details.php?dvd_title_id=<?php echo $row['dvd_title_id']?>"> <?php echo $row["title"] ?> </a></td>
								<td> <?php echo $row["release_date"] ?></td>
								<td> <?php echo $row["genre"] ?></td>
								<td> <?php echo $row["rating"] ?></td>
							</tr>

						<?php endwhile; ?>

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
	<script>
		let deleteButtons = document.querySelectorAll(".delete-btn");

		for (let i = 0; i < deleteButtons.length; i++) {
			deleteButtons[i].onclick = function() {
				// return false is like event.preventDefault(), it prevents default behavior. In this
				// case it prevents page to go to delete.php

				// confirm() returns TRUE if user clicked 'ok'and FALSE if user clicked 'cancel'
				return confirm("Are you sure you want to delete this DVD?");
			}
		}
	</script>
</body>
</html>