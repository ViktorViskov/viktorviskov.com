<?php
require '../lib/php/utils.php';
if (isset($_COOKIE['login']) && isset($_COOKIE['password'])){
    $userData = searchUser($_COOKIE['login'], $_COOKIE['password']);
    print "Hello {$userData['name']}";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
    </body>
    </html>
    <?php
    else {
        header("Location: ../");
    }
?>