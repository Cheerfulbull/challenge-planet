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
        <title>Forgot your password?</title>
    </head>
    <body>
    <?php include("nav.php"); ?>
        <h1>Forgot your password?</h1>
        <?php
            include("conn.php");
            $conn = mysqli_connect($servername, $username, $password, $dbusers);
            $ret=0;
            function generateRandomString($length = 20) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[random_int(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            function handlelogin(){
                global $conn;
                if (isset($_SESSION["username"])){
                    $GLOBALS["ret"]=1;
                    return "<script>location.replace('index.php')</script>";
                }
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
                    return "<p>Please enter an email</p>";
                }
                if(!preg_match("/^[a-z][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST["email"])){
                    $GLOBALS["ret"]=1;
                    return "<p>Email is invalid</p>";
                }
                $sql = "SELECT reset FROM `users` where email='".$_POST["email"]."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) < 1) {
                    $GLOBALS["ret"]=1;
                    return "<p>If your address is registered, a password reset email has been sent to your address from \"challenge-planet@challenge-planet.42web.io\", please open it and click on the link. Make sure to check your junk/spam folder.</p>";
                }
                                $token=generateRandomString(20);
            $sql = "UPDATE `users` SET forgottoken='".md5($token)."',reset=1 where email='".$_POST["email"]."'";
            
                $result = mysqli_query($conn, $sql);
                define('CONTACTFORM_TO_ADDRESS', $_POST["email"]);
define('CONTACTFORM_TO_NAME', "");
                require_once __DIR__.'/vendor/autoload.php';
                require_once __DIR__.'/functions.php';
                require_once __DIR__.'/config.php';
                $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                    $mail->setLanguage(CONTACTFORM_LANGUAGE);
    $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;
    $mail->isSMTP();
    $mail->Host = CONTACTFORM_SMTP_HOSTNAME;
    $mail->SMTPAuth = true;
    $mail->Username = CONTACTFORM_SMTP_USERNAME;
    $mail->Password = CONTACTFORM_SMTP_PASSWORD;
    $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;
    $mail->Port = CONTACTFORM_SMTP_PORT;
    $mail->CharSet = CONTACTFORM_MAIL_CHARSET;
    $mail->Encoding = CONTACTFORM_MAIL_ENCODING;
$mail->IsHTML(true); 
    // Recipients
    $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
    $mail->addAddress(CONTACTFORM_TO_ADDRESS, CONTACTFORM_TO_NAME);
    // Content
    $mail->Subject = "Password reset";
    $mail->Body    = "Greetings from Challenge Planet! Someone has requested a password reset on your account. If this was you, reset your password by clicking <a href='http://challenge-planet.42web.io/reset.php?token=".$token."'>here</a>. If this wasn't you, you can ignore this email.";
try{
    $mail->send();
}catch (Exception $e) {
    return "An error occurred while trying to send your message: ".$mail->ErrorInfo;
}
                echo "<p>If your address is registered, a password reset email has been sent to your address from \"challenge-planet@challenge-planet.42web.io\", please open it and click on the link. Make sure to check your junk/spam folder.</p>";
            }


        echo handlelogin();
        
        ?>
        <?php if($GLOBALS["ret"]==1) : ?>
        <p>Don't have an account yet? Register <a href="register.php">here</a></p>
        <form method="POST">
            <p>Email:</p>
            <input type="email" name="email"><br>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <input type="submit" value="Reset!" name="submit">
        </form>
        <?php endif; ?>
    </body>
</html>