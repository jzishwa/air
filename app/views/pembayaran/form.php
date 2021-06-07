<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Tambah pembayaran
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/pembayaran">pembayaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Pembayaran</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Form Tambah Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= BASEURL; ?>/pembayaran/add" method="POST">
                            <div class="form-group">
                                <label for="id_tagihan">Pilih Pembayaran</label>
                                <select name="id_tagihan" id="id_tagihan" class="form-control select2" style="width: 100%!important;">
                                    <option value=""></option>
                                    <?php for ($i = 0; $i < sizeof($data['pilihan']); $i++) { ?>
                                        <option value="<?= $data['id_tagihan'][$i]; ?>" data-id="<?= $data['id_tagihan'][$i]; ?>"><?= $data['pilihan'][$i]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="pakai">Jumlah Pemakaian</label>
                                    <input type="number" min="0" class="form-control" id="pakai" name="pakai" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="total">Biaya Tambahan</label>
                                    <input type="number" min="0" class="form-control" value="<?= $data['tambahan']['tarif_ht']; ?>" id="tambahan" name="tambahan" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="total">Total Biaya</label>
                                    <input type="number" min="0" class="form-control" id="total" name="total" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bayar">Uang Bayar</label>
                                <input type="number" name="bayar" id="bayar" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="kembali">Uang Kembali</label>
                                <input type="text" name="kembali" id="kembali" class="form-control" readonly>
                            </div>
                            <button type="submit" class="btn btn-outline-primary" id="simpan" name="simpan">Simpan</button>
                            <button type="submit" class="btn btn-outline-success" id="btn-bayar" name="btn-bayar">Cetak</button>
                            <a href="<?= BASEURL; ?>/pembayaran" class="btn btn-outline-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>