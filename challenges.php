<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Challenge Planet - Challenges</title>
    </head>
    <body>
    <?php include("nav.php"); ?>
        <h1>Challenges</h1>
        <?php
            if(isset($_SESSION["username"])){
                echo "Hello ".$_SESSION["username"]."!";
            } else {
                exit("You are not logged in! Please <a href='login.php'>log in</a></body></html>");
            }
            include("conn.php");
            $conn = mysqli_connect($servername, $username, $password, $dbusers);
        ?>
        <h2>Cracking</h2>
        <table>
            <tr>
                <th>Solved?</th>
                <th>ID</th>
                <th>Name</th>
                <th>Points</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `challenges` where category='Cracking'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_SESSION["username"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td><a href='viewchall.php?id=".$row["ID"]."'>".$row["name"]."</a></td>";
                    echo "<td>".$row["points"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <h2>Cryptography</h2>
        <table>
            <tr>
                <th>Solved?</th>
                <th>ID</th>
                <th>Name</th>
                <th>Points</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `challenges` where category='Cryptography'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_SESSION["username"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td><a href='viewchall.php?id=".$row["ID"]."'>".$row["name"]."</a></td>";
                    echo "<td>".$row["points"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <h2>Exploit</h2>
        <table>
            <tr>
                <th>Solved?</th>
                <th>ID</th>
                <th>Name</th>
                <th>Points</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `challenges` where category='Exploit'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_SESSION["username"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td><a href='viewchall.php?id=".$row["ID"]."'>".$row["name"]."</a></td>";
                    echo "<td>".$row["points"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <h2>Forensics</h2>
        <table>
            <tr>
                <th>Solved?</th>
                <th>ID</th>
                <th>Name</th>
                <th>Points</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `challenges` where category='Forensics'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_SESSION["username"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td><a href='viewchall.php?id=".$row["ID"]."'>".$row["name"]."</a></td>";
                    echo "<td>".$row["points"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <h2>Fun</h2>
        <table>
            <tr>
                <th>Solved?</th>
                <th>ID</th>
                <th>Name</th>
                <th>Points</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `challenges` where category='Fun'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_SESSION["username"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td><a href='viewchall.php?id=".$row["ID"]."'>".$row["name"]."</a></td>";
                    echo "<td>".$row["points"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <h2>JavaScript</h2>
        <table>
            <tr>
                <th>Solved?</th>
                <th>ID</th>
                <th>Name</th>
                <th>Points</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `challenges` where category='Javascript'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_SESSION["username"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td><a href='viewchall.php?id=".$row["ID"]."'>".$row["name"]."</a></td>";
                    echo "<td>".$row["points"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <h2>Logic</h2>
        <table>
            <tr>
                <th>Solved?</th>
                <th>ID</th>
                <th>Name</th>
                <th>Points</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `challenges` where category='Logic'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_SESSION["username"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td><a href='viewchall.php?id=".$row["ID"]."'>".$row["name"]."</a></td>";
                    echo "<td>".$row["points"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <h2>Programming</h2>
        <table>
            <tr>
                <th>Solved?</th>
                <th>ID</th>
                <th>Name</th>
                <th>Points</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `challenges` where category='Programming'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_SESSION["username"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td><a href='viewchall.php?id=".$row["ID"]."'>".$row["name"]."</a></td>";
                    echo "<td>".$row["points"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <h2>Research</h2>
        <table>
            <tr>
                <th>Solved?</th>
                <th>ID</th>
                <th>Name</th>
                <th>Points</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `challenges` where category='Research'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_SESSION["username"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td><a href='viewchall.php?id=".$row["ID"]."'>".$row["name"]."</a></td>";
                    echo "<td>".$row["points"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <h2>Steganography</h2>
        <table>
            <tr>
                <th>Solved?</th>
                <th>ID</th>
                <th>Name</th>
                <th>Points</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `challenges` where category='Steganography'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_SESSION["username"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td><a href='viewchall.php?id=".$row["ID"]."'>".$row["name"]."</a></td>";
                    echo "<td>".$row["points"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>           