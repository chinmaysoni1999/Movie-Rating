<?php
  session_start();
    include("support.php");
    if (isset($_SESSION["logged"]) && ($_SESSION["logged"] == true)) {
      header('Location: select.php');
      
    }
    $bodyTop = <<<CODE
        <div class="center">
            <h1 class="title">Welcome to Movie Rating!</h1>
            <img class="img_center" src="../images/reel.png" alt="reel logo" width="150px" height="150px">
            <h3>Sign in</h3>
            <form action="main.php" method="post" class="form-inline">
                <label for="username" >Username:</label>
                <input type="text" name="username" method="post" placeholder="Username" required>
                <br><br>
                <label for="password">Password:</label>
                <input type="password" name="password" method="post" placeholder="Password" required>
                <br><br>
                <input type="submit" name="submit" method="post" value="Log in">
            </form>
        </div>
CODE;
    $bodyTopMessage = "<br>";
    $bodyBot = <<<CODE
        <div class="center">
            <h4>Don't have an account?<em> Create one for free</em></h4>
            <br>

            <form action="main.php" method="post" class="form-inline">
                <input type="text" name="username" method="post" placeholder="Username" required>
                <br><br>
                <input id="pw" type="password" name="new_password" method="post" placeholder="Password" required>
                <br><br>
                <input type="password" name="new_password_verify" method="post" placeholder="Verify password" required>
                <br><br>
                <input type="submit" name="new_submit" method="post" value="Create account">
            </form>
        </div>
CODE;
    $bodyBotMessage="<br>";
    if (isset($_POST["new_submit"])) {
        $sqlquery = sprintf("select username from users where username=\"".$_POST["username"]."\"");
        $connect = mysqli_connect("localhost", "root", "", "moviereviews");
        $result = mysqli_query($connect, $sqlquery);
        $count = mysqli_num_rows($result);

        if ($count>0){
            $bodyBotMessage = "<h4 style=\"text-align: center; color:red;\"> Username already exists. Please select another username!!</h4>";;
        }
        else{
        if ($_POST["new_password"] == $_POST["new_password_verify"]) {
            if (mysqli_connect_errno()) {
                echo "Connect failed.\n".mysqli_connect_error();
                exit();
            }
            $sqlquery = sprintf("insert into users (username, password) values ('%s', '%s')",
                        $_POST["username"], password_hash($_POST["new_password"], PASSWORD_DEFAULT));
            $result = mysqli_query($connect, $sqlquery);
            $bodyBotMessage = "<h4 class=\"center\">Account successfully created.</h4>";
        } else {
            $bodyBotMessage =  "<h4 style=\"text-align: center; color:red;\"> error: passwords do not match</h4>";
        }
    }
    mysqli_close($connect);
}
    if (isset($_POST["submit"])) {
        $connect = mysqli_connect("localhost", "root", "", "moviereviews");
        $sqlquery = sprintf("select username,password from users where username=\"".$_POST["username"]."\"");
        $result = mysqli_query($connect, $sqlquery);
        
        if ($result) {
            $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($data)
                if (password_verify($_POST["password"], $data["password"])) {
                    session_start();
                    $_SESSION['logged'] = true;
                    $_SESSION['user'] = $_POST["username"];
                    header('Location: select.php');
                } else
                    $bodyTopMessage = "<h4 style=\"text-align: center; color:red;\"> error: incorrect password</h4>";
            else
                $bodyTopMessage = "<h4 style=\"text-align: center; color:red;\"> error: username does not exist</h4>";
        }
        else {
            $bodyTopMessage = "<h4 style=\"text-align: center; color:red;\"> error: something wrong</h4>";
        }
        mysqli_close($connect);
    }
    
    echo generatePage($bodyTop.$bodyTopMessage."<hr>".$bodyBot.$bodyBotMessage);
    include("footer.php");
?>

