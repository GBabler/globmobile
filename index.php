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
		$sql = $pdo->query("SELECT * FROM administrador WHERE email = '$email' and senha = '$senha'");
		if ($sql->rowCount() > 0){ 
		
		$dado = $sql->fetch(); //cria um array com os valores do usuário
		$_SESSION['id'] = $dado['id'];
		$_SESSION['nome'] = $dado['nome'];
		$_SESSION['email'] = $dado['email'];
		$_SESSION['senha'] = $dado['senha'];

			header("Location: menu.php");
		}
		
		//---------------------------------------
		
		//---------------------------------------
		else {
		$email = addslashes($_POST['email']); //pega o e-mail digitado
		$senha = md5(addslashes($_POST['senha'])); //pega a senha digitada 

		//verifica se o e-mail e a senha constam no banco de dados.
		$sql = $pdo->query("SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'");
		if ($sql->rowCount() > 0){ 
		
		$dado = $sql->fetch(); //cria um array com os valores do usuário
		$_SESSION['id'] = $dado['id'];
		$_SESSION['nome'] = $dado['nome'];
		$_SESSION['email'] = $dado['email'];
		$_SESSION['senha'] = $dado['senha'];

		//direciona o aluno para a tela de confirmação com seu respectivo ID ja pré selecionado
		header('Location: menu_usuario.php?id='.$_SESSION['id'].'');
		}
		}

	}
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>GlobMobile</title>
	<link rel="stylesheet" type="text/css" href="./css/index.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
</head>
<body>


	<header>
        <p>
        <h1>GlobMobile</h1>
        <h2>Login</h2>
        </p>
    </header>
	<section>
    <div id="telaLogin">
        
        <div id="telaLogin">
			<form method="POST">
            <p>
                Usuario <br>
                <input id="iptLogin" type="text" name="email" placeholder="E-mail" autocomplete="off" required=""><br>
            </p>
            <p> 
                Senha <br>
                <input id="iptSenha" type="password" name="senha" placeholder="Senha" autocomplete="off ">
            </p>
           		 <div id = divBtnLogin>
					<button id="iptBtnLogin" type="submit">Entrar</button>
            	 </div>
			</form>
        </div>
        
    </div>
    </section>
	
        
        <footer> 
            <p>© GlobMobile</p>
        </footer>
</body>
</html>