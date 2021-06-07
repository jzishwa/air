<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Tambah Pelanggan
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/pelanggan">Pelanggan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Pelanggan</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Form Tambah Pelanggan</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= BASEURL; ?>/pelanggan/add" method="POST">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="hp">HP</label>
                                    <input type="text" class="form-control" id="hp" name="hp">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat">
                            </div>
                            <div class="form-group">
                                <label for="id_tagihan">Jenis Tarif</label>
                                <select name="id_harga" id="id_harga" class="form-control select2" style="width: 100%!important;">
                                    <option value=""></option>
                                    <?php foreach ($data['harga'] as $harga) : ?>
                                        <option value="<?= $harga['id_harga']; ?>"><?= $harga['ket'] . ' - ' . $harga['tarif']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Tambah</button>
                            <a href="<?= BASEURL; ?>/pelanggan" class="btn btn-outline-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>