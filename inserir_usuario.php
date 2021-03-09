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
	$marca = addslashes($_POST['marca']);
	$quantidade = addslashes($_POST['quantidade']);

	$sql = "INSERT INTO produtos SET nome = '$nome', marca = '$marca', quantidade = '$quantidade' ";

	$sql = $pdo->query($sql);
	header ("Location: lista_usuario.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name = "viewport" content="widht=device-width, inicial-scale=1.0">
	<div style="text-align: right;">
		<span>Bem Vindo <?php echo "$_SESSION[nome]"; ?></span> 
		<!-- mensagem de bem vindo com o nome do usuário -->

	</div>
</head>

<body bgcolor="#4F4F4F" text="#DCDCDC" align="center";>
	<form method="POST">
		<label>Nome do Produto: </label><br>
		<input type="text" name="nome"/> </br><p>
			
		<label>Marca do Produto: </label><br>
		<input type="text" name="marca"> </br><p>
			

		<label>Quantidade: </label><br>
		<input type="text" name="quantidade"> </br>

		<br>
		<button type="submit" align="center">Inserir</button><br><p>
		<a href="lista_usuario.php"><button type="button" align="center">Tabela de Produtos</button><br><p></a>
	</form>

</body>

</html>