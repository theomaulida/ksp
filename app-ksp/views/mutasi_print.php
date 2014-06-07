<!-- Start Content -->
	<div class="container-fluid fixed">
		
				
		<div id="content">
<head>
<style type="text/css">
        @media print {
            body * {
                visibility:hidden;
            } 
            #printable, #printable * {
                visibility:visible;
            }
            #printable { /* aligning the printable area */
                position:absolute;
                left:10;
                top:0;
                bottom: 0;
            }
        }
        </style>
</head>
<div class="separator"></div>
<img width="60px" height="60px" title="Print" src="<?php echo base_url()?>/assets/images/print.png" onClick="window.print()">
<div id="printable">
<table align="center">
<tr>
	<td><img src="<?php echo base_url()?>/assets/images/logo.png" width="120" height="120"></td>
	<td align="center">
		<?php foreach ($kop as $row) {
			echo $row->kop;
		}?>
	
	</td>
</tr>
</table>
<hr>
<div class="widget widget-4 widget-body-white">
	<div class="widget-head">
		<?php foreach ($nasabah as $key);?>
	</div>
	<h5>
			
<table>
	<tr><td>NIS</td><td>:</td><td><strong><?php echo $key->nis;?></strong></td></tr>
	<tr><td>NAMA</td><td>:</td><td><strong><?php echo $key->nama;?></strong></td></tr>
</table>
	</h5>
	<div class="widget-body" style="padding: 10px 0 0;">
		<table class="table table-striped table-bordered table-condensed">
			<thead>
				<tr>
					<th>NO</th>
					<th>TANGGAL</th>
					<th>SANDI</th>
					<th>JENIS TRANSAKSI</th>
					<th class="center">DEBET (Rp)</th>
					<th class="center">KREDIT (Rp)</th>
					<th class="center">SALDO (Rp)</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; foreach ($mutasi as $row):?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row->tgl; ?></td>
					<td><?php echo $row->sandi; ?></td>
					<td><?php echo $row->nama_sandi; ?></td>
					<td class="right"><?php if($row->transaksi=="DEBET") echo buatrp($row->nominal); ?></td>
					<td class="right"><?php if($row->transaksi=="KREDIT") echo buatrp($row->nominal); ?></td>
					<td class="right"><?php echo buatrp($row->saldo); ?></td>
				</tr>
			<?php $i++; endforeach;
				function buatrp($angka){
        			$jadi = number_format($angka,2,',','.');
    	    		return $jadi;
    			}	
			?>
				
			</tbody>
		</table>
	</div>
</div>
</div>