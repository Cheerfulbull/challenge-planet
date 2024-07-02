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
        <title>Login to Challenge-Planet</title>
    </head>
    <body>
        <?php include("nav.php"); ?>
        <h1>Login to Challenge-Planet</h1>
        <?php
            include("conn.php");
            $conn = mysqli_connect($servername, $username, $password, $dbusers);
            $ret=0;
            function handlelogin(){
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
                if(preg_match('/[^a-z0-9]/', $_POST["username"])){
                    $GLOBALS["ret"]=1;
                    return "<p>Username must only contain numbers and lowercase letters</p>";
                }
                $sql = "SELECT password FROM `users` where username='".$_POST["username"]."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) < 1) {
                    $GLOBALS["ret"]=1;
                    return "<p>Invalid username/password</p>";
                }
                $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
                if (!password_verify($_POST["password"], $row["password"])){
                    $GLOBALS["ret"]=1;
                    return "<p>Invalid username/password</p>";
                }
                $_SESSION["username"]=$_POST["username"];
                echo "<p>Welcome ".$_SESSION["username"]."! Redirecting to the <a href='index.php'>home page</a>...</p><script>window.setTimeout(function(){window.location.replace('index.php')},1000)</script>";
            }


        echo handlelogin();
        
        ?>
        <?php if($GLOBALS["ret"]==1) : ?>
        <p>Don't have an account yet? Register <a href="register.php">here</a></p>
        <form method="POST">
            <p>Username:</p>
            <input type="text" name="username"><br>
            <p>Password:</p>
            <input type="password" name="password"><br>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <input type="submit" value="Login!" name="submit">
        </form>
        <p>Forgot password? Click <a href="forgot.php">here</a>.</p>
        <?php endif; ?>
    </body>
</html>