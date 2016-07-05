<?php
require_once("dbdata.php");

class mother
{
    protected $pdo;

    public function __construct($connection = null)
    {
        try {
            $this->pdo = $connection;
            if ($this->pdo === null) {
                $this->pdo = new PDO(
                    UserData::$dsn,
                    UserData::$dbuser,
                    UserData::$dbpass
                );
            }
        } catch (PDOException $e) {
            echo("Ein Fehler ist aufgetreten<br>" . $e->getMessage() . "<br>");
            die();
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}