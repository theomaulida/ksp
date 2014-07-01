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
	 $data = fgetcsv($handle,1000,",","'"," ");
	 print_r($data);
	 foreach ($data as $key => $value) {
	 	 echo $value.'<br>';
	 }

	// while ($data = fgetcsv($handle,1000,",","'"," "))
	// {
 //            echo $data[0].'<br>';
 //            // echo addslashes($data[1]).'<br>';
	// } 
 ?>

</table>
</div>