<?php
class Harga extends Controller
{
    public function index()
    {
        $data['harga'] = $this->model('Harga_model')->getHarga();
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');

        $this->view('pengaturan/harga', $data);
        $this->view('pengaturan/script_harga');
    }

    public function tambah()
    {
        if ($this->model('Harga_model')->tambah($_POST)) {
            header('Location:' . BASEURL . '/harga');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('Harga_model')->hapus($id)) {
            header('Location:' . BASEURL . '/harga');
            exit;
        }
    }

    public function getedit()
    {
        echo json_encode($this->model('Harga_model')->getById($_POST['id']));
    }

    public function edit()
    {
        if ($this->model('Harga_model')->edit($_POST)) {
            header('Location:' . BASEURL . '/harga');
            exit;
        }
    }

    //HARGA TAMBAHAN

    public function tambahan()
    {
        $data['harga'] = $this->model('Harga_model')->getHargaTambahan();
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');

        $this->view('pengaturan/tambahan', $data);
        $this->view('pengaturan/script_tambahan');
    }

    public function tambahht()
    {
        if ($this->model('Harga_model')->tambah_ht($_POST)) {
            header('Location:' . BASEURL . '/harga/tambahan');
            exit;
        }
    }

    public function hapusht($id)
    {
        if ($this->model('Harga_model')->hapus_ht($id)) {
            header('Location:' . BASEURL . '/harga/tambahan');
            exit;
        }
    }

    public function geteditht()
    {
        echo json_encode($this->model('Harga_model')->getById_ht($_POST['id']));
    }

    public function editht()
    {
        if ($this->model('Harga_model')->edit_ht($_POST)) {
            header('Location:' . BASEURL . '/harga/tambahan');
            exit;
        }
    }
}
