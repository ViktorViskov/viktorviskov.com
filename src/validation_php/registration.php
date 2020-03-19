<?php
require('../../lib/php/utils.php');

// отримання і очистка даних від користувача
$login = clearFilter($_POST["login"]);
$name = clearFilter($_POST["name"]);
$passwordOne = clearFilter($_POST["passwordOne"]);
$passwordTwo = clearFilter($_POST["passwordTwo"]);

// массив для помилок
$errors = [];

if (mb_strlen($login) < 4 || mb_strlen($login) > 20) {
    $errors[] = "Недопустима довжина логіну.(Від 4 до 20 символів)";
}

if (mb_strlen($name) < 2 || mb_strlen($name) > 20) {
    $errors[] = "Невірна дожина імені.(Від 2 до 20 символів)";
}

if (mb_strlen($passwordOne) < 4 || mb_strlen($passwordOne) > 20) {
    $errors[] = "Невірна дожина пароля.(Від 4 до 20 символів)";
}

if ($passwordOne === $passwordTwo) {
    $password = $passwordOne;
} 
else {
    $errors[] = "Введені паролі різні";
}



if ($errors){

    // виведення масиву з помилками
    printArr($errors);

exit();
}
else {   
    // хешування паролю
    $password = hashPassword($password);

    // створення користувача
    createUser($login,$password,$name);

    print "Користувача $login успішно зареєстовано.<br>";
    print "<a href='../index.html'>Повернутись на головну</a>";
}
?>
