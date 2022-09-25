<?php
    require "App.php";
    $app = new App("localhost", "root", "massa123", "pw2");

    if(isset($_GET['nome']) && isset($_GET['nascimento']) && isset($_GET['renda'])){
        $app->insert($app->connect());
        header("location: index.php");
    }

    if(isset($_GET['del'])){
        $app->delete($app->connect(), $_GET['del']);
    } else if(isset($_GET['edit'])){
        
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        form {
            border: 1px solid black;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        table, tr, td, th {
            border: 1px solid #000;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <form action="#" method="get">
        <label for="nome">nome</label>
        <input type="text" name="nome" id="nome" required><br>
        <label for="nascimento">nascimento</label>
        <input type="date" name="nascimento" id="nascimento" required><br>
        <label for="renda">renda</label>
        <input type="number" name="renda" id="renda" required><br>
        <input type="submit" value="enviar">
    </form>
    <table>
        <tr>
            <th>id</th>
            <th>nome</th>
            <th>nascimento</th>
            <th>renda</th>
        </tr>
    <?php
        $app->select($app->connect());
    ?>
    </table>
    <script>
        let del = document.querySelectorAll(".del");
        let edit = document.querySelectorAll(".edit");
        del.forEach(e => {
            e.addEventListener("click", () => {
                window.location.href = "index.php?del="+e.parentElement.parentElement.children[0].textContent;
            })
        })
        edit.forEach(e => {
            e.addEventListener("click", () => {
                window.location.href = "index,php?edit="+e.parentElement.parentElement.children[0].textContent;
            })
        })
    </script>
</body>
</html>