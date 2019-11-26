<!DOCTYPE html>
<?php 

	include_once "conf/default.inc.php";
	require_once "conf/Conexao.php";

	$title = "Google Keep";
	
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
	<title><?php echo $title; ?></title>
</head>
<body>
	<div class="container">
		<a href="cad.php"><button>Novo</button></a>
		<form action="" method="post">
			<input type="text" placeholder='Digite sua busca'>
			<input type="submit" value="Buscar">	
		</form>
		<?php  	
			$pdo = Conexao::getInstance();
			$consulta = $pdo->query("SELECT * FROM notes;");
			while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { 
		?>			
		<div class="card" style="background-color: <?php echo $linha['corFundo'];?>">
			<div class="container">
				<div class="card-head"> 
					<h4><b><?php echo "#" . $linha['codigo'] . " | " . $linha['titulo'];?></b></h4>
				</div>
				<div class="card-body">
					<p>
						<?php echo $linha['texto'];?>
					</p>
					<p>
						<?php echo $linha['tags'];?>
					</p>
				</div>
				<div class="card-bottom">
					<p>
						<?php 
							if($linha['ativa'] == 1) echo "Ativa: sim | "; else	echo "Ativa: não | ";
							if($linha['estrela'] == 1) echo "Estrela: sim";	else echo "Estrela: não";
						?>	
					</p>
					<a href='cad.php?acao=editar&codigo=<?php echo $linha['codigo'];?>'>/\</a>
					<a href="javascript:excluirRegistro('acao.php?acao=excluir&codigo=<?php echo $linha['codigo'];?>')">X</a>
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
