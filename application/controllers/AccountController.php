<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller {

    public function loginAction() {
        //$this->view->redirect('https://google.com');
        if (!empty($_POST)) {
            $this->view->location('/account/register');
        }
        $this->view->render('Вход');

    }
    public function registerAction() {
        $this->view->render('Регистрация');
    }
}