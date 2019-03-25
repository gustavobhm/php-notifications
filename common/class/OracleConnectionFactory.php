<?php

class OracleConnectionFactory
{

    // Hold the class instance.
    private static $instance = null;

    private $conn;

    // The db connection is established in the private constructor.
    private function __construct()
    {
        $this->conn = oci_connect(ORACLE_DB_USERNAME, ORACLE_DB_PASSWORD, ORACLE_DB_HOSTNAME . '/' . ORACLE_DB_DATABASE, ORACLE_DB_CHARSET);
    }

    public static function getInstance()
    {
        if (! self::$instance) {
            self::$instance = new OracleConnectionFactory();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

?>