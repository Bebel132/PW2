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
        echo '<script>
                    const id = '.$_GET['edit'].'
                </script>';
    }

    if(isset($_GET['query'])){
        $query = $_GET['query'];
        $app->update($app->connect(), $query);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <form action="#" method="get">
        <div class="form-field">
            <label for="nome">nome:</label>
            <input type="text" name="nome" id="nome" required>
        </div>
        <div class="form-field">
            <label for="nascimento">nascimento:</label>
            <input type="date" name="nascimento" id="nascimento" required>
        </div>
        <div class="form-field">
            <label for="renda">renda:</label>
            <input type="number" name="renda" id="renda" required>
        </div>
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
    <script src="assets/script.js"></script>
</body>
</html>