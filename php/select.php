<?php
session_start();
  require_once("supportForSelect.php");

  $top = <<<EOTOP
    <div class="center selectTitle">
        
        <h1 class="title">Movie Rating</h1>
        
        <a href="logout.php"> <button> Logout </button> </a>

        <form action="select.php" method="post">
        <em><input type="text" name="search_name" id="search_name" placeholder="Please enter the keywords related to the movie" size="60%" /></em>
        <input type="submit" name="sub_search" id="sub_search" value="Find" />
        </form>
        
    </div>
    

EOTOP;

  $table = <<<EOTABLE

    <hr>
    <table style="opacity: 0.9;" class="table-striped table-bordered">
      <tbody>

EOTABLE;

  $empty = false;

  $connect_movies = new mysqli("localhost", "root", "", "moviereviews");
  if ($connect_movies->connect_error) {
    echo "Connect failed.\n";
    die($connect_movies->connect_error);
  }
  

  if (isset($_POST["sub_search"]) && $_POST["search_name"] !== "") {

    $search_name = $_POST["search_name"];
    $table .= <<<EOSE
    <div class="center"><h3>Keywords: <em>$search_name</em></h3></div>
EOSE;

    $search_query = 'select name, image, rating from movies where name like '."'%{$search_name}%' 
    OR cast like "."'%{$search_name}%'  OR director like "."'%{$search_name}%' 
    OR producer like "."'%{$search_name}%' order by release_date desc";

    $search_result = $connect_movies->query($search_query);

    if ($search_result) {
      $num_rows = $search_result->num_rows;

      if ($num_rows !== 0) {
  			 for ($row_index = 0; $row_index < $num_rows; $row_index++) {
          $row = $search_result->fetch_array(MYSQLI_ASSOC);
          $imag = base64_encode($row["image"]);
          $rate = $row["rating"];
          $name = $row["name"];
          

          $table .= <<<EOIMAG
          <tr>
            <td class="col-xs-4">
            <form action="display.php" method="post">
              <a href="#" onclick="$(this).closest('form').submit();">
              <input type="hidden" name="movie_to_be_displayed" value="$name" />
              <div class="text-center">
              <img src="data:image/jpeg;base64, {$imag}" width="120" height="160" style="margin: 1em;"/>
              </div>
              </a>
            </form>
            </td>
            <td class="col-xs-6">
            <form action="display.php" method="post">
              <a href="#" onclick="$(this).closest('form').submit();">
              <input type="hidden" name="movie_to_be_displayed" value="$name" />
              <strong><em>$name</em></strong>
            </a>
            </form>
            </td>
            <td class="col-xs-2"><strong>$rate</strong></td>
          </tr>
EOIMAG;

        }
      } else {
        $empty = true;
      }





      }



  } else {
    $query = "select name, image, rating from movies order by release_date desc";
    $result = $connect_movies->query($query);

    if ($result) {
      $num_rows = $result->num_rows;

      if ($num_rows !== 0) {
  			for ($row_index = 0; $row_index < $num_rows; $row_index++) {
  				$result->data_seek($row_index);
          $row = $result->fetch_array(MYSQLI_ASSOC);
          $imag = base64_encode($row["image"]);
          $rate = $row["rating"];
          $name = $row["name"];

          $table .= <<<EOIMAG
          <tr>
            <td class="col-xs-4">
            <form action="display.php" method="post">
              <a href="#" onclick="$(this).closest('form').submit();">
              <input type="hidden" name="movie_to_be_displayed" value="$name" />
              <div class="text-center">
              <img src="data:image/jpeg;base64, {$imag}" width="120" height="160" style="margin: 1em;"/>
              </div>
              </a>
            </form>
            </td>
            <td class="col-xs-6">
            <form action="display.php" method="post">
              <a href="#" onclick="$(this).closest('form').submit();">
              <input type="hidden" name="movie_to_be_displayed" value="$name" />
              <strong><em>$name</em></strong>
            </a>
            </form>
            </td>
            <td class="col-xs-2, rate"><strong>$rate</strong></td>
          </tr>
EOIMAG;

        }
      }
    }

  }


  $table .= "</tbody></table>";
  if ($empty) {
    $body = $top."<hr><div class=\"center\"><h3>No Movie Found!</h3></div>";
  } else {
    $body = $top.$table;
  }

  $connect_movies->close();
  echo generatePage($body);
 
  
  include("footer.php");
  
  
  
?>
