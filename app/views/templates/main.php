<main class="content">
	<div class="container-fluid">

		<div class="header">
			<h1 class="header-title">
				Dashboards PAM <?= $data['pam']['nama_pam']; ?>
			</h1>
			<p class="header-subtitle"><?= $data['pam']['alamat']; ?></p>
		</div>

		<div class="row">
			<div class="col-md-6 col-lg-3 col-xl">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Pendapatan</h5>
							</div>

							<div class="col-auto">
								<div class="avatar">
									<div class="avatar-title rounded-circle bg-primary-dark">
										<i class="align-middle" data-feather="dollar-sign"></i>
									</div>
								</div>
							</div>
						</div>
						<h1 class="display-5 mt-1 mb-3"><?= 'Rp. ' . number_format($data['pendapatan']['income'], 0, ',', '.'); ?></h1>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 col-xl">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Pengeluaran</h5>
							</div>

							<div class="col-auto">
								<div class="avatar">
									<div class="avatar-title rounded-circle bg-primary-dark">
										<i class="align-middle" data-feather="shopping-cart"></i>
									</div>
								</div>
							</div>
						</div>
						<h1 class="display-5 mt-1 mb-3"><?= 'Rp. ' . number_format($data['keluar']['jml'], 0, ',', '.'); ?></h1>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 col-xl">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Saldo</h5>
							</div>

							<div class="col-auto">
								<div class="avatar">
									<div class="avatar-title rounded-circle bg-primary-dark">
										<i class="align-middle" data-feather="activity"></i>
									</div>
								</div>
							</div>
						</div>
						<h1 class="display-5 mt-1 mb-3"><?= 'Rp. ' . number_format($data['pendapatan']['income'] - $data['keluar']['jml'], 0, ',', '.'); ?></h1>
					</div>
				</div>
			</div>
		</div>



	</div>
</main>