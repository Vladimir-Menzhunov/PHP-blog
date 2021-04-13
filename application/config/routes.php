<?php

return [
    // Маршрут до глаавной страницы
    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],

   // 'contact' => [
    //    'controller' => 'main',
    //    'action' => 'contact'
    //],

    //Переходы по страницам аналог
    // index.php/account/login
    'account/login' => [
        'controller' => 'account',
        'action' => 'login'
    ],

    'account/register' => [
        'controller' => 'account',
        'action' => 'register'
    ],

];