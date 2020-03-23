<?php
// логіка захисту
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

// імпорт бібліотеки
require '../lib/php/utils.php';

// отримання і обробка данних від користувача
$login = clearFilter($_POST['login']);
$password = clearFilter($_POST['password']);

// хешування даних
$login = hashData($login);
$password = hashData($password);

$userData = searchUser($login,$password);
if ($userData){
    // ставим куки
    setUsersCookie($userData, 30);
    header("Location: ../main");
}
else {
    print "Логін або пароль введено невірно";
}
}
else {
    header("Location: ./");
}

?>