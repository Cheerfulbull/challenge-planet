<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="style.css">
    <?php include("nav.php"); ?>
        <?php
            include("conn.php");
            $ret=0;
            if(!isset($_GET["user"])){
                exit("Invalid user!");
            }
            if(preg_match('/[^a-z0-9]/', $_GET["user"])){
                exit("<p>Invalid user!</p>");
            }
            $conn = mysqli_connect($servername, $username, $password, $dbusers);
            $sql = "SELECT * FROM `users` where username='".$_GET["user"]."'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) < 1) {
                exit("<p>Invalid user!</p>");
            }
            $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
            echo "<title>Profile for ".$row["username"]."</title></head><body>";
            echo "<h1>Profile for ".$row["username"]."</h1>";
            if (isset($_SESSION["username"]) && $_GET["user"]==$_SESSION["username"]){
                echo "<h4><a href='emailchange.php'>Change your Email</a></h4>";
            }
            $sql = "SELECT challenge FROM `challengesolves` WHERE user='".$_GET["user"]."'";
            $result = mysqli_query($conn, $sql);
            $points=0;
            while ($row = mysqli_fetch_assoc($result)) {
                $sql = "SELECT * FROM `challenges` where ID=".$row["challenge"];
                $challenge = mysqli_query($conn, $sql);
                $challengepoints = mysqli_fetch_assoc($challenge);
                $points+=$challengepoints["points"];
            }
            echo "<p>This user has ".$points." points.</p>";
        ?>
        <h2>Challenges statuses for <?php echo $_GET["user"]; ?></h2>
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
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_GET["user"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td>".$row["name"]."</td>";
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
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_GET["user"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td>".$row["name"]."</td>";
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
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_GET["user"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td>".$row["name"]."</td>";
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
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_GET["user"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td>".$row["name"]."</td>";
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
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_GET["user"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td>".$row["name"]."</td>";
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
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_GET["user"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td>".$row["name"]."</td>";
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
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_GET["user"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td>".$row["name"]."</td>";
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
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_GET["user"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["points"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <h2>Realistic</h2>
        <table>
            <tr>
                <th>Solved?</th>
                <th>ID</th>
                <th>Name</th>
                <th>Points</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `challenges` where category='Realistic'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_GET["user"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td>".$row["name"]."</td>";
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
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_GET["user"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td>".$row["name"]."</td>";
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
                    $sql = "SELECT * FROM `challengesolves` where challenge=".$row["ID"]." AND user='".$_GET["user"]."'";
                    $solved = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($solved)>0){
                        echo "<td>✔</td>";
                    } else {
                        echo "<td>✘</td>";
                    }
                    echo "<td>".$row["ID"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["points"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>