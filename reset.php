<?php
    include("conn.php");
    $conn = mysqli_connect($servername, $username, $password, $dbusers);
    if(!isset($_GET["token"])){
        echo "<p>Blank token!<p>";
        exit();
    }
    if(preg_match('/[^a-z0-9]/i', $_GET["token"])){
        echo "<p>Invalid token!</p>";
        exit();
    }
    $sql = "SELECT * FROM `users` where forgottoken='".md5($_GET["token"])."' and reset=1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        echo "<p>Invalid token!</p>";
        exit();
    }

    /*$sql = "UPDATE `users` SET verified = 1 WHERE BINARY token='".$_GET["token"]."'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<p>Your account has been verified! Please <a href='login.php'>log in</a>.</p>";
    }*/
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Reset your password</title>
    </head>
    <body>
    <?php include("nav.php"); ?>
        <h1>Reset your password</h1>
        <?php
            include("conn.php");
            function generateRandomString($length = 10) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[random_int(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            $conn = mysqli_connect($servername, $username, $password, $dbusers);
            $ret=0;
            function handlereg(){
                global $conn;
                if (isset($_SESSION["username"])){
                    $GLOBALS["ret"]=1;
                    return "<script>location.replace('index.php')</script>";
                }
                if (isset($_POST["cpassword"]) && isset($_POST["password"]) && isset($_POST["submit"])){
                    $GLOBALS["ret"]=0;
                } else {

                    $GLOBALS["ret"]=1;
                    return;
                }

                if ($_POST["password"]==""){
                    $GLOBALS["ret"]=1;
                    return "<p>Please enter a password</p>";
                }
                if($_POST["password"]!=$_POST["cpassword"]){
                    $GLOBALS["ret"]=1;
                    return "<p>Passwords do not match</p>";
                }
                $password=password_hash($_POST["password"],PASSWORD_BCRYPT);
                $sql = "UPDATE `users` SET password = '".$password."',reset=0 WHERE BINARY forgottoken='".md5($_GET["token"])."'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<p>Your password has been reset! Please <a href='login.php'>log in</a>.</p>";
                }

            }
            

        echo handlereg();
        
        ?>
        <?php if($GLOBALS["ret"]==1) : ?>
        <form method="POST">
            <p>New Password:</p>
            <input type="password" name="password"><br>
            <p>Confirm New Password:</p>
            <input type="password" name="cpassword"><br>
            <input type="submit" value="Reset!" name="submit">
        </form>
        <?php endif; ?>
        <?php if($GLOBALS["ret"]==0) : ?>
        <!--<p>You are Successfully registered. Please <a href="login.php">log in</a>.</p>-->
        <?php endif; ?>
    </body>
</html>