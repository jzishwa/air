<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Edit Pengeluaran
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/pengeluaran">Pengeluaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Pengeluaran</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Form Edit Pengeluaran</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= BASEURL; ?>/pengeluaran/update" method="POST">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $data['keluar']['id']; ?>">
                            </div>
                            <div class="form-group">
                                <select name="jenis" id="jenis" class="form-control select2" data-toggle="select2">
                                    <option value=""></option>
                                    <?php foreach ($data['jp'] as $jp) : ?>
                                        <option <?php if ($data['keluar']['id_jp'] == $jp['id_jp']) echo 'selected'; ?> value="<?= $jp['id_jp']; ?>"><?= $jp['nama_jp']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="biaya">Biaya</label>
                                    <input type="text" class="form-control" id="biaya" name="biaya" value="<?= $data['keluar']['total']; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tgl">Tanggal</label>
                                    <input class="form-control" type="text" name="tgl" readonly value="<?php $data['keluar']['tgl'] = date('d-m-Y');
                                                                                                        echo $data['keluar']['tgl'];  ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <input type="text" class="form-control" id="catatan" name="catatan" value="<?= $data['keluar']['catatan']; ?>">
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Edit</button>
                            <a href="<?= BASEURL; ?>/pengeluaran" class="btn btn-outline-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>