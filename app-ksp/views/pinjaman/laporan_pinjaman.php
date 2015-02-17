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
	<div class="pull-left">
		<h4 class="heading"><?php
			echo form_open('','method="get"');
			echo 'Jenis : '.form_dropdown('jenis', array(''=>'-- Semua --','Uang'=>'Uang','Barang'=>'Barang'), $this->input->get('jenis'), 'onChange="this.form.submit()"');
			?>
		</h4>
	</div>
	<div class="pull-right">
		<h4 class="heading"><?php
			$dropdown = $this->mdb->getPeriodePinjaman();
			echo 'Periode : '.form_dropdown('per', $dropdown, $this->input->get('per'), 'onChange="this.form.submit()"');
			echo '   '.form_submit('export','Download', 'class="btn btn-warning"');
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
					<th>NO_ANGGOTA</th>
					<th>NAMA_ANGGOTA</th>
					<th>TANGGAL</th>
					<th>JENIS</th>
					<th style="text-align:right;">JUMLAH</th>
					<th>ANGURAN</th>
					<th>CICILAN</th>
				</tr>
			</thead>
			<tbody>	
			</tbody>
		</table>
	</div>
</div>
