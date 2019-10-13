<?php
session_start();
require_once("support.php");


  $body = "This is a Test!";

  echo generatePage($body);

?>
