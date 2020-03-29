<?php
class pageRender {
    function __construct ($content,$stylesLink = "",$pageName = "") {
        $this->renderBlock($this->base($stylesLink));
        $this->renderBlock($this->crtHeader($pageName));
        $this->renderBlock($content);
        $this->renderBlock($this->end);
    }

    // вивести блок
    private function renderBlock($element) {
        print $element;
    }

    // базові мета дані
    private function base($link){
    print <<<BASE
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href=$link>
    </head>
    <body>
    BASE;}

    // header
    // заголовок + логіка на активну сторінку
    private function crtHeader($currentPage){
        $pages = [
            "Головна"=>"../main",
            "Календар"=>"../calendar",
            "Статистика"=>"../statistick",
            "Налаштування"=>"../settings"];
        $items = "";
        foreach ($pages as $pageName => $link){
            if ($currentPage === $pageName){
                $items .= "<li class='list__item'><a href=$link class='list__link list__link_active'>$pageName</a></li>";
            }
            else {
                $items .="<li class='list__item'><a href=$link class='list__link '>$pageName</a></li>";
            }
        }

        $header = <<<HEADER
        <header class="main-header">
        <div class="container">
            <nav class="menu">
                <ul class="list">
                $items
                </ul>
            </nav>
            <ul class="list">
                <li class="list__item"><span class="title">Привіт \$userName</span></li>
                <li class="list__item"><a href="#" class="list__link list__link_exit">Вихід</a></li>
            </ul>
        </div>
        </header>
        HEADER;    
        print $header;

    }
    // кінцеві теги
    public $end = <<<END
    </body>
    </html>
    END;

}
?>