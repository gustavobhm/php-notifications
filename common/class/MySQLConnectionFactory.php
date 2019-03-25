<?php

class MySQLConnectionFactory
{

    // Hold the class instance.
    private static $instance = null;

    private $conn;

    // The db connection is established in the private constructor.
    private function __construct()
    {
        $this->conn = new PDO("mysql:host=" . DB_HOSTNAME . ";charset= . DB_CHARSET . ", DB_USERNAME, DB_PASSWORD);

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->conn->exec("SET NAMES " . DB_CHARSET);
        $this->conn->exec("SET character_set_connection=" . DB_CHARSET);
        $this->conn->exec("SET character_set_client=" . DB_CHARSET);
        $this->conn->exec("SET character_set_results=" . DB_CHARSET);
    }

    public static function getInstance()
    {
        if (! self::$instance) {
            self::$instance = new MySQLConnectionFactory();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

?>