<?php
    if(isset($_GET["authkey"]) && isset($_GET["username"]) && isset($_GET["email"]) && md5($_GET["authkey"])==="1b88d7e23076fb7adff1bfe436a5c800"){
        if ($_GET["username"]==""){
            exit("0");
        }
        if ($_GET["email"]==""){
            exit("0");
        }
        if(preg_match('/[^a-z0-9]/', $_GET["username"])){
            exit("0");
        }
        if(!preg_match("/^[a-z][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_GET["email"])){
            exit("0");
        }
        include("conn.php");
        $conn = mysqli_connect($servername, $username, $password, $dbusers);
        $sql = "SELECT * FROM `users` where username='".$_GET["username"]."' and email='".$_GET["email"]."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) !== 1) {
            exit("0");
        }
        echo "1";
    }else{
        echo "0";
    }
?>