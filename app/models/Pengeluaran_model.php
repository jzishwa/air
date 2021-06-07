<?php
class Pengeluaran_model
{

    private $db;
    private $stmt;

    public function __construct()
    {
        $this->db = new mysqli(URL, USER_DB, PASS_DB, NAMA_DB);
    }

    public function getAll()
    {
        $this->stmt = $this->db->prepare("SELECT * FROM pengeluaran LEFT JOIN jenis_pengeluaran ON pengeluaran.id_jp=jenis_pengeluaran.id_jp LEFT JOIN user ON user.id_user = pengeluaran.id_user ORDER BY STR_TO_DATE(pengeluaran.tgl,'%d-%m-%Y') ASC ");
        $this->stmt->execute();
        $a = $this->stmt->get_result();
        return $a->fetch_all(MYSQLI_ASSOC);
    }

    public function tambah($data)
    {
        $this->stmt = $this->db->prepare("INSERT INTO pengeluaran (id_keluar,id_jp,total,catatan,id_user,tgl) VALUES ('',?,?,?,?,?)");
        $this->stmt->bind_param("iisis", $id_jp, $total, $catatan, $id_petugas, $tgl);
        $id_jp = $data['jenis'];
        $total = $data['biaya'];
        $catatan = $data['catatan'];
        $id_petugas = $_SESSION['id_user'];
        $tgl = $data['tgl'];

        $this->stmt->execute();
        $last_id = $this->stmt->insert_id;

        $berhasil = $this->keluarToRekap($last_id);
        return $berhasil;
    }

    public function hapus($id)
    {
        $this->stmt = $this->db->prepare("DELETE FROM pengeluaran WHERE id_keluar ='$id'");
        $this->stmt->execute();

        $this->stmt = $this->db->prepare("DELETE FROM rekap WHERE id_keluar ='$id'");
        $berhasil = $this->stmt->execute();

        return $berhasil;
    }

    public function getById($id)
    {
        $this->stmt = $this->db->prepare("SELECT * FROM pengeluaran WHERE id_keluar ='$id'");
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        return $data->fetch_array(MYSQLI_ASSOC);
    }

    public function update($data)
    {
        $id_jp = $data['jenis'];
        $total = $data['biaya'];
        $catatan = $data['catatan'];
        $id = $data['id'];
        $tgl = $data['tgl'];
        $this->stmt = $this->db->prepare("UPDATE pengeluaran SET id_jp = '$id_jp', total = '$total', catatan = '$catatan', tgl='$tgl' WHERE id_keluar = '$id' ");
        return $this->stmt->execute();
    }

    public function getJumlah()
    {
        $this->stmt = $this->db->prepare(" SELECT SUM(total) AS jml FROM pengeluaran ");
        $this->stmt->execute();
        $data = $this->stmt->get_result();
        return $data->fetch_assoc();
    }

    public function keluarToRekap($id_keluar)
    {
        $this->stmt = $this->db->prepare(" INSERT INTO rekap (id_rekap,id_pembayaran,id_keluar) VALUES ('','0',?) ");
        $this->stmt->bind_param('i', $id_keluar);
        return $this->stmt->execute();
    }
}
