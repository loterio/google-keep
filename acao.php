<?php

    // notes(codigo,titulo,texto,corFundo,tags,ativa,estrela)

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
      $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : 0;
      excluir($codigo);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
      $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
      if ($codigo == 0)
        inserir($codigo);
      else
        editar($codigo);
    }

    // Métodos para cada operação          notes(codigo,titulo,texto,corFundo,tags,ativa,estrela)
    function inserir($codigo){
      $dados = dadosForm();
      $pdo = Conexao::getInstance();
      $stmt = $pdo->prepare('INSERT INTO notes (titulo, texto, corFundo, tags, ativa, estrela) VALUES(:titulo, :texto, :corFundo, :tags, :ativa, :estrela)');
      $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
      $stmt->bindParam(':texto', $texto, PDO::PARAM_STR);
      $stmt->bindParam(':corFundo', $corFundo, PDO::PARAM_STR);
      $stmt->bindParam(':tags', $tags, PDO::PARAM_STR);
      $stmt->bindParam(':ativa', $ativa, PDO::PARAM_INT);
      $stmt->bindParam(':estrela', $estrela, PDO::PARAM_INT);
      $titulo = $dados['titulo'];
      $texto = $dados['texto'];
      $tags = $dados['tags'];
      $ativa = $dados['ativa'];
      $estrela = $dados['estrela'];
      $stmt->execute();
      header("location:index.php");
    }

    function editar($codigo){
      $dados = dadosForm();
      $pdo = Conexao::getInstance();
      $stmt = $pdo->prepare('UPDATE notes SET titulo = :titulo, texto = :texto, corFundo = :corFundo, tags = :tags, ativa = :ativa, estrela = :estrela WHERE codigo = :codigo');
      $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
      $stmt->bindParam(':texto', $texto, PDO::PARAM_STR);
      $stmt->bindParam(':corFundo', $corFundo, PDO::PARAM_STR);
      $stmt->bindParam(':tags', $tags, PDO::PARAM_STR);
   		$stmt->bindParam(':ativa', $ativa, PDO::PARAM_INT);
      $stmt->bindParam(':estrela', $estrela, PDO::PARAM_INT);
      $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
      $titulo = $dados['titulo'];
      $texto = $dados['texto'];
      $corFundo = $dados['corFundo'];
      $tags = $dados['tags'];
      $ativa = $dados['ativa'];
      $estrela = $dados['estrela'];
      $codigo = $dados['codigo'];
      $stmt->execute();
      header("location:index.php");
    }

    function excluir($codigo){
      $pdo = Conexao::getInstance();
      $stmt = $pdo->prepare('DELETE FROM notes WHERE codigo = :codigo');
      $stmt->bindParam(':codigo', $codigoD, PDO::PARAM_INT);
      $codigoD = $codigo;
      $stmt->execute();
      header("location:index.php");
    }


    // Busca um item pelo código no BD
    function buscarDados($codigo){
      $pdo = Conexao::getInstance();
      $consulta = $pdo->query("SELECT * FROM notes WHERE codigo = $codigo");
      $dados = array();
      while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['codigo'] = $linha['codigo'];
        $dados['titulo'] = $linha['titulo'];
        $dados['texto'] = $linha['texto'];
        $dados['corFundo'] = $linha['corFundo'];
        $dados['tags'] = $linha['tags'];
        $dados['ativa'] = $linha['ativa'];
        $dados['estrela'] = $linha['estrela'];
      }
      return $dados;
  }

  // Busca as informações digitadas no form
  function dadosForm(){
    $dados = array();
    $dados['codigo'] = $_POST['codigo'];
    $dados['titulo'] = $_POST['titulo'];
    $dados['texto'] = $_POST['texto'];
    $dados['corFundo'] = $_POST['corFundo'];
		$dados['tags'] = $_POST['tags'];
		$dados['ativa'] = $_POST['ativa'];
		// echo $dados['ativa'];
		$dados['estrela'] = $_POST['estrela'];
		// echo $dados['estrela'];
		return $dados;
  }

?>