<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viktor Viskov homepage</title>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <nav class="menu">
        <ul class="list">
            <li class="list__item"><a href="./tetianaWorkPlan/index.php" class="list__link">Робочий план Тетянки</a>
            </li>
            <li class="list__item"><a href="./login/" class="list__link">Авторизація</a></li>
            <li class="list__item"><a href="./registration/" class="list__link">Реєстрація</a></li>
            <li class="list__item"><a href="./zelando" class="list__link list__link_red">Zelando</a></li>
            <li class="list__item"><a href="#" class="list__link">Тест</a></li>
        </ul>
    </nav>
    <?php
    require "./lib/php/utils.php";
    if (isset($_COOKIE['login'])){
        header("Location: ./main");
    }
    ?>
</body>

</html>