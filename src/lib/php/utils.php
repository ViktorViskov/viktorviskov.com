<?php
// роздрукувати массив
function printArr($arr) {
    foreach ($arr as $item){
        print $item."<br>";
    }
}

// хешування даних
function hashData($password){
    $result = md5($password);
    $result = md5($result.$password);
    $result = md5($result.'<!.,a-zїы');
    return $result;
}

// запит до бд
function requestToDb($sqlCode){
    // Імпорт даних для підключення до бази даних
    require 'config.php';

    // код функції
    $mysql = new mysqli($settings['host'],$settings['userName'],$settings['password'],$settings['dataBaseName']);
    $result = $mysql->query($sqlCode);
    $mysql->close();
    if ($result){
        return $result;
    }
}

// реєстрація нового користувача
function createUser($login, $password, $name){
    requestToDb("INSERT INTO `users` (`login`,`password`,`name`) values ('$login','$password','$name')");
}

// пошук користувача в бд для авторизації
function searchUser($login,$password){
    $result = requestToDb("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");    
    $user = $result->fetch_assoc();
    return $user;
}

// пошук для перевірки чи зареєстрований користувач
function chechUser($login){
    $result = requestToDb("SELECT `login` FROM `users` WHERE `login` = '$login'");
    $user = $result->fetch_assoc();
    return $user;
}

// очистка данних від користувача (логін)
function clearFilter($value){
    return filter_var(trim($value),FILTER_SANITIZE_STRING);
}

// встановлення куки
function setUsersCookie($userData, $period){
    setcookie("id", $userData['id'],time() + $period, "/");
    setcookie("login", $userData['login'],time() + $period, "/");
    setcookie("password", $userData['password'],time() + $period, "/");
}
?>