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
echo form_open('main/tambah_user',$atribut)?>
	
	<h4>Tambah Admin</h4>
	<hr class="separator line" />
	<div class="row-fluid">
		
			<div class="control-group">
				<label class="control-label" for="lastname">NAMA</label>
				<div class="controls"><input class="span6" id="lastname" name="nama" type="text" required autofocus/></div>
			</div>
			<div class="control-group">
				<label class="control-label" for="name">LEVEL</label>
				<div class="controls"><select id="name" name="level" required>
					<option value="">--Pilih Level--</option>
					<option value="admin">Admin</option>
					<option value="teller">Teller</option>
				</select> </div>
			</div>
			<div class="control-group">
				<label class="control-label" for="email">USERNAME</label>
				<div class="controls"><input class="span6" id="email" name="username" type="text" required/></div>
			</div>
			<div class="control-group">
				<label class="control-label" for="email1">PASSWORD</label>
				<div class="controls"><input class="span6" id="email1" name="password" type="password" required/></div>
			</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>SIMPAN</button>
		<button type="reset" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>RESET</button>
	</div>
	
<?php echo form_close();?>
<!-- jQuery Validate -->