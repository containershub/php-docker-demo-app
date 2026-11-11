<?php declare(strict_types=1);

namespace App\Migrations;

use App\Classes\Database;

final class TruncateTables
{
    private Database $db;
    private array $tables = ['users', 'posts'];

    public function __construct()
    {
        $this->db = new Database;
    }

    public function up(): void
    {
        foreach ($this->tables as $table) {
            $query = "TRUNCATE TABLE {$table}";

            $this->db->query($query);
            $this->db->execute();
        }
    }
}
