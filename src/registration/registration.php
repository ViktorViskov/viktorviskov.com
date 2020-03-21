<?php
// логіка захисту
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

// імпорт бібліотеки функцій
require('../lib/php/utils.php');

// отримання і очистка даних від користувача
$login = clearFilter($_POST["login"]);
$name = clearFilter($_POST["name"]);
$passwordOne = clearFilter($_POST["passwordOne"]);
$passwordTwo = clearFilter($_POST["passwordTwo"]);

// массив для помилок
$errors = [];

// виявлення помилок
if (mb_strlen($login) < 4 || mb_strlen($login) > 20) {
    $errors[] = "Невірна довжина логіну.(Від 4 до 20 символів)";
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



// виведення масиву з помилками
if ($errors){
    printArr($errors);
    exit();
}

else {
    // перевірка чи занятий логін
    if (!chechUser($login)){

        // хешування даних
        $login = hashData($login);        
        $password = hashData($password);
    
        // створення користувача
        createUser($login,$password,$name);
    
        print "Користувача {$_POST['login']} успішно зареєстовано.<br>";
    }
    else {
        print "$login даний логін використовуєтсья. Виберіть інший логін.<br>";
    }
    
    print "<a href='../index.html'>Повернутись на головну</a>";
}
}


else {
    // перенаправлення на основну сторінку
    header("Location: ./");
}
?>
