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
						<li class="breadcrumb-item"><a href="<?= base_url('film'); ?>">Data Film</a></li>
						<li class="breadcrumb-item active">Tambah Film</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="card card-secondary">
						<div class="card-header">
							<h3 class="card-title">Form Tambah Film</h3>
						</div>
						<div class="card-body">
							<form action="<?= base_url('film/store'); ?>" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label>Judul Film</label>
									<input type="text" name="judul" class="form-control" value="<?php echo set_value('judul'); ?>">
									<span class="text-danger"><?php echo form_error('judul'); ?></span>
								</div>
								<div class="form-group">
									<label>Genre</label>
									<input type="text" name="genre" class="form-control" value="<?php echo set_value('genre'); ?>">
									<span class="text-danger"><?php echo form_error('genre'); ?></span>
								</div>
								<div class="form-group">
									<label>Durasi</label>
									<input type="number" name="durasi" class="form-control" value="<?php echo set_value('durasi'); ?>">
									<span class="text-danger"><?php echo form_error('durasi'); ?></span>
								</div>
								<div class="form-group">
									<label>Sinopsis</label>
									<textarea name="sinopsis" class="form-control" rows="7"><?php echo set_value('sinopsis'); ?></textarea>
									<span class="text-danger"><?php echo form_error('sinopsis'); ?></span>
								</div>
								<div class="form-group">
									<label>Gambar</label>
									<input type="file" name="gambar" class="form-control" accept=".png,.jpg,.jpeg">
								</div>

								<button type="submit" class="btn btn-success">Simpan</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>