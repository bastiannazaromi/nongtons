<h1><?php echo $title; ?></h1>

<div class="row mb-3">
	<div class="col-lg-4">
		<a href="<?= base_url('buku/add'); ?>" class="btn btn-primary btn-sm">Tambah</a>
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
		<table id="myTable" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul</th>
					<th>Penerbit</th>
					<th>Penulis</th>
					<th>Tahun Terbit</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($buku as $i => $bk) : ?>
					<tr>
						<td><?php echo $i + 1; ?></td>
						<td><?php echo $bk->nama; ?></td>
						<td><?php echo $bk->username; ?></td>
						<td><?php echo $bk->email; ?></td>
						<td><?php echo $bk->tahun; ?></td>
						<td>
							<a href="<?= base_url('buku/edit/' . $bk->id); ?>" class="btn btn-warning btn-sm">Edit</a>
							<a href="<?= base_url('buku/delete/' . $bk->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin data akan dihapus ?')">Hapus</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>