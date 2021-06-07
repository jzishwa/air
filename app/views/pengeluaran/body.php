<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Daftar Pengeluaran
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Transaksi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Pengeluaran</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <?= Flash::info(); ?>
                        <h5 class="card-title float-left d-block">Daftar Pengeluaran</h5>
                        <a class="btn btn-outline-primary float-right d-block mx-2" href="<?= BASEURL; ?>/pengeluaran/tambah">Tambah</a>
                    </div>
                    <div class="card-body">

                        <table id="datatables-basic" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengeluaran</th>
                                    <th>Total</th>
                                    <th>Catatan</th>
                                    <th>Petugas</th>
                                    <th>Tanggal</th>
                                    <?php if ($_SESSION['level'] == 'Administrator') { ?>
                                        <th>Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($data['keluar'] as $keluar) : $keluar['total'] = 'Rp. ' . number_format($keluar['total'], 2, ',', '.'); ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $keluar['nama_jp']; ?></td>
                                        <td><?= $keluar['total']; ?></td>
                                        <td><?= $keluar['catatan']; ?></td>
                                        <td><?= $keluar['nama']; ?></td>
                                        <td><?= $keluar['tgl']; ?></td>
                                        <?php if ($_SESSION['level'] == 'Administrator') { ?>
                                            <td><a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $i; ?>">Hapus</a>
                                                <a href="<?= BASEURL; ?>/pengeluaran/edit/<?= $keluar['id_keluar'] ?>" class="btn btn-primary btn-sm">edit</a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <div class="modal fade" id="hapusModal<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pengeluaran</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin akan menghapus <b><?= $keluar['catatan']; ?></b></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= BASEURL; ?>/pengeluaran/hapus/<?= $keluar['id_keluar'] ?>" class="btn btn-success">Iya</a>
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