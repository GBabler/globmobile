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
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lista de Usuarios</title>
	<link rel="stylesheet" type="text/css" href="./css/lista_usuario.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

</head>

<body id = "res">
	<header>
		<div id = "iptbtncenter">
			<input type="button" value="NOVO USUARIO" id = "iptbtn" onclick="novoUsuario()">
			<input type="button" value="VOLTAR AO MENU" id = "iptbtn" onclick="voltarMenu()">
		</div>
	</header>
	<div class="content">
	<table class="rtable">
		<thead>
			
			<br>
			<tr">
				<th>POS</th>
				<th>NOME</th>
				<th>CELULAR</th>
				<th>AÇÃO</th>
				
			</tr>
		</thead>

		<tbody>

				<?php
			/************INICIA O PHP PARA INICIAR A PAGINAÇÃO*********/
			$limite = 7; //determina o numero de registros que serão mostrados por página

			@$pagina = $_GET['pag'];
				if(isset($pagina)){
					$pagina = $pagina; //armazenamos o valor da pagina atual
				} else { //Se caso não encontrar nenhum valor fica por padrão na pagina
					$pagina=1;
				}

				//Calcula a pagina inicial em relação a pagina atual
				$inicio = ($pagina * $limite) - $limite;

				//conta o numero de linhas da tabela
				$qtdRegistros = $pdo->query('select count(id) from usuarios')->fetchColumn();

				//Determina o total de páginas
				$total_paginas = Ceil($qtdRegistros / $limite);

				//seleciona os registros do php
				$sql = "select * from usuarios 
				order by posicao asc
				LIMIT $inicio, $limite"; //limite no seleqt mysql

				//executa o select
				$sql = $pdo->query($sql);

				/************ FINALIZA O PHP PARA EFETUAR A PAGINAÇÃO ********/ 

		foreach	($sql->fetchall() as $user) {
			echo '<tr>';
			echo '<td class="letra-tabela">'.$user['posicao'].'</td>';
			echo '<td class="letra-tabela">'.$user['nome'].'</td>';
			echo '<td class="letra-tabela">'.$user['celular'].'</td>';
			echo '<td>
				<a class="img" href="editar_usuario.php?id='.$user['id'].' "><img src="img\lapis.png" alt="editar"></a>
				
				<a class="img" href="excluir_usuario.php?id='.$user['id'].' "><img src="img\lixeira.png" alt="excluir"></a><br>
				</td>';
				
			
		echo '</tr>';
	}

?>

</tbody>
</table>
</div>
<br>
<div>
<?php
		echo '<div>';
			echo '<a class="usu-adm-header-footer" href="lista_usuario.php?pag=1">PRIMEIRA</a>&nbsp &nbsp'; //Primeira página
			
			for ($i=1; $i <= $total_paginas; $i++){ //looping conforme o numero de paginas
				echo '<a class="usu-adm-header-footer" href="lista_usuario.php?pag='.$i.'"> '.$i.' </a>&nbsp &nbsp'; 
				}
				echo '<a class="usu-adm-header-footer" href="lista_usuario.php?pag='.$total_paginas.'">ULTIMA</a>';
				echo '</div>'; //ultima pagina
				?>

				<!-- Final do menu de paginação -->
				</div>
		<footer>
				<p> 
				&copy GlobMobile
				</p>
		</footer>

		<script src="js\lista_usuario.js">
				
		</script>

</body>


</html>