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
	$email = addslashes($_POST['email']);
	$senha = md5(addslashes($_POST['senha']));

	$sql = "INSERT INTO cadastro SET NOME = '$nome', email = '$email', senha = '$senha' ";

	$sql = $pdo->query($sql);
	header ("Location: lista_adm.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

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
		<label>Nome: </label><br>
		<input type="text" name="nome"/> </br><p>
			
		<label>Email: </label><br>
		<input type="email" name="email"> </br><p>
			

		<label>Senha: </label><br>
		<input type="password" name="senha"> </br>

		<br>
		<button type="submit" align="center">Salvar</button><br><p>
		<a href="lista_adm.php"><button type="button" align="center">Voltar</button><br><p></a>
	</form>

</body>

</html>