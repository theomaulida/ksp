<div class="container-fluid fixed">
	<div id="content">
<div class="widget widget-4 row-fluid widget-tabs widget-tabs-2">

<?php $this->load->view('template/menu_tab', array('hal'=>'nasabah'));?>
<hr>
	<div class="heading-buttons">
		<?php $a = $this->nasabah->getDetail($data); 
			foreach ($a as $key);
		?>
		<table class="table">
			<tr>
				<th>Kode Nasabah</th>
				<td>:</td>
				<td><?php echo $key->kode; ?></td>
			</tr>
			<tr>
				<th>Nama</th>
				<td>:</td>
				<td><?php echo $key->nama; ?></td>
			</tr>
			<tr>
				<th>Alamat</th>
				<td>:</td>
				<td><?php echo $key->alamat; ?></td>
			</tr>
			<tr>
				<th>No. HP</th>
				<td>:</td>
				<td><?php echo $key->hp; ?></td>
			</tr>
			<tr>
				<th>Jenis Keanggotaan</th>
				<td>:</td>
				<td><?php echo $key->jenis; ?></td>
			</tr>
			<tr>
				<th>Tanggal Masuk</th>
				<td>:</td>
				<td><?php echo $key->tgl_masuk; ?></td>
			</tr>
		</table>
	</div>
	
</div>
