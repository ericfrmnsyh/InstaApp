<?php
require_once('valid.inc');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form</title>
    <link rel="stylesheet" type="text/css" href="form.css">
</head>

<body>
    <header>
        <div class='app-bar'>
            You Have PC Problem? Here's The Solutions
        </div>
        <div class='nav'>
            <a href="index.php">Home</a>
            <a href="profil.php">Profile</a>
            <?php
			if (isset($_SESSION['isUser'])) {
				echo "<a href='logout.php'>Sign Out</a>";
			} elseif (isset($_SESSION['isExpert'])) {
				echo "<a href='logout.php'>Sign Out</a>";
			} else {
				echo "<a href='login.php'>Sign In</a>";
			};
			?>
        </div>
    </header>
    <main>
        <fieldset>
            <h1>User Sign In</h1>
            <div class='form'>
                <form name='myform' action="login.php" method="POST">
                    <?php
                    include 'login.inc';
                    ?>
                    <div class="box">
                        <a href="expert_login.php">Sign In as Expert</a>
                    </div>
                    <div class="box">
                        <label>Don't have account?</label><a href="register.php">Sign Up</a>
                    </div>
                </form>
            </div>
        </fieldset>
    </main>
</body>

</html>