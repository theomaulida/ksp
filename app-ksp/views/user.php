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

<div class="widget widget-4 widget-body-white">
	<div class="widget-head">
		<h4 class="heading">Data Admin | <?php echo anchor('main/form_user','Tambah Admin')?></h4>
	</div>
	<div class="widget-body" style="padding: 10px 0 0;">
		<table class="table table-striped table-bordered table-primary table-condensed">
			<thead>
				<tr>
					<th>NAMA</th>
					<th>USERNAME</th>
					<th>LEVEL</th>
					<th>ACT</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($nasabah as $row):?>
				<tr>
					<td><?php echo $row->nama; ?></td>
					<td><?php echo $row->username; ?></td>
					<td><?php echo ucfirst($row->level); ?></td>
					<td><?php echo anchor('main/edit_user/'.$row->id,'EDIT');
					?> &nbsp;|&nbsp;
					<a href="<?php echo site_url('main/delete_user/'.$row->id)?>" onClick="return confirm('Apakah Anda benar-benar akan menghapus data ini?')">DELETE</a>
					</td>
				</tr>
			<?php endforeach;?>
				
			</tbody>
		</table>
	</div>
</div>
