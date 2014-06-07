<div class="container-fluid fixed">
	<div id="content">
<div class="widget widget-4 row-fluid widget-tabs widget-tabs-2">

<?php $this->load->view('template/menu_tab', array('hal'=>'simpanan'));?>
<hr>
	<div class="heading-buttons">
		<?php 
				$periode = ($this->input->get('per')) ? $this->input->get('per') : '';
				$nasabah = $this->mdb->getDetailSimpanan($kode, $periode);

				foreach ($nasabah as $key); 
				echo '<h5>NO PEGAWAI : <b>'.$key->kode.'</b><br> NAMA : <b>'.$key->nama.'</b><br>';
				echo 'DEPARTEMEN : <b>'.$key->departemen.'</b><br>TANGGAL MASUK : <b>'.$key->tgl_masuk.'</b></h5>';
				
			if(!$periode)
			{
				echo '&nbsp;&nbsp;&nbsp;<h5>';
				$jenis = $this->mdb->getDetailJenis($kode);
				foreach ($jenis as $rows) {
					if($rows->jenis!='Ambil') echo 'TOTAL SIMPANAN '.$rows->jenis.' : <b>Rp. '.buatrp($rows->total).'</b><br>';
				}
				echo '</h5>';
			}
		

		?>
		
		<div class="pull-right">
			<h4 class="heading"><?php
				$dropdown = $this->mdb->getPeriodeSimpanan($kode);
				echo form_open('','method="get"');
				// $default = ($this->input->get('per')) ? $this->input->get('per') : mdate('%Y-%m',now());
				echo 'Periode : '.form_dropdown('per', $dropdown, $this->input->get('per'), 'onChange="this.form.submit()"');
				echo form_close();
				?>
			</h4>
		</div>
	</div>
	<div class="widget-body" style="padding: 10px 0 0;">
		<table class="table table-striped table-bordered table-primary table-condensed">
			<thead>
				<tr>
					<th>NO</th>
					<th>TANGGAL</th>
					<th>JENIS_TRANSAKSI</th>
					<th class="center">AMBIL (Rp)</th>
					<th class="center">SIMPAN (Rp)</th>
					<th class="center">SALDO (Rp)</th>
					<!-- <th>PRINT</th> -->
				</tr>
			</thead>
			<tbody>
				<?php $i=1; foreach ($nasabah as $row):?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo mdate('%d %M %Y',strtotime($row->tanggal)); ?></td>
					<td><?php echo $row->jenis; ?></td>
					<td class="right"><?php if($row->jumlah<0) echo buatrp(substr($row->jumlah, 1)); ?></td>
					<td class="right"><?php if($row->jumlah>=0) echo buatrp($row->jumlah); ?></td>
					<td class="right"><?php echo buatrp($row->saldo); ?></td>
					<!-- <td><?php //echo anchor('main/print_transaksi/'.$row->id,'Print');?>
					</td> -->
				</tr>
			<?php $i++; endforeach;
				function buatrp($angka){
        			$jadi = number_format($angka,0,',','.');
    	    		return $jadi;
    			}	
			?>
				
			</tbody>
		</table>
	</div>
</div>
