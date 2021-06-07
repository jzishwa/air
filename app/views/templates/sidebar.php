<body>
    <div class="splash active">
        <div class="splash-icon"></div>
    </div>

    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <a class="sidebar-brand" href="<?= BASEURL; ?>">
                <i class="fas fa-fw fa-hand-holding-water"></i>
                PAM AIR
            </a>
            <div class="sidebar-content">
                <div class="sidebar-user">
                    <img src="<?= BASEURL; ?>/public/img/avatars/avatar.jpg" class="img-fluid rounded-circle mb-2" alt="Linda Miller" />
                    <div class="font-weight-bold"><?= $_SESSION['nama']; ?></div>
                    <small><?= $_SESSION['level']; ?></small>
                </div>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Main
                    </li>
                    <?php if ($_SESSION['level'] == 'Administrator') { ?>
                        <li class="sidebar-item">
                            <a href="<?= BASEURL; ?>" class="sidebar-link">
                                <i class="align-middle mr-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboards</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="sidebar-item">
                        <a href="<?= BASEURL; ?>/pelanggan" class="sidebar-link">
                            <i class="align-middle mr-2 fas fa-fw fa-users"></i> <span class="align-middle">Pelanggan</span>
                        </a>
                    </li>
                    <?php if ($_SESSION['level'] == 'Administrator') { ?>
                        <li class="sidebar-item">
                            <a href="#auth" data-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle mr-2 fas fa-fw fa-file"></i> <span class="align-middle">Master</span>
                            </a>
                            <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                                <li class="sidebar-item"><a class="sidebar-link" href="<?= BASEURL; ?>/master/desa">Desa</a></li>
                            </ul>
                            <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                                <li class="sidebar-item"><a class="sidebar-link" href="<?= BASEURL; ?>/master/user">User</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['level'] == 'Administrator') { ?>
                        <li class="sidebar-item">
                            <a href="#ui" data-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle mr-2 fas fa-fw fa-users-cog"></i> <span class="align-middle">Pengaturan</span>
                            </a>
                            <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                                <li class="sidebar-item"><a class="sidebar-link" href="<?= BASEURL; ?>/harga">Harga</a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?= BASEURL; ?>/harga/tambahan">Harga Tambahan</a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?= BASEURL; ?>/jenispengeluaran">Jenis Pengeluaran</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <li class="sidebar-item">
                        <a href="#ui1" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle mr-2 fas fa-fw fa-file-invoice-dollar"></i> <span class="align-middle">Transaksi</span>
                        </a>
                        <ul id="ui1" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="<?= BASEURL; ?>/tagihan">Tagihan</a></li>
                            <?php if ($_SESSION['level'] == 'Administrator') { ?>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?= BASEURL; ?>/pengeluaran">Pengeluaran</a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?= BASEURL; ?>/pembayaran">Pembayaran</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php if ($_SESSION['level'] == 'Administrator') { ?>
                        <li class="sidebar-item">
                            <a href="#ui2" data-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle mr-2 fas fa-fw fa-file-invoice"></i> <span class="align-middle">Laporan</span>
                            </a>
                            <ul id="ui2" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                                <li class="sidebar-item"><a class="sidebar-link" href="<?= BASEURL; ?>/laporan/tagihan">Tagihan</a></li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?= BASEURL; ?>/laporan/pembukuan">Pembukuan</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </nav>