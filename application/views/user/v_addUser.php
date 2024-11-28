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
						<li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Data User</a></li>
						<li class="breadcrumb-item active">Tambah User</li>
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
							<h3 class="card-title">Form Tambah User</h3>
						</div>
						<div class="card-body">
							<form action="<?= base_url('user/store'); ?>" method="post">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control" value="<?php echo set_value('username'); ?>">
									<span class="text-danger"><?php echo form_error('username'); ?></span>
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" value="<?php echo set_value('nama'); ?>">
									<span class="text-danger"><?php echo form_error('nama'); ?></span>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>">
									<span class="text-danger"><?php echo form_error('email'); ?></span>
								</div>
								<div class="form-group">
									<label>Tahun</label>
									<input type="number" name="tahun" class="form-control" value="<?php echo set_value('tahun'); ?>">
									<span class="text-danger"><?php echo form_error('tahun'); ?></span>
								</div>
								<div class="form-group">
									<label>Role</label>
									<select name="role" class="form-control">
										<option value="1" <?= (set_value('role') == 1) ? 'selected' : ''; ?>>Admin</option>
										<option value="2" <?= (set_value('role') == 2) ? 'selected' : ''; ?>>User</option>
									</select>
									<span class="text-danger"><?php echo form_error('tahun'); ?></span>
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