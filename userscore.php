<?php
    if(isset($_GET["authkey"]) && isset($_GET["username"]) && md5($_GET["authkey"])==="1b88d7e23076fb7adff1bfe436a5c800"){
        if ($_GET["username"]==""){
            exit("0");
        }
        if(preg_match('/[^a-z0-9]/', $_GET["username"])){
            exit("0");
        }
        include("conn.php");
        $conn = mysqli_connect($servername, $username, $password, $dbusers);
        $sql = "SELECT * FROM `users` where username='".$_GET["username"]."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) !== 1) {
            exit("0");
        }
        $row=mysqli_fetch_array($result);
        $sql = "SELECT * FROM `users` where points<".$row["points"];
        $result = mysqli_query($conn, $sql);
        $rank=mysqli_num_rows($result);
        $score=$row["points"];
        $sql = "SELECT SUM(points) FROM `challenges`";
        $result = mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result);
        $maxscore=$row["SUM(points)"];
        $sql = "SELECT * FROM `challengesolves` where user='".$_GET["username"]."'";
        $result = mysqli_query($conn, $sql);
        $challsolved=mysqli_num_rows($result);
        $sql = "SELECT * FROM `challenges`";
        $result = mysqli_query($conn, $sql);
        $challcount=mysqli_num_rows($result);
        $sql = "SELECT * FROM `users`";
        $result = mysqli_query($conn, $sql);
        $usercount=mysqli_num_rows($result);
        exit(sprintf('%s:%d:%d:%d:%d:%d:%d', $_GET['username'], $rank, $score, $maxscore, $challsolved, $challcount, $usercount));
    }else{
        echo "0";
    }
?>