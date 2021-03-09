<?php
require 'config.php';
session_start();

if(isset($_SESSION['id']) == false) {
//se não estiver sem id de sessão continua na página
header("Location: index.php");
session_destroy();
}

if(isset($_GET['id']) && empty($_GET['id']) == false) {
	$id = addslashes($_GET['id']);

	$sql = "DELETE FROM produtos WHERE id = '$id'";

	$sql = $pdo->query($sql);

	header("Location: prod_list.php");
} else {
	header("Location: prod_list.php");
}
?>