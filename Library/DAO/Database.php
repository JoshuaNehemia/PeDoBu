<?php
namespace App\Database;

use mysqli;
use mysqli_sql_exception;

class Database {
    private static ?Database $instance = null;

    private string $dbServer   = "localhost";
    private string $dbUser     = "root";
    private string $dbPassword = "";
    private string $dbName     = "pedobub"; //Sorry kuganti bentar mysqlku bermasaslah - Joshua


    private ?mysqli $conn = null;

    private function __construct() {
        $this->connect();
    }

    private function connect(): void {
        if ($this->conn instanceof mysqli && $this->conn->ping()) {
            return;
        }

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $this->conn = new mysqli($this->dbServer, $this->dbUser, $this->dbPassword, $this->dbName);
            $this->conn->set_charset("utf8mb4");
        } catch (mysqli_sql_exception $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw $e;
        }
    }

    public static function getConnection(): mysqli {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        self::$instance->connect();
        return self::$instance->conn;
    }

    public function close(): void {
        if ($this->conn) {
            $this->conn->close();
            $this->conn = null;
        }
    }

    public function __destruct() {
        $this->close();
    }
}
?>
