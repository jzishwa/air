<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Laporan Tagihan
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Laporan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cetak Tagihan</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <?= Flash::info(); ?>
                        <h5 class="card-title float-left d-block">Filter Cetak Tagihan</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= BASEURL; ?>/laporan/cetaktagihan" method="POST">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_bulan">Pilih Bulan</label>
                                        <select name="id_bulan" id="id_bulan" class="form-control select2" style="width: 100%!important;">
                                            <option value="13">Semua</option>
                                            <?php foreach ($data['bulan'] as $bulan) : ?>
                                                <option value="<?= $bulan['id_bulan']; ?>"><?= $bulan['nama_bulan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="thn">Pilih Tahun</label>
                                        <select name="thn" id="thn" class="form-control select2" style="width: 100%!important;">
                                            <option value=""></option>
                                            <?php foreach ($data['tahun'] as $thn) : ?>
                                                <option value="<?= $thn['tahun']; ?>"><?= $thn['tahun']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-success" id="cetak" name="cetak">Export</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</main>