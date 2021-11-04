<?php 
    include "conexao.php";


    $nome = $_POST['nome_app'];
    $email = $_POST['email_app'];
    $senha = $_POST['senha_app'];

    //verifica se o usuario ja existe

    $sql_verifica = "SELECT * FROM nometabela  WHERE email = :EMAIL";

    $stmt = $PDO->prepare($sql_verifica);
    $stmt->bindParam(':EMAIL',$email);
    $stmt->execute();

    if($stmt -> rowCount()-> 0){
        // email já cadastrado
        $retornoApp = array("CADASTRO"=>"EMAIL_ERRO");
    }else{
        //vai ser cadastrado
        $sql_insert = "INSERT INTO nomeTabela(nome,emaiil,senha) VALUES (:NOME, :EMAIL, :SENHA):";

        $stmt->bindParam(':NOME', $nome);
        $stmt->bindParam(':EMAIL', $email);
        $stmt->bindParam(':SENHA',$senha);

        if($stmt->execute()){
            $retornoApp= array("CADASTRO"=>"SUCESSO");
          
        }else{
            $retornoApp= array("CADASTRO"=>"ERRO");
        }

    }
    echo json_encode($retornoApp);

?>