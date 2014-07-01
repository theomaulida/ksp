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

<?php echo form_open_multipart('main/payroll/upload','class="form-horizontal"');?>

<div class="control-group">
	<label class="control-label" for="file">Upload File (.csv)</label>
	<div class="controls">
		<input class="span6" type="file" name="payroll" id="file" accept=".csv" />
	</div>
</div>
<div class="form-actions">
		<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>PROSES</button>
</div>
<?php echo form_close(); ?>


</div>