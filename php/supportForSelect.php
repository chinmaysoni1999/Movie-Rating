<?php


function generatePage($body) {
 
    $page = <<<EOPAGE
   
    <!doctype html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <!-- For responsive page -->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <link rel="stylesheet" href="../css/main.css">
            <title>Movie Rating</title>
            <style>
              table {
                margin: 0 auto;
                width: 80%;
                background: #e7e7e7;
              }

              table.table-bordered {
                border: 2px solid;
              }

              a {
                color: black;
                font: em;
                font-size: 16px;
              }
              .rate {
                font-size: 20px;
                text-align: center;
                color: blue;
              }
              body {
                background: black;
                background-image: url('../images/bg.jpg');
                height:100%;
                background-repeat: no-repeat;
                background-size: cover;
                background-attachment: fixed;
              }
              h1 {
                text-shadow: black .1em .1em .1em;
                color: white;
              }
              h3 {
                text-shadow: black .1em .1em .1em;
                color: white;
              }


              small {
                color:white;
              }
            </style>
        </head>

    <body>
    
        $body
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
EOPAGE;

    return $page;
}
?>
