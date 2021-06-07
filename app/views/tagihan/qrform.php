<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Tambah Tagihan
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/tagihan">Tagihan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Tagihan</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Form Tambah Tagihan</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= BASEURL; ?>/tagihan/add" method="POST">
                            <div class="form-group">
                                <label for="id_pel"></label>
                                <input type="hidden" name="id_pel" id="id_pel" value="<?= $data['pelanggan']['id_pelanggan']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="pelanggan">Pelanggan</label>
                                <input type="text" name="pelanggan" class="form-control" value="<?= 'P' . substr(str_repeat(0, 3) . $data['pelanggan']['id_pelanggan'], -3) . ' | ' . $data['pelanggan']['nama']; ?>" id="pelanggan" readonly>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="bulan">Bulan</label>
                                    <select name="bulan" id="bulan" class="form-control selectbulan" style="width: 100%!important;">
                                        <option value=""></option>
                                        <?php foreach ($data['bulan'] as $bulan) : ?>
                                            <option <?php if (date('n') == $bulan['id_bulan']) echo 'selected' ?> value="<?= $bulan['id_bulan']; ?>"><?= $bulan['nama_bulan']; ?></option>
                                        <?php endforeach; ?>
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
                                    <input type="number" min="0" class="form-control" id="m_awal" name="m_awal" value="<?= $data['meter']['akhir']; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="m_akhir">Meter Akhir</label>
                                    <input type="number" min="0" class="form-control" id="m_akhir" name="m_akhir">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto" class="form-label w-100">Foto Meteran</label>
                                <input type="file" name="foto" id="foto">
                                <small class="form-text text-muted">Masukkan Bukti Foto Meteran</small>
                            </div>
                            <button type="submit" id="simpan" name="simpan" class="btn btn-outline-primary">Simpan</button>
                            <button type="submit" id="btn-bayar" name="btn-bayar" class="btn btn-outline-success">Bayar</button>
                            <a href="<?= BASEURL; ?>/tagihan" class="btn btn-outline-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>