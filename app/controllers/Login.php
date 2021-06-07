<?php

class Login extends Controller
{
    public function index()
    {
        if (isset($_SESSION['login'])) {
            header('Location:' . BASEURL);
            exit;
        }
        $this->view('templates/login');
    }

    public function verif()
    {
        if (isset($_POST['login'])) {
            $cek = $this->model('Login_model')->valid($_POST);
            if ($cek == 'admin') {
                header('Location:' . BASEURL);
                exit;
            } elseif ($cek == 'operator') {
                header('Location:' . BASEURL);
                exit;
            } elseif ($cek == 2) {
                Flash::setFlash('Password Salah', 'Gagal Login! ', 'primary');
                header('Location:' . BASEURL . '/login');
                exit;
            } else {
                Flash::setFlash('Username tidak ditemukan', 'Gagal Login! ', 'primary');
                header('Location:' . BASEURL . '/login');
                exit;
            }
        }
    }
}
