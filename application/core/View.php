<?php


namespace application\core;


class View {
    public $path; // путь к виду Всё что внутри Body
    public $layout = 'default'; //шаблон <!Doctype> до <body> .. </html>
    public $route;

    public function __construct($route) {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
        //debug($this->path);
    }
    public function render($title, $vars = []) {
        extract($vars); //Забираем все переменные по ключу из vars
        $path = 'application/views/'.$this->path.'.php';
        if(file_exists($path)) {
            ob_start();//Копируем в буфер и получаем контент
            require $path;
            $content = ob_get_clean();
            require 'application/views/layouts/' . $this->layout . '.php';
        } else {
            echo 'Вид не найден: '.$this->path;
        }
    }

    public function redirect($url) {
        header('location: '.$url);
        exit;
    }

    public static function errorCode($code) {
        http_response_code($code);
        $path = 'application/views/errors/'.$code.'.php';
        if(file_exists($path)) {
            require $path;
        }
        exit; // Код не выполняется после выбрасывания ошибки
    }

    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url) {
        exit(json_encode(['url' => $url]));
    }


}