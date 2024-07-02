<?php
 session_start();
 $token = isset($_SESSION['token']) ? $_SESSION['token'] : "";
 if (!$token) {
     $token = md5(openssl_random_pseudo_bytes(32));
     $_SESSION['token']= $token;
 }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Register to Challenge-Planet</title>
    </head>
    <body>
   <?php include("nav.php"); ?>
        <h1>Register to Challenge-Planet</h1>
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
                if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["submit"])){
                    $GLOBALS["ret"]=0;
                } else {

                    $GLOBALS["ret"]=1;
                    return;
                }
                if ($_POST["token"]!==$_SESSION["token"]){
                    $GLOBALS["ret"]=1;
                    return "Invalid CSRF token";
                }
                if ($_POST["username"]==""){
                    $GLOBALS["ret"]=1;
                    return "<p>Please enter a username</p>";
                }

                if ($_POST["password"]==""){
                    $GLOBALS["ret"]=1;
                    return "<p>Please enter a password</p>";
                }
                if ($_POST["email"]==""){
                    $GLOBALS["ret"]=1;
                    return "<p>Please enter an email</p>";
                }
                if($_POST["password"]!=$_POST["cpassword"]){
                    $GLOBALS["ret"]=1;
                    return "<p>Passwords do not match</p>";
                }
                $password=password_hash($_POST["password"],PASSWORD_BCRYPT);
                if(preg_match('/[^a-z0-9]/', $_POST["username"])){
                    $GLOBALS["ret"]=1;
                    return "<p>Username must only contain numbers and lowercase letters</p>";
                }
                $sql = "SELECT * FROM `users` where username='".$_POST["username"]."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $GLOBALS["ret"]=1;
                    return "<p>Username already taken</p>";
                }
                if(!preg_match("/^[a-z][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST["email"])){
                    $GLOBALS["ret"]=1;
                    return "<p>Email is invalid</p>";
                }
                if($_POST["email"]!=$_POST["cemail"]){
                    $GLOBALS["ret"]=1;
                    return "<p>Email addresses do not match</p>";
                }
                $token=generateRandomString(20);
            $sql = "INSERT INTO `users` values ('".$_POST["username"]."', '".$password."', '".$_POST["email"]."', '{}', now(), '', 0, 0)";
            
                $result = mysqli_query($conn, $sql);


            }


        echo handlereg();
        
        ?>
        <?php if($GLOBALS["ret"]==1) : ?>
        <form method="POST">
            <p>Username (must only be digits and lowercase letters):</p>
            <input type="text" name="username"><br>
            <p>Email (will be used to contact you if you forget your password):</p>
            <input type="email" name="email"><br>
            <p>Confirm Email:</p>
            <input type="email" name="cemail"><br>
            <p>Password:</p>
            <input type="password" name="password"><br>
            <p>Confirm password:</p>
            <input type="password" name="cpassword"><br>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <input type="submit" value="Register!" name="submit">
        </form>
        <?php endif; ?>
        <?php if($GLOBALS["ret"]==0) : ?>
        <p>You are Successfully registered. Please <a href="login.php">log in</a>.</p>
        <?php endif; ?>
    </body>
</html>