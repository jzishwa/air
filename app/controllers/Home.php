<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Home extends Controller
{
    public function index()
    {
        
        $data['pam'] = $this->model('Master_model')->getprofile();
        $data['pendapatan'] = $this->model('Pembayaran_model')->getJumlah();
        $data['keluar'] = $this->model('Pengeluaran_model')->getJumlah();
        if ($_SESSION['level'] == 'Administrator') {

            $this->view('templates/header');
            $this->view('templates/sidebar');
            $this->view('templates/topbar');
            $this->view('templates/main', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL . '/tagihan');
            exit;
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_unset();
        session_destroy();
        header('Location:' . BASEURL . '/login');
        exit;
    }
}