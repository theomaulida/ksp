	<div class="container-fluid fixed">
		<div id="content">
			<div class="widget widget-4 row-fluid widget-tabs widget-tabs-2">

<?php 
$this->load->view('template/menu_tab', array('hal'=>'nasabah'));

$atribut=array('class'=>'form-horizontal','style'=>'margin-bottom: 0;');
echo form_open('',$atribut)?>
	
	<h4>Tambah NASABAH</h4>
	<hr class="separator line" />
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="firstname">NO NASABAH</label>
				<div class="controls">
					<input class="span12" id="firstname" name="kode" type="text" value="<?php echo set_value('kode')?>" required autofocus/>
					<?php echo form_error('kode','<label class="label-warning">','</label>'); ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="lastname">NAMA</label>
				<div class="controls">
					<input class="span12" id="lastname" name="nama" type="text" value="<?php echo set_value('nama')?>" required/>
					<?php echo form_error('nama','<label class="label-warning">','</label>'); ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="alamat">ALAMAT</label>
				<div class="controls">
					<textarea class="span12" id="alamat" name="alamat"><?php echo set_value('alamat')?></textarea>
					<?php echo form_error('alamat','<label class="label-warning">','</label>'); ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="hp">HP</label>
				<div class="controls">
					<input class="span12" id="hp" name="hp" type="text" value="<?php echo set_value('hp')?>" />
					<?php echo form_error('hp','<label class="label-warning">','</label>'); ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="lastname">KEANGGOTAAN</label>
				<div class="controls">
					<?php 
					$dropdownKeanggotaan = $this->keanggotaan->getOptionKeanggotaan();
					 echo form_dropdown('keanggotaan_id',$dropdownKeanggotaan,set_value('keanggotaan_id'),'required="required"');?>
				</div>
			</div>
			<!-- <div class="control-group">
				<label class="control-label" for="username">DEPARTEMEN</label>
				<div class="controls">
					<input class="span12" id="username" name="departemen" type="text" value="<?php echo set_value('departemen')?>" />
				</div>
			</div> -->
			<div class="control-group">
				<label class="control-label" for="lembar2">TANGGAL MASUK</label>
				<div class="controls">
					<input class="span12" id="lembar2" name="tgl_masuk" type="date" value="<?php echo set_value('tgl_masuk')?>" required/>
					<?php echo form_error('tgl_masuk','<label class="label-warning">','</label>'); ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="form-actions">
		<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>SIMPAN</button>
		<button type="button" onClick="window.history.back()" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>KEMBALI</button>
	</div>
<?php echo form_close();?>