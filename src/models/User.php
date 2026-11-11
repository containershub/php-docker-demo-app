<?php

namespace App\Models;

use App\Classes\Database;
use Exception;

class User
{
    
    private Database $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Inserts one User entry into database
     *
     * @param array $data
     * @throws Exception
     */
    public function insertOne(array $data): void
    {
        if (empty($data)) {
            throw new Exception("Error Processing Request, your data is empty!", 1);
        }

        $query = <<<SQL
            INSERT INTO users (
                first_name, last_name, email_address
            ) VALUES (
                :first_name, :last_name, :email_address
            )
        SQL;

        $this->db->query($query);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email_address', $data['email_address']);
        $this->db->execute();
    }

    /**
     * Gets all users
     *
     * @return array
     * @throws Exception
     */
    public function getAll(): array
    {
        $this->db->query("SELECT * FROM users");

        if (!$this->db->resultSet()) {
            throw new Exception("Error: Something went wrong while fetching data!", 1);
        }

        return $this->db->resultSet();
    }

}
