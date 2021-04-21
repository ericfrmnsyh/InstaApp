<?php
require 'adminPermission.inc';
include 'connect.inc';
$tgl = date('Y-m-d');
if (isset($_POST['ask'])) {
	$state = $db->prepare("INSERT INTO diskusi (username_diskusi,pertanyaan_diskusi,tgl_diskusi) VALUES (:user,:quest,:date)");
	$state->bindValue(':user', $_SESSION['isUser']);
	$state->bindValue(':quest', $_POST['quest']);
	$state->bindValue(':date', $tgl);
	$state->execute();
	header('Location: http://localhost/InstaApp/index.php');
}
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
			if (!isset($_SESSION['isUser'])) {
				echo "<a href='login.php'>Sign In</a>";
			} else {
				echo "<a href='logout.php'>Sign Out</a>";
			};
			?>
		</div>
	</header>
	<main>
		<fieldset>
			<h1>Apa yang ingin anda tanyakan</h1>
			<div class='form'>
				<form name='myform' action="diskusi.php" method="POST">
					<div class="field">
						<div>
							<input name="quest" type="text" class="kontrol-form">
						</div>
					</div>

					<div class="button">
						<input name="ask" type="submit" class="kontrol-form" value="Tanya">
					</div>
				</form>
			</div>
		</fieldset>
	</main>
</body>

</html>