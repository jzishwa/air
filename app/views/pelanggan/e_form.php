<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Edit Pelanggan
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/pelanggan">Pelanggan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Pelanggan</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Form Edit Pelanggan</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= BASEURL; ?>/pelanggan/update" method="POST">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $data['id']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="status" name="status" value="<?= $data['status']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $data['nik']; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="hp">HP</label>
                                    <input type="text" class="form-control" id="hp" name="hp" value="<?= $data['hp']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data['alamat']; ?>">
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>