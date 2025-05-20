<?php
class Database {
    public function connect() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=sistema_nutricion;charset=utf8", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>
