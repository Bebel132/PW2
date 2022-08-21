<?php
    require "assets/backend/connect.php";
    if(isset($_GET['err']) and $_GET['err'] == '1'){
        $err = true;
    } else {
        $err = false;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <form action="assets/backend/adicionar.php" method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="fulano" required>
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" id="endereco" placeholder='rua fodaRuaMuitoFoda 6669' required>
            <label for="telefone">Telefone</label>
            <input type="tel" pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" name="telefone" id="telefone" required placeholder="00-0000-0000">
            <input type="submit" value="enviar" id="enviar">
        </form>
        <?php
            if($err){
                echo "<div id='erro'>já existe alguém com o mesmo endereço e telefone</div>";
            }
        ?>
        <table id="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th></th>
                </tr>
            </thead>
            <?php
                $resultado = $conn->query("SELECT * FROM `dados`");
                if($resultado->num_rows > 0){
                    while($row = $resultado->fetch_assoc()){
                        echo "
                        <tr>
                            <td>".$row['id']."</td>
                            <td>".$row['nome']."</td>
                            <td>".$row['endereco']."</td>
                            <td>".$row['telefone']."</td>
                            <td><button class='tabelaBtn editar'>Editar</button><button class='tabelaBtn excluir'>Excluir</button></td>
                        </tr>";
                    }
                }
            ?>
        </table>
    </div>
    <script>
        document.querySelectorAll(".tabelaBtn").forEach(i => {
            i.addEventListener("click", () => {
                let id = i.parentNode.parentNode.children[0].textContent;
                if(i.textContent == 'Excluir'){
                    window.location.href='assets/backend/remover.php?id='+id;
                } else {
                    window.location.href='assets/backend/editar.php?id='+id;
                }
            })
        })
    </script>
</body>
</html>