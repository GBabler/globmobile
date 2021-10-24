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

if (isset($_POST['nome']) && empty($_POST['nome']) == false) {

	$nome = addslashes($_POST['nome']);
	$email = addslashes($_POST['email']);
	$senha = md5(addslashes($_POST['senha']));

	$sql = "INSERT INTO administrador SET NOME = '$nome', email = '$email', senha = '$senha' ";

	$sql = $pdo->query($sql);
	header ("Location: lista_adm.php");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro de Administrador</title>
	<link rel="stylesheet" type="text/css" href="./css/inserir_adm.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
</head>
<body>
	<header class="header">
		<h1>Registro de Administrador</h1>
	</header>
	<form method="POST">
	<div class="color-form">
		<div class="centralizar">
		<div class="input-label">
		<label>Nome: </label><br>
		<input type="text" name="nome"/>

		<label>Email: </label><br>
		<input type="email" name="email">

		<label>Senha: </label><br>
		<input type="password" name="senha">

		<button  class="button" type="submit">Salvar</button>
		<a href="lista_adm.php"><button class="button" type="button">Voltar</button></a>
	</form>

</body>

</html>