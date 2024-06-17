<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header("HTTP/1.1 200 OK");
die();
}
class ConfigureteConnection
{
    private $host;
    private $database;
    private $username;
    private $password;
    private $pdo;

    public function __construct()
    {
        $this->host = 'mysql.geocontrole.com:3306';
        $this->database = 'geo';
        $this->username = 'utilizador';
        $this->password = 'Geocontrole1975!';
        $this->pdo = null;
    }

    public function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error connecting to the database: ' . $e->getMessage();
            $this->pdo = null; // Set $pdo to null on connection failure
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
