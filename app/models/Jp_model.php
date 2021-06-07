<?php
class Jp_model
{

    private $db;
    private $stmt;

    public function __construct()
    {
        $this->db = new mysqli(URL, USER_DB, PASS_DB, NAMA_DB);
    }

    public function getAll()
    {
        $this->stmt = $this->db->prepare("SELECT * FROM jenis_pengeluaran");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }

    public function tambahJp($data)
    {
        $this->stmt = $this->db->prepare("INSERT INTO jenis_pengeluaran (id_jp,nama_jp,kode,keterangan) VALUES ('',?,?,?)");
        $this->stmt->bind_param("sss", $nama, $kode, $keterangan);
        $nama = $data['namajp'];
        $kode = $data['kode'];
        $keterangan = $data['ketjp'];
        $berhasil = $this->stmt->execute();
        return $berhasil;
    }

    public function hapusJp($id)
    {
        $this->stmt = $this->db->prepare("DELETE FROM jenis_pengeluaran WHERE id_jp ='$id'");
        $berhasil = $this->stmt->execute();
        return $berhasil;
    }

    public function getJp($id)
    {
        $this->stmt = $this->db->prepare("SELECT * FROM jenis_pengeluaran WHERE id_jp ='$id'");
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        return $data->fetch_array(MYSQLI_ASSOC);
    }

    public function updateJp($data)
    {
        $nama = $data['namajp'];
        $kode = $data['kode'];
        $keterangan = $data['ketjp'];
        $id = $data['id'];
        $this->stmt = $this->db->prepare("UPDATE jenis_pengeluaran SET nama = '$nama', kode = '$kode', keterangan = '$keterangan' WHERE id_jp = '$id' ");
        return $this->stmt->execute();
    }
}
