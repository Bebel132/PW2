<?php
class App {
    private $servername;
    private $username;
    private $password;
    private $database;
    public $table;

    public function __construct($servername, $username, $password, $database){
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->table = [];
    }

    public function showData($table){
        foreach($table as $row){
            echo "<tr>";
            foreach($row as $i){
                echo "<td>".$i."</td>";
            }
            echo "<td><button class='del'>deletar</button><button class='edit'>editar</button>";
            echo "</tr>";
        }
    }

    public function connect(){
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
        return $conn;
    }

    public function insert($conn){
        $dataUser = [
            $_GET['nome'],
            $_GET['nascimento'],
            $_GET['renda']
        ];
        try{
            $query = "INSERT INTO aluno(nome, nascimento, renda) VALUES ('$dataUser[0]', '$dataUser[1]', '$dataUser[2]')";
            $conn->exec($query);
        } catch(PDOException $e){
            echo $query . "<br>" . $e->getMessage();
        }
        $conn = null;
    }

    public function select($conn){
        $data = $conn->query("SELECT * FROM `aluno`")->fetchAll();
        foreach($data as $row){
            $arr = [
                $row['id'],
                $row['nome'],
                $row['nascimento'],
                "R$".$row['renda']
            ];
            array_push($this->table, $arr);
        }
        $conn = null;
        $this->showData($this->table);
    }

    public function delete($conn, $id){
        $conn->exec("DELETE FROM aluno WHERE id=$id");
        $conn = null;
    }

    public function update($conn, $query){
        $conn->exec("$query");
        $conn = null;
    }
}
?>