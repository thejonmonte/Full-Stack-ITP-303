<?php
	if ( !isset($_GET['page']) || empty($_GET['page'])) {
		echo "Requested page could not be found";
	} else {
		$page = $_GET['page'];
		$url = "https://wger.de/api/v2/";
		if ($page == "Search.php") {
			if ( !isset($_GET['type']) || empty($_GET['type'])) {
				echo "Type could not be found";
			}
			$type = $_GET['type'];
			if ($type == "exercisecategory") {
				$url = $url . "exercisecategory";
			} else if ($type == "equipment") {
				$url = $url . "equipment";
			} else if ($type == "muscle") {
				$url = $url . "muscle";
			}

			$url = $url . ".json/";
			define("WGER_ENDPT", $url);
			// Initialize curl
			$curl = curl_init();
			// Set some curl options
			curl_setopt($curl, CURLOPT_URL, WGER_ENDPT);
			// Verifies the authenticity of the peer's SSL certificate
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			// Returns the data instead of printing it to the page
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			// Execute curl, aka make a HTTP request
			$response = curl_exec($curl);
			echo $response;
			curl_close($curl);
		} else if ($page == "SearchResults.php") {
			if (!isset($_GET['id']) || empty($_GET['id']) ||
				!isset($_GET['type']) || empty($_GET['type']) ||
				!isset($_GET['pageNum']) || empty($_GET['pageNum'])) {
				echo "Parameters could not be found";
			} else {
				$type = $_GET['type'];
				$id = $_GET['id'];
				$pageNum = $_GET['pageNum'];
				$url2 = $url . "exercise.json/?page=" . $pageNum . "&status=2&language=2";
				$url = $url . "exerciseinfo.json/?page=" . $pageNum . "&status=2&language=2";

				if ($type == "exercisecategory") {
					$url2 = $url2 . "&category=";
					$url = $url . "&category=";
				} else if ($type == "equipment") {
					$url2 = $url2 . "&equipment=";
					$url = $url . "&equipment=";
				} else if ($type == "muscle") {
					$url2 = $url2 . "&muscles=";
					$url = $url . "&muscles=";
				}

				$url2 = $url2 . $id;
				$url = $url . $id;

				define("WGER_ENDPT", $url);
				// Initialize curl
				$curl = curl_init();
				// Set some curl options
				curl_setopt($curl, CURLOPT_URL, WGER_ENDPT);
				// Verifies the authenticity of the peer's SSL certificate
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				// Returns the data instead of printing it to the page
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				// Execute curl, aka make a HTTP request
				$response1 = curl_exec($curl);

				define("WGER_ENDPT2", $url2);

				curl_setopt($curl, CURLOPT_URL, WGER_ENDPT2);
				$response2 = curl_exec($curl);

				$decode1 = json_decode($response1, true);
				$decode2 = json_decode($response2, true);

				for ($i=0; $i<count($decode1["results"]); $i++) {
					$decode1['results'][$i]['id'] = $decode2['results'][$i]['id'];
				} // Make another API call to get the exercise ID and append it to the exercise info JSON because the people who made this API are stupid.
				echo json_encode($decode1);
				curl_close($curl);
			}
		} else if ($page == "SearchDetails.php") {
			if (!isset($_GET['id']) || empty($_GET['id'])) {
				echo "Parameters could not be found";
			} else {
				$id = $_GET['id'];
				$url2 = $url . "exerciseimage.json/?exercise=" . $id . "&status=2&language=2&limit=1";
				$url = $url . "exerciseinfo/" . $id . ".json"; 

				define("WGER_ENDPT", $url);
				define("WGER_ENDPT2", $url2);

				// Initialize curl
				$curl = curl_init();
				// Set some curl options
				curl_setopt($curl, CURLOPT_URL, WGER_ENDPT);
				// Verifies the authenticity of the peer's SSL certificate
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				// Returns the data instead of printing it to the page
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				// Execute curl, aka make a HTTP request
				$response1 = curl_exec($curl);

				curl_setopt($curl, CURLOPT_URL, WGER_ENDPT2);
				$response2 = curl_exec($curl);

				$decode1 = json_decode($response1, true);
				$decode2 = json_decode($response2, true);

				if ($decode2["count"] == 0) {
					$decode1["image"] = "images/detail_img_not_available.png";
				} else if ($decode2["count"] > 0) {
					$decode1["image"] = $decode2["results"][0]["image"];
				}
				echo json_encode($decode1);
				curl_close($curl);
			}
		}
	}

?>