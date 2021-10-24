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
// pega os valores digitados nos campos do formulario e insere nas variáveis 
$nome = addslashes($_POST['nome']); //variável nome
$email = addslashes($_POST['email']); // varável email.
$senha = md5(addslashes($_POST['senha'])); // variável senha com criptografia MD5

//altera os registros no BD, apenas do id selecionado.
$sql = "UPDATE administrador SET nome = '$nome', email = '$email', senha = '$senha' WHERE id = '$id'";

$sql = $pdo->query($sql); //executa o insert.
header("Location: lista_adm.php"); //após a execução do insert, retorna para a página de consulta dos dados.
}

//apresenta apenas os dados do ïd que foi selecionado
$sql = "SELECT * FROM administrador WHERE id = '$id' ";
$sql = $pdo->query($sql); // executa o select

if ($sql->rowCount() > 0){  // verifica se o registro existe, maior que zero.
	$dado = $sql->fetch(); //cria um array com os dados
	// $teste = var_dump($dado); variavel para pegar o valor var_dump
	// return $dado; retorna o var_dump
}else{
	header("Location: lista_adm.php");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar Administrador</title>
	<link rel="stylesheet" type="text/css" href="./css/editar_adm.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
</head>
<body>
		<header>
			<div id="divHeader">
			<p>Editar Administrador</p>
			</div>
		</header>
		<section>
			<div id="divForm">
				<form method="POST">
					<div class="classEspaco">
						<label>Nome</label><br>
						<input type="text" name="nome" value="<?php echo $dado['nome']?>"/>
					</div>
					<div class="classEspaco">
						<label>Email</label><br>
						<input type="email" name="email" value="<?php echo $dado['email']?>"/>
					</div>
					<div class="classEspaco">
						<label>Senha</label><br>
						<input type="password" name="senha" value="<?php echo $dado['senha']?>"/>
					</div>
					
					<div id="divBtn">
					<button type="submit" id="btnInserir">Salvar</button>
					<a href="lista_adm.php"><button type="button" id="btnVoltar">Cancelar</button></a>
					<div>
				</form>
			</div>
		</section>
</body>
</html> 