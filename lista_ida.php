<?php
require 'config.php';
session_start();

if(isset($_SESSION['id']) == false) {
//se não estiver sem id de sessão continua na página
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
	<link rel="stylesheet" type="text/css" href="css\lista_ida.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

</head>

<body id = "res">
<header>
	<div class="user_info">
			<?php echo "$_SESSION[nome]"; ?>
			|
			<a class ="logout" href="logout.php">Logout</a>
			</div>
					<div>
							<input type="button" value="VOLTAR PARA MENU" id = "btnVoltar" onclick="voltarMenu()">
					</div>
					
	</header>
	<div class="content">
	<table align="center" class="rtable">
		<thead>
			
			<br>
			<tr">
				<th>NOME</th>

			</tr>
		</thead>

		<tbody>

				<?php
			/************INICIA O PHP PARA INICIAR A PAGINAÇÃO*********/
			$limite = 1; //determina o numero de registros que serão mostrados por página

			@$pagina = $_GET['pag'];
				if(isset($pagina)){
					$pagina = $pagina; //armazenamos o valor da pagina atual
				} else { //Se caso não encontrar nenhum valor fica por padrão na pagina
					$pagina=1;
				}

				//Calcula a pagina inicial em relação a pagina atual
				$inicio = ($pagina * $limite) - $limite;

				//conta o numero de linhas da tabela
				$qtdRegistros = $pdo->query('SELECT count(posicao) FROM usuarios 
				WHERE val_ida = "1" ')->fetchColumn();

				//Determina o total de páginas
				$total_paginas = Ceil($qtdRegistros / $limite);

				//seleciona os registros do php
				$sql = "SELECT * FROM usuarios 
				WHERE val_ida = '1'
				order by posicao asc  LIMIT $inicio, $limite"; //limite no seleqt mysql
				//executa o select
				$sql = $pdo->query($sql);

				/************ FINALIZA O PHP PARA EFETUAR A PAGINAÇÃO ********/ 

		foreach	($sql->fetchall() as $user) {
			echo '<tr>';

			echo '<td class="letra-tabela">'.$user['nome'].'</td>';
			
		echo '</div>';
	}

?>

</tbody>
</table>
</div>
<br>
<div align="center">
<?php
		echo '<div id="btnDivProxVoltar">';
		
				echo '<div id="btnProximo">';
				if(($pagina >= 2)){
				echo '<a class="usu-adm-header-footer" href="lista_ida.php?pag='.($pagina-1).'">VOLTAR </a>';
				}
				echo '</div>';
				echo '<div id="btnAnterior">';
				if($pagina < $total_paginas){
					echo '<a class="usu-adm-header-footer" href="lista_ida.php?pag='.($pagina+1).'">PROXIMO</a>';
				}
				echo '</div>';
				echo '</div>'; //ultima pagina
				?>

				<!-- Final do menu de paginação -->
				</div>
		<footer>
				<p> 
				&copy GlobMobile
				</p>
		</footer>

		<script src="js\lista_ida.js"></script>

</body>


</html>