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
$val_ida = addslashes($_POST['val_ida']); // variável email.
//altera os registros no BD, apenas do id selecionado.
$sql = "UPDATE usuarios SET val_ida = '$val_ida', nome = '$nome' WHERE id = '$id'";

$sql = $pdo->query($sql); //executa o insert.

header('Location: confirmacaoAluno.php?id='.$_SESSION['id'].'');//após a execução do insert, retorna para a página de consulta dos dados.
}

//apresenta apenas os dados do ïd que foi selecionado
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$sql = $pdo->query($sql); // executa o select

if ($sql->rowCount() > 0){  // verifica se o registro existe, maior que zero.
	$dado = $sql->fetch(); //cria um array com os dados
	// $teste = var_dump($dado); variavel para pegar o valor var_dump
	// return $dado; retorna o var_dump
}else{
	header('Location: confirmacaoAluno.php?id='.$_SESSION['id'].'');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar Usuario</title>
	<link rel="stylesheet" type="text/css" href="./css/confirmacaoAluno.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
</head>
<body>
	<header>
	</header>
	<div id="alinhamento">
    <section>
					<div id="flex">
						<form method="POST" id="divbt1">
							<input type="hidden" name="nome" value="<?php echo $dado['nome']?>"/>
							<input type="hidden" name="val_ida" value="1"/>
						<div id="divbt1">
							<input type="submit" value="ACEITAR" id="btAceitar">
						</div>
					</form>
				
				
					<form method="POST" id="divbt2">
					
						<input type="hidden" name="nome" value="<?php echo $dado['nome']?>"/>
						<input type="hidden" name="val_ida" value="0"/>
					
					<div id="divbt2">
							<input type="submit" value="RECUSAR" id="btRecusar">
					</div>
					</form>
				
				</div>
    </section>
    </div>
</body>

</html> 