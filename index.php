<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" type="image/x-gif" href="challengeplaneticon.gif">
        <link rel="shortcut icon" type="image/x-gif" href="challengeplaneticon.gif">
        <link rel="stylesheet" href="style.css">
        <title>Challenge Planet - Home</title>
    </head>
    <body>
    <?php 
                if (isset($_GET["logout"])){
                    if($_GET["logout"]==1){
                        unset($_SESSION["username"]);
                        session_destroy();
                    }
                }
                ?>
           <?php include("nav.php"); ?>
        <h1>Home</h1>

        <?php
            if(isset($_SESSION["username"])){
                echo "Hello ".$_SESSION["username"],"! Go to the <a href='challenges.php'>challenges</a>";
            } else {
                echo "Hello Guest! Please <a href='login.php'>log in</a>";
            }
        ?>
        <h2>What is this?</h2>
        <p>Challenge Planet is a website that helps you train your programming, cybersecurity, and problem-solving skills by giving you "challenges": tasks that you have to solve to get a password and then use that password to get points.<br>
        We have challenges in the following categories:
        <ul>
            <li>Cryptography</li>
            <li>Cracking</li>
            <li>Exploit</li>
            <li>Steganography</li>
            <li>Forensics</li>
            <li>Fun</li>
            <li>Javascript</li>
            <li>Logic</li>
            <li>Programming</li>
            <li>Realistic</li>
            <li>Research</li>
        </ul>
        </p>
        <p>We also have a Discord server you can join <a href="https://discord.gg/2TWFX4ArcN">here</a>. Good luck and have fun!</p>
        <h2>FAQ</h2>
        <h4>The website has a problem, what do I do?</h4>
        <p>Contact me, the Admin, via Discord (cheerfulbull_29688), Email (cheerfulbulltargz@outlook.com) or WeChall.net (Cheerfulbull). I will try to fix it as soon as I can</p>
        <h4>I need help with a challenge!</h4>
        <p>Join our Discord server! People will be happy to help you</p>
        <h4>Can I see the source code?</h4>
        <p>The source code is available on GitHub <a href="google.com">Here (BROKEN LINK)</a></p>
    </body>
</html>
