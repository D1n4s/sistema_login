<?php
/*
    Conexão com BD PDO : PDO permite acessar 
    Qualquer banco de dados.
    PDO = PHP Data Objects = PHP Objeto de dados
*/
// Declara as variaveis como objetos de conexao

$host = 'localhost';
$dbname = 't57_login';
$usuario = 'root';
$senha = '';
//Data Source Name = Nome da origem dos dados
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    //Cria a Conexão
    $conn = new PDO($dsn,$usuario,$senha);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

}catch(PDOException $e){
    die("ERRO de Conexão".$e->getMessage());
}
