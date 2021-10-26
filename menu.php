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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu de Navegação</title>
    <link rel="stylesheet" href="css\menu.css">
</head>
<body>
    <header>
        <div id="desconectar">
        <?php echo "$_SESSION[nome]"; ?>
				|
				<a class="logout" href="logout.php">sair</a>
        </div>

    </header>
    <div id="alinhamento">
        <section>
            <div class="flex">
                <div id="divbt1">
                    <input type="button" value="Perfil" id ="iptbtn" onclick="perfilMotorista() ">
                </div>
                <div id="divbt2">
                    <input type="button" value="Alunos" id ="iptbtn" onclick="listaAlunos()">
                </div>
                <div id="divbt3">
                    <input type="button" value="Iniciar Trajeto" id ="iptbtn" onclick="iniciarTrajeto()">
                </div>
                <div id="divbt4">
                    <input type="button" value="Editar Aluno" id ="iptbtn" onclick="novoarquivovolta()">
                </div>
            </div>
        </section>
        <footer>

        </footer>
    </div>
    <script src="js\menu.js"></script>
</body>
</html>