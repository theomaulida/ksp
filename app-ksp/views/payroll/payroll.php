<style type="text/css" media="print">
@media print {
    .noprint {display:none !important;}
    a:link:after, a:visited:after {  
      display: none;
      content: "";    
    }
}
</style>
<div class="">
	<div id="content">
<div class="widget widget-4 row-fluid widget-tabs widget-tabs-2">

<div class="widget-head hidden-print">
	<ul>
		<li class="<?php if ($this->uri->segment(3)=='') echo 'active';?>"><a href="<?php echo site_url('main/payroll/')?>" >Data Payroll</a></li>
		<li class="<?php if ($this->uri->segment(3)=='import') echo 'active';?>"><a href="<?php echo site_url('main/payroll/import')?>" >Import Payroll</a></li>
	</ul>
</div>

	<div class="widget-body" style="padding: 10px 0 0;">
		<table class="dynamicTable table table-striped table-bordered table-primary table-condensed">
			<thead>
				<tr>
					<!-- <th>NO</th> -->
					<th width="20%">NAMA</th>
					<th>NO.PEG</th>
					<th>ANGS_UANG</th>
					<th>JASA_UANG</th>
					<th>ANGS_BARANG</th>
					<th>JASA_BARANG</th>
					<th>MASUK_ANGGOTA</th>
					<th>SUKARELA</th>
					<th>SRPLUS</th>
					<th>KRG_POTONG</th>
					<th>TOTAL</th>
					<th>JKT</th>
					<th>SELISIH</th><!-- 
					<th class="hidden-print" width="12%">ACTION</th>
					<th class="hidden-print" width="27%">SIMPAN/PINJAM </th> -->
				</tr>
			</thead>
			<tbody>	
			</tbody>
		</table>
	</div>
</div>
