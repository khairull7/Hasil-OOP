<?php
class DatabaseConnection
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (!$this->connection) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }

    public function executeQuery($sql)
    {
        return mysqli_query($this->connection, $sql);
    }

    public function closeConnection()
    {
        mysqli_close($this->connection);
    }
}

class NilaiDeletion
{
    private $database;

    public function __construct(DatabaseConnection $database)
    {
        $this->database = $database;
    }

    public function deleteData($data)
    {
        $sql = "DELETE FROM nilai WHERE id = '$data'";
        $query = $this->database->executeQuery($sql);

        if ($query) {
            echo "Data berhasil dihapus!";
            echo "<a href='tampil.php'> Tampilkan Data</a> ";
            echo "<a href='tugas3.php'> Tambahkan Data</a> ";
        } else {
            echo "Penghapusan gagal sebab : <br>" . mysqli_error($this->database->getConnection());
        }
    }
}

$data = $_GET['id'];

$host = "localhost";
$username = "root";
$password = "";
$databaseName = "tugas";

$database = new DatabaseConnection($host, $username, $password, $databaseName);
$database->connect();

$nilaiDeletion = new NilaiDeletion($database);
$nilaiDeletion->deleteData($data);

$database->closeConnection();
?>