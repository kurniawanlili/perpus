<div class="page-header">
	<h3>transaksi selesai</h3>
</div>
<?php foreach($peminjaman as $p){ ?>
<form action="<?php echo base_url().'adamin/transaksi_selesai_act' ?>" method="post">
	<input type="hidden" name="id" value="<?php echo $p->id_pinjam ?>">
	<input type="hidden" name="buku" value="<?php echo $p->id_buku ?>">
	<input type="hidden" name="tgl_kembali" value="<?php echo $p->tgl_kembali ?>">
	<input type="hidden" name="denda" value="<?php echo $p->denda ?>">
		<label>anggota</label>
		<select class="form-control" name="anggota" disabled>
			<option value="">-pilih anggota-</option>
			<?php foreach($anggota as $k){ ?>
				<option <?php if($p->id_anggota == $k->id_anggota){echo "selected='selected'";} ?> value="<?php echo $k->id_anggota; ?>"><?php echo $k->nama_anggota; ?></option>
			<?php } ?>

		</select>
	</div>

	<div class="form-group">
		<label>buku</label>
		<select class="form-control" name="buku" disabled>
			<option value="">-pilih buku-</option>
			<?php foreach($buku as $m){ ?>
				<option <?php if($p->id_buku == $m->id_buku){echo "selected='selected'";} ?> value="<?php echo $m->id_buku; ?>"><?php echo $m->id_buku; ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="form-group">
		<label>tanggal pinjam</label>
		<input class="form-control" type="date" name="tgl_pinjam" value="<?php echo $p->tgl_pinjam ?>"disabled>
	</div>

	<div class="form-group">
		<label>tanggal kembali</label>
		<input class="form-control" type="date" name="tgl_kembali" value="<?php echo $p->tgl_kembali ?>"disabled>
	</div>

	<div class="form-group">
		<label>harga denda / hari</label>
		<input class="form-control" type="text" name="denda" value="<?php echo $p->denda ?>"disabled>
	</div>

	<div class="form-group">
		<label>tangal dikembalikan oleh anggota</label>
		<input class="form-control" type="date" name="tgl_pengembalian>
		<?php echo form_error('tgl_pengembalian'); ?>
	</div>
	<div class="form-group">
		<input type="submit" value="simpan" class="btn btnprimary btn-sm">
	</div>
</form>
<?php } ?>	 
