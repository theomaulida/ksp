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
<body>
<div id="printable">
<table align="center">
<tr>
	<td><img src="<?php echo base_url()?>/assets/images/logo.png" width="120" height="120"></td>
	<td align="center">
		<?php foreach ($kop as $rows) {
			echo $rows->kop;
		}?>
	
	</td>
</tr>
</table>
<hr align="center">
<table align="center">
<tr>
	<td align="center">
		BUKTI <?php echo $tipe ?> TABUNGAN
	</td>
</tr>
</table>

<?php foreach ($result as $row);?>
<div style="float:left;width:350px">
<table>
	<tr>
		<td>NIS</td>
		<td><strong>: <?php echo $row->nis; ?></strong></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><strong>: <?php echo $row->nama; ?></strong></td>
	</tr>
	<tr>
		<td>Kelas</td>
		<td><strong>: <?php echo $row->kelas; ?></strong></td>
	</tr>
	<tr>
		<td>Jenis Transaksi</td>
		<td><strong>: <?php echo $row->transaksi.' ('.$row->sandi.')';?></strong></td>
	</tr>
	<tr>
		<td>Nominal</td>
		<td><strong>: <?php echo buatrp($row->nominal);?></strong></td>
	</tr>
	<tr>
		<td>Saldo</td>
		<td><strong>: <?php echo buatrp($row->saldo);?></strong></td>
	</tr>
</table>
</div>
<div style="float:right;">
<h5>Munjungan,<br> <?php echo $row->tgl; ?></h5>
<br><br>
teller
<h5><?php echo $this->session->userdata('nama');
function buatrp($angka){
        $jadi = "Rp " . number_format($angka,2,',','.');
        return $jadi;
    }
?></h5>
</div>

</div>
</body>
</html>

<img width="60px" height="60px" title="Print" src="<?php echo base_url()?>/assets/images/print.png" onClick="window.print()">