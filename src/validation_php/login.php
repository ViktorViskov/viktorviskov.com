<?php
// імпорт бібліотеки
require '../../lib/php/utils.php';

// отримання і обробка данних від користувача
$login = clearFilter($_POST['login']);
$password = clearFilter($_POST['password']);

// хешування паролю
$password = hashPassword($password);

$userData = searchUser($login,$password);
if ($userData){
    print "Привіт {$userData['name']}! Вітаємо в особистому кабінеті.";
}
else {
    print "Логін або пароль введено невірно";
}


?>