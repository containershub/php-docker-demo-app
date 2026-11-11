<?php declare(strict_types=1);

namespace App\Migrations;

use App\Classes\Database;

final class CreateTables
{

    /** @var Database $db The database object */
    private Database $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function up(): void
    {
        // Create Tables
        $this->createUsersTable();
        $this->createPostsTable();
    }

    public function createUsersTable(): void
    {
        $query = <<<SQL
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT NOT NULL COMMENT 'Primary Key',
                first_name VARCHAR(50) DEFAULT '' NOT NULL COMMENT 'User First Name',
                last_name VARCHAR(50) DEFAULT '' NOT NULL COMMENT 'User Last Name',
                email_address VARCHAR(100) DEFAULT '' NOT NULL COMMENT 'User Email Address',
                PRIMARY KEY (id)
            )
        SQL;

        $this->db->query($query);
        $this->db->execute();
    }

    public function createPostsTable(): void
    {
        $query = <<<SQL
            CREATE TABLE IF NOT EXISTS posts (
                id INT AUTO_INCREMENT NOT NULL COMMENT 'Primary Key',
                title VARCHAR(100) DEFAULT '' NOT NULL COMMENT 'Post Title',
                post TEXT DEFAULT '' NOT NULL COMMENT 'Post Content',
                PRIMARY KEY (id)
            )
        SQL;

        $this->db->query($query);
        $this->db->execute();
    }

}
