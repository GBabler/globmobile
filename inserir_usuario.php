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
	$celular = addslashes($_POST['celular']);
	$sql = "INSERT INTO usuarios SET NOME = '$nome', email = '$email', senha = '$senha', celular = '$celular'";

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
	<link rel="stylesheet" type="text/css" href="css\inserir_usuario.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
</head>
<body> 

	<header>
		<div id="divHeader">
		<p>Registro de usuario</p>
		</div>
	</header>
	<section>
			<div id="divForm">
				<form method="POST">
					<div id="divEspaco">
						<label>Nome</label><br>
						<input type="text" name="nome"/>
					</div>
					<div id="divEspaco">
						<label>Email</label><br>
						<input type="email" name="email">
					</div>
					<div id="divEspaco">
						<label>Senha</label><br>
						<input type="password" name="senha">
					</div>
					<div id="divEspaco">
						<label>N° Celular</label><br>
						<input type="tel" name="celular">
					</div>
					
					<div id="divBtn">
						<button type="submit" id="btnInserir">Inserir</button>
						<a href="lista_usuario.php"><button type="button" id="btnVoltar">Voltar</button></a>
					</div>
				</form>
			</div>
		</section>
</body>

</html>