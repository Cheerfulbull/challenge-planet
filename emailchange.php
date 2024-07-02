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
        <title>Change your account Email</title>
    </head>
    <body>
    <?php include("nav.php"); ?>
        <h1>Change your account Email</h1>
        <?php
            if(isset($_SESSION["username"])){
            } else {
                exit("You are not logged in! Please <a href='login.php'>log in</a></body></html>");
            }
        ?>
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
                if (isset($_POST["email"]) && isset($_POST["submit"])){
                    $GLOBALS["ret"]=0;
                } else {

                    $GLOBALS["ret"]=1;
                    return;
                }
                if ($_POST["token"]!==$_SESSION["token"]){
                    $GLOBALS["ret"]=1;
                    return "Invalid CSRF token";
                }
                if ($_POST["email"]==""){
                    $GLOBALS["ret"]=1;
                    return "<p>Please enter an Email</p>";
                }

                if ($_POST["password"]==""){
                    $GLOBALS["ret"]=1;
                    return "<p>Please enter your password</p>";
                }
                if($_POST["email"]!=$_POST["cemail"]){
                    $GLOBALS["ret"]=1;
                    return "<p>Emails do not match</p>";
                }
                $sql = "SELECT password FROM `users` where username='".$_SESSION["username"]."'";
                $result = mysqli_query($conn, $sql);
                $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
                if (!password_verify($_POST["password"], $row["password"])){
                    $GLOBALS["ret"]=1;
                    return "<p>Invalid password</p>";
                }
                if(!preg_match("/^[a-z][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST["email"])){
                    $GLOBALS["ret"]=1;
                    return "<p>Email is invalid</p>";
                }
                if($_POST["email"]!=$_POST["cemail"]){
                    $GLOBALS["ret"]=1;
                    return "<p>Email addresses do not match</p>";
                }
            $sql = "UPDATE `users` SET email='".$_POST["email"]."' WHERE username='".$_SESSION["username"]."'";
                $result = mysqli_query($conn, $sql);


            }


        echo handlereg();
        
        ?>
        <?php if($GLOBALS["ret"]==1) : ?>
        <form method="POST">
            <p>Email (will be used to contact you if you forget your password):</p>
            <input type="email" name="email"><br>
            <p>Confirm Email:</p>
            <input type="email" name="cemail"><br>
            <p>Password:</p>
            <input type="password" name="password"><br>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <input type="submit" value="Change Email" name="submit">
        </form>
        <?php endif; ?>
        <?php if($GLOBALS["ret"]==0) : ?>
        <p>Email successfully changed to <?php echo $_POST["email"]; ?>.</p>
        <?php endif; ?>
    </body>
</html>