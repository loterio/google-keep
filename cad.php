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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/materialize.css">
	<title><?php echo $title; ?></title>
</head>
<body>

<a href="index.php" class='btn'>Listar</a>
<a href="cad.php" class='btn'>Novo</a>

	<div class="container">
		<form action="acao.php" method="post"><!-- notes(codigo,titulo,texto,corFundo,tags,ativa,estrela) -->

			<div class="input-field col s2">
				<input readonly type="text" name="codigo" id="codigo" value="<?php if ($acao == "editar") echo $dados['codigo']; else echo 0; ?>" class="validate">
				<label for="codigo">Código</label>
			</div>

			<div class="input-field col s6">
				<input required=true placeholder='titulo' type="text" name="titulo" id="titulo" value="<?php if ($acao == "editar") echo $dados['titulo']; ?>" class="validate">
				<label for="titulo">Titulo</label>
			</div>

			<div class="input-field col s12">
        <textarea class="materialize-textarea" required=true placeholder='text' type="text" name="texto" id="texto" cols="20" rows="10" class='validate'><?php if ($acao == "editar") echo $dados['texto']; ?></textarea>
        <label for="texto">Texto</label>
      </div>

			<input type="color" name="corFundo" id="corFundo" value="<?php if ($acao == "editar") echo $dados['corFundo']; ?>"><br>

			<input required=true placeholder='tags' type="text" name="tags" id="tags" value="<?php if ($acao == "editar") echo $dados['tags']; ?>"><br>

			<p>
				<label>
					<input type="checkbox" name="ativa" value='1' <?php if($acao == "editar" && $dados['ativa'] == 1) echo "checked";?>/>
					<span>Ativa</span>
				</label>
			</p>
			<p>
				<label>
					<input type="checkbox" name="estrela" value='1' <?php if($acao == "editar" && $dados['estrela'] == 1) echo "checked";?>/>
					<span>Estrela</span>
				</label>
			</p>

			<button type="submit" class='btn' name="acao" id="acao" value="salvar">Salvar</button>
		</form>
	</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>