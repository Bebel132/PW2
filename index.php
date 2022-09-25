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
        echo $query;
        $app->update($app->connect(), $query);
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
                window.location.href = "index.php?edit="+e.parentElement.parentElement.children[0].textContent+"";
            })
        })

        if(id != null){
            const rows = document.querySelectorAll('tr');
            let arr = [];
            rows.forEach(row => {
                arr.push(row.children[0].textContent);
            })
            arr.forEach(i => {
                if(i == id){
                    rows.forEach(row => {
                        if(row.children[0].textContent == id){
                            for(let e = 1; e<=3; e++){
                                let input = document.createElement('input');
                                input.setAttribute("type", "text");
                                input.classList.add("atualizar");
                                input.id = e;
                                row.children[e].innerHTML = "";
                                row.children[e].append(input);
                            }

                            document.querySelectorAll(".atualizar")[2].setAttribute("type", "number");

                            row.children[4].innerHTML = "";
                            let button = document.createElement('button');
                            button.innerHTML = "enviar";
                            button.id = "enviar"
                            row.children[4].append(button)

                            document.querySelector("#enviar").addEventListener('click', () => {
                                const novosDadosBruto = document.querySelectorAll(".atualizar");
                                let novosDadosRef = [];
                                let arr = [];

                                novosDadosBruto.forEach(i => {
                                    arr.push(i);
                                })

                                arr.forEach(i => {
                                    if(i.value != ""){
                                        novosDadosRef.push([i.value, i.id]);
                                    }
                                })

                                let query = `UPDATE aluno SET `
                                for(let i = 0; i<novosDadosRef.length; i++){
                                    if(novosDadosRef.length == 1){
                                        if(novosDadosRef[i][1] == 1){
                                            query += "nome='"+novosDadosRef[i][0]+"'"
                                        } else if(novosDadosRef[i][1] == 2){
                                            query += "nascimento='"+novosDadosRef[i][0]+"'"
                                        } else if(novosDadosRef[i][1] == 3){
                                            query += "renda="+novosDadosRef[i][0]
                                        }
                                    } else {
                                        if(novosDadosRef[i][1] == 1){
                                            query += "nome='"+novosDadosRef[i][0]+"',"
                                        } else if(novosDadosRef[i][1] == 2){
                                            query += "nascimento='"+novosDadosRef[i][0]+"',"
                                        } else if(novosDadosRef[i][1] == 3){
                                            query += "renda="+novosDadosRef[i][0]+","
                                        }
                                    }
                                }

                                if(novosDadosRef.length >= 2){
                                    query = query.substring(0, query.length-1)
                                }
                                query += " WHERE id="+id
                                console.log(query) // só preciso mandar isso pro php, vou fazer isso da maneira mais burra
                                window.location.href = "index.php?query="+query;

                            })
                        }
                    })
                }
            })
        }
    </script>
</body>
</html>