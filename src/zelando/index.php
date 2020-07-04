<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zalando parser</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header class="header">
        <h3 class="header__title">
            Zalando parser
        </h3>
        <p class="header__description">
            Веб сторінка яка вам допоможе слідкувати за цінами на популярному ресурсі www.zalando.dk.
        </p>
        <nav class="nav">
            <a href="list.php" class="nav__link show">Переглянути список</a>
            <a href="add.php" class="nav__link add">Додати елемент</a>
            <a href="#" class="nav__link edit">Редагувати список</a>
            <a href="#" class="nav__link clear">Очистити список</a>
        </nav>
    </header>
    <main class="main">
        <section class="section">
            <span class="section__text">У вас в списку </span>
            <span class="section__text nrItems"></span>
            <span class="section__text"> елементів.</span>
        </section>
    </main>
    <script src="index.js" type="module"></script>
</body>
</html>