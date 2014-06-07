<!-- Start Content -->
	<div class="container-fluid fixed">
		
				
		<div id="content"><!-- <ul class="breadcrumb">
	<li><a href="index.html" class="glyphicons home"><i></i> AIR</a></li>
	<li class="divider"></li>
	<li>Forms</li>
	<li class="divider"></li>
	<li>Form Validator</li>
</ul> -->
<div class="separator"></div>

<!-- <h3 class="glyphicons show_thumbnails_with_lines"><i></i> Form Validator</h3> -->


<?php 
$atribut=array('class'=>'form-horizontal','style'=>'margin-bottom: 0;');
echo form_open('main/kop',$atribut);
foreach ($kop as $row);
?>
	
	<h4>Edit KOP</h4>
	<hr class="separator line" />
	<div class="row-fluid">
			<div class="control-group">
				<label class="control-label" for="email">KOP</label>
				<div class="controls"><textarea name="kop"><?php echo $row->kop ?></textarea></div>
			</div>
		

	
	<div class="form-actions">
		<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>SIMPAN</button>
		<button type="reset" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>RESET</button>
	</div>
	
<?php
 echo form_close();?>
<!-- jQuery Validate -->