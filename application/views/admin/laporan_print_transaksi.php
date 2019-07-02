<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/cscs">
		.table-data{
			width: 100%;
			border-collapse: collapse;
		}
		.table-data tr th,
		.table-data tr td{
			border:1px solid black;
			font-size: 10 pt;
		}
	</style>
	<h3>Laporan Data Anggota Perpustakaan Online</h3>
	<br/>
	<table class="table-data">
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
								echo "-";
					}
					?></td>
				</tr>
			<?php
			}?>
		</tbody>
	</table>
	<script type="text/javascript">
		window.print();
		</script>
	</body>
</html>