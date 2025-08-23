<?php //atribui as variaveis os parametros de conexão com o banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "acqa_db";

//executa a conexão com o banco usando as variaveis para identificação usando a classe mysqli
$conn = new mysqli($host, $usuario, $senha, $banco);


if ($conn->connect_error) { //caso ocorra algum erro, retorna a mensagem de erro do banco de dados
    die("Conexão falhou: " . $conn->connect_error);
}
//print "Conectado com sucesso!"; 
//Linha de teste para verifica se a conexão foi bem-sucedida
?>
