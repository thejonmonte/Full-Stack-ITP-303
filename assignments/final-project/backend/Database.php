<?php

require './config/config.php';

	if (!isset($_POST['function']) || empty($_POST['function'])) {
		echo "ERROR";
	} else {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->connect_errno ) {
			echo "ERROR";
			exit();
		}
		$mysqli->set_charset('utf8');

		$function = $_POST['function'];
		if ($function == "create") {
			if ( !isset($_POST['exercise']) || empty($_POST['exercise']) || 
				!isset($_POST['sets']) || empty($_POST['sets']) ||
				!isset($_POST['reps']) || empty($_POST['reps'])  ||
				!isset($_POST['userID']) || empty($_POST['userID']) ) {
				echo "ERROR";
				exit();
			} else {
				$exercise = str_replace("-", " ", $_POST['exercise']);
				$sets = $_POST['sets'];
				$reps = $_POST['reps'];
				$userID = $_POST['userID'];

				// Only insert if the exercise doesn't exist
				$sql = "INSERT IGNORE INTO Exercises (exerciseName) VALUES (?);";

				$stmt = $mysqli->prepare($sql);

				$stmt->bind_param("s", $exercise);

				$stmt->execute();

				$sql = "SELECT exerciseID FROM Exercises WHERE exerciseName = '" . $exercise . "';";

				$results = $mysqli->query($sql);

				$exerciseID = null;

				if ($results == false || $results->num_rows == 0) {
					echo "ERROR";
					exit();
				} else {
					$row = $results->fetch_assoc();
					$exerciseID = $row['exerciseID'];
				}

				$sql = "SELECT * FROM Workouts WHERE userID = " . $userID . " AND exerciseID = " . $exerciseID . ";";

				$results = $mysqli->query($sql);

				if ($results->num_rows > 0) {
					echo "Already added";
					exit();
				} else {
					$sql = "INSERT INTO Workouts (userID, exerciseID, sets, reps) VALUES (?, ?, ?, ?)";
					$stmt = $mysqli->prepare($sql);
					$stmt->bind_param("iiii", $userID, $exerciseID, $sets, $reps);
					$executed = $stmt->execute();
					if (!$executed) {
						echo "ERROR";
						exit();
					} else {
						echo "OK";
					}
					$stmt->close(); 
				}
			}
		} else if ($function == "read") {
			if ( !isset($_POST['userID']) || empty($_POST['userID'])) {
				echo "ERROR";
				exit();
			} else {
				$userID = $_POST['userID'];

				$sql = "SELECT Workouts.workoutID, Exercises.exerciseName, Workouts.sets, Workouts.reps 
					FROM Workouts 
					JOIN Exercises
						ON Workouts.exerciseID = Exercises.exerciseID
    				WHERE userID = " . $userID . ";";

				$results = $mysqli->query($sql);

				if ($results->num_rows == 0) {
					echo "No results";
					exit();
				} else {
					$results_array = [];
					while( $row = $results->fetch_assoc() ) {
						array_push($results_array, $row);
					}
					// Convert this one array to a STRING in JSON format
					echo json_encode($results_array);
				}
			}
		} else if ($function == "update") {
			if ( !isset($_POST['workoutID']) || empty($_POST['workoutID']) || 
				!isset($_POST['sets']) || empty($_POST['sets']) ||
				!isset($_POST['reps']) || empty($_POST['reps'])) {
				echo "ERROR";
				exit();
			} else {
				$workoutID = $_POST['workoutID'];
				$sets = $_POST['sets'];
				$reps = $_POST['reps'];

				$sql = "UPDATE Workouts SET sets = ?, reps = ? WHERE workoutID = ? ;";

				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param("iii", $sets, $reps, $workoutID);
				$executed = $stmt->execute();
				if (!$executed) {
					echo "ERROR";
					exit();
				} else {
					echo "OK";
				}
			}
		} else if ($function == "delete") {
			if ( !isset($_POST['workoutID']) || empty($_POST['workoutID'])) {
				echo "ERROR";
				exit();
			} else {
				$workoutID = $_POST['workoutID'];

				$sql = "DELETE FROM Workouts WHERE workoutID = ?;";

				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param("i", $workoutID);
				$executed = $stmt->execute();
				if (!$executed) {
					echo "ERROR";
					exit();
				} else {
					echo "OK";
				}
			}
		} else if ($function == "addRating") {
			if ( !isset($_POST['userID']) || empty($_POST['userID']) || !isset($_POST['rating']) || empty($_POST['rating'])|| !isset($_POST['review']) || empty($_POST['review'])) {
				echo "ERROR";
				exit();
			} else {
				$review = str_replace("-", " ", $_POST['review']);
				$userID = $_POST['userID'];
				$rating = $_POST['rating'];
				$datetime = date('Y-m-d H:i:s');

				$sql = "SELECT * FROM Reviews WHERE userID = " . $userID . ";";

				$results = $mysqli->query($sql);

				if ($results->num_rows > 0) {
					$sql = "UPDATE Reviews SET review = ?, rating = ?, updatedAt = ? WHERE userID = ?";

					$stmt = $mysqli->prepare($sql);
					$stmt->bind_param("sisi", $review, $rating, $datetime, $userID);

					$executed = $stmt->execute();
					if (!$executed) {
						echo "ERROR";
						exit();
					} else {
						echo "OK";
					}
				} else {
					$sql = "INSERT INTO Reviews(userID, review, rating, updatedAt) VALUES(?, ?, ?, ?);";

					$stmt = $mysqli->prepare($sql);
					$stmt->bind_param("isss", $userID, $review, $rating, $datetime);
					$executed = $stmt->execute();
					if (!$executed) {
						echo "ERROR";
						exit();
					} else {
						echo "OK";
					}
				}
			}
		} else if ($function == "getRatings") {
			$sql = "SELECT Users.name, Users.image, Reviews.review, Reviews.rating FROM Reviews JOIN Users ON Users.userID = Reviews.userID ORDER BY rating DESC, updatedAt DESC LIMIT 2;";

			$results = $mysqli->query($sql);

			if ($results->num_rows == 0) {
				echo "ERROR";
				exit();
			} else {
				$results_array = [];
				while( $row = $results->fetch_assoc() ) {
					array_push($results_array, $row);
				}
				// Convert this one array to a STRING in JSON format
				echo json_encode($results_array);
			}
		}
		$mysqli->close();
	}
?>