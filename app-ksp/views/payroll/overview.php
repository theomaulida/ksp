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

<table>

<?php 
	$file = './assets/'.$file['file_name'];
	$handle = fopen($file,"r");

$arr2 = array();
	while(!feof($handle)){
		$data = fgetcsv($handle,1000,","," ");
		$arr = array('kode'=>$data[0],'amount'=>$data[2]);
		array_push($arr2, $arr);
	}
		/*echo '<pre>';
			print_r($arr2);
		echo '</pre>';*/
		$this->mdb->import($arr2);
		$db = $this->mdb->get_import();
		foreach ($db as $key) {
			echo $key->kode.' '.$key->nama.' '.$key->amount.'<br>';
		}
 ?>

</table>
</div>