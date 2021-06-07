<?php
class Scan extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('scan/scan');
        $this->view('scan/script');
    }
}
