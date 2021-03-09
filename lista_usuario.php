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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body bgcolor="#4F4F4F" text="#DCDCDC";>
	<table border="5" align="center" width="1000">
		<thead>
			<div align="center"><br>
			<font face="Arial" size="4"><i><span>Bem Vindo	 <?php echo "$_SESSION[nome]"; ?> !</span></font></i>
		</div><br>
			<div align="center">
				<a href="inserir_usuario.php">NOVO USUARIO</a>
				&nbsp &nbsp
				<a href="lista_adm.php">ADMINISTRADORES</a>
				&nbsp &nbsp
				<a href="logout.php">LOGOUT</a>
			</div>
			<br>
			<tr">
				<th>ID</th>
				<th>NOME</th>
				<th>Email</th>
				<th>AÇÃO</th>
				<th>APAGAR DADOS</th>
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
				$qtdRegistros = $pdo->query('select count(id) from usuarios')->fetchColumn();

				//Determina o total de páginas
				$total_paginas = Ceil($qtdRegistros / $limite);

				//seleciona os registros do php
				$sql = "select * from usuarios LIMIT $inicio, $limite"; //limite no seleqt mysql

				//executa o select
				$sql = $pdo->query($sql);

				/************ FINALIZA O PHP PARA EFETUAR A PAGINAÇÃO ********/ 

		foreach	($sql->fetchall() as $user) {
		echo '<tr>';
			echo '<td align="center">'.$user['id'].'</td>';
			echo '<td align="center">'.$user['nome'].'</td>';
			echo '<td align="center">'.$user['email'].'</td>';
			
			echo '<td align="center">
				<a href="editar_usuario.php?id='.$user['id'].' "><font color="black"> Editar Usuario </font> </a><br>
				</td>';
			echo '<td align="center">
			<a href="excluir_usuario.php?id='.$user['id'].' "><font color="blue"> Remover Usuario </font> </a><br>
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