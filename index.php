<!DOCTYPE html>
<?php 

	include_once "conf/default.inc.php";
	require_once "conf/Conexao.php";

	$title = "Google Keep";
	
	$busca = isset($_POST['search']) ? $_POST['search'] : null;
	
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/materialize.css">
	<title><?php echo $title; ?></title>
</head>
<body>
	<a href="cad.php" class='btn'>novo</a>
	<div class="container">
		<form method="post">
			<input type="text" placeholder='Digite sua busca' name='search'>
			<input type="submit" class='btn center'	value="Buscar">	
		</form>
		<?php  	
			$pdo = Conexao::getInstance();
			$consulta = $pdo->query("SELECT * FROM notes;");
			while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { 
		?>

		<div class="row">
			<div class="col s12 m6">
				<div class="card" style="background-color: <?php echo $linha['corFundo'];?>">
					<div class="card-content white-text">
						<span class="card-title"><?php echo "#" . $linha['codigo'] . " | " . $linha['titulo'];?></span>
						<p><?php echo $linha['texto'];?></p>
						<p><?php echo $linha['tags'];?></p>
						<p>
							<?php 
								if($linha['ativa'] == 1) echo "Ativa: sim | "; else	echo "Ativa: não | ";
								if($linha['estrela'] == 1) echo "Estrela: sim";	else echo "Estrela: não";
							?>	
						</p>
					</div>
					<div class="card-action">
						<a href='cad.php?acao=editar&codigo=<?php echo $linha['codigo'];?>'><i class="material-icons left">create</i></a>
						<a href="javascript:excluirRegistro('acao.php?acao=excluir&codigo=<?php echo $linha['codigo'];?>')"><i class="material-icons left">delete</i></a>
					</div>
				</div>
			</div>
		</div>
		
    <?php } // fecha o while ?>  
	</div> 

<script>
	function excluirRegistro(url) {
		if (confirm("Confirmar Exclusão?"))
			location.href = url;
		}
</script>	
</body>
</html>
