<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Daftar Harga
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Pengaturan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Harga</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <?= Flash::info(); ?>
                        <h5 class="card-title float-left d-block">Daftar Tarif Harga</h5>
                        <?php if ($_SESSION['level'] == 'Administrator') { ?>
                            <button class="tombolTambah btn btn-outline-primary float-right d-block mx-2" data-target="#modal" data-toggle="modal">Tambah</button>
                        <?php } ?>
                    </div>
                    <div class="card-body">

                        <table id="datatables-basic" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tarif</th>
                                    <th>Keterangan</th>
                                    <?php if ($_SESSION['level'] == 'Administrator') { ?>
                                        <th>Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($data['harga'] as $harga) : $harga['tarif'] = 'Rp. ' . number_format($harga['tarif'], 2, ',', '.'); ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $harga['tarif']; ?></td>
                                        <td><?= $harga['ket']; ?></td>
                                        <?php if ($_SESSION['level'] == 'Administrator') { ?>
                                            <td><a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $i; ?>">Hapus</a>
                                                <button class=" tombolEdit btn btn-primary btn-sm" data-target="#modal" data-toggle="modal" data-id="<?= $harga['id_harga']; ?>">edit</button>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <div class="modal fade" id="hapusModal<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Harga</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin akan menghapus <b><?= $harga['ket']; ?></b></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= BASEURL; ?>/harga/hapus/<?= $harga['id_harga'] ?>" class="btn btn-success">Iya</a>
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

            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Tambah Jenis Harga</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= BASEURL; ?>/harga/tambah" method="POST">
                                <input type="hidden" id="id" name="id">
                                <div class="form-group">
                                    <label for="tarif">Tarif</label>
                                    <input class="form-control" type="number" id="tarif" name="tarif">
                                </div>
                                <div class="form-group">
                                    <label for="ket">Keterangan</label>
                                    <input class="form-control" type="text" id="ket" name="ket">
                                </div>
                                <button type="button" class="btn btn-secondary float-right mx-1" data-dismiss="modal">Batal</button>
                                <button type="submit" id="simpan" class="btn btn-primary float-right mx-1">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>