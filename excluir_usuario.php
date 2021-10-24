<?php
require 'config.php';
session_start();

if(isset($_SESSION['id']) == false){
//se não estiver sem id de sessão continua na página
header("Location: index.php");
session_destroy();
}

if(isset($_GET['id']) && empty($_GET['id']) == false) {
	//pega o ID do cliente que o usuário selecionou para alterar o registro.
	$id = addslashes($_GET['id']);
}
//se o ID da pessoa que for fazer o login for maior que 1 a sessão se quebra
if ($_SESSION['id'] > 1){
    header("Location: index.php");
    session_destroy();
}


if(isset($_GET['id']) && empty($_GET['id']) == false) {
	$id = addslashes($_GET['id']);

	$sql = "DELETE FROM usuarios WHERE id = '$id'";

	$sql = $pdo->query($sql);

	header("Location: lista_usuario.php");
} else {
	header("Location: lista_usuario.php");
}
?>