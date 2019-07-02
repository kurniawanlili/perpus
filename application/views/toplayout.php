<nav class="navbar navbar-default">
<div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<?=anchor('member', 'Perpustakaan', ['class'=>'navbar-brand'])?>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	<ul class="nav navbar-nav navbar-right">
<li><?php echo anchor('member', 'Home');?></li>
<li>
<?php
	$text_cart_url = '<span class="glyphicon glyphicon-shopping-cart" ariahidden="true"></span>';
	$text_cart_url .= ' Booking Cart: '. $this->M_perpus->edit_data(array('id_anggota'=>$this->session->userdata('id_agt')),'transaksi')->num_rows() .' Buku';
		?>
		<?=anchor('peminjaman/lihat_keranjang', $text_cart_url)?>
</li>
	<?php if($this->session->userdata('id_agt')) { ?>
		<li><div style="line-height:50px;">Hai <b><?=$this->session->userdata('nama_agt')?></b></div></li>
		<li><?php echo anchor('admin/logout', 'Logout');?></li>
	<?php } else { ?>
		<li><?php echo anchor('welcome', 'Login');?></li>
	<?php } ?>
</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>