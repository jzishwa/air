<?php
class Tagihan extends Controller
{
    public function index()
    {
        $data['full'] = $this->model('Tagihan_model')->getAll();
        $data['tambahan'] = $this->model('Tagihan_model')->getTambahan();
        foreach ($data['full'] as $user) :
            $userId = 'P' . substr(str_repeat(0, 3) . $user['id_pelanggan'], -3);
            $tarif = number_format($user['tarif'], 0, '', '.');
            $total = $user['akhir'] - $user['awal'];
            $biaya = $user['tarif'] * $total;
            $biaya = $biaya + $data['tambahan']['tarif_ht'];
            $biaya = number_format($biaya, 0, '', '.');
            $data['id_baru'][] = $userId;
            $data['tarif'][] = $tarif;
            $data['total'][] = $total;
            $data['biaya'][] = $biaya;
        endforeach;
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('tagihan/body', $data);
        $this->view('tagihan/body_script');
    }

    public function tambah()
    {
        $data['pelanggan'] = $this->model('Pelanggan_model')->getAllPelanggan();
        $data['bulan'] = $this->model('Tagihan_model')->bulan();
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');

        $this->view('tagihan/form', $data);
        $this->view('tagihan/script');
    }

    public function add()
    {

        if (isset($_POST['simpan'])) {
            if ($this->model('Tagihan_model')->tambah($_POST)) {
                Flash::setFlash('Menambahkan data Tagihan', 'Berhasil!', 'success');
                header('Location:' . BASEURL . '/Tagihan');
                exit;
            }
        } elseif (isset($_POST['btn-bayar'])) {

            $id = $this->model('Tagihan_model')->tambahGetLastId($_POST);
            $bayar = new Pembayaran;
            $bayar->fromtagihan($id);
        }
    }


    public function edit($id)
    {
        $data = $this->model('Tagihan_model')->getById($id);
        $data['list_bulan'] = $this->model('Tagihan_model')->bulan();
        if ($data['status_bayar'] == 0) {
            $this->view('templates/header');
            $this->view('templates/sidebar');
            $this->view('templates/topbar');
            $this->view('tagihan/eform', $data);
            $this->view('tagihan/escript');
        } else if ($data['status_bayar'] == 1) {
            $this->view('templates/header');
            $this->view('templates/sidebar');
            $this->view('templates/topbar');
            $this->view('tagihan/eform', $data);
            $this->view('tagihan/escript');
        }
    }

    public function update()
    {
        $status = $_POST['status_byr'];
        if ($status == 0) {
            if ($this->model('Tagihan_model')->update($_POST)) {
                header('Location:' . BASEURL . '/tagihan');
                exit;
            }
        } elseif ($status == 1) {
            $this->model('Pembayaran_model')->hapus($_POST['id_tagihan']);
            if ($this->model('Tagihan_model')->update($_POST)) {
                header('Location:' . BASEURL . '/tagihan');
                exit;
            }
        }
    }

    public function qrtagihan($id)
    {
        $data['pelanggan'] = $this->model('Pelanggan_model')->getPelanggan($id);
        //$data['meter'] = $this->model('Tagihan_model')->getMeter($id);
        $data['bulan'] = $this->model('Tagihan_model')->bulan();
        $bulan = $this->model('Tagihan_model')->getBulanSudah($id);

        for ($j = 0; $j < sizeof($bulan); $j++) {
            $id_sama = $bulan[$j]['id_bulan'] - 1;
            unset($data['bulan'][$id_sama]);
        }

        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('tagihan/qrform', $data);
        $this->view('tagihan/script');
    }

    public function getmeterakhir()
    {
        $data['akhir'] = null;

        $prev_bulan = $_POST['bulan'] - 1;
        if ($this->model('Tagihan_model')->getMeter($_POST['id_pel'], $prev_bulan) == NULL) {
            echo json_encode($data);
        } else {
            echo json_encode($this->model('Tagihan_model')->getMeter($_POST['id_pel'], $prev_bulan));
        }
    }

    //dapatkan bulan yg belum
    public function getbulanpelanggan()
    {
        $data['bulan'] = $this->model('Tagihan_model')->bulan();
        $bulan = $this->model('Tagihan_model')->getBulanSudah($_POST['id_pel']);

        for ($j = 0; $j < sizeof($bulan); $j++) {
            $id_sama = $bulan[$j]['id_bulan'] - 1;
            unset($data['bulan'][$id_sama]);
        }

        $data['sudah'] = $bulan;

        echo json_encode($data);
    }

    public function qrbayar()
    {
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('pembayaran/qrform');
        $this->view('templates/footer');
    }

    //ajax untuk harga pelanggan

    public function gethargapelanggan()
    {
        echo json_encode($this->model('Pelanggan_model')->hargaByIdPelanggan($_POST['id_pel']));
    }

    //hapus tagihan khusus yang belum lunas
    public function hapus($id)
    {
        if ($this->model('Tagihan_model')->hapus($id)) {
            Flash::setFlash('Menghapus data Tagihan', 'Berhasil!', 'success');
            header('Location:' . BASEURL . '/tagihan');
            exit;
        }
    }
}
