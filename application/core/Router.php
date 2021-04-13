<?php

namespace application\core;

class Router
{
    protected $routes = [];
    protected $params = [];


    public function __construct()
    {
        //Добавили 2 маршрута пока не обработали
        $arr = require  'application/config/routes.php';
        foreach ($arr as $key => $val) {
            //Обращение к методам через this
            $this->add($key, $val);
        }
        //Стали регулярными выражениями debug($this->routes);
    }
    // будет добавлять маршрут
    public function add($route, $params) {
        //Регулярные выражения
        $route = '#^'.$route. '$#';
        $this->routes[$route] = $params;

    }/// Сравниваем запрашиваемую ссылку с теми направлениями которые у нас уже есть
    /// Если есть то, записываем в this->params = $params
    public function match() {
        //debug($_SERVER);
        //$_SERVER - Информация о странице
        //REDIRECT_URL - Страница на которой мы находимся
        //trim - удаляем первый '/'
        $url = trim($_SERVER['REQUEST_URI'],'/');
        //debug($url);
        foreach ($this->routes as $route => $params) {
            if(preg_match($route, $url, $matches )) {
                $this->params = $params;
                return true;
                //var_dump($matches);
            }
        }
        return false;
    }
    public function run() {
       if($this->match()) {
           $path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
            if(class_exists($path)) {
                //Добавляем Action - для безопасности- что бы не был вызван скрытый метод
                $action = $this->params['action'].'Action';
                if(method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
       } else {
           View::errorCode(404);
       }

    }
}