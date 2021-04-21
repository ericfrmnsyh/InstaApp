<?php
session_start();
$tgl = date('Y-m-d');
include 'connect.inc';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Ini Index</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
	<header>
		<div class='app-bar'>
			You Have PC Problem? Here's The Solutions
		</div>
		<div class='nav'>
			<a href="profil.php">Profile</a>
			<?php
			if (isset($_SESSION['isUser'])) {
				echo "<a href='diskusi.php'>Buat Diskusi</a>";
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
		<?php
		if (isset($_SESSION['isUser'])) {
			$state = $db->query("SELECT * FROM diskusi ORDER BY id_diskusi DESC");
			while ($dis = $state->fetch(PDO::FETCH_ASSOC)) {
				echo "<div class='diskusi'><div class='Tanya'><div class='tgl'>{$dis['tgl_diskusi']}</div>";
				echo "<div class='user'>{$dis['username_diskusi']}</div>";
				echo "<p>{$dis['pertanyaan_diskusi']}</p>";
				$id = $dis['id_diskusi'];
				$usr = $db->query("SELECT username_diskusi FROM diskusi WHERE username_diskusi = '$_SESSION[isUser]' AND id_diskusi = $id");
				if ($user = $usr->fetch(PDO::FETCH_ASSOC)) {
					echo "<button onclick='window.location.href=\"update_diskusi.php?iddiskusi=$id\"'>Edit</button>";
				}
				echo "</div>";
				$conn = $db->query("SELECT * FROM diskusi,jawaban WHERE diskusi.id_jawaban_diskusi = jawaban.id_jawaban AND id_diskusi = $id");
				if ($con = $conn->fetch(PDO::FETCH_ASSOC)) {
					echo "<div class='Jawab'><div class='tgl'>{$con['tgl_jawaban']}</div>";
					echo "<div class='user'>{$con['username_jawaban']}</div>";
					echo "<p>{$con['jawaban_jawaban']}</p></div>";
				}
				echo "</div>";
			}
		} elseif (isset($_SESSION['isExpert'])) {
			$state = $db->query("SELECT * FROM diskusi ORDER BY id_diskusi DESC");
			while ($dis = $state->fetch(PDO::FETCH_ASSOC)) {
				$idd = $dis['id_diskusi'];
				echo "<div class='diskusi'><div class='Tanya'><div class='tgl'>{$dis['tgl_diskusi']}</div>";
				echo "<div class='user'>{$dis['username_diskusi']}</div>";
				echo "<p>{$dis['pertanyaan_diskusi']}</p></div>";
				$jawab = $db->query("SELECT * FROM diskusi WHERE diskusi.id_jawaban_diskusi is NULL and diskusi.id_diskusi = '$idd' ");
				if ($jwb = $jawab->fetch(PDO::FETCH_ASSOC)) {
					echo "<div class='Jawab'><form name='FormJawab' action='index.php' method='POST'>";
					echo "<label>Beri Jawaban</label> <input type='text' name='reply'>";
					echo "<input type='hidden' name='iddiskusi' value='{$dis['id_diskusi']}'>";
					echo "<input type='hidden' name='user' value='{$dis['username_diskusi']}'>";
					echo "<input type='submit' name='answer' value='Jawab'></form>";
					if (isset($_POST['answer'])) {
						$a = 1;
						$id = $db->query("SELECT id_jawaban FROM jawaban ORDER BY id_jawaban DESC LIMIT 1");
						if ($b = $id->fetch(PDO::FETCH_ASSOC)) {
							$a = $b['id_jawaban'] + 1;
						}
						$jawab = $db->prepare("INSERT INTO jawaban (username_jawaban,jawaban_jawaban,tgl_jawaban) VALUES (:user,:reply,:date)");
						$jawab->bindValue(':user', $_SESSION['isExpert']);
						$jawab->bindValue(':reply', $_POST['reply']);
						$jawab->bindValue(':date', $tgl);
						$jawab->execute();
						$inp = $db->prepare("UPDATE diskusi SET id_jawaban_diskusi = :id WHERE id_diskusi = :idd AND username_diskusi = :user");
						$inp->bindValue(':id', $a);
						$inp->bindValue(':idd', $_POST['iddiskusi']);
						$inp->bindValue(':user', $_POST['user']);
						$inp->execute();
						header("Refresh:0");
					}
					echo "</div>";
				}
				$conn = $db->query("SELECT * FROM diskusi,jawaban WHERE diskusi.id_jawaban_diskusi = jawaban.id_jawaban AND id_diskusi = $idd");
				if ($con = $conn->fetch(PDO::FETCH_ASSOC)) {
					echo "<div class='Jawab'><div class='tgl'>{$con['tgl_jawaban']}</div>";
					echo "<div class='user'>{$con['username_jawaban']}</div>";
					echo "<p>{$con['jawaban_jawaban']}</p>";
					$id = $con['id_jawaban'];
					$usr = $db->query("SELECT username_jawaban FROM jawaban WHERE username_jawaban = '$_SESSION[isExpert]' AND id_jawaban = $id");
					if ($user = $usr->fetch(PDO::FETCH_ASSOC)) {
						echo "<button onclick='window.location.href=\"update_jawab.php?idjawab=$id\"'>Edit</button>";
					}
					echo "</div>";
				}
				echo "</div>";
			}
		} else {
			include 'home.inc';
		}
		?>
	</main>
</body>

</html>