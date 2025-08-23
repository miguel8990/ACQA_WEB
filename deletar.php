<!--Formulario onde o usuario digita o id do produto que quer deletar-->
<div class="container">
  <h2>Deletar produto</h2>
  <form method="post" action="">
    <label>ID DO PRODUTO:</label><br>
    <input type="number" name="id" placeholder="Digite o ID do produto que deseja deletar" required><br><br>
    <button type="submit" name="buscar">Buscar Produto</button>
  </form>
</div>

<?php
include 'conexao.php'; //abre uma conexão


if (isset($_POST['buscar'], $_POST['id'])) { //verifica se buscar e id foram inviados via post
  $id = $_POST['id']; //variavel id recebe o que o usuario enviou via post

  //s1 recebe uma instrução SQL para selecionar o produto que se quer deletar via id
  $s1 = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
  //O id que o usuario digitou é vinculado a s1 que coloca os mesmo na consulta SQL
  //sendo i representa o int de id
  $s1->bind_param("i", $id);
  $s1->execute(); //comando SQL é execultado com o id digitado pelo usuario

  //resultado pega os objetos SQL retornados pelo banco com o comando de s1 
  $resultado1 = $s1->get_result();

  if ($resultado1->num_rows > 0) { //verifica se resultado possui o objeto SQL
    $produto = $resultado1->fetch_assoc(); //produto recebe o objeto SQL e o trasforma em um array
    echo '<div id="delete">'; //retorna os dados do produto que o usuario quer deletar para o mesmo verificar
    echo "<h4>Produto encontrado:</h4>";
    echo "ID: " . $produto['id'] . "<br>";
    echo "Nome: " . $produto['nome'] . "<br>";
    echo "Descrição: " . $produto['descricao'] . "<br>";
    echo "Preço: " . $produto['preco'] . "<br>";
    echo "</div>";

    echo '
<form method="post" action="">
  <input type="hidden" name="id" value="' . $produto['id'] . '">
  <button type="submit" name="confirmar">Deletar Produto</button> 
</form>'; //botão para deletar o produto
  } else {
    // Redireciona com erro se não encontrado
    header("Location: " . $_SERVER['PHP_SELF'] . "?erro=1");
    exit;
  }

  $s1->close(); //fecha o objeto de consulta
}

//verifica se o usuario apertou para deletar e verifica se o id foi enviado, ambos por post
if (isset($_POST['confirmar'], $_POST['id'])) {
  $id = $_POST['id'];

  //s1 recebe um comando SQL de deletar pelo ID
  $s1 = $conn->prepare("DELETE FROM produtos WHERE id = ?");

  //vincula o id a ordem de deletar que está em s1
  $s1->bind_param("i", $id);

  if ($s1->execute()) { //se a ordem de deletar for executada ele retorna true e entra no if
    if ($s1->affected_rows > 0) { //retorna se o comando SQL deletou pelo menos uma linha
      //Um alert em js aparece ao usuario revelando que o produto foi deletado
      echo "<script>
                alert('Produto deletado com sucesso!');
                window.location.href = '" . $_SERVER['PHP_SELF'] . "';
            </script>";
      exit;
    } else {
      //caso não encontre nenhuma linha para se deletar se retorna esse alert
      echo "<script>
                alert('Erro: Produto não encontrado para deletar.');
                window.location.href = '" . $_SERVER['PHP_SELF'] . "';
            </script>";
      exit;
    }
  } else { //caso a ordem de deletar não for executada
    $s1->close(); //obejto SQL é fechado
    //Em caso de erro, exibe um alert e redireciona para a mesma página 
    //para evitar que o alert seja executado a cada reload da página
    echo "<script>
            alert('Erro ao deletar: " . addslashes($s1->error) . "');
            window.location.href = '" . $_SERVER['PHP_SELF'] . "';
        </script>";
    exit;
  }


}


if (isset($_GET['erro']) && $_GET['erro'] == 1) { //caso o erro seja pego pelo get executa esse alert
  echo "<script>
        alert('Produto não encontrado!');
        window.history.replaceState({}, document.title, '" . $_SERVER['PHP_SELF'] . "');
    </script>";
}

$conn->close(); //fecha a conexão
?>
