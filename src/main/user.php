<?php
require '../lib/php/utils.php';
if (isset($_COOKIE['login']) && isset($_COOKIE['password'])){
    $userData = searchUser($_COOKIE['login'], $_COOKIE['password']);
    print "Hello {$userData['name']}";
}
?>