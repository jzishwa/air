<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Edit Tagihan
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/tagihan">Tagihan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Tagihan</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Form Edit Tagihan</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= BASEURL; ?>/tagihan/update" method="POST">
                            <input type="hidden" name="status_byr" id="status_byr" value="<?= $data['status_bayar']; ?>">
                            <input type="hidden" name="id_tagihan" id="id_tagihan" value="<?= $data['id_tagihan']; ?>">
                            <div class="form-group">
                                <label for="id_pel">Pelanggan</label>
                                <select name="id_pel" id="id_pel" class="form-control" style="width: 100%!important;">
                                    <option value="<?= $data['id_pelanggan'] ?>" selected><?= 'P' . substr(str_repeat(0, 3) . $data['id_pelanggan'], -3) . ' | ' . $data['nama']; ?></option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="bulan">Bulan</label>
                                    <select name="bulan" id="bulan" class="form-control selectbulan" style="width: 100%!important;">
                                        <?php for ($i = 0; $i < sizeof($data['list_bulan']); $i++) { ?>
                                            <option value="<?= $data['list_bulan'][$i]['id_bulan']; ?>" <?php if ($data['list_bulan'][$i]['id_bulan'] == $data['id_bulan']) echo "selected"; ?>><?= $data['list_bulan'][$i]['nama_bulan']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="thn">Tahun</label>
                                    <input class="form-control" type="text" name="thn" value="<?= date('Y'); ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="m_awal">Meter Awal</label>
                                    <input type="number" min="0" class="form-control" id="m_awal" name="m_awal" value="<?= $data['awal']; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="m_akhir">Meter Akhir</label>
                                    <input type="number" min="0" class="form-control" id="m_akhir" name="m_akhir" value="<?= $data['akhir']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto" class="form-label w-100">Foto Meteran</label>
                                <input type="file" name="foto" id="foto">
                                <small class="form-text text-muted">Masukkan Bukti Foto Meteran</small>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="harga" id="harga">
                            </div>
                            <?php if ($data['status_bayar'] == 0) { ?>
                                <button type="submit" id="simpan" name="simpan" class="btn btn-outline-primary">Edit</button>
                            <?php } elseif ($data['status_bayar'] == 1) { ?>
                                <a href="" class="btn btn-outline-primary" data-toggle="modal" data-target="#editModal">Edit</a>
                            <?php } ?>
                            <!-- <button type="submit" id="btn-bayar" name="btn-bayar" class="btn btn-outline-success">Bayar</button> -->
                            <a href="<?= BASEURL; ?>/tagihan" class="btn btn-outline-danger">Batal</a>
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Tagihan ini <b>Sudah Lunas</b>. Jika melanjutkan <b>edit</b>, Pembayaran atas tagihan ini akan <b>dihapus</b></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="simpan" name="simpan" class="btn btn-primary">Edit</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>