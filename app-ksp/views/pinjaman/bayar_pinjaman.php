<?php $keyword = $this->input->get('kode');
echo validation_errors();
?>
<div class="container-fluid fixed"><div id="content">
	<div class="widget widget-4 row-fluid widget-tabs widget-tabs-2">

<?php $this->load->view('template/menu_tab', array('hal'=>'pinjaman'));?>
<hr>
	<form method="get" class="form-horizontal">
	<fieldset>
	<div class="input-append control-group">
	  	<label class="control-label" for="kode">NO. NASABAH</label><div class="controls"> 
	  		<input class="span8" id="kode" name="kode" type="text" placeholder="NO. NASABAH" value="<?php echo $keyword; ?>" autofocus required/>
	  	<button class="btn" type="submit"><i class="icon-search"></i></button></div>
	</div>
	</fieldset>
	</form>
</div>
	<?php
    function buatrp($angka){
        $jadi = "Rp " . number_format($angka,0,',','.');
        return $jadi;
    }
	 if($keyword!=""){
	 	$result = $this->mdb->getPinjaman($keyword);
			foreach ($result as $row);
			if(!$result){echo "<h3>Data Pinjaman untuk nasabah ini tidak ditemukan</h3>Pastikan anda memasukkan nomor nasabah dengan benar";}else{ ?>
<?php echo form_open('',array('class'=>'form-horizontal','style'=>'margin-bottom: 0;'));?>
<div class="widget widget-4 widget-body-white">
		<fieldset>
			<!-- <input type="hidden" name="pinjaman_id" value="<?php echo $keyword ?>"> -->
			<input type="hidden" name="kode_nasabah" value="<?php echo $keyword ?>">
			<div class="control-group">
				<label class="control-label" for="username">NAMA</label>
				<div class="controls"><input class="span6" id="username" value="<?php echo $row->nama?>" type="text" disabled/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="username">JENIS PINJAMAN</label>
				<div class="controls">
					<input class="span2" id="username" value="<?php echo $row->jenis?>" type="text" disabled/>
					<span>TANGGAL PEMINJAMAN</span>
					<input class="span2" id="username" value="<?php echo $row->tanggal?>" type="text" disabled/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="saldo">JUMLAH</label>
				<div class="controls">
					<input class="span2" id="saldo" value="<?php echo buatrp($row->jumlah)?>" type="text" disabled/>
					<span>&nbsp;&nbsp;&nbsp; LAMA ANGSURAN </span><input class="span1" id="saldo" value="<?php echo $row->lama?>" type="text" disabled/>BULAN
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">TANGGAL</label>
				<div class="controls">
					<input type="text" name="tanggal" id="datepicker" value="<?php echo mdate('%m/%d/%Y', now())?>" />
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="jt">Angsuran Ke</label>
				<div class="controls">
					<?php 
					$cicilan_ke = $this->input->get('cicilan_ke');
					$nominal = $this->input->get('jumlah');
					$dropd[''] = '--Pilih--';
					for ($i=1; $i <= $row->lama; $i++) { 
						$dropd[$i]=$i;
					}
					 echo form_dropdown('cicilan_ke', $dropd, $cicilan_ke, 'class="span2" required="required"');?>
				</div>
			</div> 

			<div class="control-group">
				<label class="control-label" for="nominal">NOMINAL</label>
				<div class="controls"><input class="span6" id="nominal" name="nominal" type="number" min="1" step="" max="<?php ?>" value="<?php echo $nominal?>" required/>
				</div>
			</div>
</fieldset>
</div>
<div class="form-actions">
		<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>PROSES</button>
		<a href="<?php echo site_url('main/pinjaman')?>" type="button" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>KEMBALI</a>
	</div>
<?php echo form_close(); }}?>