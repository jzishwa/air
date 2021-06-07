<?php

class Pembayaran extends Controller
{
    public function index()
    {
        $data['full'] = $this->model('Pembayaran_model')->getAll();
        foreach ($data['full'] as $user) :
            $pembayaran = 'P' . substr(str_repeat(0, 3) . $user['id_pelanggan'], -3) . '-' . $user['nama'];
            $data['pembayaran'][] = $pembayaran;
        endforeach;
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('pembayaran/body', $data);
        $this->view('pembayaran/body_script');
    }

    public function tambah()
    {
        $data['full'] = $this->model('Tagihan_model')->getBelumLunas();
        foreach ($data['full'] as $user) :
            $pilhan = 'P' . substr(str_repeat(0, 3) . $user['id_pelanggan'], -3) . '-' . $user['nama'] . ' | ' . $user['nama_bulan'] . '-' . $user['tahun'];
            $total = $user['akhir'] - $user['awal'];
            $biaya = $user['tarif'] * $total;
            $biaya = number_format($biaya, 0, '', '.');
            $data['id_tagihan'][] = $user['id_tagihan'];
            $data['pilihan'][] = $pilhan;
            $data['total'][] = $total;
            $data['biaya'][] = $biaya;
        endforeach;
        $data['tambahan'] = $this->model('Tagihan_model')->getTambahan();
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('pembayaran/form', $data);
        $this->view('pembayaran/script');
    }

    public function getdata()
    {
        echo  json_encode($this->model('Tagihan_model')->getById($_POST['id']));
    }

    public function add()
    {
        if (isset($_POST['simpan'])) {
            if ($this->model('Pembayaran_model')->tambah($_POST) && $this->model('Tagihan_model')->lunas($_POST['id_tagihan'])) {
                Flash::setFlash('Menambahkan data Pembayaran', 'Berhasil! ', 'success');
                header('Location:' . BASEURL . '/pembayaran');
                exit;
            }
        } else if (isset($_POST['btn-bayar'])) {
            $id = $this->model('Pembayaran_model')->tambahLangsungBayar($_POST);
            $this->model('Tagihan_model')->lunas($_POST['id_tagihan']);
            header('Location:' . BASEURL . '/pembayaran/nota/' . $id);
            exit;
        }
    }

    //fungsi untuk menerima data dari tagihan yang langsung bayar
    public function fromtagihan($id_tagihan)
    {
        $data = $this->model('Tagihan_model')->getById($id_tagihan);
        $data['pelanggan'] = 'P' . substr(str_repeat(0, 3) . $data['id_pelanggan'], -3) . '-' . $data['nama'] . ' | ' . $data['nama_bulan'] . '-' . $data['tahun'];
        $harga_tambahan = $this->model('Harga_model')->getHargaTambahan();
        $data['tarif_ht'] = $harga_tambahan[0]['tarif_ht'];
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('pembayaran/form_tagihan', $data);
        $this->view('pembayaran/script');
    }

    public function nota($id)
    {
        $data['bayar'] = $this->model('Pembayaran_model')->getById($id);
        $data['profile'] = $this->model('Master_model')->getprofile();
        $data['tambah'] = $this->model('Tagihan_model')->getTambahan();
        $word_almt = str_word_count($data['profile']['alamat']);
        $pisah = explode(' ', trim($data['profile']['alamat']));
        $index = 0;
        for ($i = 0; $i < 3; $i++) {
            $data['alamat'][$i] = $pisah[$index] . ' ' . $pisah[$index + 1];
            $index = $index + 2;
        }
        $this->view('pembayaran/nota', $data);
    }

    public function preview($id)
    {
        $data['bayar'] = $this->model('Pembayaran_model')->getById($id);
        $data['profile'] = $this->model('Master_model')->getprofile();
        $data['tambah'] = $this->model('Tagihan_model')->getTambahan();
        $word_almt = str_word_count($data['profile']['alamat']);
        $pisah = explode(' ', trim($data['profile']['alamat']));
        $index = 0;
        for ($i = 0; $i < 3; $i++) {
            $data['alamat'][$i] = $pisah[$index] . ' ' . $pisah[$index + 1];
            $index = $index + 2;
        }
        //$this->view('pembayaran/pdf');
        $this->view('pembayaran/notabaru',$data);
    }
}
