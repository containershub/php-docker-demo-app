<?php
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
            <h1><?= $appName ?></h1>

            <div style="background-color:lightblue;padding:1em;">
                <h2>Add a user</h2>
                <form method="post" action="/user/create" enctype="multipart/form-data">
                    <input type="text" name="first_name" placeholder="First Name"/>
                    <input type="text" name="last_name" placeholder="Last Name"/>
                    <input type="email" name="email" placeholder="Email"/>
                    <button type="submit">Add User</button>
                </form>
                
                <div style="background-color:lightgreen;padding:.5em;margin-top:1em;">
                    <h2>List of all users</h2>
                    <ul>
                        <?php foreach ($data['users'] as $user): ?>
                        <li><?= "{$user['first_name']} {$user['last_name']} | {$user['email_address']}"; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            
            <div style="background-color:lightblue;padding:1em;margin-top:1em;">
                <h2>Add a post</h2>
                <form method="post" action="/post/create" enctype="multipart/form-data">
                    <input type="text" name="post_title" placeholder="Title"/>
                    <textarea name="post_text" rows="3" cols="48" placeholder="Post Text"></textarea>
                    <button type="submit">Add Post</button>
                </form>
                
                <div style="background-color:lightgreen;padding:.5em;margin-top:1em;">
                    <h2>List of all posts</h2>
                    <ul>
                        <?php foreach ($data['posts'] as $user): ?>
                        <li><?= "{$user['title']} | {$user['post']}"; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div>
                <h2>Send a test email</h2>
                <form method="post" action="/user/sendmail" enctype="multipart/form-data">
                    <button type="submit">Send Mail</button>
                </form>
            </div> 
        </div>
    </body>
</html>
