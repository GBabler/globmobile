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

	$sql = "INSERT INTO usuarios SET nome = '$nome', email = '$email'";

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
		<?php echo "$_SESSION[nome]";?> 
		<!-- mensagem de bem vindo com o nome do usuário -->
	</div>
</head>

<body>
	<form method="POST">

		<div>
		<label>Nome do usuario: </label><br>
		<input type="text" name="nome"/> </br>
			
		<label>Email: </label><br>
		<input type="text" name="email"> </br>
		</div>	
		
		<br>
		<button type="submit">Inserir</button>
		<a href="lista_usuario.php"><button type="button">Voltar</button><br><p></a>
	</form>

</body>

</html>