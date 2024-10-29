<?php
class Database {  
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;

    public function __construct($host='localhost', $username='userweb', $password='iw2014pw', $database='crm') {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
        // Establecer el charset UTF-8 para evitar problemas con caracteres especiales
        if (!$this->conn->set_charset("utf8")) {
            die('Error cargando el conjunto de caracteres utf8: ' . $this->conn->error);
        }
    }

    public function query($sql) {
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Error en la consulta: " . $this->conn->error);
        }
        return $result;
    }

    public function prepare($sql) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die('Error en prepare: ' . htmlspecialchars($this->conn->error));
        }
        return $stmt;
    }

    public function getConnError() {
        return $this->conn->error;
    }
    
    public function getLastInsertId() {
        return $this->conn->insert_id;
    }

    public function __destruct() {
        $this->conn->close();
    }
    // Ejecutar una consulta y obtener todos los resultados 
    public function rptArray($query) {
        $result = $this->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
        
    }
}
?>
