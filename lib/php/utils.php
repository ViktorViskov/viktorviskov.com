<?php
// роздрукувати массив
function printArr($arr) {
    foreach ($arr as $item){
        print $item."<br>";
    }
}

// хешування паролю
function hashPassword($password){
    return md5($password."viktorviskov");
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

// пошук користувача в бд
function searchUser($login,$password){
    $mysql = connectToDb();
    $result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    
}

// очистка данних від користувача (логін)
function clearFilter($value){
    return filter_var(trim($value),FILTER_SANITIZE_STRING);
}
?>