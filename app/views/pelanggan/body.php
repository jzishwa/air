<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Daftar Pelanggan
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Pelanggan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Pelanggan</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <?= Flash::info(); ?>
                        <h5 class="card-title float-left d-block">Daftar Pelanggan Air</h5>
                        <?php if ($_SESSION['level'] == 'Administrator') { ?>
                            <a class="btn btn-outline-primary float-right d-block mx-2" href="<?= BASEURL; ?>/pelanggan/tambah">Tambah</a>
                        <?php } ?>
                        <a class="btn btn-outline-warning float-right d-block mx-2" href="<?= BASEURL; ?>/pelanggan/qrall" target="_blank">QR Code</a>
                    </div>
                    <div class="card-body">

                        <table id="datatables-basic" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Hp</th>
                                    <th>Alamat</th>
                                    <th>Aktif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($data['pelanggan'] as $user) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $data['id_baru'][$i - 1]; ?></td>
                                        <td><?= $user['nik']; ?></td>
                                        <td><?= $user['nama']; ?></td>
                                        <td><?= $user['hp']; ?></td>
                                        <td><?= $user['alamat']; ?></td>
                                        <td>
                                            <?php if ($user['status'] == 1) echo '<i class="fas fa-check"></i>'; ?>
                                        </td>
                                        <td>
                                            <?php if ($_SESSION['level'] == 'Administrator') { ?>
                                                <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $i; ?>">Hapus</a>
                                                <a href="<?= BASEURL; ?>/pelanggan/edit/<?= $user['id_pelanggan'] ?>" class="btn btn-primary btn-sm">edit</a>
                                            <?php } ?>
                                            <a href="<?= BASEURL; ?>/pelanggan/cetakqr/<?= $user['id_pelanggan'] ?>" target="_blank" class="btn btn-warning btn-sm">QR code</a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="hapusModal<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pelanggan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin akan menghapus pelanggan <b><?= $user['nama']; ?></b></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= BASEURL; ?>/pelanggan/hapus/<?= $user['id_pelanggan'] ?>" class="btn btn-success">Iya</a>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</main>