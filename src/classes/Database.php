<?php declare(strict_types=1);

namespace App\Classes;

use PDO;
use PDOException;
use PDOStatement;

class Database
{

    private string $host;
    private string $port;
    private string $dbname;
    private string $username;
    private string $password;

    // Database Handler
    private PDO $dbh;
    private PDOStatement $stmt;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->port = $_ENV['DB_PORT'];
        $this->dbname = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];

        // Set Data Source Name
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};port={$this->port}";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            $this->dbh = new PDO($dsn, $this->username, $this->password, $options);
        } catch(PDOException $exception) {
            throw new PDOException($exception->getMessage(), (int) $exception->getCode());
        }
    }

    /**
     *  Prepares statement with query
     *
     *  @param string $sql
     */
    public function query(string $sql): void
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Bind values instead of passing them directly into the query
     *
     * @param string $param
     * @param mixed $value
     * @param mixed $type Default: null
     */
    public function bind(string $param, mixed $value, mixed $type = null): void
    {
        if (is_null($type)) {
            $type = match($value) {
                is_int($value) => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Executes the prepared statement
     *
     * @return object
     */
    public function execute(): bool
    {
        return $this->stmt->execute();
    }

    /**
     * Gets result set as an associative array of objects
     *
     * @return array|bool
     */
    public function resultSet(): array|bool
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *  Gets a single result object
     *
     *  @return array|bool
     */
    public function single(): array|bool
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Gets the row count
     *
     * @return int
     */
    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

}
