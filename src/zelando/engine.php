<?php
class takePrice
{
    function __construct($link, $nameCN = "_3yfuT5", $priceCN = "WbSD97")
    {
        // введення данних
        $this->link = $link;
        $this->nameCN = $nameCN;
        $this->priceCN = $priceCN;
        $this->name[1] = "Сталась помилка. Перевірте посилання.";
        $this->mkClientsHeader();
        $this->parseData();
        $this->formatData();
        $this->render();
    }

    // створюємо заголовок клієнта
    private function mkClientsHeader()
    {
        $opts = array(
            'http' => array(
                "method" => "GET",
                "timeout" => 10,
                "header" => "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36",
            )
        );
        $this->context = stream_context_create($opts);
    }

    // парсимо дані
    private function parseData()
    {
        $this->rowData = file_get_contents($this->link, false, $this->context);
    }

    // пошук данних
    private function formatData()
    {
        if ($this->rowData)
        {
        // пошук назви 
        $pattern = "!<div class=\"$this->nameCN\">(.*?)</div>!si";
        preg_match($pattern, $this->rowData, $this->name);

        // пошук ціни
        $pattern = "!<div class=\"$this->priceCN\">(.*?)</div>!si";
        preg_match($pattern, $this->rowData, $this->price);
        }
    }

    // рендер елемента
    private function render()
    {
        print <<<PAGE
        <li class="item">
            <a href="$this->link" class="name">{$this->name[1]}</a>
            <div class="price">{$this->price[1]}</div></div>
            <button class="delete">Видалити</button>
        </li>
        PAGE;
    }
}
