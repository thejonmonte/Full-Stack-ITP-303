<?php
// Check that all required fields have been passed to this page
$isInserted = "";
if ( !isset($_POST['track_name']) || 
	empty($_POST['track_name']) || 
	!isset($_POST['media_type']) || 
	empty($_POST['media_type']) || 
	!isset($_POST['genre']) || 
	empty($_POST['genre']) || 
	!isset($_POST['milliseconds']) || 
	empty($_POST['milliseconds']) || 
	!isset($_POST['price']) || 
	empty($_POST['price']) ) {
	$error = "Please fill out all required fields.";
}
else {
	// Connect to the db
	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$pass = "uscItp2019!";
	$db = "nayeon_song_db";
	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}
	$mysqli->set_charset('utf8');
	// Handle optional fields like album, composer, bytes
	if( isset($_POST["album"]) && !empty($_POST["album"]) ) {
		// user selected an album
		$album_id = $_POST["album"];
	}
	else {
		// user did not select an album, so set it to null
		$album_id = "null";
	}
	if( isset($_POST["composer"]) && !empty($_POST["composer"]) ) {
		// user entered a composer
		$composer = "'" . $_POST["composer"] . "'";
	}
	else {
		// user did not enter a composer, so set it to null
		$composer = "null";
	}
	if( isset($_POST["bytes"]) && !empty($_POST["bytes"]) ) {
		// user entered bytes 
		$bytes = $_POST["bytes"];
	}
	else {
		// user did not enter bytes, so set it to null
		$bytes = "null";
	}
	// Escape special characters like single quote, double quote, etc 
	$track_name = $mysqli->real_escape_string( $_POST["track_name"] );
	// SQL statement to INSERT new record into the DB.
	$sql = "INSERT INTO tracks(name, album_id, media_type_id, genre_id, composer, milliseconds, bytes, unit_price)
		VALUES('" . $track_name . "', "
		. $album_id
		. ", "
		. $_POST["media_type"]
		. ", "
		. $_POST["genre"]
		. ", "
		. $composer
		. ", "
		. $_POST["milliseconds"]
		. ", "
		. $bytes
		. ", "
		. $_POST["price"]
		.");";
	echo "<hr>" . $sql . "<hr>";
	$results = $mysqli->query($sql);
	if( !$results) {
		echo $mysqli->error;
		exit();
	}
	// If record has been inserted, mysqli->affected_rows will return 1.
	echo "Inserted: " . $mysqli->affected_rows;
	if( $mysqli->affected_rows == 1 ) {
		$isInserted = true;
	}
	$mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | Song Database</title>
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
			<h1 class="col-12 mt-4">Add a Song</h1>
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
			<?php echo $_POST["track_name"]; ?>
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