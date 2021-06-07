<?php

class Harga_model
{
    private $db;
    private $stmt;

    public function __construct()
    {
        $this->db = new mysqli(URL, USER_DB, PASS_DB, NAMA_DB);
    }

    public function getHarga()
    {
        $this->stmt = $this->db->prepare('SELECT * FROM harga');
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        $rows = $data->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function tambah($data)
    {
        $tarif = $data['tarif'];
        $ket = $data['ket'];
        $this->stmt = $this->db->prepare(" INSERT INTO harga (id_harga,tarif,ket) VALUES ('',?,?) ");
        $this->stmt->bind_param('is', $tarif, $ket);
        return $this->stmt->execute();
    }

    public function hapus($id)
    {
        $this->stmt = $this->db->prepare("DELETE FROM harga WHERE id_harga ='$id'");
        $berhasil = $this->stmt->execute();
        return $berhasil;
    }

    public function getById($id)
    {
        $this->stmt = $this->db->prepare("SELECT * FROM harga WHERE id_harga ='$id' ");
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        return $data->fetch_assoc();
    }

    public function edit($data)
    {
        $tarif = $data['tarif'];
        $id = $data['id'];
        $ket = $data['ket'];

        $this->stmt = $this->db->prepare(" UPDATE harga SET tarif = '$tarif', ket = '$ket' WHERE id_harga = '$id' ");

        return $this->stmt->execute();
    }



    //HARGA TAMBAHAN
    public function getHargaTambahan()
    {
        $this->stmt = $this->db->prepare('SELECT * FROM harga_tambahan');
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        $rows = $data->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function tambah_ht($data)
    {
        $tarif = $data['tarif'];
        $ket = $data['ket'];
        $this->stmt = $this->db->prepare(" INSERT INTO harga_tambahan (id_ht,tarif_ht,ket_ht) VALUES ('',?,?) ");
        $this->stmt->bind_param('is', $tarif, $ket);
        return $this->stmt->execute();
    }


    public function hapus_ht($id)
    {
        $this->stmt = $this->db->prepare("DELETE FROM harga_tambahan WHERE id_ht ='$id'");
        $berhasil = $this->stmt->execute();
        return $berhasil;
    }

    public function getById_ht($id)
    {
        $this->stmt = $this->db->prepare("SELECT * FROM harga_tambahan WHERE id_ht ='$id' ");
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        return $data->fetch_assoc();
    }

    public function edit_ht($data)
    {
        $tarif = $data['tarif'];
        $id = $data['id'];
        $ket = $data['ket'];

        $this->stmt = $this->db->prepare(" UPDATE harga_tambahan SET tarif_ht = '$tarif', ket_ht = '$ket' WHERE id_ht = '$id' ");

        return $this->stmt->execute();
    }
}
