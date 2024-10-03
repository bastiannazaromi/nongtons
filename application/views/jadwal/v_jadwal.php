<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?= $title; ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Data Jadwal Tayang</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row mb-3">
				<div class="col-lg-4">
					<a href="<?= base_url('jadwal/add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Jadwal</a>
				</div>
			</div>

			<?php if ($this->session->flashdata('sukses')) : ?>
				<div class="alert alert-success" role="alert">
					<?= $this->session->flashdata('sukses'); ?>
				</div>
			<?php endif; ?>

			<?php if ($this->session->flashdata('error')) : ?>
				<div class="alert alert-danger" role="alert">
					<?= $this->session->flashdata('error'); ?>
				</div>
			<?php endif; ?>

			<div class="row">
				<div class="col-xl-12">
					<div class="card card-secondary">
						<div class="card-header">
							<h3 class="card-title">Data Jadwal Tayang</h3>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Judul Film</th>
											<th>Genre</th>
											<th>Durasi Film</th>
											<th>Cinema</th>
											<th>Tanggal</th>
											<th>Jumlah Kursi</th>
											<th>Kursi Terjual</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($jadwal as $i => $jdw) : ?>
											<tr>
												<td><?php echo $i + 1; ?></td>
												<td><?php echo $jdw->judul; ?></td>
												<td><?php echo $jdw->genre; ?></td>
												<td><?php echo $jdw->durasi; ?></td>
												<td><?php echo $jdw->namaCinema; ?></td>
												<td><?php echo date('d M Y', strtotime($jdw->tanggal)) . ' - ' . date('H:i', strtotime($jdw->jamTayang)); ?></td>
												<td><?php echo $jdw->jumlahKursi; ?></td>
												<td><?php echo $jdw->kursiTerjual; ?></td>
												<td>
													<div class="btn-group">
														<a href="<?= base_url('jadwal/edit/' . $jdw->id); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
														<a href="<?= base_url('jadwal/delete/' . $jdw->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin data akan dihapus ?')"><i class="fa fa-trash"></i></a>
													</div>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>