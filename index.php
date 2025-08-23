<!DOCTYPE html>
<html lang="pt-br">
<!--Html da páguina index, que é a primeira e principal-->

<head>
  <meta charset="UTF-8">
  <title>Lista de Produtos</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<header>
  <h1 id="titulo">Lista de produtos</h1>
</header>
<main>
  <!--Aqui todos os arquivos das páginas são chamados para o index-->

  <body>
    <?php include 'listar.php'; ?><br><br>
    <?php include 'adicionar.php'; ?><br><br>
    <?php include 'editar.php'; ?><br><br>
    <?php include 'deletar.php'; ?><br><br>
  </body>

</main>

</html>
