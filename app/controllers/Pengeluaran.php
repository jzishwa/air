<?php
class Pengeluaran extends Controller
{
    public function index()
    {
        $data['keluar'] = $this->model('Pengeluaran_model')->getAll();
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');

        $this->view('pengeluaran/body', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $data['jp'] = $this->model('Jp_model')->getAll();
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');

        $this->view('pengeluaran/form', $data);
        $this->view('pengeluaran/script');
    }

    public function add()
    {
        if ($this->model('Pengeluaran_model')->tambah($_POST)) {
            Flash::setFlash('Menambahkan data Pengeluaran', 'Berhasil!', 'success');
            header('Location:' . BASEURL . '/pengeluaran');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('Pengeluaran_model')->hapus($id)) {
            Flash::setFlash('Menghapus data Pengeluaran', 'Berhasil!', 'success');
            header('Location:' . BASEURL . '/pengeluaran');
            exit;
        }
    }

    public function edit($id)
    {
        $data['keluar'] = $this->model('Pengeluaran_model')->getById($id);
        $data['jp'] = $this->model('Jp_model')->getAll();

        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');

        $this->view('Pengeluaran/e_form', $data);
        $this->view('pengeluaran/script');
    }

    public function update()
    {
        if ($this->model('Pengeluaran_model')->update($_POST)) {
            Flash::setFlash('Mengedit data Pengeluaran', 'Berhasil!', 'success');
            header('Location:' . BASEURL . '/pengeluaran');
            exit;
        }
    }
}
