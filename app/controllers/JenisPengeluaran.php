<?php

class JenisPengeluaran extends Controller
{

    public function index()
    {
        $data['jp'] = $this->model('Jp_model')->getAll();
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');

        $this->view('pengaturan/jenisPengeluaran', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');

        $this->view('pengaturan/jpform');
        $this->view('templates/footer');
    }

    public function add()
    {
        if ($this->model('Jp_model')->tambahJp($_POST)) {
            Flash::setFlash('Menambahkan Jenis Pengeluaran', 'Berhasil!', 'success');
            header('Location:' . BASEURL . '/jenispengeluaran');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('Jp_model')->hapusJp($id)) {
            Flash::setFlash('Menghapus Jenis Pengeluaran', 'Berhasil!', 'success');
            header('Location:' . BASEURL . '/jenispengeluaran');
            exit;
        }
    }

    public function edit($id)
    {
        $data['jp'] = $this->model('Jp_model')->getJp($id);
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');

        $this->view('pengaturan/e_jpform', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if ($this->model('Jp_model')->updateJp($_POST)) {
            Flash::setFlash('Mengedit Jenis Pengeluaran', 'Berhasil!', 'success');
            header('Location:' . BASEURL . '/jenispengeluaran');
            exit;
        }
    }
}
