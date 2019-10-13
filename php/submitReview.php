<?php
session_start();
	/* Inserts image */
    require_once("supportForSelect.php");
    
   
    if (isset($_POST['send_movie'])) {

      $movieName = $_POST['send_movie'];
    } else {
      $movieName = "Movie Name";
    }
    // print($movieName);//  does not exist yet
    $body = '<div><div class="w3-container"><div class="center">
    <table style="opacity: 0.9;" class="table-striped table-bordered">
    	<tbody><tr>
    		<td class="col-xs-4">';
    $host = "localhost";
	$user = "root";
	$password = "";
	$database = "moviereviews";
	$table = "movies";
    //$db = connectToDB($host, $user, $password, $database);
    $db_connection = new mysqli($host, $user, $password, $database);

    if(!isset($_POST["submit"])){
    $body .= <<<EOBODY

    <h2>$movieName</h2><br><br>

    <form action="" method="post">
        <input type="hidden" name="movieName" value="$movieName"/>
        Rating: <input type="number" id="rating" name="rating" min="0" max="10" step="0.1"> /10 <br><br>
        Review: <textarea cols="10" rows="2" name="review"> </textarea> <br><br>
        <input type="submit" name="submit" id="submit" value="Submit"><br>

    </form>

    <a href="select.php">
      <input type="button" value="Back">
    </a>
</td></tr></table>

EOBODY;




    }else{


        $rating = 0;
        $total = 0;
        $review = "";
        $movieName = $_POST['movieName'];

        //$sqlQuery = "insert into $table (name, image, description, rating, total) values ";
        $query = sprintf("select rating, total from movies where name = '%s'", $movieName);
        $query1 = sprintf("select reviewed_by, rating,review from reviews where on_movie= '%s'", $movieName);
        $result = $db_connection->query($query);
        $result1 = $db_connection->query($query1);
        if($result){
            /* Number of rows found */
            $num_rows = $result->num_rows;
            $num_rows1 = $result1->num_rows;
            if ($num_rows === 0) {
                echo "Empty Table<br>";
            } else {
                for ($row_index = 0; $row_index < $num_rows; $row_index++) {
                    $result->data_seek($row_index);
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                  

                    $rating = $row['rating'];
                    $total = $row['total'];
                    
                    
                }
                

                 /* Freeing memory */




            }
            $result->close();
          
            $query2 = sprintf("update movies set rating=%f,total=%d where name='%s'", ((($rating * $total) + $_POST['rating'] ) / ($total + 1)), $total + 1, $movieName);
            $query1_2 = sprintf("insert into reviews (reviewed_by, on_movie, rating, review) VALUES ('%s', '%s', %d, '%s')", $_SESSION['user'], $movieName,$_POST['rating'],$_POST['review']);

            $result2 = $db_connection->query($query2);
            $result1_2 = $db_connection->query($query1_2);

            if ($result2 ) {
              $body .= "<h2>Thank you for your submission!</h2><br>";
              $body .= '<a href="select.php">
                <input type="button" value="Back">
              </a><br><br>';
            }else{
                die("Retrieval failed: ". $db_connection->error);
            }

            $db_connection->close();


        }
        else{
          die("Retrieval failed: ". $db_connection->error);

         }




    }
    echo generatePage($body);


?>
