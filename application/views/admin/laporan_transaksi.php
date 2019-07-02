<div class="page-header">
	<h3>Cetak Data Transaksi</h3>
</div>
	<a class="btn btn-default btn-md" href="<?php echo base_url().'admin/laporan_print_transaksi' ?>"><span class="glyphicon glyphicon-print"></span>Print</a>
		<a class="btn btn-default btn-md" href="<?php echo base_url().'admin/laporan_pdf_transaksi' ?>"><span class="glyphicon glyphicon-print"></span>Cetak PDF</a>
		<br/><br>
	<div class="table-responsive">
		<table class="table table-border table-striped table-hower" id=*table-datatable>
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
				<th>Status Pinjam</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$no = 1;
				foreach($transaksi as $t){
			?>
			<tr>
				<td><?php echo $no++;?></td>
				<td><?php echo $t->id_anggota;?></td>
				<td><?php echo $t->id_buku;?></td>
				<td><?php echo date('d/m/Y',strtotime($t->tgl_pinjam));?></td>
				<td><?php echo date('d/m/Y',strtotime($t->tgl_kembali));?></td>
				<td><?php echo 'Rp. '.number_format($t->denda); ?></td>
				<td><?php if ($t->tgl_pengembalian =="0000-00-00"){
					echo "-";
			}else{
					echo date('d/m/Y',strtotime($t->tgl_pengembalian));
			}?></td>
				<td><?php echo 'Rp. '.number_format($t->total_denda)." ,-";?></td>
				<td><?php if($t->status_peminjaman == "1"){
								echo "Selesai";
					}else if($t->status_peminjaman == "0"){
								echo "belum selesai";
					}
					?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>