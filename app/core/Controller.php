<?php



class Controller
{
    public function view($view, $data = [])
    {

        require_once './app/views/' . $view . '.php';
    }

    public function model($model)
    {
        if (!isset($_SESSION['login']) && $model != 'Login_model') {
            header('Location:' . BASEURL . '/login');
            exit;
        } else {
            require_once './app/models/' . $model . '.php';
            return new $model;
        }
    }
}
