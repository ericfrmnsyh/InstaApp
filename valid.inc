<?php
include 'connect.inc';
if (isset($_POST['login'])) {
    function checkPassword($username, $password, $id_status)
    {
        $db = new PDO('mysql:host=localhost;dbname=forum','root','');
        $query = $db->prepare("SELECT * FROM user WHERE username_user = :username AND password_user = SHA2(:pass, 0) AND id_status_user = '01'");
        $query->bindValue(':username', $_POST['username']);
        $query->bindValue(':pass', $_POST['pass']);
        $query->execute();
        return $query->rowCount() > 0;
    }
    if (checkPassword($_POST['username'], $_POST['pass'], '01')) {
        session_start();
        $_SESSION['isUser'] = $_POST['username'];
        header('Location: http://localhost/InstaApp/index.php');
        exit();
    }
} else if (isset($_POST['back'])) {
    header('Location: http://localhost/InstaApp/index.php');
    exit();
}
?>