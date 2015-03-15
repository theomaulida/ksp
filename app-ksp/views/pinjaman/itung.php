<?php
$kode = $this->input->get('kode');
$pinjam = $this->input->get('nominal');

$ab = $this->nasabah->getDetail($kode); foreach ($ab as $key2);
$bunga = $key2->bunga_pinjaman/100;

if($this->input->get('lama'))
{
	$angsur = $this->input->get('lama');
	$angsuran = $pinjam/$angsur;
}
else if($this->input->get('angs'))
{
	$angsur = ceil($pinjam/$this->input->get('angs'));
	$angsuran = $this->input->get('angs');
}

// $selisih_koma = min(($pinjam%$angsur), ($angsur-($pinjam%$angsur)));
function fbuatrp($angka){
        $jadi = "Rp " . number_format($angka,0,',',',');
        return $jadi;
}

?>
<div style="float:left;">
<table style="width: 500px;" class="table table-striped table-bordered table-primary table-condensed">
	<thead>
	<tr>
		<th>No</th>
		<th>Angsuran</th>
		<th>Jasa Uang</th>
		<th>Total Bayar</th>
		<th>Saldo</th>
	</tr>
	</thead>
	<tbody>


<?php
$saldo = array();
$saldo[0] = $pinjam;
$total_jasa = $total_angsuran = $total_bayar = 0;

for ($i=0; $i <= $angsur ; $i++) 
{ 
if($i>0) $jasa = $saldo[$i-1]*$bunga;
if($i>0) $bayar = $angsuran+$jasa;

?>
	<tr>
		<td><?php echo $i?></td>
		<td style="text-align:right"><?php if($i>0) echo fbuatrp(round($angsuran))?></td>
		<td style="text-align:right"><?php if($i>0) echo fbuatrp(round($jasa))?></td>
		<td style="text-align:right"><?php if($i>0) echo fbuatrp(round($bayar))?></td>
		<td style="text-align:right">
			<?php 
			if($saldo[$i]>0){ echo fbuatrp(round($saldo[$i])); } else { echo '('.fbuatrp(round($saldo[$i]*(-1))).')';}
			// echo round($saldo[$i]);
			?>
		</td>
	</tr>

<?php 
 $saldo[$i+1] = $saldo[$i]-$angsuran;
 if($i>0) $total_jasa += $jasa; 
 if($i>0) $total_angsuran += $angsuran; 
 if($i>0) $total_bayar += $bayar; 
}
?>
<tr>
	<td></td>
	<td style="text-align:right"><b><?php echo fbuatrp($total_angsuran)?></b></td>
	<td style="text-align:right"><b><?php echo fbuatrp($total_jasa)?></b></td>
	<input type="hidden" name="total_bayar" value="<?php echo $total_bayar ?>">
	<td style="text-align:right"><b><?php echo fbuatrp($total_bayar)?></b></td>
	<td></td>
</tr>
</tbody>
</table>

</div>
<div>
<table style="width: 300px;padding-left:20px" class="table table-striped table-bordered table-primary table-condensed">
	<thead>
	<tr>
		<th colspan="3">SUMMARY</th>
	</tr>
	</thead>
	<tbody>
		<tr>
			<td><b>DIPINJAM</b></td>
			<td style="text-align:right"><?php echo fbuatrp($pinjam)?></td>
		</tr>
		<tr>
			<td><b>BUNGA</b></td>
			<td style="text-align:right"><?php echo fbuatrp($total_jasa)?></td>
		</tr>
		<tr>
			<td><b>DIBAYAR</b></td>
			<td style="text-align:right"><?php echo fbuatrp($total_bayar)?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><b>% TOTAL</b></td>
			<td style="text-align:right"><?php
			$persen_total = $total_jasa/$pinjam*100;
			echo round($persen_total, 2);
			?></td>
		</tr>
		<tr>
			<td><b>% / TAHUN</b></td>
			<td style="text-align:right">
				<?php
					if($angsur>12)
					{
						echo round($persen_total/($angsur/12), 2);
					}
					else
					{
						echo '0';
					}
				?>
			</td>
		</tr>

	</tbody>
</table>
</div>