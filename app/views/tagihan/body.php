<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Daftar Tagihan
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Tagihan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Tagihan</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <?= Flash::info(); ?>
                        <h5 class="card-title float-left d-block">Daftar Tagihan Pelanggan</h5>
                        <a class="btn btn-outline-primary float-right d-block mx-2" href="<?= BASEURL; ?>/tagihan/tambah">Tambah</a>
                        <a class="btn btn-outline-warning float-right d-block mx-2" href="<?= BASEURL; ?>/scan">Scan Qrcode</a>
                    </div>
                    <div class="card-body">
                        <div id="cari" class="float-right">
                        </div>
                        <div id="status" class="float-right">
                        </div>
                        <table id="datatables-basic" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pelanggan</th>
                                    <th>Periode</th>
                                    <th>Mtr Lalu</th>
                                    <th>Mtr Now</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Iuran</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Bukti</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                    <th>Tgl</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($data['full'] as $tagihan) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $data['id_baru'][$i - 1] . '-' . $tagihan['nama']; ?></td>
                                        <td><?= $tagihan['nama_bulan'] . '-' . $tagihan['tahun']; ?></td>
                                        <td><?= $tagihan['awal']; ?></td>
                                        <td><?= $tagihan['akhir']; ?></td>
                                        <td><?= $data['total'][$i - 1]; ?></td>
                                        <td><?= $data['tarif'][$i - 1]; ?></td>
                                        <td><?= $data['tambahan']['tarif_ht']; ?></td>
                                        <td><?= $data['biaya'][$i - 1]; ?></td>
                                        <td>
                                            <?php if ($tagihan['status_bayar'] == 1) echo '<span class="badge badge-success">Lunas</span>';
                                            else echo '<span class="badge badge-danger">Belum Bayar</span>'; ?>
                                        </td>
                                        <td><?= $tagihan['status']; ?></td>
                                        <td>1</td>
                                        <td>
                                            <a href="" class="btn btn-danger btn-sm <?php if ($tagihan['status_bayar'] == 1) echo 'd-none'; ?>" data-toggle="modal" data-target="#hapusModal<?= $i; ?>">Hapus</a>
                                            <a href="<?= BASEURL; ?>/tagihan/edit/<?= $tagihan['id_tagihan']; ?>" class="btn btn-primary btn-sm">edit</a>
                                        </td>
                                        <td><?= $tagihan['tgl']; ?></td>
                                    </tr>
                                    <div class="modal fade" id="hapusModal<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Tagihan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php if ($tagihan['status_bayar'] == 1) { ?>
                                                        <P style="margin: 0;">Tagihan ini sudah <b>Lunas</b>. Pembayaran atas tagihan ini juga akan <b>dihapus</b>. Apakah Anda yakin akan menghapus Tagihan <b><?= $data['id_baru'][$i - 1] . '-' . $tagihan['nama'] . '|' . $tagihan['nama_bulan'] . '-' . $tagihan['tahun']; ?></P>
                                                    <?php } elseif ($tagihan['status_bayar'] == 0) { ?>
                                                        <p>Apakah Anda yakin akan menghapus Tagihan <b><?= $data['id_baru'][$i - 1] . '-' . $tagihan['nama'] . '|' . $tagihan['nama_bulan'] . '-' . $tagihan['tahun']; ?></b></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= BASEURL; ?>/tagihan/hapus/<?= $tagihan['id_tagihan'] ?>" class="btn btn-success">Iya</a>
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