<div class="page-haeder">
	<h3> Buku Baru</h3>
</div>
<?= validation_errors('<p style="color:red;">','</p>');?>
<?php
if($this->session->flashdata())
	{
		echo "<div class='alert alert-danger alert-message'>";
		echo $this->session->flashdata('alert');
		echo "</div>";
	}
?>
<form action="<?php echo base_url().'admin/tambah_buku_act'?>" method="post" enctype="multipart/form-data">
	<div class="panel panel-default">
	<div class="panel-body">
	<div class="form-group">
		<label>Kategori</label>
		<select name="id_kategori" class="form-control" >
			<option value="">-Pilih Kategori-</option>
			<?php foreach($kategori as $k){ ?>
			<option value="<?php echo $k->id_kategori;?>"><?php echo $k->nama_kategori;?></option>
			<?php }?>
		</select>
		<?php echo form_error('id_kategori');?>
	</div>

	<div class="form-group">
		<label>Judul Buku</label>
		<input type="text" name="judul_buku" class="form-control">
		<?php echo form_error('judul_buku');?>
	</div>

	<div class="form-group">
		<label>Pengarang</label>
		<input type="text" name="pengarang" class="form-control">
			<?php echo form_error('pengarang'); ?>
	</div>

	<div class="form-group">
		<label>Penerbit</label>
		<input type="text" name="penerbit" class="form-control">
			<?php echo form_error('penerbit'); ?>
	</div>

	<div class="form-group">
		<label>Tahun Terbit</label>
		<input type="text" name="thn_terbit" class="form-control">
			<?php echo form_error('thn_terbit'); ?>
	</div>

	<div class="form-group">
		<label>ISBN</label>
		<input type="text" name="isbn" class="form-control">
			<?php echo form_error('isbn'); ?>
	</div>

	<div class="form-group">
		<label>Jumlah Buku</label>
		<input type="text" name="jumlah_buku" class="form-control">
			<?php echo form_error('jumlah_buku'); ?>
	</div>

	<div class="form-group">
		<label>Lokasi</label>
		<select name="lokasi" class="form-control">
		<option value=""></option>
		<option value="Rak 1">Rak 1</option>
		<option value="Rak 2">Rak 2</option>
		<option value="Rak 3">Rak 3</option>
	</select>
	<?php echo form_error('lokasi'); ?>
	</div>

	<div class="form-group">
		<label>Status Buku</label>
		<select name="status_buku" class="form-control">
				<option value=""></option>
			<option value="1">Tersedia</option>
			<option value="0">Sedang dipinjam</option>
		</select>
		<?php echo form_error('status_buku');?>
	</div>

	<div class="form-group">
		<label>Gambar</label>
		<input name="gambar	" type="file" class="form-control">
			<?php echo form_error('gambar'); ?>
	</div>

	<div class="form_group">
		<input type="submit" value="Simpan" class="btn btn-primary btn-block">
	</div>
	</div>
	</div>
</form>
