<?php

class Pembayaran_model
{
    private $db;
    private $stmt;

    public function __construct()
    {
        $this->db = new mysqli(URL, USER_DB, PASS_DB, NAMA_DB);
    }

    public function getAll()
    {

        $this->stmt = $this->db->prepare(" SELECT * FROM pembayaran LEFT JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan LEFT JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan LEFT JOIN bulan ON bulan.id_bulan = tagihan.id_bulan ");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {

        $this->stmt = $this->db->prepare(" SELECT * FROM pembayaran LEFT JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan LEFT JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan LEFT JOIN bulan ON bulan.id_bulan = tagihan.id_bulan LEFT JOIN harga ON pelanggan.id_harga=harga.id_harga WHERE pembayaran.id_pembayaran = '$id' ");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_assoc();
    }

    public function tambah($data)
    {
        $this->stmt = $this->db->prepare(" INSERT INTO pembayaran (id_pembayaran,id_tagihan,tagihan,tgl_bayar,uang_bayar,uang_kembali,uang_masuk) VALUES ('',?,?,?,?,?,?) ");
        $this->stmt->bind_param('iisiii', $id_tagihan, $tagihan, $tgl_bayar, $uang_bayar, $uang_kembali, $uang_masuk);
        $id_tagihan = $data['id_tagihan'];
        $tagihan = $data['pakai'];
        $tgl_bayar = date('d-m-Y H:i:s');
        $uang_bayar = $data['bayar'];
        $uang_kembali = $data['kembali'];
        $uang_masuk = $data['total'];
        $this->stmt->execute();

        $last_id = $this->stmt->insert_id;
        $b = $this->bayarToRekap($last_id);
        return $b;
    }


    public function tambahLangsungBayar($data)
    {
        $this->stmt = $this->db->prepare(" INSERT INTO pembayaran (id_pembayaran,id_tagihan,tagihan,tgl_bayar,uang_bayar,uang_kembali,uang_masuk) VALUES ('',?,?,?,?,?,?) ");
        $this->stmt->bind_param('iisiii', $id_tagihan, $tagihan, $tgl_bayar, $uang_bayar, $uang_kembali, $uang_masuk);
        $id_tagihan = $data['id_tagihan'];
        $tagihan = $data['pakai'];
        $tgl_bayar = date('d-m-Y H:i:s');
        $uang_bayar = $data['bayar'];
        $uang_kembali = $data['kembali'];
        $uang_masuk = $data['total'];
        $this->stmt->execute();
        $b = $this->stmt->insert_id;

        $this->bayarToRekap($b);
        return $b;
    }

    public function thnBayar()
    {
        $this->stmt = $this->db->prepare(" SELECT MID(tgl_bayar,7,4) AS tahun FROM pembayaran GROUP BY MID(tgl_bayar,7,4) ");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }

    public function filter($data)
    {
        $thn = $data['thn'];
        $bln = $data['id_bulan'];

        $bln = substr(str_repeat(0, 2) . $bln, -2);
        if ($bln == 13) {
            $this->stmt = $this->db->prepare(" SELECT * FROM pembayaran LEFT JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan LEFT JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan LEFT JOIN bulan ON bulan.id_bulan = tagihan.id_bulan WHERE MID(pembayaran.tgl_bayar,7,4) = '$thn' ");
        } else {
            $this->stmt = $this->db->prepare(" SELECT * FROM pembayaran LEFT JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan LEFT JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan LEFT JOIN bulan ON bulan.id_bulan = tagihan.id_bulan WHERE MID(pembayaran.tgl_bayar,7,4) = '$thn' AND MID(pembayaran.tgl_bayar,4,2) = '$bln'");
        }

        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }

    public function getJumlah()
    {
        $this->stmt = $this->db->prepare(" SELECT SUM(uang_masuk) AS income FROM pembayaran ");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_assoc();
    }


    //masukkan data ke tabel rekap

    public function bayarToRekap($id_bayar)
    {
        $this->stmt = $this->db->prepare(" INSERT INTO rekap (id_rekap,id_pembayaran,id_keluar) VALUES ('',?,'0') ");
        $this->stmt->bind_param('i', $id_bayar);
        return $this->stmt->execute();
    }

    //menghapus pembayaran sebab tagihan yang diedit
    public function hapus($id_tagihan)
    {
        $this->stmt = $this->db->prepare("SELECT id_pembayaran FROM pembayaran WHERE id_tagihan = '$id_tagihan' ");
        $this->stmt->execute();
        $id = $this->stmt->get_result();
        $get = $id->fetch_assoc();

        $id_pembayaran = $get['id_pembayaran'];


        $this->stmt = $this->db->prepare("DELETE FROM rekap WHERE id_pembayaran = '$id_pembayaran' ");
        $this->stmt->execute();

        $this->stmt = $this->db->prepare("DELETE FROM pembayaran WHERE id_tagihan = '$id_tagihan' ");
        return $this->stmt->execute();
    }
}
