<?php
require 'config.php';
session_start();

if(isset($_SESSION['id']) == false) {
//se não estiver sem id de sessão continua na página
header("Location: index.php");
session_destroy();
}

if (isset($_POST['nome']) && empty($_POST['nome']) == false) {

	$nome = addslashes($_POST['nome']);
	$celular = addslashes($_POST['celular']);

	$sql = "INSERT INTO usuarios SET nome = '$nome', celular = '$celular'";

	$sql = $pdo->query($sql);
	header ("Location: lista_usuario.php");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inserir Usuario</title>
	<link rel="stylesheet" type="text/css" href="./css/inserir_usuario.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
</head>
<body> 

	<header class="header">
			<h1>Registro de Usuario</h1>	
	</header>
	<form method="POST">
		<div class="color-form">
			<div class="centralizar">
				
				<div class="input-label">
				<label>Nome: </label><br>
				<input type="text" name="nome"/><br><br>
							
				<label>N° Celular : </label><br>
				<input type="tel" name="celular"> <br><br>
			
			<div class="div-button">
			<button type="submit" class="button">Inserir</button>
			<a href="lista_usuario.php"><button type="button" class="button">Voltar</button><br><p></a>
		</div>
		</div>
		</div>	
	</form>

</body>

</html>