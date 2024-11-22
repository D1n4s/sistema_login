<?php
include 'conexao.php';

//verifica se a requisição atual é um post
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //limpa o Email e armazena
    
    $email = htmlspecialchars($_POST['email']);
    $senha = $_POST['senha'];

    try{
        //prepara a instrução SQL para a Execução
        $stmt = $conn->prepare("SELECT id_cliente, senha, nome FROM usuarios WHERE email = :email");

        $stmt->bindParam(':email',$email);
        $stmt->execute();

        //obtem o resultado pra trabalhar depois
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        //verifica se algum usuario foi retomada a  consulta
        //se existir usuario
        if($usuario){
            //verifica se a senha fornecida correponde a senha armazenada
            if(password_verify($senha,$usuario['senha'])){
                //inicia sessão para armazenar informções do usuario
                session_start();
                //regenera o id da sessão pra previnir sequestro de sessão
                session_regenerate_id();
                //define configurações seguras para o cookie da sessão
                session_set_cookie_params(['secure'=>true,'httponly'=>true,'samesite'=>'strict']);
                //armazena o id do  usuario e o estado de login
                $_SESSION['usuario_id'] = $usuario['id_cliente'];
                $_SESSION['logado'] = true;
                $_SESSION['nome'] = $usuario['nome'];

                //redireciona o usuario para a pagina do painel pós login
                header("Location: painel.php");
                exit;
            }else{
                //caso a senha não esteja correta
                echo "senha incorreta";
            }
        }else{
            echo "usuario não encontrado";
        }
    }catch(PDOException $e){
        echo "Erro no login".$e->getMessage();
    }
}