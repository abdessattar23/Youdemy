<?php
include_once __DIR__ . '/Utils.php';
class BaseController
{
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
}