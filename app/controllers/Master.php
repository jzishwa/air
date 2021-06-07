<?php

class Master extends Controller
{
    public function desa()
    {
        $data = $this->model('Master_model')->getprofile();
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('desa/body', $data);
        $this->view('templates/footer');
    }

    public function edit()
    {
        $this->model('Master_model')->edit($_POST);
        header('Location:' . BASEURL . '/master/desa');
        exit;
    }

    //user
    public function user()
    {
        $data = $this->model('Master_model')->getAllUser();
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('user/body', $data);
        $this->view('user/user_script');
    }

    public function getedituser()
    {
        echo json_encode($this->model('Master_model')->getUserById($_POST['id']));
    }

    public function hapususer($id)
    {
        if ($this->model('Master_model')->hapusUser($id)) {
            header('Location:' . BASEURL . '/master/user');
            exit;
        }
    }
}
