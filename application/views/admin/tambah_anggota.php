<div class="page-haeder">
	<h3> Anggota Baru</h3>
</div>
<?php validation_errors('<p style="color:red;">','</p>');?>

<?php
	if($this->session->flashdata())
	{
		echo "<div class='alert alert-danger alert-massage'>";
		echo $this->session->flashdata('alert');
		echo "</div>";
	}
?>

<form action="<?php echo base_url().'admin/tambah_anggota_act'?>" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama_anggota" class="form-control">
		<?php echo form_error('nama_anggota');?>
	</div>

	<div class="form-group">
		<label>Jenis Kelamin</label>
		<input type="text" name="gender" class="form-control">
			<?php echo form_error('gender'); ?>
	</div>

	<div class="form-group">
		<label>No Telepon</label>
		<input type="text" name="no_telp" class="form-control">
			<?php echo form_error('no_telp'); ?>
	</div>

	<div class="form-group">
		<label>Alamat</label>
		<input type="text" name="alamat" class="form-control">
			<?php echo form_error('alamat'); ?>
	</div>

	<div class="form-group">
		<label>Email</label>
		<input type="text" name="email" class="form-control">
			<?php echo form_error('email'); ?>
	</div>

  <div class="form-group">
    <label>Password</label>
    <input class="form-control" type="password" name="password">
    <?php echo form_error('password');?>
  </div>

  <div class="form-group">
    <label>Konfirmasi Password</label>
    <input class="form-control" type="password" name="repassword">
    <?php echo form_error('repassword');?>
  </div>
	<div class="form_group">
		<input type="submit" value="Simpan" class="btn btn-primary">
	</div>
	</div>
	</div>
</form>
