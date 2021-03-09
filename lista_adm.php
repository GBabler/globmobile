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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lista de administradores</title>
	<link rel="stylesheet" type="text/css" href="./css/lista_adm.css">
</head>
<body>
	<table align="center">
		<thead>
			<div class="user_info">
			<?php echo "$_SESSION[nome]"; ?>
			|
			<a href="logout.php">Logout</a>
		 	</div>
			<div class="cab_tabela">
				<a href="inserir_adm.php">INSERIR ADMINISTRADOR</a>
				&nbsp &nbsp
				<a href="lista_usuario.php">TABELA DE CADASTRADOS</a>
				&nbsp &nbsp
			</div>
			<br>
			<tr" class="texto_link">
				<th>NOME</th>
				<th>EMAIL</th>
				<th>AÇÃO</th>
			</tr>
		</thead>

		<tbody>

				<?php
			/************INICIA O PHP PARA INICIAR A PAGINAÇÃO*********/
			$limite = 10; //determina o numero de registros que serão mostrados por página

			@$pagina = $_GET['pag'];
				if(isset($pagina)){
					$pagina = $pagina; //armazenamos o valor da pagina atual
				} else { //Se caso não encontrar nenhum valor fica por padrão na pagina
					$pagina=1;
				}

				//Calcula a pagina inicial em relação a pagina atual
				$inicio = ($pagina * $limite) - $limite;

				//conta o numero de linhas da tabela
				$qtdRegistros = $pdo->query('select count(id) from cadastro')->fetchColumn();

				//Determina o total de páginas
				$total_paginas = Ceil($qtdRegistros / $limite);

				//seleciona os registros do php
				$sql = "select * from cadastro LIMIT $inicio, $limite"; //limite no seleqt mysql

				//executa o select
				$sql = $pdo->query($sql);

				/************ FINALIZA O PHP PARA EFETUAR A PAGINAÇÃO ********/ 

		foreach	($sql->fetchall() as $user) {
		echo '<tr>';
			echo '<td align="center">'.$user['nome'].'</td>';
			echo '<td align="center">'.$user['email'].'</td>';
			echo '<td align="center">
				<a href="excluir_adm.php?id='.$user['id'].' "><font color="blue"> APAGAR USUÁRIO </font> </a><br>
				<a href="editar_adm.php?id='.$user['id'].' "><font color="blue"> ALTERAR USUÁRIO </font> </a>
				</td>';
		echo '</tr>';
	}

?>

	</tbody>
</table>
<br>
<div align="center">
<?php
		echo '<div>';
			echo '<a href="lista_adm.php?pag=1">PRIMEIRA</a>&nbsp &nbsp'; //Primeira página
			
			for ($i=1; $i <= $total_paginas; $i++){ //looping conforme o numero de paginas
				echo '<a href="lista_adm.php?pag='.$i.'">'.$i.'</a>&nbsp &nbsp'; 
				}
				echo '<a class="page.link" href="lista_adm.php?pag='.$total_paginas.'">ULTIMA</a>';
				echo '</div>'; //ultima pagina
				?>

				<!-- Final do menu de paginação -->
				</div>
</body>
</html>