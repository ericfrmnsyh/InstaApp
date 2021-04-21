<?php
require 'adminPermission.inc';
include 'connect.inc';
$nama = filter_input(INPUT_POST, 'nama');
$email = filter_input(INPUT_POST, 'email');
$phone = filter_input(INPUT_POST, 'phone');


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

if (empty($nama_error) && empty($email_error) && empty($hp_error)) {
	session_start();
	if (isset($_SESSION['isUser'])){
		$state = $db->prepare("UPDATE user SET nama_user=:nama, phone_user=:phone, email_user=:email WHERE username_user = '$_SESSION[isUser]'");
	}
	if (isset($_SESSION['isExpert'])){
		$state = $db->prepare("UPDATE user SET nama_user=:nama, phone_user=:phone, email_user=:email WHERE username_user = '$_SESSION[isExpert]'");
	}
	$state->bindValue(':nama', $_POST['nama']);
	$state->bindValue(':phone', $_POST['phone']);
	$state->bindValue(':email', $_POST['email']);
	$state->execute();
	header('Location: http://localhost/InstaApp/index.php');
} else {
	include('ubah.php');
}
