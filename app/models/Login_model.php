<?php
class Login_model
{

    private $db;
    private $stmt;

    public function __construct()
    {
        $this->db = new mysqli(URL, USER_DB, PASS_DB, NAMA_DB);
    }

    public function valid($data)
    {
        
        $pass = md5($data['password']);
        $password = $this->db->real_escape_string($pass);
        $user = $this->db->real_escape_string($data['username']);


        $this->stmt = $this->db->prepare("SELECT * FROM user WHERE username = '$user'  ");

        $this->stmt->execute();
        $a = $this->stmt->get_result();
        if ($a->num_rows > 0) {
            $cek = $a->fetch_assoc();
            if ($password == $cek['pass']) {
                $_SESSION['user'] = $user;
                $_SESSION['nama'] = $cek['nama'];
                $_SESSION['level'] = $cek['level'];
                $_SESSION['id_user'] = $cek['id_user'];
                if ($cek['level'] == 'Administrator') {
                    $_SESSION['login'] = true;
                    return 'admin';
                } else if ($cek['level'] == 'Operator') {
                    $_SESSION['login'] = true;
                    return 'operator';
                }
            }
            return 2; //password salah
        }
        return 3; //user tidak ada
    }
}
