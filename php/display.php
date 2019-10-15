<?php
	session_start();
	require_once("supportForSelect.php");
	
	$body = "";
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "moviereviews";
	$table = "movies";

	$db = connectToDB($host, $user, $password, $database);

	$name_from_select = $_POST["movie_to_be_displayed"];

	$sqlQuery = "select * from $table where name = '".$name_from_select."'";
	$result = mysqli_query($db, $sqlQuery);

	$query = "select * from reviews where on_movie = '".$name_from_select."'";
	$result1 = mysqli_query($db, $query);
	$num_rows = $result1->num_rows;
	$reviews = "";
	
		for ($row_index = 0; $row_index < $num_rows; $row_index++) {
			$result1->data_seek($row_index);
			$row = $result1->fetch_array(MYSQLI_ASSOC);

			$reviews .= $row['reviewed_by']  .",\t"  . $row['rating'] ."/10,\t'" . $row['review']."'\r\n" ;
			$reviews = nl2br($reviews,false);
			
		}
	
$body .= '<div><div class="w3-container"><div class="center">
<table style="opacity: 0.9;" class="table-striped table-bordered">
	<tbody><tr>
		<td class="col-xs-4">';

	if ($result->num_rows > 0) {
	    // output data of each row

		while($row = $result->fetch_assoc()){

	    	$name = $row["name"];
	    	$image = $row["image"];
			$description = $row["description"];
			$cast = $row["cast"];
			$producer = $row["producer"];
			$director = $row["director"];
			$release_date = $row["release_date"];
			$budget = $row["budget"];
			$collection = $row["collection"];
	    	$rating = $row["rating"];
			$total = $row["total"];
			//$review = $row["review"];
			

			$body .= '<img src="data:image/jpeg;base64,'.base64_encode( $image ).'" width="300px" height="400px" />';
	    	$body.= <<<EOSEND
			<h1>$name</h1>
			<hr>
			<div>
			<h3>Description</h3>
			<h4>$description</h4>
			<br/><br/>
			<div>
			<div>
			<h3>Cast</h3>
			<h4>$cast</h4>
			<br/><br/>
			<div>
			<div>
			<h3>Producer</h3>
			<h4>$producer</h4>
			<br/><br/>
			<div>
			<div>
			<h3>Director</h3>
			<h4>$director</h4>
			<br/><br/>
			<div>
			<div>
			<h3>Release Date</h3>
			<h4>$release_date</h4>
			<br/><br/>
			<div>
			<div>
			<h3>Budget</h3>
			<h4>$budget</h4>
			<br/><br/>
			<div>
			<div>
			<h3>Net Collection</h3>
			<h4>$collection</h4>
			<br/><br/>
			<div>

			<h3><em>Average rating:</em> $rating </h3><br>
			<h3><em>Total Reviews:</em> $total</h3> <br>
			<h3>Reviews By Users:</h3>
			<h4>$reviews</h4> <br>
			</div><br/>
			<div>
			<a href="main.php">
				<input type="button" value="Return to main menu">
			</a>

			<a href="select.php">
				<input type="button" value="Back">
			</a>
			</div>
			<br>
			<div>
			<form action="submitReview.php" method="post">
				<input type="hidden" name="send_movie" id="send_movie" value="$name"/ >
				<input type="submit" name="send" id="send" value="Give Review"/>
				</form>
				</div>

				<hr>
EOSEND;
	    	;
	    }
			$body .= 		"</td></tr></table></div></div></div>";



	}
	mysqli_close($db);

	echo generatePage($body);

function connectToDB($host, $user, $password, $database) {
	$db = mysqli_connect($host, $user, $password, $database);
	if (mysqli_connect_errno()) {
		echo "Connect failed.\n".mysqli_connect_error();
		exit();
	}
	return $db;
}

 ?>
