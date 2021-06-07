<?php

class Tagihan_model
{
    private $db;
    private $stmt;

    public function __construct()
    {
        $this->db = new mysqli(URL, USER_DB, PASS_DB, NAMA_DB);
    }

    public function getAll()
    {
        $this->stmt = $this->db->prepare("SELECT * FROM tagihan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = tagihan.id_pelanggan LEFT JOIN harga ON pelanggan.id_harga = harga.id_harga LEFT JOIN bulan ON bulan.id_bulan = tagihan.id_bulan");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }

    public function getBelumLunas()
    {
        $this->stmt = $this->db->prepare("SELECT * FROM tagihan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = tagihan.id_pelanggan LEFT JOIN harga ON pelanggan.id_harga = harga.id_harga LEFT JOIN bulan ON bulan.id_bulan = tagihan.id_bulan WHERE tagihan.status_bayar = '0' ORDER BY tagihan.id_bulan ASC ");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $this->stmt = $this->db->prepare("SELECT * FROM tagihan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = tagihan.id_pelanggan LEFT JOIN harga ON pelanggan.id_harga = harga.id_harga LEFT JOIN bulan ON bulan.id_bulan = tagihan.id_bulan WHERE tagihan.id_tagihan = '$id' ");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_assoc();
    }

    public function bulan()
    {
        $this->stmt = $this->db->prepare("SELECT * FROM bulan ");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }

    public function tambah($data)
    {
        $this->stmt = $this->db->prepare("INSERT INTO tagihan (id_tagihan,id_pelanggan,id_bulan,tahun,awal,akhir,tarif_at,status_bayar,tgl,id_user) VALUES ('',?,?,?,?,?,?,'0',?,?)");
        $this->stmt->bind_param("iiiiiisi", $id_pelanggan, $bulan, $tahun, $awal, $akhir, $tarif, $tgl, $id_user);
        $id_pelanggan = $data['id_pel'];
        $bulan = $data['bulan'];
        $tahun = $data['thn'];
        $awal = $data['m_awal'];
        $akhir = $data['m_akhir'];
        $tarif = $data['harga'];
        $id_user = $_SESSION['id_user'];
        $tgl = date('d-m-Y H:i:s');
        $b = $this->stmt->execute();
        return $b;
    }

    public function tambahGetLastId($data)
    {
        $this->stmt = $this->db->prepare("INSERT INTO tagihan (id_tagihan,id_pelanggan,id_bulan,tahun,awal,akhir,tarif_at,status_bayar,tgl,id_user) VALUES ('',?,?,?,?,?,?,'0',?,?)");
        $this->stmt->bind_param("iiiiiisi", $id_pelanggan, $bulan, $tahun, $awal, $akhir, $tarif, $tgl, $id_user);
        $id_pelanggan = $data['id_pel'];
        $bulan = $data['bulan'];
        $tahun = $data['thn'];
        $awal = $data['m_awal'];
        $akhir = $data['m_akhir'];
        $tarif = $data['harga'];
        $id_user = $_SESSION['id_user'];
        $tgl = date('d-m-Y H:i:s');
        $this->stmt->execute();
        $id = $this->stmt->insert_id;
        return $id;
    }

    public function getMeter($id, $bulan)
    {
        $this->stmt = $this->db->prepare("SELECT akhir FROM tagihan WHERE id_pelanggan = '$id' AND id_bulan = '$bulan' ");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_assoc();
    }

    public function getBulanSudah($id)
    {
        $thn = date('Y');
        $this->stmt = $this->db->prepare("SELECT id_bulan FROM tagihan WHERE id_pelanggan = '$id' AND  tahun = '$thn'");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }


    public function lunas($id)
    {
        $this->stmt = $this->db->prepare(" UPDATE tagihan SET status_bayar = '1' WHERE id_tagihan = '$id' ");
        return $this->stmt->execute();
    }

    public function getTambahan()
    {
        $this->stmt = $this->db->prepare("SELECT tarif_ht FROM harga_tambahan");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_assoc();
    }

    public function getTahun()
    {
        $this->stmt = $this->db->prepare("SELECT tahun FROM tagihan GROUP BY tahun");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }

    public function filter($data)
    {
        $id_bln = $data['id_bulan'];
        $thn = $data['thn'];
        if ($id_bln == 13) {
            $this->stmt = $this->db->prepare("SELECT * FROM tagihan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = tagihan.id_pelanggan LEFT JOIN harga ON pelanggan.id_harga = harga.id_harga LEFT JOIN bulan ON bulan.id_bulan = tagihan.id_bulan WHERE tagihan.tahun = '$thn' AND tagihan.status_bayar = '0' ");
        } else {
            $this->stmt = $this->db->prepare("SELECT * FROM tagihan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = tagihan.id_pelanggan LEFT JOIN harga ON pelanggan.id_harga = harga.id_harga LEFT JOIN bulan ON bulan.id_bulan = tagihan.id_bulan WHERE tagihan.id_bulan = '$id_bln' AND tagihan.tahun = '$thn' AND tagihan.status_bayar = '0' ");
        }

        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }

    public function update($data)
    {
        $id_tagihan = $data['id_tagihan'];
        $id_bln = $data['bulan'];
        $thn = $data['thn'];
        $awal = $data['m_awal'];
        $akhir = $data['m_akhir'];
        $tgl = date('d-m-Y H:i:s');
        $this->stmt = $this->db->prepare("UPDATE tagihan SET id_bulan = '$id_bln', tahun = '$thn', awal ='$awal', akhir = '$akhir', status_bayar = '0', tgl = '$tgl' WHERE id_tagihan = '$id_tagihan'  ");
        return $this->stmt->execute();
    }

    public function hapus($id)
    {
        $this->stmt = $this->db->prepare(" DELETE FROM tagihan WHERE id_tagihan = '$id' ");
        $berhasil = $this->stmt->execute();
        return $berhasil;
    }
}
