<?php 
    require "connect.php";
    $id = rand(0, 999999);
    $nome = strtoupper($_POST['nome']);
    $endereco = strtoupper($_POST['endereco']);
    $telefone = $_POST['telefone'];

    $err = false;
    
    $resultado = $conn->query("SELECT * FROM `dados`");
    if($resultado->num_rows > 0){
        while($row = $resultado->fetch_assoc()){
            while($id == $row['id']){
                $id = rand(0, 999999);
            }
            if($endereco == $row['endereco'] and $telefone == $row['telefone']){
                $err = true;
                //se achar o mesmo endereco e telefone na tabela, vai dar erro
            }
        }
    }

    if($err){
        header("location: ../../index.php?err=1");
    } else {
        if($conn->query("INSERT INTO `dados` (id, nome, endereco, telefone) VALUES ('$id', '$nome', '$endereco', '$telefone')")){
            header("location: ../../index.php?err=0");
        }
    }
?>