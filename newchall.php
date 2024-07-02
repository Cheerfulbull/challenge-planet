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
    <?php
        include("conn.php");
        $ret=0;
        if($_SESSION["username"]!=="cheerfulbull"){
            exit("<head><title>Access denied!</title></head><body><p>You are not authorised to view this page.</p></body></html>");
        }
        $conn = mysqli_connect($servername, $username, $password, $dbusers);
        function handlereg(){
                global $conn;
                if (isset($_POST["submit"])){
                    $GLOBALS["ret"]=0;
                } else {

                    $GLOBALS["ret"]=1;
                    return;
                }
                if ($_POST["token"]!==$_SESSION["token"]){
                    $GLOBALS["ret"]=1;
                    return "Invalid CSRF token";
                }
                if ($_POST["challname"]==""){
                    $GLOBALS["ret"]=1;
                    return "<p>Please enter a Challenge Name</p>";
                }

                if ($_POST["password"]==""){
                    $GLOBALS["ret"]=1;
                    return "<p>Please enter a password</p>";
                }
                if ($_POST["html"]==""){
                    $GLOBALS["ret"]=1;
                    return "<p>Please enter the HTML</p>";
                }
                if($_POST["password"]!=$_POST["cpassword"]){
                    $GLOBALS["ret"]=1;
                    return "<p>Passwords do not match</p>";
                }
                $password=password_hash($_POST["password"],PASSWORD_BCRYPT);
                if(!preg_match("/^\d+$/", $_POST["points"])){
                    $GLOBALS["ret"]=1;
                    return "<p>Points have to be a number</p>";
                }

            $sql = "INSERT INTO `challenges` values (NULL, '".htmlspecialchars($_POST["challname"], ENT_QUOTES)."', '".base64_encode($_POST["html"])."', '".$password."', ".$_POST["points"].", '".$_POST["category"]."')";
            //echo $sql;
                $result = mysqli_query($conn, $sql);


            }


        echo handlereg();
    ?>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Make a new challenge</title>
    </head>
    <body>
    <?php include("nav.php"); ?>
        <h1>Create a new challenge</h1>
        <?php if($GLOBALS["ret"]==1) : ?>
        <form method="POST">
            <p>Challenge Name:</p>
            <input type="text" name="challname"><br>
            <p>Challenge category:</p>
            <select name="category">
                <option value="Cracking">Cracking</option>
                <option value="Cryptography">Cryptography</option>
                <option value="Exploit">Exploit</option>
                <option value="Forensics">Forensics</option>
                <option value="Fun">Fun</option>
                <option value="JavaScript">JavaScript</option>
                <option value="Logic">Logic</option>
                <option value="Programming">Programming</option>
                <option value="Realistic">Realistic</option>
                <option value="Research">Research</option>
                <option valuue="Steganography">Steganography</option>
            </select><br>
            <p>Challenge HTML</p>
            <textarea name="html"></textarea><br>
            <p>Points to give:</p>
            <input type="number" name="points" min="0" max="500"><br>
            <p>Challenge Password:</p>
            <input type="password" name="password"><br>
            <p>Confirm password:</p>
            <input type="password" name="cpassword"><br>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <input type="submit" value="Register!" name="submit">
        </form>
        <?php endif; ?>
        <?php if($GLOBALS["ret"]==0) : ?>
        <p>Challenge successfully created.</p>
        <?php endif; ?>
    </body>
</html>