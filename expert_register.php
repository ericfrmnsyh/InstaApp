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
            if (isset($_SESSION['isUser'])) {
                echo "<a href='logout.php'>Sign Out</a>";
            } elseif (isset($_SESSION['isExpert'])) {
                echo "<a href='logout.php'>Sign Out</a>";
            } else {
                echo "<a href='login.php'>Sign In</a>";
            };
            ?>
            <a href="">Diskusi</a>
            <a href="profil.php">Profile</a>
        </div>
    </header>
    <main>
        <?php 
        include 'connect.inc';
        if (!isset($username)  && !isset($nama) && !isset($email) && !isset($phone) && !isset($pass) && !isset($confirm)) {
            $username = '';
            $nama = '';
            $email = '';
            $phone = '';
            $pass = '';
            $confirm = '';
        }
        
        $username = filter_input(INPUT_POST, 'username');
        $nama = filter_input(INPUT_POST, 'nama');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $pass = filter_input(INPUT_POST, 'pass');
        $confirm = filter_input(INPUT_POST, 'confirm');
        
        if (isset($_POST['add'])) {
            function checkUser($username)
            {
                include 'connect.inc';
                $query = $db->prepare("SELECT * FROM user WHERE username_user = :username");
                $query->bindValue(':username', $_POST['username']);
                $query->execute();
                return $query->rowCount() > 0;
            }
            if (checkUser($_POST['username'])) {
                $username_error = 'Username telah digunakan';
            }
        } else if (isset($_POST['back'])) {
            header('Location: http://localhost/index.php');
            exit();
        }
        
        if (empty($username)) {
            $username_error = 'username harus diisi!';
        } elseif (!preg_match("/^(?=.*[a-z])(?=.*\d)[a-z\d]+$/", $username)) {
            $username_error = 'Isi username anda  dengan kombinasi huruf dan angka';
        }
        
        if (empty($nama)) {
            $nama_error = 'nama harus diisi!';
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $nama)) {
            $nama_error = 'Isi nama anda hanya dengan huruf!';
        }
        
        if (empty($email)) {
            $email_error = 'Email harus diisi!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = 'Format email anda salah!';
        }
        
        if (empty($phone)) {
            $phone_error = 'Nomor HP harus diisi!';
        } elseif (!preg_match("/^[0-9 ]*$/", $phone)) {
            $phone_error = 'Nomor HP hanya boleh angka';
        } elseif (strlen($phone) < 12) {
            $phone_error = 'Nomor HP minimal 12 digit';
        }
        
        if (empty($pass)) {
            $pass_error = 'password harus diisi';
        } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]+$/", $pass)) {
            $pass_error = 'isi password anda dengan kombinasi huruf kecil, huruf besar, dan angka';
        } elseif (strlen($pass) < 8) {
            $pass_error = 'password minimal 8 karakter';
        }
        
        if (empty($confirm)) {
            $confirm_error = ' Password tidak sama';
        } elseif ($confirm != $pass) {
            $confirm_error = ' Password tidak sama';
        }
        
        if (empty($username_error) && empty($nama_error) && empty($email_error) && empty($hp_error) && empty($pass_error) && empty($confirm_error)) {
            $state = $db->prepare("INSERT INTO user (username_user,nama_user,password_user,phone_user,email_user,id_status_user) VALUES (:username,:nama,SHA2(:pass,0),:phone,:email,:id_status)");
            $state->bindValue(':username', $_POST['username']);
            $state->bindValue(':nama', $_POST['nama']);
            $state->bindValue(':pass', $_POST['pass']);
            $state->bindValue(':phone', $_POST['phone']);
            $state->bindValue(':email', $_POST['email']);
            $state->bindValue(':id_status', '02');
            $state->execute();
            header('Location: http://localhost/Tugas Akhir/index.php');
        } else {
            include('expert_form.inc');
        }
        ?>
    </main>
</body>

</html>