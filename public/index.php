<?php
    require_once __DIR__ . '/../bootstrap/init.php';
    $appName = $_ENV['APP_NAME'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $appName ?></title>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div id="main" style="height: 100vh">
            <div>
                <h1><?= $appName ?></h1>
                <form method="post">
                    <button type="submit">Send Mail</button>
                </form>
            </div>
        </div>
    </body>
</html>
