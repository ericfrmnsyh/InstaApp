<?php
require 'adminPermission.inc';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Profil</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
	<header>
		<div class='app-bar'>
			You Have PC Problem? Here's The Solutions
		</div>
		<div class='nav'>
			<a href="index.php">Home</a>
			<a href="edit_profil.php">Ubah Profile</a>
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
	<?php
	include 'connect.inc';
	if (isset($_SESSION['isUser'])) {
		$user = $db->query("SELECT * FROM user WHERE username_user = '$_SESSION[isUser]'");
		if ($usr = $user->fetch(PDO::FETCH_ASSOC)) {
			echo "<div class='box'><div class='isi'>";
			echo "<H2>Data Diri</H2>";
			echo "<p>Nama: {$usr['nama_user']}</p>";
			echo "<p>Email: {$usr['email_user']}</p>";
			echo "<p>No. Hp : {$usr['phone_user']}</p></div></div>";
		}
		echo "<div class='box'><h1>Diskusi Saya</h1></div>";
		echo "<main>";
		$st = $db->query("SELECT * FROM diskusi,jawaban WHERE diskusi.id_jawaban_diskusi IS NULL AND username_diskusi = '$_SESSION[isUser]'");
		if ($dis = $st->fetch(PDO::FETCH_ASSOC)) {
			echo "<div class='diskusi'><div class='Tanya'><div class='tgl'>{$dis['tgl_diskusi']}</div>";
			echo "<div class='user'>{$dis['username_diskusi']}</div>";
			echo "<p>{$dis['pertanyaan_diskusi']}</p></div>";
			echo "<div class='Jawab'><div class='tgl'></div>";
			echo "<div class='user'></div>";
			echo "<p></p></div></div>";
		}
		$state = $db->query("SELECT * FROM diskusi,jawaban WHERE diskusi.id_jawaban_diskusi = jawaban.id_jawaban AND username_diskusi = '$_SESSION[isUser]'");
		while ($dis = $state->fetch(PDO::FETCH_ASSOC)) {
			echo "<div class='diskusi'><div class='Tanya'><div class='tgl'>{$dis['tgl_diskusi']}</div>";
			echo "<div class='user'>{$dis['username_diskusi']}</div>";
			echo "<p>{$dis['pertanyaan_diskusi']}</p></div>";
			echo "<div class='Jawab'><div class='tgl'>{$dis['tgl_jawaban']}</div>";
			echo "<div class='user'>{$dis['username_jawaban']}</div>";
			echo "<p>{$dis['jawaban_jawaban']}</p></div></div>";
		}
		echo "</main>";
	} else if (isset($_SESSION['isExpert'])) {
		$user = $db->query("SELECT * FROM user WHERE username_user = '$_SESSION[isExpert]'");
		if ($usr = $user->fetch(PDO::FETCH_ASSOC)) {
			echo "<div class='box'><div class='isi'>";
			echo "<H2>Data Diri</H2>";
			echo "<p>Nama: {$usr['nama_user']}</p>";
			echo "<p>Email: {$usr['email_user']}</p>";
			echo "<p>No. Hp : {$usr['phone_user']}</p></div></div>";
		}
		echo "<div class='box'><h1>Jawaban Saya</h1></div>";
		echo "<main>";

		$state = $db->query("SELECT * FROM diskusi,jawaban WHERE diskusi.id_jawaban_diskusi = jawaban.id_jawaban AND username_jawaban = '$_SESSION[isExpert]'");
		while ($dis = $state->fetch(PDO::FETCH_ASSOC)) {
			echo "<div class='diskusi'><div class='Tanya'><div class='tgl'>{$dis['tgl_diskusi']}</div>";
			echo "<div class='user'>{$dis['username_diskusi']}</div>";
			echo "<p>{$dis['pertanyaan_diskusi']}</p></div>";
			echo "<div class='Jawab'><div class='tgl'>{$dis['tgl_jawaban']}</div>";
			echo "<div class='user'>{$dis['username_jawaban']}</div>";
			echo "<p>{$dis['jawaban_jawaban']}</p></div></div>";
		}
		echo "</main>";
	}
	?>
</body>

</html>