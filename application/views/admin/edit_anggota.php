<div class="page-header">
	<h3>Edit Anggota</h3>
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

<?php foreach ($anggota as $a) { ?>
<form action="<?php echo base_url().'admin/update_anggota'?>" method="post" enctype="multipart/form-data">
	<div class="panel panel-default">
  <div class="panel-body">
	<div class="form-group">
		<label>Nama Anggota</label>
		<input type="hidden" name="id" value="<?php echo $a->id_anggota; ?>">
		<input class="form-control" type="text" name="nama_anggota" value="<?php echo $a->nama_anggota; ?>">
		<?php echo form_error('nama_anggota'); ?>
	</div>

	<div class="form-group">
		<label>Jenis Kelamin</label>
		<input class="form-control" type="text" name="gender" value="<?php echo $a->gender; ?>">
		<?php echo form_error('gender'); ?>
	</div>

	<div class="form-group">
		<label>No Telepon</label>
		<input class="form-control" type="text" name="no_telp" value="<?php echo $a->no_telp; ?>">
		<?php echo form_error('no_telp'); ?>
	</div>

	<div class="form-group">
		<label>Alamat</label>
		<input class="form-control" type="text" name="alamat" value="<?php echo $a->alamat; ?>">
		<?php echo form_error('alamat'); ?>
	</div>

	<div class="form-group">
		<label>Email</label>
		<input class="form-control" type="text" name="email" value="<?php echo $a->email; ?>">
		<?php echo form_error('email'); ?>
	</div>

	<div class="form_group">
	<input type="submit" value="Update" class="btn btn-primary">
</div>
</div>
</div>
</form>
<?php } ?>
