<?php
include_once __DIR__ . '/../app/helpers/Utils.php';
include_once __DIR__ . '/../app/helpers/ErrorHandler.php';

class BaseController
{
    protected function setError($message) {
        ErrorHandler::setError($message);
    }

    protected function setSuccess($message) {
        ErrorHandler::setSuccess($message);
    }

    

    public function render($view, $data = [])
    {
        extract($data);
        require_once __DIR__ . '/../app/views/' . $view . '.php';
    }


    public function renderVisitor($view, $data = []){
        extract($data);
        require_once __DIR__ . '/../app/views/visitor/' . $view . '.php';
    }


    public function renderAdmin($view, $data = []){
        extract($data);
        require_once __DIR__ . '/../app/views/admin/' . $view . '.php';
    }


    public function renderTeacher($view, $data = []){
        extract($data);
        require_once __DIR__ . '/../app/views/teacher/' . $view . '.php';
    }


    public function renderStudent($view, $data = []){
        extract($data);
        require_once __DIR__ . '/../app/views/student/' . $view . '.php';
    }
    public function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }
}