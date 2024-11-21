<?php
//Código pra receber as informações do HTML e fazer algo
//Caputura o que o usuario digitou e caadastra no BD

//Chama o arquivo de conexão
include 'conexao.php';

//Verifica se existe alguma informação chegando pela rede
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Recebe o e-mail, filtra e armazena na variavel
    $email = htmlspecialchars($_POST['email']);

    //Recebe a senha , criptografa e armazena em uma variavel
    $senha = password_hash($_POST['senha'],PASSWORD_DEFAULT);

    //exibe a variavel pra testar
    //var_dump($senha);

    //bloco tente para cadastrar no banco de dados
    try{
        //Prepara o comando SQL para inserir no banco de dados 
        // Utilizar o Prepared para prevenir injetar sQL
        $stmt = $conn->prepare("INSERT INTO usuarios (email,senha) VALUES (:email, :senha)");

        //Associa os valores das variaveis :email, :senha
        $stmt->bindParam(":email",$email); //Vincula o e-mail e limpa
        $stmt->bindParam(":senha",$senha);

        //Executa o Codigo
        $stmt->execute();

        echo "Cadastrado com Sucesso!";


    }catch(PDOException $e){
        echo "Erro ao cadastrar:".$e->getMessage();
    }
}