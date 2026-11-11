<?php

namespace App\Models;

use App\Classes\Database;
use Exception;

class Post
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
            INSERT INTO posts (title, post) VALUES (:title, :post)
        SQL;

        $this->db->query($query);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':post', $data['post']);
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
        $this->db->query("SELECT * FROM posts");

        if (!$this->db->resultSet()) {
            throw new Exception("Error: Something went wrong while fetching data!", 1);
        }

        return $this->db->resultSet();
    }

}
