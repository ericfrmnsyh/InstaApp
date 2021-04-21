<?php
	$db = new PDO('mysql:host=localhost;dbname=forum','root','');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>