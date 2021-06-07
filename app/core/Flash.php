<?php

class Flash
{
    public static function setFlash($pesan, $tebal, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'tebal' => $tebal,
            'tipe' => $tipe
        ];
    }

    public static function  info()
    {
        if (isset($_SESSION['flash'])) {

            echo '
            <div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-outline-coloured alert-dismissible" role="alert">
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                <strong>' . $_SESSION['flash']['tebal'] . ' </strong>' . $_SESSION['flash']['pesan'] . ' 
            </div>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            unset($_SESSION['flash']);
        }
    }
}
