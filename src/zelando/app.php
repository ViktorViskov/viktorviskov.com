<?php
include './engine.php';
include './links.php';
function startApp()
{
    global $links;    
    foreach ($links as $link)
    {
        new takePrice($link);
    }
}
