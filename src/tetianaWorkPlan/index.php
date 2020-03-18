<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6 maximum-scale=0.6, user-scalable=no">
    <title>Робочий графік Тетяни</title>
    <link rel="stylesheet" href="./css/page.css">
</head>

<body>
    <div class="container">
        <div class="week">

        <?php 
        require_once "utils.php";
        new MakeDay(16,03,2020,"8:00","16:00");
        new MakeDay(17,03,2020);
        new MakeDay(18,03,2020);
        new MakeDay(19,03,2020);
        new MakeDay(20,03,2020,"14:00","22:00");
        new MakeDay(21,03,2020,"14:00","22:00");
        new MakeDay(22,03,2020,"14:00","22:00");
        new MakeDay(23,03,2020);
        new MakeDay(24,03,2020);
        new MakeDay(25,03,2020,"6:00","14:00");
        new MakeDay(26,03,2020,"8:00","16:00");
        new MakeDay(27,03,2020,"7:00","15:00");
        new MakeDay(28,03,2020);
        new MakeDay(29,03,2020);        
        ?>
        </div>
    </div>
</body>
</html>