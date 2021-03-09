<?php
require 'config.php'; // conexão com o banco de dados
session_start();

$mgs = "Erro"; //retorna uma mensagem de erro do javascript se email ou senha errados.

//verifica se os campos e-mail e senha estão preenchidos
if (isset($_POST['email']) && empty($_POST['email']) == false) {
	if (isset($_POST['senha']) && empty($_POST['senha']) == false){
		$email = addslashes($_POST['email']); //pega o e-mail digitado
		$senha = md5((addslashes($_POST['senha']))); //pega a senha digitada 

		//verifica se o e-mail e a senha constam no banco de dados.
		$sql = $pdo->query("SELECT * FROM cadastro WHERE email = '$email' and senha = '$senha'");
		if ($sql->rowCount() > 0){ 
		
		$dado = $sql->fetch(); //cria um array com os valores do usuário
		$_SESSION['id'] = $dado['id'];
		$_SESSION['nome'] = $dado['nome'];
		$_SESSION['email'] = $dado['email'];
		$_SESSION['senha'] = $dado['senha'];

			header("Location: lista_usuario.php");

		} else {

			// mensagem em javascript com erro de login
			echo "

			<META HTTP-EQUIV-REFRESH CONTENT='0; URL=index.php'>
			<script type=\"text/javascript\">
			alert(\"Erro: Usuário ou senha inválidos\");
			</script>
			";
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div align="center">
		<form method="POST">

<div>
	<h1 style="text-align: center;"><strong><font color="white">LOGIN</font></strong></h1>
</div>

<div>
	<label>EMAIL</label>
	<input type="text" name="email" placeholder="e-mail" required="">
</div><br>

<div>
	<label>SENHA</label>
	<input type="password" name="senha" placeholder="Senha" required="">
</div><br>

<button type="submit"><strong>ENTRAR</strong></button>
</form>
</div>
</body>
</html>