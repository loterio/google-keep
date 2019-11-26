<!DOCTYPE html>
<?php

		include_once "acao.php";
		
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;

    if ($acao == 'editar'){
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : "";
        if ($codigo > 0)
            $dados = buscarDados($codigo);
    }

    $title = "Cadastro";
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="assets/css/style.css">
	<title><?php echo $title; ?></title>
</head>
<body>
<br>
<a href="index.php"><button>Listar</button></a>
<a href="cad.php"><button>Novo</button></a>
	<div class="container">
		<form action="acao.php" method="post"><!-- notes(codigo,titulo,texto,corFundo,tags,ativa,estrela) -->
			<input readonly type="text" name="codigo" id="codigo" value="<?php if ($acao == "editar") echo $dados['codigo']; else echo 0; ?>"><br>
			<input required=true placeholder='titulo' type="text" name="titulo" id="titulo" value="<?php if ($acao == "editar") echo $dados['titulo']; ?>"><br>
			<textarea required=true placeholder='text' type="text" name="texto" id="texto" cols="20" rows="10"><?php if ($acao == "editar") echo $dados['texto']; ?></textarea><br>
			<input type="color" name="corFundo" id="corFundo" value="<?php if ($acao == "editar") echo $dados['corFundo']; ?>"><br>
			<input required=true placeholder='tags' type="text" name="tags" id="tags" value="<?php if ($acao == "editar") echo $dados['tags']; ?>"><br>
			ativa
			<input type="checkbox" name="ativa" value='1' <?php if($acao == "editar" && $dados['ativa'] == 1) echo "checked";?>><br>
			estrela
			<input type="checkbox" name="estrela" value='1' <?php if($acao == "editar" && $dados['estrela'] == 1) echo "checked";?>><br>

			<button type="submit" name="acao" id="acao" value="salvar">Salvar</button>
		</form>
	</div>
</body>
</html>