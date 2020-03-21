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

// зєднання з бд
function connectToDb(){
    // Дані для підключення до бази даних
    $settings = [  'host'=>'localhost',
                    'userName'=>'root',
                    'password'=>'',
                    'dataBaseName'=>'test'];

    return $mysql = new mysqli($settings['host'],$settings['userName'],$settings['password'],$settings['dataBaseName']);
}

// реєстрація нового користувача
function createUser($login, $password, $name){
    $mysql = connectToDb();
    $mysql->query("INSERT INTO `users` (`login`,`password`,`name`) values ('$login','$password','$name')");
    // закриття зєднання
    $mysql->close();
}

// пошук користувача в бд для авторизації
function searchUser($login,$password){
    $mysql = connectToDb();
    $result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    $mysql->close();    
    $user = $result->fetch_assoc();
    return $user;
}

// пошук для перевірки чи зареєстрований користувач
function chechUser($login){
    $mysql = connectToDb();
    $result = $mysql->query("SELECT `login` FROM `users` WHERE `login` = '$login'");
    $user = $result->fetch_assoc();
    return $user;
}

// очистка данних від користувача (логін)
function clearFilter($value){
    return filter_var(trim($value),FILTER_SANITIZE_STRING);
}
?>