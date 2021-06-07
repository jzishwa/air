<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Profile
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Pengaturan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengaturan Profile</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <?= Flash::info(); ?>
                        <h5 class="card-title float-left d-block">Pengaturan Profile</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="20%">Nama</th>
                                    <td><?= $data['nama']; ?></td>
                                </tr>
                                <tr>
                                    <th width="20%">Username</th>
                                    <td><?= $data['username']; ?></td>
                                </tr>
                                <tr>
                                    <th width="20%">Level</th>
                                    <td><?= $data['level']; ?></td>
                                </tr>
                                <tr>
                                    <th width="20%">Password</th>
                                    <td>******* <button class="tombolUbah btn btn-sm btn-outline-primary" data-target="#modal" data-toggle="modal" data-id="<?= $data['id_user'] ?>">Ubah Password</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Ubah Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= BASEURL; ?>/pengguna/editpassword" method="POST">
                                <input type="hidden" id="pass" name="id" value="<?= $_SESSION['id_user']; ?>">
                                <div class="form-group">
                                    <label for="pass_lama">Password Lama</label>
                                    <input class="form-control" type="password" id="pass_lama" name="pass_lama" required>
                                    <small id="valid_lama" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="pass_new">Password Baru</label>
                                    <input class="form-control" type="password" id="pass_new" name="pass_new" required>
                                    <small id="valid_baru" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="pass_valid">Konfirmasi Password</label>
                                    <input class="form-control" type="password" id="pass_valid" name="pass_valid" required>
                                    <small id="valid_konfirmasi" class="form-text text-danger"></small>
                                </div>
                                <button type="button" class="btn btn-secondary float-right mx-1" data-dismiss="modal">Batal</button>
                                <button type="submit" id="tombolUbah" class="btn btn-primary float-right mx-1">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</main>