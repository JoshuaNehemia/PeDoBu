<?php

namespace App\Database;

use mysqli;
use mysqli_sql_exception;

class Database
{
    private string $dbServer = "localhost";
    private string $dbUser = "root";
    private string $dbPassword = "";
    private string $dbName = "PeDoBu";
    private ?mysqli $conn = null;

    public function __construct()
    {
        $this->connect();
    }

    private function connect(): void
    {
        if ($this->conn instanceof mysqli && $this->conn->ping()) {
            return; // Already connected and alive
        }

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $this->conn = new mysqli($this->dbServer, $this->dbUser, $this->dbPassword, $this->dbName);
            $this->conn->set_charset("utf8mb4"); // Always use UTF-8
        } catch (mysqli_sql_exception $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw $e;
        }
    }

    public function getConnection(): mysqli
    {
        $this->connect(); // Ensure alive
        return $this->conn;
    }

    public function close(): void
    {
        if ($this->conn) {
            $this->conn->close();
            $this->conn = null;
        }
    }

    public function __destruct()
    {
        $this->close();
    }
}
