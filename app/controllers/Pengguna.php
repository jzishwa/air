<?php

class Pengguna extends Controller
{
    public function index()
    {
        $data = $this->model('Master_model')->getUserById($_SESSION['id_user']);
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('user/data', $data);
        $this->view('user/data_script');
    }

    public function editpassword()
    {
        $data = $this->model('Master_model')->getUserById($_SESSION['id_user']);
        if ($data['pass'] == md5($_POST['pass_lama'])) {
            if ($_POST['pass_new'] == $_POST['pass_valid']) {
                if ($this->model('Master_model')->updatePass($_SESSION['id_user'], $_POST['pass_new'])) {
                    Flash::setFlash('Update Password ', 'Berhasil!', 'success');
                }
            } else {
                Flash::setFlash('Password Baru tidak sesuai dengan Password konfirmasi', 'Gagal!', 'danger');
            }
        } else {
            Flash::setFlash('Password Lama tidak sesuai', 'Gagal!', 'danger');
        }
        header('Location:' . BASEURL . '/pengguna');
        exit;
    }
}
