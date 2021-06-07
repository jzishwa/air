<?php
class Pelanggan_model
{
    private $db;
    private $stmt;

    public function __construct()
    {
        $this->db = new mysqli(URL, USER_DB, PASS_DB, NAMA_DB);
    }

    public function getAllPelanggan()
    {
        $this->stmt = $this->db->prepare('SELECT * FROM pelanggan');
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        $rows = $data->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function tambahPelanggan($data)
    {
        $this->stmt = $this->db->prepare("INSERT INTO pelanggan (id_pelanggan,nik,nama,hp,alamat,id_harga,status) VALUES ('',?,?,?,?,?,'1')");
        $this->stmt->bind_param("ssssi", $nik, $nama, $hp, $alamat, $harga);
        $nik = $data['nik'];
        $nama = $data['nama'];
        $hp = $data['hp'];
        $alamat = $data['alamat'];
        $harga = $data['id_harga'];
        $berhasil = $this->stmt->execute();
        return $berhasil;
    }

    public function hapusPelanggan($id)
    {
        $this->stmt = $this->db->prepare("DELETE FROM pelanggan WHERE id_pelanggan ='$id'");
        $berhasil = $this->stmt->execute();
        return $berhasil;
    }

    public function getPelanggan($id)
    {
        $this->stmt = $this->db->prepare("SELECT * FROM pelanggan WHERE id_pelanggan ='$id'");
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        return $data->fetch_array(MYSQLI_ASSOC);
    }

    public function updatePelanggan($data)
    {
        $nik = $data['nik'];
        $id = $data['id'];
        $nama = $data['nama'];
        $hp = $data['hp'];
        $alamat = $data['alamat'];
        $status = $data['status'];
        $this->stmt = $this->db->prepare("UPDATE pelanggan SET nik = '$nik', nama = '$nama', hp = '$hp', alamat = '$alamat', status = '$status' WHERE id_pelanggan = '$id' ");
        return $this->stmt->execute();
    }

    public function getHarga()
    {
        $this->stmt = $this->db->prepare("SELECT * FROM harga");
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        return $data->fetch_all(MYSQLI_ASSOC);
    }

    //dapatkan harga dari pelanggan By Id
    public function hargaByIdPelanggan($id_pel)
    {
        $this->stmt = $this->db->prepare("SELECT harga.tarif FROM pelanggan LEFT JOIN harga ON pelanggan.id_harga = harga.id_harga WHERE pelanggan.id_pelanggan = '$id_pel' ");
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        return $data->fetch_assoc();
    }
}
