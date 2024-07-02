<?php
 session_start();
 $token = isset($_SESSION['token']) ? $_SESSION['token'] : "";
 if (!$token) {
     $token = md5(openssl_random_pseudo_bytes(32));
     $_SESSION['token']= $token;
 }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <?php include("nav.php"); ?>
        <?php
            include("conn.php");
            $ret=0;
            if(!isset($_SESSION["username"])){
                exit("You are not logged in! Please <a href='login.php'>log in</a></body></html>");
            }
            if(preg_match('/[^0-9]/', $_GET["id"])){
                exit("<p>Invalid challenge ID!</p>");
            }
            $conn = mysqli_connect($servername, $username, $password, $dbusers);
            $sql = "SELECT * FROM `challenges` where ID=".$_GET["id"];
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) < 1) {
                exit("<p>Invalid challenge ID!</p>");
            }
            $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
            $sql = "SELECT * FROM `challengesolves` WHERE challenge=".$_GET["id"]." AND user='".$_SESSION["username"]."'";
            $result = mysqli_query($conn, $sql);
            $solved=0;
            if (mysqli_num_rows($result) > 0) {
                $solved=1;
            }
            echo "<title>".stripslashes($row["name"])."</title>";
            if (isset($_POST["password"]) && isset($_POST["submit"])){
                $success=0;
                $timeout=0;
                if ($_POST["token"]!==$_SESSION["token"]){
                    $GLOBALS["ret"]=1;
                    exit("Invalid CSRF token");
                }
                if(!isset($_SESSION["challatt"])){
                    $_SESSION["challatt"]=time()-10;
                }
                if($_SESSION["challatt"]+10<=time()){
                    if(password_verify($_POST["password"], $row["password"])){
                        if($solved===0){
                            $points=$row["points"];
                            $sql = "INSERT INTO `challengesolves` VALUES (".$_GET["id"].", '".$_SESSION["username"]."')";
                            $result = mysqli_query($conn, $sql);
                            $sql = "SELECT points FROM `users` WHERE username='".$_SESSION["username"]."'";
                            $result = mysqli_query($conn, $sql);
                            $user=mysqli_fetch_array($result);
                            $points+=$user["points"];
                            $sql = "UPDATE `users` SET points=".$points." WHERE username='".$_SESSION["username"]."'";
                            $result = mysqli_query($conn, $sql);
                        }
                        $success=1;
                    }
                } else {
                    $timeout=1;
                }
            }
        ?>
    </head>
    <body>
        <?php
            if(isset($success)){
                if($success===1){
                    exit("<p>Congratulations! You have solved the challenge!</p>");
                }
                if($success===0){
                    if ($timeout==0){
                        echo "<p>Wrong password.</p>";
                    } else {
                        echo "<p>Please wait at least 10 seconds between password submissions.</p>";
                    }
                    $_SESSION["challatt"]=time();
                }
            }
            if($solved===1){
                echo "<p>Note: you have already solved this challenge</p>";
            }
            echo "<h1>The challenge:</h1>";
            echo base64_decode($row["html"]);
        ?>
        <h1>Enter challenge password:</h1>
        <form method="POST">
            <input type="password" name="password"><input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <input type="submit" name="submit" value="submit">
        </form>
    </body>
</html>