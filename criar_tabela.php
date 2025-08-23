<?php
include 'conexao.php'; // arquivo de conexão com o banco

//sql recebe um comando SQL para a criação de uma tabela
$sql = "CREATE TABLE produtos ( 
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50),
    descricao TEXT,
    preco DECIMAL(10, 2),
    PRIMARY KEY (id)
)";

if ($conn->query($sql) === TRUE) { //executa sql para criar a tabela, retorna true caso bem-sucedido
    print "Tabela criada com sucesso!";
} else {
    print "Erro: " . $conn->error; //caso não retorna a mesagem de erro do banco
}
?>
