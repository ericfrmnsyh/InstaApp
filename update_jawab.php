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
        <?php
        $id = $_REQUEST['idjawab'];
        $state = $db->query("SELECT * FROM diskusi,jawaban WHERE diskusi.id_jawaban_diskusi = jawaban.id_jawaban AND jawaban.id_jawaban = '$id'");
        echo "<main>";
        while ($dis = $state->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='diskusi'><div class='Tanya'><div class='tgl'>{$dis['tgl_diskusi']}</div>";
            echo "<div class='user'>{$dis['username_diskusi']}</div>";
            echo "<p>{$dis['pertanyaan_diskusi']}</p></div>";
            echo "<div class='Jawab'><div class='tgl'>{$dis['tgl_jawaban']}</div>";
            echo "<div class='user'>{$dis['username_jawaban']}</div>";
        ?>
            <div class='form'>
                <form name='myform' action="update_jawab.php" method="POST">
                    <div class="field">
                        <div>
                            <input name="quest" type="text" class="kontrol-form" value="<?php echo $dis['jawaban_jawaban']; ?>">
                        </div>
                    </div>

                    <div class="field">
                        <div>
                            <input name="idjawab" type="hidden" class="kontrol-form" value="<?php echo $dis['id_jawaban']; ?>">
                        </div>
                    </div>

                    <div class="button">
                        <input name="editDiscuss" type="submit" class="kontrol-form" value="Update">
                    </div>
                </form>
            </div>
        <?php
            echo "</div></div>";
            echo "</main>";
        }
        ?>
    <?php
    $tgl = date('Y-m-d');
    if (isset($_POST['editDiscuss'])) {
        $update = $db->prepare("UPDATE jawaban SET jawaban_jawaban=:jawaban, tgl_jawaban=:date WHERE id_jawaban=:id AND username_jawaban='$_SESSION[isExpert]'");
        $update->bindValue(':jawaban', $_POST['quest']);
        $update->bindValue(':date', $tgl);
        $update->bindValue(':id', $_POST['idjawab']);
        $update->execute();
        header('Location: http://localhost/InstaApp/index.php');
    }

    ?>
</body>

</html>