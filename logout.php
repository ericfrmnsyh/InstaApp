<?php
if (isset($_POST['logout'])) {
	session_start();
	unset($_SESSION['isUser']);
	unset($_SESSION['isExpert']);
	header('Location: http://localhost/InstaApp/index.php');
} else if (isset($_POST['cancel'])) {
	header('Location: http://localhost/InstaApp/index.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Logged Out</title>
	<link rel="stylesheet" type="text/css" href="form.css">
</head>

<body>
	<header>
		<div class='app-bar'>
			Logged Out
		</div>
	</header>
	<main>
		<fieldset>
			<legend>Signed Out</legend>
			<div class='form'>
				<form action="logout.php" method="POST">
					<div class="button">
						<input name='logout' type="submit" class="kontrol-form" value="SIGN OUT"/>
						<input name='cancel' type="submit" class="kontrol-form" value="CANCEL"/>
					</div>
				</form>
			</div>
		</fieldset>
	</main>
</body>

</html>