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
						<li class="breadcrumb-item active">Data Film</li>
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
					<a href="<?= base_url('film/add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Film</a>
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
							<h3 class="card-title">Data Film</h3>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Judul Film</th>
											<th>Genre</th>
											<th>Durasi</th>
											<th>Sinopsis</th>
											<th>Gambar</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($film as $i => $fil) : ?>
											<tr>
												<td><?php echo $i + 1; ?></td>
												<td><?php echo $fil->judul; ?></td>
												<td><?php echo $fil->genre; ?></td>
												<td><?php echo $fil->durasi . ' Menit'; ?></td>
												<td><?php echo nl2br(htmlspecialchars($fil->sinopsis)); ?></td>
												<td class="text-center">
													<?php if ($fil->gambar != NULL) : ?>
														<a href="<?= base_url('upload/gambar/' . $fil->gambar); ?>" target="gambar">
															<img src="<?= base_url('upload/gambar/' . $fil->gambar); ?>" class="img-thumbnail" width="150">
														</a>
													<?php endif; ?>
												</td>
												<td>
													<div class="btn-group">
														<a href="<?= base_url('film/edit/' . $fil->id); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
														<a href="<?= base_url('film/delete/' . $fil->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin data akan dihapus ?')"><i class="fa fa-trash"></i></a>
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