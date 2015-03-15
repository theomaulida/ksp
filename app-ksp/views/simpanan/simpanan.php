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

<div class="widget widget-4 widget-body-white widget-tabs widget-tabs-2">
		<?php $this->load->view('template/menu_tab', array('hal'=>'simpanan'));?>
	<div class="widget-body" style="padding: 10px 0 0;">
		<table class="dynamicTable table table-striped table-bordered table-primary table-condensed">
			<thead>
				<tr>
					<th>NO_NASABAH</th>
					<th>NAMA_NASABAH</th>
					<!-- <th>JENIS</th> -->
					<th>TANGGAL</th> 
					<th>SALDO</th>
					<th class="hidden-print">ACTION</th>
				</tr>
			</thead>
			<tbody>	
			</tbody>
		</table>
	</div>
</div>
