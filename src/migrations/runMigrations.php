<?php declare(strict_types=1);

require_once __DIR__ . '/../config/_env.php';

try {
    $migrate = new \App\Migrations\CreateTables;
    $migrate->up();
} catch (\Exception $exception) {
    throw new ErrorException($exception->getMessage(), (int) $exception->getCode());
}
