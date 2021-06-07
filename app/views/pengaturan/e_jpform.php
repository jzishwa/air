<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Edit Jenis Pengeluaran
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/jenispengeluaran">Jenis Pengeluaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Jenis Pengeluaran</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Form Edit Jenis Pengeluaran</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= BASEURL; ?>/jenispengeluaran/update" method="POST">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $data['jp']['id']; ?>">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="namajp">Nama</label>
                                    <input type="text" value="<?= $data['jp']['nama']; ?>" class="form-control" id="namajp" name="namajp">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="kode">Kode</label>
                                    <input type="text" value="<?= $data['jp']['kode']; ?>" class="form-control" id="kode" name="kode">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ketjp">Deskripsi</label>
                                <textarea class="form-control" id="ketjp" name="ketjp" rows="3"><?= $data['jp']['keterangan']; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Edit</button>
                            <a class="btn btn-outline-danger" href="<?= BASEURL; ?>/jenispengeluaran">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>