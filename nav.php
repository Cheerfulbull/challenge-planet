 <nav>
            <ul>
                <div id="logo">
                    <li><a href="index.php"><img src="challenge-planet.png" height="70px"></a></li>
                </div>
                
                <?php if(isset($_SESSION["username"])) : ?>
                    <li><a href="challenges.php">Challenges</a></li>
                    <li><a <?php echo " href='profile.php?user=".$_SESSION["username"]; ?>'>Your profile</a></li>
                    <li><a href='index.php?logout=1'>Logout</a></li>
                <?php else : ?>
                    <li><a href="login.php">Login</a></li>
                    <li> <a href='register.php'>Register</a></li>
                    <li> <a href='forgot.php'>Forgot Password?</a></li>
                <?php endif; ?>
            </ul>
        </nav>