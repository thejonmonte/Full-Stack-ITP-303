<?php

require './config/config.php';

	if ( !isset($_POST['name']) || empty($_POST['name']) || 
		!isset($_POST['email']) || empty($_POST['email']) ||
		!isset($_POST['image']) || empty($_POST['image']) ) {
		echo "ERROR";
	} else {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$image = $_POST['image'];

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->connect_errno ) {
			echo "ERROR";
			exit();
		}
		$mysqli->set_charset('utf8');

		// All authentication has been down through Google OAuth 2.0 on the front-end, so all parameters here are correct. Therefore, use INSERT IGNORE to only insert if the user does not exist.
		$sql = "INSERT IGNORE INTO Users(name, email, image) VALUES(?, ?, ?)";

		$stmt = $mysqli->prepare($sql);

		$stmt->bind_param("sss", $name, $email, $image);

		$executed = $stmt->execute();

		if (!$executed) {
			echo "ERROR";
		} else {

			$sql = "SELECT userID FROM Users WHERE email = '" . $email . "';";

			$results = $mysqli->query($sql);

			$userID = null;

			if ($results == false || $results->num_rows == 0) {
				echo "ERROR";
				exit();
			} else {
				$row = $results->fetch_assoc();
				$userID = $row['userID'];
			}

			echo $userID;
		}
	}

?>