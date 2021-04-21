<?php
if (!isset($username)  && !isset($email) && !isset($phone)) {
	$username = '';
	$email = '';
	$phone = '';
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
			<h1>EDIT PROFIL</h1>
			<div class='form'>
				<?php
				include 'connect.inc';
				if (isset($_SESSION['isUser'])) {
					$profile = $db->query("SELECT * from user WHERE username_user = '$_SESSION[isUser]'");
				} else if (isset($_SESSION['isExpert'])) {
					$profile = $db->query("SELECT * from user WHERE username_user = '$_SESSION[isExpert]'");
				}
				$data = $profile->fetch(PDO::FETCH_ASSOC);
				?>
				<form name='myform' action="edit_profil.php" method="POST">
					<div class="field">
						<label>Nama</label>
						<div>
							<input name="nama" type="text" class="kontrol-form" value="<?php echo $data['nama_user']; ?>">
							<?php if (isset($nama_error)) { ?>
								<p><?php echo $nama_error ?></p>
							<?php } ?>
						</div>
					</div>

					<div class="field">
						<label>Phone</label>
						<div>
							<input name="phone" type="text" class="kontrol-form" value="<?php echo $data['phone_user']; ?>">
							<?php if (isset($phone_error)) { ?>
								<p><?php echo $phone_error ?></p>
							<?php } ?>
						</div>
					</div>

					<div class="field">
						<label>Email</label>
						<div>
							<input name="email" type="text" class="kontrol-form" value="<?php echo $data['email_user']; ?>">
							<?php if (isset($email_error)) { ?>
								<p><?php echo $email_error ?></p>
							<?php } ?>
						</div>
					</div>

					<div class="button">
						<input name="update" type="submit" class="kontrol-form" value="SUBMIT">
						<input type="reset" class="kontrol-form" value="RESET">
					</div>
				</form>
			</div>
		</fieldset>
	</main>
</body>

</html>