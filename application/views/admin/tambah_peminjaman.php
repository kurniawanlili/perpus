<div class="page-header">
	<h3>Tambah Transaksi</h3>
</div>
<form action="<?php echo base_url().'admin/tambah_peminjaman_act' ?>"method="post">

	<div class="form-group">
		<label>Anggota</label>
		<select name="anggota" class="form-control">
			<option value="">-Pilih Anggota-</option>
			<?php foreach($anggota as $a){ ?>
			<option value="<php echo $a->id_anggota; ?>"><?php echo $a->nama_anggota; ?></option>
			<?php } ?>
		</select>
		<?php echo form_error('anggota'); ?>
	</div>

	<div class="form-group">
		<label>Buku</label>
		<select name="buku" class="form-control">
			<option value="">-Pilih Buku-</option>
			<?php foreach($buku as $b){ ?>
			<option value="<php echo $b->buku; ?>"><?php echo $b->judul_buku; ?></option>
			<?php } ?>
		</select>
		<?php echo form_error('buku'); ?>
	</div>

	<div class="form-group">
		<label>Tanggal Pinjam</label>
		<input type="date" name="tgl_pinjam" class="form-control">
		<?php echo form_error('tgl_pinjam'); ?>
	</div>

	<div class="form-group">
		<label>Tanggal Kembali</label>
		<input type="date" name="tgl_kembali" class="form-control">
		<?php echo form_error('tgl_kembali'); ?>
	</div>

	<div class="form-group">
		<label>Harga Denda / hari</label>
		<input type="text" name="denda" class="form-control">
		<?php echo form_error('denda'); ?>
	</div>

	<div class="form-group">
		<input type="submit" value="Simpan" class="btn btn-primary btn-xn">
	</div>
</form>
