<?php
    require_once __DIR__ . '/../bootstrap/init.php';
    $appName = $_ENV['APP_NAME'];
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $appName ?></title>
</head>
<body>
    <div style="height: 100vh">
        <div>
            <h1><?= $appName ?></h1>
            <form method="post">
                <button type="submit">Send Mail</button>
            </form>
        </div>
    </div>
</body>
</html>
