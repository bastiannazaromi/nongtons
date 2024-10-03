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
						<li class="breadcrumb-item"><a href="<?= base_url('cinema'); ?>">Data Cinema</a></li>
						<li class="breadcrumb-item active">Edit Cinema</li>
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
							<h3 class="card-title">Form Edit Cinema</h3>
						</div>
						<div class="card-body">
							<form action="<?= base_url('cinema/update'); ?>" method="post">
								<input type="hidden" name="id" value="<?php echo $cinema->id; ?>">
								<div class="form-group">
									<label>Nama Cinema</label>
									<input type="text" name="namaCinema" class="form-control" value="<?php echo $cinema->namaCinema; ?>">
									<span class="text-danger"><?php echo form_error('namaCinema'); ?></span>
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