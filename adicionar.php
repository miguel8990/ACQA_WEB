<!--Aqui é o formulario que cria os campos onde o usuario digita os dados que quer enviar ao banco via post-->
<!--Os dados aparecem na tabela visivel ao usuario através de listar.php-->

<div class="container">
  <h2>Adicionar produtos</h2>
  <form method="post" action="">
    <label>Nome:</label><br>
    <input type="text" name="nome" placeholder="Digite o nome do produto" required><br><br>

    <label>Descrição:</label><br>
    <input type="text" name="descricao" placeholder="Digite a descrição do produto" required><br><br>

    <label>Preço:</label><br>
    <input type="number" step="0.01" name="preco" placeholder="Digite o preço do produto" required><br><br>

    <button type="submit" name="adicionar">Adicionar</button>
  </form>
</div>

<?php
include 'conexao.php'; //cria uma conexão

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Verifica se a requisição foi feita por post


  if (isset($_POST['adicionar'])) { // verifica se o botão adicionar foi requisitado via post, caso não seu valor seria null
    $nome = $_POST['nome']; //variaveis recebem dados via post do formulario
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    //comando recebe um objeto da intrução sql
    $comando = $conn->prepare("INSERT INTO produtos (nome, descricao, preco) VALUES (?,?,?)");
    //variaveis digitadas são vinculadas a cada parametro do banco de dados
    //ssd == string string double
    $comando->bind_param("ssd", $nome, $descricao, $preco);

    //se o comando for executado ele retorna true ao if 
    if ($comando->execute()) {
      //Diz ao navegador para retornar ao endereço anterior
      //previne que o mesmo objeto seja adicionado ao recarregar o navegador
      header("Location: " . $_SERVER['PHP_SELF'] . "?sucesso=1");
      exit;
    } else {
      echo "<p>Erro: " . $comando->error . "</p>"; //
    }
    //fechamento da instrução sql e da conexão
    $comando->close();
  }
  $conn->close();
}
?>
