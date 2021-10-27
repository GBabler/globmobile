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
$celular = addslashes($_POST['celular']); // variável email.
$posicao = addslashes($_POST['posicao']);
$senha = md5(addslashes($_POST['senha']));

$sql = "UPDATE usuarios SET posicao = '$posicao', nome = '$nome', celular = '$celular', email = '$email' WHERE id = '$id'";

$sql = $pdo->query($sql); //executa o insert.
header("Location: lista_usuario.php"); //após a execução do insert, retorna para a página de consulta dos dados.
}

//apresenta apenas os dados do ïd que foi selecionado
$sql = "SELECT * FROM usuarios WHERE id = '$id' ";
$sql = $pdo->query($sql); // executa o select

if ($sql->rowCount() > 0){  // verifica se o registro existe, maior que zero.
	$dado = $sql->fetch(); //cria um array com os dados
	// $teste = var_dump($dado); variavel para pegar o valor var_dump
	// return $dado; retorna o var_dump
}else{
	header("Location: lista_usuario.php");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar Usuario</title>
	<link rel="stylesheet" type="text/css" href="./css/editar_usuario.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
</head>
<body>
		<header>
			<div id="divHeader">
			<p>Editar Usuario</p>
			</div>
		</header>
		<section>
			<div id="divForm">
				<form method="POST">
					<div class="classEspaco">
						<label>Posição na fila</label><br>
						<input type="text" name="posicao" value="<?php echo $dado['posicao']?>"/>
					<div>
					<div class="classEspaco">
						<label>Nome</label><br>
						<input type="text" name="nome" value="<?php echo $dado['nome']?>"/>
					</div>
					<div class="classEspaco">
						<label>Email</label><br>
						<input type="email" name="email" value="<?php echo $dado['email']?>"/>
					</div>
					<div class="classEspaco">
						<label>N° Celular</label><br>
						<input type="text" name="celular" value="<?php echo $dado['celular']?>"/>
					</div>
					<div id="divBtn">
					<button type="submit" id="btnInserir">Salvar</button>
					<a href="lista_usuario.php"><button type="button" id="btnVoltar">Cancelar</button></a>
					<div>
				</form>
			</div>
		</section>
</body>

</html> 