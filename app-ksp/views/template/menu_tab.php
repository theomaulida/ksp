
<div class="widget-head hidden-print">
	<ul>
		<li class="<?php if ($this->uri->segment(3)=='') echo 'active';?>"><a href="<?php echo site_url('main/'.$hal.'/')?>" >Data <?php echo $hal?></a></li>
		<li class="<?php if ($this->uri->segment(3)=='add') echo 'active';?>"><a href="<?php echo site_url('main/'.$hal.'/add')?>" >Tambah <?php echo $hal?></a></li>
	<?php if($hal!='nasabah'){
		if($hal=='pinjaman'){?>
		<li class="<?php if ($this->uri->segment(3)=='bayar') echo 'active';?>"><a href="<?php echo site_url('main/'.$hal.'/bayar')?>" >Bayar <?php echo $hal?></a></li>
		<?php }else{ ?>
		<li class="<?php if ($this->uri->segment(3)=='ambil') echo 'active';?>"><a href="<?php echo site_url('main/'.$hal.'/ambil')?>" >Ambil <?php echo $hal?></a></li>
	<?php } ?>
		<li class="<?php if ($this->uri->segment(3)=='laporan') echo 'active';?>"><a href="<?php echo site_url('main/'.$hal.'/laporan')?>" >Laporan <?php echo $hal?></a></li>
	<?php } ?>
	</ul>
</div>