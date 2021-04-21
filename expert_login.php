<?php
if (isset($_POST['login'])) {
	function checkPassword($username, $password, $id_status)
	{
		include 'connect.inc';
		$query = $db->prepare("SELECT * FROM user WHERE username_user = :username AND password_user = SHA2(:pass, 0) AND id_status_user = '02'");
		$query->bindValue(':username', $_POST['username']);
		$query->bindValue(':pass', $_POST['pass']);
		$query->execute();
		return $query->rowCount() > 0;
	}
	if (checkPassword($_POST['username'], $_POST['pass'], '02')) {
		session_start();
		$_SESSION['isExpert'] = $_POST['username'];
		header('Location: http://localhost/Tugas Akhir/index.php');
		exit();
	}
} else if (isset($_POST['back'])) {
	header('Location: http://localhost/index.php');
	exit();
} ?>

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
			<?php
			if (!isset($_SESSION['isExpert'])) {
				echo "<a href='expert_register.php'>Sign Up</a>";
			} else {
				echo "<a href='logout.php'>Sign Out</a>";
			};
			?>
			<a href="">Diskusi</a>
			<a href="profil.php">Profile</a>
		</div>
	</header>
	<main>
		<fieldset>
			<h1>Expert Sign In</h1>
			<div class='form'>
				<form name='myform' action="expert_login.php" method="POST">
					<?php
					include 'login.inc';
					?>
					<div class="box">
						<label>Don't have account?</label><a href="expert_register.php">Sign Up</a>
					</div>
				</form>
			</div>
		</fieldset>
	</main>
</body>

</html>