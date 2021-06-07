<?php

class Pengaturan extends Controller
{

    public function index()
    {
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('pengaturan/utama');
        $this->view('templates/footer');
    }
}
