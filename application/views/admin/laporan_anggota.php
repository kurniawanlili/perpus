<div class="page-header">
	<h3>Cetak Data Anggota</h3>
</div>
	<a class="btn btn-default btn-md" href="<?php echo base_url().'admin/laporan_print_anggota' ?>"><span class="glyphicon glyphicon-print"></span>Print</a>
		<a class="btn btn-default btn-md" href="<?php echo base_url().'admin/laporan_pdf_anggota' ?>"><span class="glyphicon glyphicon-print"></span>Cetak PDF</a>
		<br/><br>
	<div class="table-responsive">
		<table class="table table-border table-striped table-hower" id=*table-datatable>
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Anggota</th>
					<th>Gender</th>
					<th>Nomor Telepon</th>
					<th>Alamat</th>
					<th>E-Mail</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				foreach ($anggota as $a) {
				?>
				}
				<tr>
					<td><?php echo $no++;?></td>
					<td><?php echo $a->nama_anggota ?></td>
					<td><?php echo $a->gender ?></td>
					<td><?php echo $a->no_telp ?></td>
					<td><?php echo $a->alamat ?></td>
					<td><?php echo $a->email ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>