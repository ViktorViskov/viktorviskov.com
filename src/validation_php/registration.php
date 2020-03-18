<?php
require('../../lib/php/utils.php');

// trim видаляэ пробіли filter_var перевіряє на заборонені символи і видаляє правило записане в FILTER_SANITIZE_STRING
$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
$name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
$passwordOne = filter_var(trim($_POST['passwordOne']),FILTER_SANITIZE_STRING);
$passwordTwo = filter_var(trim($_POST['passwordTwo']),FILTER_SANITIZE_STRING);

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
    createUser($login,$password,$name,$settingsForDb);

    print "Користувача $login успішно зареєстовано.<br>";
    print "<a href='../index.html'>Повернутись на головну</a>";
}
?>
