<?php $keyword = $this->input->get('kode');
echo validation_errors();
?>
<div class="container-fluid fixed"><div id="content">
<div class="widget widget-4 row-fluid widget-tabs widget-tabs-2">

<?php $this->load->view('template/menu_tab', array('hal'=>'simpanan'));?>
<hr>
	<form method="get" class="form-horizontal">
	<fieldset>
	<div class="input-append control-group">
	  	<label class="control-label" for="kode">NO ANGGOTA</label><div class="controls"> <input class="span12" id="kode" name="kode" type="text" placeholder="NO ANGGOTA" value="<?php echo $keyword; ?>" autofocus required/>
	  	<button class="btn" type="submit"><i class="icon-search"></i></button></div>
	</div>
	</fieldset>
	</form>
</div>
	<?php
    function buatrp($angka){
        $jadi = "Rp " . number_format($angka,2,',','.');
        return $jadi;
    }
	 if($keyword!=""){
	 	$result = $this->mdb->getSaldoTerakhir($keyword);
			foreach ($result as $row);
			if(!$result){echo "<h3>Data Tidak ditemukan</h3>";}else{ ?>
<?php echo form_open('',array('class'=>'form-horizontal','style'=>'margin-bottom: 0;'));?>
<div class="widget widget-4 widget-body-white">
		<fieldset>
			<input type="hidden" name="kode_nasabah" value="<?php echo $keyword ?>"> 
			<input type="hidden" name="saldo" value="<?php echo $row->saldo ?>"> 
			<div class="control-group">
				<label class="control-label" for="username">NAMA</label>
				<div class="controls"><input class="span6" id="username" value="<?php echo $row->nama?>" type="text" disabled/>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="saldo">SALDO</label>
				<div class="controls"><input class="span6" id="saldo" value="<?php echo buatrp($row->saldo)?>" type="text" disabled/>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">TANGGAL</label>
				<div class="controls">
					<input type="text" name="tanggal" id="datepicker" value="<?php echo mdate('%m/%d/%Y', now())?>" />
				</div>
			</div>

<!-- 			<div class="control-group">
				<label class="control-label" for="jt">JENIS SIMPANAN</label>
				<div class="controls">
					<?php 
					 //echo form_dropdown('jenis',array(''=>'-- Pilih --','Pokok'=>'Pokok','Wajib'=>'Wajib','Sukarela'=>'Sukarela','Surplus'=>'Sukarela Plus'),'','required="required"');?>
				</div>
			</div> -->
			<div class="control-group">
				<label class="control-label" for="nominal">NOMINAL</label>
				<div class="controls"><input class="span6" id="nominal" name="nominal" type="number" max="<?php echo $row->saldo?>" required/>
				</div>
			</div>
</fieldset>
</div>
<div class="form-actions">
		<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>PROSES</button>
		<a href="<?php echo site_url('main/simpanan')?>" type="button" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>KEMBALI</a>
	</div>
<?php echo form_close(); }}?>