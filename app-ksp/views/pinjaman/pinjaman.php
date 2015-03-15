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
<?php $this->load->view('template/menu_tab', array('hal'=>'pinjaman'));?>
<br>
<div class="heading-buttons">
	<div class="">
		<h4 class="heading"><?php
			echo form_open('','method="get"');
			echo 'Jenis : '.form_dropdown('jenis', array(''=>'-- Semua --','Uang'=>'Uang','Barang'=>'Barang'), $this->input->get('jenis'), 'onChange="this.form.submit()"');
			echo form_close();
			?>
		</h4>
		<br>
	</div>
</div>

	<div class="widget-body" style="padding: 10px 0 0;">
		<table class="dynamicTable table table-striped table-bordered table-primary table-condensed">
			<thead>
				<tr>
					<th>NO_NASABAH</th>
					<th>NAMA_NASABAH</th>
					<th>TANGGAL</th>
					<th>JENIS</th>
					<th>JUMLAH (RP)</th>
					<th>ANGSURAN</th>
					<th>CICILAN</th>
					<th class="hidden-print">ACTION</th>
				</tr>
			</thead>
			<tbody>	
			</tbody>
		</table>
	</div>
</div>
