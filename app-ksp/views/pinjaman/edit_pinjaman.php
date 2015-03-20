<?php 
foreach ($pinjaman as $pj);
$keyword = $pj->kode;
echo validation_errors();
?>
<div class="container-fluid fixed"><div id="content">
<div class="widget widget-4 row-fluid widget-tabs widget-tabs-2">

<?php $this->load->view('template/menu_tab', array('hal'=>'pinjaman'));?>
<hr>
			<!-- <div class="separator"></div> -->
	<form method="get" class="form-horizontal">
	<fieldset>
	<div class="input-append control-group">
	  	<label class="control-label" for="kode">NO NASABAH</label><div class="controls"> <input class="span12" id="kode" name="kode" type="text" placeholder="NO NASABAH" onkeypress="return isNumberKey(event)" value="<?php echo $keyword; ?>" autofocus readonly/>
	  	<button class="btn" type="submit"><i class="icon-search"></i></button></div>
	</div>
	</fieldset>
	</form>
<!-- </div> -->
	<?php
    function buatrp($angka){
        $jadi = "Rp " . number_format($angka,0,',','.');
        return $jadi;
    }

	$result = $this->mdb->formPinjam($keyword);
	foreach ($result as $row);

		if($this->input->get('itung')){
			$method = 'post';
			$disabled = 'readonly';
			$re_url = $_SERVER['REQUEST_URI'].'&itung=';
		}else {
			$method = 'get';
			$disabled = '';
			$re_url = '';
		}
				?>
<?php echo form_open('',array('method'=>$method,'class'=>'form-horizontal','style'=>'margin-bottom: 0;'));?>
<div class="widget widget-4 widget-body-white">
		<fieldset>
			<input type="hidden" name="kode" value="<?php echo $keyword ?>"> 
			<input type="hidden" name="itung" value="true"> 
			<div class="control-group">
				<label class="control-label" for="username">NAMA</label>
				<div class="controls"><input class="span6" id="username" value="<?php echo $row->nama?>" type="text" disabled/>
				</div>
			</div>
			
<!-- 			<div class="control-group">
				<label class="control-label" for="saldo">SALDO SIMPANAN</label>
				<div class="controls"><input class="span6" id="saldo" value="<?php //echo buatrp($row->saldo)?>" type="text" disabled/>
				</div>
			</div> -->

			<div class="control-group">
				<label class="control-label" for="keanggotaan">KEANGGOTAAN</label>
				<?php $a = $this->nasabah->getDetail($row->kode); foreach ($a as $key);?>
				<div class="controls"><input class="span6" id="keanggotaan" value="<?php echo $key->jenis?>" type="text" disabled/>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="bunga">BUNGA PINJAMAN</label>
				<div class="controls"><input name="bunga" class="span1" id="bunga" value="<?php echo $key->bunga_pinjaman?>" type="text" readonly/> %
					
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">TANGGAL</label>
				<div class="controls">
					<input type="text" name="tanggal" id="datepicker" value="<?php echo mdate('%m/%d/%Y', now())?>" <?php echo $disabled?>/>
				</div>
			</div>

<!-- 			<div class="control-group">
				<label class="control-label" for="jt">JENIS PINJAMAN</label>
				<div class="controls">
					<?php 
					 //echo form_dropdown('jenis',array(''=>'-- Pilih --','Uang'=>'Uang','Barang'=>'Barang'),$this->input->get('jenis'),'required="required" '.$disabled);?>
				</div>
			</div> -->
			<div class="control-group">
				<label class="control-label" for="nominal">NOMINAL</label>
				<div class="controls"><input class="span6" id="nominal" name="nominal" type="number" value="<?php echo $this->input->get('nominal')?>" required <?php echo $disabled?>/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="lama">ANGSURAN</label>
				<div class="controls">
					<input <?php echo $disabled?> class="span1" id="lama" name="lama" type="number" step="1" min="1" value="<?php echo $this->input->get('lama')?>" />
					<span>Kali, atau Nominal Angsuran</span>
					<input <?php echo $disabled?> class="span2" id="lama" name="angs" type="number" step="1" min="1" value="<?php echo $this->input->get('angs')?>" />
				</div>
			</div>
</fieldset>
<?php if($re_url!=''){ ?>
	<a href="<?php echo $re_url?>" class="btn btn-icon btn-default"> EDIT </a>
<?php } ?>
</div>
<?php
	if ($this->input->get('itung')) {
		$this->load->view('pinjaman/itung');
	}
?>

<div class="form-actions" style="display:table;">
		<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>PROSES</button>
		<a href="<?php echo site_url('main/pinjaman')?>" type="button" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>KEMBALI</a>
	</div>
<?php echo form_close(); ?>

<script type="text/javascript">
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
</script>