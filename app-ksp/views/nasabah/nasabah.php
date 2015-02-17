<style type="text/css" media="print">
@media print {
    .noprint {display:none !important;}
    a:link:after, a:visited:after {  
      display: none;
      content: "";    
    }
}
</style>
<div class="container-fluid fixed">
	<div id="content">
<div class="widget widget-4 row-fluid widget-tabs widget-tabs-2">

<?php $this->load->view('template/menu_tab', array('hal'=>'anggota'));?>
	<div class="widget-body" style="padding: 10px 0 0;">
		<table class="dynamicTable table table-striped table-bordered table-primary table-condensed">
			<thead>
				<tr>
					<th>NO</th>
					<th>NO_ANGGOTA</th>
					<th width="20%">NAMA_ANGGOTA</th>
					<th>DEPARTEMEN</th>
					<th>TGL MASUK</th>
					<th class="hidden-print" width="13%">ACTION</th>
					<th class="hidden-print" width="27%">SIMPAN/PINJAM </th>
				</tr>
			</thead>
			<tbody>	
			</tbody>
		</table>
	</div>
</div> 
