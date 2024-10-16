<?php
class Database {

  public function connect() {
    $host = getenv('DB_HOST'); // Retrieve from environment variable
    $db = getenv('DB_NAME');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASS');

    try {
      $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
      $pdo = new PDO($dsn, $user, $pass);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      die("Database connection failed: " . $e->getMessage());
    }
  }
}
