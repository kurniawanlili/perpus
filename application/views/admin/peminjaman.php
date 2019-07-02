<div class="page-header">
	<h3>Data Transaksi</h3>
</div>

<a href="<?php echo base_url().'admin/tambah_peminjaman';?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> Tambah Transaksi</a>
<br>
<br>

<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover" id="table-datatable">
		<thead>
			<tr>
				<th>No</th>
				<th>Anggota</th>
				<th>Buku</th>
				<th>Tgl. Pinjam</th>
				<th>Tgl. Kembali</th>
				<th>Denda/Hari</th>
				<th>Tgl. Dikembalikan</th>
				<th>Total Denda</th>
				<th>Status Buku</th>
				<th>Status Pinjam</th>
				<th>Pilihan</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$no = 1;
				foreach($peminjaman as $p){
			?>
			<tr>
				<td><?php echo $no++;?></td>
				<td><?php echo $p->id_anggota;?></td>
				<td><?php echo $p->id_buku;?></td>
				<td><?php echo date('d/m/Y',strtotime($p->tgl_pinjam));?></td>
				<td><?php echo date('d/m/Y',strtotime($p->tgl_kembali));?></td>
				<td><?php echo 'Rp. '.number_format($p->denda); ?></td>
				<td><?php if ($p->tgl_pengembalian =="0000-00-00"){
					echo "-";
			}else{
					echo date('d/m/Y',strtotime($p->tgl_pengembalian));
			}?></td>
				<td><?php echo 'Rp. '.number_format($p->total_denda)." ,-";?></td>
				<td><?php if($p->status_buku == "1"){
								echo "Selesai";
					}else if($p->status_buku == "0"){
								echo "-";
					}
					?></td>
				<td><?php if($p->status_peminjaman == "1"){
								echo "Selesai";
					}else if($p->status_peminjaman == "0"){
								echo "-";
					}
					?></td>
				<td nowrap="nowrap">
					<a class="btn btn-primary btn-xs" href="<?php echo base_url().'admin/edit_buku/'.$p->id_pinjam;?>"><span class="glyphicon glyphicon-zoom-in"></span></a>
					<a class="btn btn-warning btn-xs" href="<?php echo base_url().'admin/hapus_buku/'.$p->id_pinjam;?>"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
