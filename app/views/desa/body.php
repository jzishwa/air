<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Profile PAM
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Master</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile PAM</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <?= Flash::info(); ?>
                        <h5 class="card-title float-left d-block">Pengaturan Master</h5>
                        <button class="btn btn-outline-primary float-right d-block" data-toggle="modal" data-target="#modal">Edit</button>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <?php if ($data == NULL) { ?>
                                <tbody>
                                    <tr>
                                        <th width="20%">Nama PAM</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Alamat</th>
                                        <td></td>
                                    </tr>
                                </tbody>
                            <?php } else { ?>
                                <tbody>
                                    <tr>
                                        <th width="20%">Nama PAM</th>
                                        <td><?= $data['nama_pam']; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Alamat</th>
                                        <td><?= $data['alamat']; ?></td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Edit Profile PAM</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= BASEURL; ?>/master/edit" method="POST">
                                <div class="form-group">
                                    <label for="nama_pam">Nama PAM</label>
                                    <input class="form-control" type="text" id="nama_pam" name="nama_pam" value="<?= $data['nama_pam']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat PAM</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= $data['alamat']; ?></textarea>
                                </div>
                                <button type="button" class="btn btn-secondary float-right mx-1" data-dismiss="modal">Batal</button>
                                <button type="submit" id="simpan" class="btn btn-primary float-right mx-1">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>