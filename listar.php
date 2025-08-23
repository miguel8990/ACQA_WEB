<!--aqui fica o codigo que cria a tabela de produtos visivel ao usuario-->

<div id="listagem">
  <h2>Tabela de Produtos</h2>
  <?php
  include 'conexao.php'; //Conecta ao banco de dados pelo arquivo de conexao
  ?>

  <!--Aqui é o cabeçalho da tabela, para identificar os dados na tabela-->
  <table border="1" id="tabela">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $resultado = $conn->query("SELECT * FROM produtos"); //resultado recebe um objeto da consulta sql
      
      if ($resultado && $resultado->num_rows > 0) { //vereifica se algo retornou
        //linha recebe um array associativo e usa o while para imprimir os dados em uma linha na tabela
        while ($linha = $resultado->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($linha['id']) . "</td>";
          echo "<td>" . htmlspecialchars($linha['nome']) . "</td>";
          echo "<td>" . htmlspecialchars($linha['descricao']) . "</td>";
          echo "<td>R$ " . number_format($linha['preco'], 2, ',', '.') . "</td>";
          echo "</tr>";
        }
      } else {
        // caso no if não retorne nada
        echo "<tr><td colspan='4'>NENHUM PRODUTO ENCONTRADO</td></tr>";
      }
      //fecha a conexão
      $conn->close();
      ?>
    </tbody>
  </table>

</div>

</html>
