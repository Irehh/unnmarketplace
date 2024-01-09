<?php
class Comments {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo;
  private $stmt;
  public $error;
  function __construct () {
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
    ]);
  }

  // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct () {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  // (C) HELPER - RUN SQL QUERY
  function query ($sql, $data=null) {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
  }

  // (D) GET COMMENTS
  function get ($id) {
    $this->query(
      "SELECT `name`, `timestamp`, `message`
       FROM `comments` WHERE `post_id`=?
       ORDER BY `timestamp` ASC", [$id]);
    return $this->stmt->fetchAll();
  }

  // (E) SAVE COMMENT
  function save ($id, $name, $msg) {
    $this->query(
      "INSERT INTO `comments` (`post_id`, `name`, `message`) VALUES (?,?,?)",
      [$id, $name, strip_tags($msg)]
    );
    return true;
  }
}

// (F) DATABASE SETTINGS - CHANGE TO YOUR OWN !
define("DB_HOST", "localhost");
define("DB_NAME", "unnmarketplace");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (G) COMMMENTS OBJECT
$_COM = new Comments();