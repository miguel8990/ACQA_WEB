<?php
include 'conexao.php'; //conexão com o banco de dados por arquivo externo
$produto = [];


if (isset($_POST['pesquisar'], $_POST['id'])) {
  $id = $_POST['id']; //recebe id pelo post 

  $s2 = $conn->prepare("SELECT * FROM produtos WHERE id=?"); //consulta sql
  $s2->bind_param("i", $id); //conecta a var id com id do banco, "i" se refere a int
  $s2->execute();//executa 
  $resultado = $s2->get_result(); //resultado recebe a query do banco

  if ($resultado->num_rows > 0) { //verifica se resultado possui algo
    $produto = $resultado->fetch_assoc(); //produto recebe um array 
  } else { //caso não seja encontrado algo em resultado
    echo "<script>
            alert('Produto não encontrado!');
            window.location.href = '" . $_SERVER['PHP_SELF'] . "';
          </script>";
    exit; //impede a execução do restante do codigo caso else seja exucutado 
  }

  $s2->close();
}


if (isset($_POST['editar'], $_POST['id'])) { //verifica se essas chaves estão no array e não são null
  $id = $_POST['id']; // variaveis recebem dados do banco
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $preco = $_POST['preco'];

  //s2 recebe a ordem de sql para atualizar o banco de dados
  $s2 = $conn->prepare("UPDATE produtos SET nome=?, descricao=?, preco=? WHERE id=?");

  //s2 vincula os dados digitados as variaveis para substituir
  //ssdi corresponde a string string double int, as variaveis tem que estar em ordem
  $s2->bind_param("ssdi", $nome, $descricao, $preco, $id);

  //executa a ordem que estava em s2
  if ($s2->execute()) {
    echo "<script>
        alert('Produto atualizado com sucesso!');
        window.location.href = '" . $_SERVER['PHP_SELF'] . "';
    </script>";//emite um alert para o usuario que foi atualizado 
    exit;
  } else {
    //emite um alert que não foi atualizado e o erro
    echo "<script>alert('Erro ao atualizar: " . addslashes($s2->error) . "');</script>";
  }
  $s2->close();
  //fecha a consulta
}
//fecha a conexão
$conn->close();
?>

<!--Aqui o html vem depois pois o php precisa buscar os dados e preencher o formulario-->

<h2>Editar produtos</h2>
<div id="formulario-editar">

  <!--Formulario onde se busca o ID do produto que se deseja editar-->
  <form action="" method="post">

    <label>ID DO PRODUTO:</label><br><br>
    <input type="number" name="id" placeholder="Digite o ID do produto que deseja editar" required>

    <!--Botão que busca o item pelo id-->
    <button type="submit" name="pesquisar">Pesquisar</button><br><br>
  </form>

</div><br><br>

<!--Aqui é o formulario onde se edita os itens, aqui também é onde fica a 
lógica que faz os dados do item pesquisado pelo ID aparecrem nos campos para a edição-->
<div class="container">
  <form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $produto['id'] ?? ''; ?>">

    <label>Nome:</label><br>
    <input type="text" name="nome" placeholder="Digite o nome do produto" value="<?php echo $produto['nome'] ?? ''; ?>"
      required><br><br>

    <label>Descrição:</label><br>
    <input type="text" name="descricao" placeholder="Digite a descrição do produto"
      value="<?php echo $produto['descricao'] ?? ''; ?>" required><br><br>

    <label>Preço:</label><br>
    <input type="number" step="0.01" placeholder="Digite o preço do produto" name="preco"
      value="<?php echo $produto['preco'] ?? ''; ?>" required><br><br>

    <!--Botão que envia os dados do formulário-->
    <button type="submit" name="editar">Editar</button>

  </form>
</div>
