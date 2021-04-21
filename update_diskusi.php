<?php
require 'adminPermission.inc';
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
            <?php
            if (isset($_SESSION['isUser'])) {
                echo "<a href='logout.php'>Sign Out</a>";
            } elseif (isset($_SESSION['isExpert'])) {
                echo "<a href='logout.php'>Sign Out</a>";
            } else {
                echo "<a href='login.php'>Sign In</a>";
            };
            ?>
            <a href="index.php">Home</a>
            <a href="profil.php">Profile</a>
        </div>
    </header>
    <main>
        <?php
        $id = $_REQUEST['iddiskusi'];
        $disk = $db->query("SELECT * FROM diskusi WHERE diskusi.id_jawaban_diskusi is NULL AND id_diskusi = '$id'");
        while ($dis = $disk->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='diskusi'><div class='Tanya'><div class='tgl'>{$dis['tgl_diskusi']}</div>";
            echo "<div class='user'>{$dis['username_diskusi']}</div>";
        ?>
            <div class='form'>
                <form name='myform' action="update_diskusi.php" method="POST">
                    <div class="field">
                        <div>
                            <input name="quest" type="text" class="kontrol-form" value="<?php echo $dis['pertanyaan_diskusi']; ?>">
                        </div>
                    </div>

                    <div class="field">
                        <div>
                            <input name="iddiskusi" type="hidden" class="kontrol-form" value="<?php echo $dis['id_diskusi']; ?>">
                        </div>
                    </div>

                    <div class="button">
                        <input name="editDiscuss" type="submit" class="kontrol-form" value="Update">
                    </div>
                </form>
            </div>
        <?php
            echo "<div class='Jawab'><div class='tgl'> </div>";
            echo "<div class='user'> </div>";
            echo "<p></p> </div>";
            echo "</div>";
        }
        $state = $db->query("SELECT * FROM diskusi,jawaban WHERE diskusi.id_jawaban_diskusi = jawaban.id_jawaban AND id_diskusi = '$id'");
        while ($dis = $state->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='diskusi'><div class='Tanya'><div class='tgl'>{$dis['tgl_diskusi']}</div>";
            echo "<div class='user'>{$dis['username_diskusi']}</div>";
        ?>
            <div class='form'>
                <form name='myform' action="update_diskusi.php" method="POST">
                    <div class="field">
                        <div>
                            <input name="quest" type="text" class="kontrol-form" value="<?php echo $dis['pertanyaan_diskusi']; ?>">
                        </div>
                    </div>

                    <div class="field">
                        <div>
                            <input name="iddiskusi" type="hidden" class="kontrol-form" value="<?php echo $dis['id_diskusi']; ?>">
                        </div>
                    </div>

                    <div class="button">
                        <input name="editDiscuss" type="submit" class="kontrol-form" value="Update">
                    </div>
                </form>
            </div>
        <?php
            echo "<div class='Jawab'><div class='tgl'>{$dis['tgl_jawaban']}</div>";
            echo "<div class='user'>{$dis['username_jawaban']}</div>";
            echo "<p>{$dis['jawaban_jawaban']}</p></div></div>";
        }
        echo "</div>";
        ?>
    </main>
    <?php
    $tgl = date('Y-m-d');
    if (isset($_POST['editDiscuss'])) {
        $update = $db->prepare("UPDATE diskusi SET pertanyaan_diskusi=:pertanyaan, tgl_diskusi=:date WHERE id_diskusi=:id AND username_diskusi='$_SESSION[isUser]'");
        $update->bindValue(':pertanyaan', $_POST['quest']);
        $update->bindValue(':date', $tgl);
        $update->bindValue(':id', $_POST['iddiskusi']);
        $update->execute();
        header('Location: http://localhost/InstaApp/index.php');
    }

    ?>
</body>

</html>