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

<div class="container">
        <header class="cabecalho">
        </header>
        
        <div class="div_login">
            <div class="logo">
                <img src="./img/logomarcaindex.png" alt="logo">
            </div>
            <div class="form_Login">
                <form method="POST" class="form">
                    <div class="div_acesse">
                    <label>Acesse</label>
                    </div>
                    <input class="inp_name" type="text" name="email" placeholder="E-mail" autocomplete="off" required=""><br>
                    <input class="inp_senha" type="password" name="senha" placeholder="Senha" autocomplete="off ">

                    <div class="buttons">
                    <button class="buttons_form entrarButton" type="submit">Entrar</button>
                    <button class="buttons_form registerButton" type="button">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
        
        <footer class="footer">   
            <p>© GlobMobile</p>
        </footer>
    </div>
	
</body>
</html>