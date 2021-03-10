<?php
require 'config.php';
session_start();

if(isset($_SESSION['id']) == false) {
//se não estiver sem id de sessão continua na página
header("Location: index.php");
session_destroy();
}

if(isset($_GET['id']) && empty($_GET['id']) == false) {
	//pega o ID do cliente que o usuário selecionou para alterar o registro.
	$id = addslashes($_GET['id']);
}

if (isset($_POST['nome']) && empty($_POST['nome']) == false) { 
// pega os valores digitados nos campos do formulario e insere nas variáveis 
$nome = addslashes($_POST['nome']); //variável nome
$email = addslashes($_POST['email']); // variável email.

//altera os registros no BD, apenas do id selecionado.
$sql = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id = '$id'";

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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body bgcolor="#4F4F4F" text="#DCDCDC";>
	<form method="POST">
	<label>Nome: </label>
	<!-- O valor dentro do input, exibe o nome que está dentro do array -->
	<input type="text" name="nome" value="<?php echo $dado['nome']?>"/> </br> 

	<label>email: </label>
	<!-- O valor dentro do input, exibe o email que está dentro do array -->
	<input type="text" name="email" value="<?php echo $dado['email']?>"/> </br>

	<button type="submit">Salvar</button>

	<a href="lista_usuario.php"><button type="button">Cancelar</button></a>
</form>
</body>

</html> 