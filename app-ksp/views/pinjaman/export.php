<!-- View Export Ke excel -->

<table border="0">
	<tr>
		<td colspan="7">LAPORAN PINJAMAN</td>
	</tr>
	<tr>
		<td>PERIODE</td>
		<td><?php if($this->input->get('per')) echo date('F Y', strtotime($this->input->get('per'))) ?></td>
	</tr>
	<tr>
		<td>JENIS PINJAMAN</td>
		<td><?php echo $this->input->get('jenis') ?></td>
	</tr>
</table>
<table border="1">
	<thead>
		<tr>
			<th>NO PEGAWAI</th>
			<th>NAMA ANGGOTA</th>
			<th>JENIS</th>
			<th>TANGGAL</th>
			<th style="text-align:right;">JUMLAH</th>
			<th>ANGSURAN</th>
			<th>CICILAN</th>
		</tr>
		<?php 
		foreach ($pinjaman as $key) {
			echo '<tr>';
			echo '<td>'.$key->kode.'</td>';
			echo '<td>'.$key->nama.'</td>';
			echo '<td>'.$key->jenis.'</td>';
			echo '<td>'.$key->tanggal.'</td>';
			echo '<td>'.$key->jumlah.'</td>';
			echo '<td>'.$key->lama.'</td>';
			echo '<td>'.$key->status.'</td>';
			echo '</tr>';
		}

		 ?>
	</thead>
	<tbody>	
	</tbody>
</table>