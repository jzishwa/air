<?php

class Master_model
{
    private $db;
    private $stmt;

    public function __construct()
    {
        $this->db = new mysqli(URL, USER_DB, PASS_DB, NAMA_DB);
    }

    public function getprofile()
    {
        $this->stmt = $this->db->prepare('SELECT * FROM desa');
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        $rows = $data->fetch_assoc();
        return $rows;
    }

    public function edit($data)
    {
        $nama_pam = $data['nama_pam'];
        $alamat = $data['alamat'];

        $this->stmt = $this->db->prepare(" UPDATE desa SET nama_pam = '$nama_pam', alamat = '$alamat' WHERE id_desa = '1' ");
        $this->stmt->execute();
    }

    public function rekap()
    {
        $this->stmt = $this->db->prepare("SELECT * , CONCAT_WS('',pembayaran.tgl_bayar,pengeluaran.tgl) AS tgl_baru FROM rekap LEFT JOIN pengeluaran ON rekap.id_keluar = pengeluaran.id_keluar LEFT JOIN pembayaran ON rekap.id_pembayaran = pembayaran.id_pembayaran LEFT JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan LEFT JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan LEFT JOIN bulan ON bulan.id_bulan = tagihan.id_bulan ORDER BY STR_TO_DATE(tgl_baru,'%d-%m-%Y') ASC");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }

    public function filter($filter)
    {
        $bulan = substr(str_repeat(0, 2) . $filter['id_bulan'], -2);
        $thn = $filter['thn'];
        $this->stmt = $this->db->prepare(" SELECT CONCAT_WS('',pembayaran.tgl_bayar,pengeluaran.tgl) AS tgl_baru, pengeluaran.total, pengeluaran.catatan, pembayaran.uang_masuk, pelanggan.nama, pelanggan.id_pelanggan, bulan.kode, tagihan.tahun FROM rekap LEFT JOIN pengeluaran ON rekap.id_keluar = pengeluaran.id_keluar LEFT JOIN pembayaran ON rekap.id_pembayaran = pembayaran.id_pembayaran LEFT JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan LEFT JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan LEFT JOIN bulan ON bulan.id_bulan = tagihan.id_bulan HAVING MONTH(STR_TO_DATE(tgl_baru,'%d-%m-%Y %H:%i:%s')) = '$bulan' AND YEAR(STR_TO_DATE(tgl_baru,'%d-%m-%Y %H:%i:%s')) = '$thn' ORDER BY STR_TO_DATE(tgl_baru,'%d-%m-%Y %H:%i:%s') ASC ");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }


    //USER MODEL
    //ambil data user
    public function getAllUser()
    {
        $this->stmt = $this->db->prepare('SELECT * FROM user');
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        $rows = $data->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function getUserById($id)
    {
        $this->stmt = $this->db->prepare("SELECT * FROM user WHERE id_user = '$id' ");
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        $rows = $data->fetch_assoc();
        return $rows;
    }

    public function hapusUser($id)
    {
        $this->stmt = $this->db->prepare(" DELETE FROM user WHERE id_user = '$id' ");
        $berhasil = $this->stmt->execute();
        return $berhasil;
    }

    public function updatePass($id, $pass)
    {
        $pass = md5($pass);
        $this->stmt = $this->db->prepare(" UPDATE user SET pass = '$pass' WHERE id_user = '$id' ");
        $berhasil = $this->stmt->execute();
        return $berhasil;
    }
}
