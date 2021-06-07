<?php
class Pelanggan extends Controller
{


    public function index()
    {

        $data['pelanggan'] = $this->model('Pelanggan_model')->getAllPelanggan();
        foreach ($data['pelanggan'] as $row) :
            $data['id_baru'][] = 'P' . substr(str_repeat(0, 3) . $row['id_pelanggan'], -3);
        endforeach;
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');

        $this->view('pelanggan/body', $data);
        $this->view('pelanggan/script');
    }

    public function tambah()
    {
        $data['harga'] = $this->model('Pelanggan_model')->getHarga();
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');

        $this->view('pelanggan/form', $data);
        $this->view('pelanggan/script');
    }

    public function add()
    {
        if ($this->model('Pelanggan_model')->tambahPelanggan($_POST)) {
            Flash::setFlash('Menambahkan data Pelanggan', 'Berhasil!', 'success');
            header('Location:' . BASEURL . '/pelanggan');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('Pelanggan_model')->hapusPelanggan($id)) {
            Flash::setFlash('Menghapus data Pelanggan', 'Berhasil!', 'success');
            header('Location:' . BASEURL . '/pelanggan');
            exit;
        }
    }

    public function edit($id)
    {
        $data = $this->model('Pelanggan_model')->getPelanggan($id);

        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');

        $this->view('pelanggan/e_form', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if ($this->model('Pelanggan_model')->updatePelanggan($_POST)) {
            Flash::setFlash('Mengedit data Pelanggan', 'Berhasil!', 'success');
            header('Location:' . BASEURL . '/pelanggan');
            exit;
        }
    }

    public function cetakqr($id)
    {
        $tempdir = "public/img/qr/";
        $nama = 'one.png';
        $data = $this->model('Pelanggan_model')->getPelanggan($id);
        QRCode::png($id, $tempdir . $nama, QR_ECLEVEL_H, 10, 0);

        $this->view('cetakqr/desainqr', $data);
    }

    public function qrall()
    {
        $data['pelanggan'] = $this->model('Pelanggan_model')->getAllPelanggan();
        $data['tempdir'] = "public/img/qr/";
        $data['file'] = "one.png";
        $data['bagi'] = floor(sizeof($data['pelanggan']) / 9);
        $this->view('cetakqr/qrall', $data);
    }
}
