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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação do Aluno</title>
    <link rel="stylesheet" href="css\confirmacaoAluno.css">
</head>
<body>
    <header>
        
    </header>
    <div id="alinhamento">
    <section>
        <div class="flex">
           <div id="divbt1">
                <input type="button" value="ACEITAR" id="btAceitar" onclick="btAceitar()">
           </div>
           <div id="divbt2">
                <input type="button" value="RECUSAR" id="btRecusar" onclick="btRecusar()">
           </div>
        </div>
            <div id="divbt3">
                <input type="button" value="CONFIRMAR RESPOSTA" id="btConfirmar" onclick="btConfirmar()">
             </div>
    </section>
    </div>
    <footer>

    </footer>
    <script src="js\confirmacaoAluno.js"></script>
</body>
</html>