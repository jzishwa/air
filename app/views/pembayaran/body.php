<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Daftar Pembayaran
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Pembayaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Pembayaran</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <?= Flash::info(); ?>
                        <h5 class="card-title float-left d-block">Daftar Pembayaran Pelanggan</h5>
                        <a class="btn btn-outline-primary float-right d-block mx-2" href="<?= BASEURL; ?>/pembayaran/tambah">Tambah</a>
                    </div>
                    <div class="card-body">
                        <div id="cari" class="float-right">
                        </div>
                        <table id="datatables-basic" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pembayaran</th>
                                    <th>Periode</th>
                                    <th>Pemakaian</th>
                                    <th>Total Tagihan</th>
                                    <th>Uang Bayar</th>
                                    <th>Kembalian</th>
                                    <th>Tgl Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($data['full'] as $bayar) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $data['pembayaran'][$i - 1]; ?></td>
                                        <td><?= $bayar['nama_bulan'] . '-' . $bayar['tahun']; ?></td>
                                        <td><?= $bayar['tagihan'] . ' m<sup>3</sup>'; ?></td>
                                        <td><?= $bayar['uang_masuk']; ?></td>
                                        <td><?= $bayar['uang_bayar']; ?></td>
                                        <td><?= $bayar['uang_kembali']; ?></td>
                                        <td><?= $bayar['tgl_bayar']; ?></td>
                                        <td>
                                            <a href="<?= BASEURL; ?>/pembayaran/preview/<?= $bayar['id_pembayaran'] ?>" target="_blank" class="btn btn-primary btn-sm">cetak</a>
                                        </td>
                                    </tr>
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