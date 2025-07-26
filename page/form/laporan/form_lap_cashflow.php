<script>
var htmlobjek;

		
		$(document).ready(function(){
		  //apabila terjadi event onchange terhadap object <select id=propinsi>
		  
		 $("#prov").change(function(){
			var kode = $("#prov").val();
			$.ajax({
				url: "controler/controler_kabupaten.php",
				data: "kode="+kode,
				cache: false,
				success: function(msg){
					//jika data sukses diambil dari server kita tampilkan
					//di <select id=kota>
					$("#kab").html(msg);
				}
			});
		  });
		  
		  
		 
		
	});
	
	
</script>
<script>
	function hasil() {
	
		  var a = document.getElementById('total').value;
		  var b = document.getElementById('diskon').value;
		  var c = document.getElementById('voucher').value;
		  var d = document.getElementById('pajak').value;
		  var e = document.getElementById('ogkir').value;
		  
		  
		  var diskon = parseInt(a)*parseInt(b)/100;
		  var pajak = parseInt(a)*parseInt(d)/100;
		  
		  var result = (parseInt(a)+parseInt(e)+parseInt(pajak))-(parseInt(diskon)+parseInt(c));
		  
		  var format = result.toString().split('').reverse().join('');
		  var convert = format.match(/\d{1,3}/g);
		  var rupiah = convert.join('.').split('').reverse().join('')
	
		  if (!isNaN(result)) {
			 document.getElementById('grandtotalx').value =rupiah;
			 document.getElementById('grandtotal').value =result;
		  }
	}
</script>
<?php

$tglx = $_POST['tgl1'];
$tgly = $_POST['tgl2'];


$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

$tahun1 = substr($tglx, 0, 4);
$bulan1 = substr($tglx, 5, 2);
$tgl1   = substr($tglx, 8, 2);
$awal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;
	   
$tahun2 = substr($tgly, 0, 4);
$bulan2 = substr($tgly, 5, 2);
$tgl2   = substr($tgly, 8, 2);
$akhir = $tgl2 . " " . $BulanIndo[(int)$bulan2-1] . " ". $tahun2;

?>

         
		  
		  <?php
		  	
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Laporan Cashflow</h4>
						<ul class=\"breadcrumbs\">
							<li class=\"nav-home\">
								<a href=\"#\">
									<i class=\"flaticon-home\"></i>
								</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Laporan</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Laporan Cashflow</a>
							</li>
						</ul>
					</div>";
		  
		  ?>


	
            <div class="card mb-12">
                <div class="card-header">
									<div class="card-title"><i><i class="fas fa-print"></i> Laporan Cashflow</i></div>
								</div>
                <div class="card-body">
				 <div class="table-responsive"> 
				  <?php
				  
				  echo "<div id=\"container\">
						<center>";
				
				 echo "<table style='width:100%; font-size:9pt; font-family:calibri; border-collapse: collapse;' border = '0'>
						<td width='70px' align='left' style='padding-right:80px; vertical-align:top'>
						<span style='font-size:12pt'><b>$company[company]</b></span></br>
						<span style='font-size:9pt'>$company[alamat]<br>Telp: $company[no_telp] / Email: $company[email]</span>
						</td>
						<td style='vertical-align:top' width='30%' align='left'></td>
				</table>";			
				 echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> 
							 <tr>
								<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\" colspan=5><h3><b>LAPORAN CASHFLOW</b></h3>
								</td>
							</tr>
							<tr>
								<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\" colspan=5><b>Periode $awal s/d. $akhir</b></td>
							</tr>
							
							<tr>
								<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>&nbsp;</td>
							</tr>
					 </table>";
					 
					 echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\" >
											<thead>
												  <tr>
													<th class=\"text-center\" style=\"font-size:12px;\" width=5>No.</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=5>Tanggal</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=10>No. Transaksi</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=50>Jenis</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=50>Penerimaan</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=50>Pengeluaran</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=100>Keterangan</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=50>User</th>
												  </tr>
											</thead>
											<tbody>";
						$baca = mysqli_query($conn,"SELECT  *,DATE_FORMAT(tgl_transaksi, '%d/%m/%Y') AS tgl,(select nm_pengguna from admin where id=tbl_jurnal.user) as kasir
											         FROM tbl_jurnal WHERE tgl_transaksi BETWEEN '$tglx' and '$tgly' and kd_akun IN ('1.1','1.2') ORDER BY tgl_transaksi");
						$no = 1;	
						while($fetchArray = mysqli_fetch_array($baca)){
						
								echo "<tr>
													<td class=\"text-center\" style=\"font-size:12px;\">$no</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[tgl]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[no_transaksi]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[jenis]</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['debet'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['kredit'])."</td>
													<td class=\"text-left\" style=\"font-size:12px;\">$fetchArray[keterangan]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[kasir]</td>			
									</tr>";
						
						
						
						 $debet = $debet+$fetchArray['debet'];
						 $kredit = $kredit+$fetchArray['kredit'];
						
						$no++;
						}
						
						echo "</tbody>
									<tr>
										<td class=\"text-right\" style=\"font-size:12px;\" colspan=4><b>Jumlah Total</b></td>
										<td class=\"text-right\" style=\"font-size:12px;\"><b>".number_format($debet)."</b></td>
										<td class=\"text-right\" style=\"font-size:12px;\"><b>".number_format($kredit)."</b></td>
										<td class=\"text-right\" style=\"font-size:12px;\"><b></b></td>
										<td class=\"text-right\" style=\"font-size:12px;\"><b></b></td>
									</tr>
							</table>";
							
							$select = mysqli_query($conn,"SELECT SUM(debet-kredit) as nilai FROM tbl_jurnal where kd_akun IN ('1.1','1.2') and tgl_transaksi<'$tglx'");
	                        $data = mysqli_fetch_array($select);
							
							$saldo = ($data['nilai']+$debet)-$kredit;
							
							echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\" >
												  <tr>
													<th class=\"text-right\" style=\"font-size:12px;\" width=>&nbsp;</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=5></th>
													<th class=\"text-right\" style=\"font-size:12px;\" width=100></th>
													<td class=\"text-right\" style=\"font-size:12px;\" width=5><b>&nbsp;</b></td>
												  </tr>
												  <tr>
													<th class=\"text-right\" style=\"font-size:12px;\" width=>Saldo Awal</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=5>:</th>
													<th class=\"text-right\" style=\"font-size:12px;\" width=100>".number_format($data['nilai'])."</th>
													<td class=\"text-right\" style=\"font-size:12px;\" width=5><b>&nbsp;</b></td>
												  </tr>
												  <tr>
													<th class=\"text-right\" style=\"font-size:12px;\" width=>Total Mutasi Masuk</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=5>:</th>
													<th class=\"text-right\" style=\"font-size:12px;\" width=100>".number_format($debet)."</th>
													<td class=\"text-right\" style=\"font-size:12px;\" width=5><b>&nbsp;</b></td>
												  </tr>
												  <tr>
													<th class=\"text-right\" style=\"font-size:12px;\" width=>Total Mutasi Keluar</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=5>:</th>
													<th class=\"text-right\" style=\"font-size:12px;\" width=100>".number_format($kredit)."</th>
													<td class=\"text-right\" style=\"font-size:12px;\" width=5><b>&nbsp;</b></td>
												  </tr>
												  <tr>
													<th class=\"text-right\" style=\"font-size:12px;\" width=>Saldo Akhir</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=5>:</th>
													<th class=\"text-right\" style=\"font-size:12px;\" width=100>".number_format($saldo)."</th>
													<td class=\"text-right\" style=\"font-size:12px;\" width=5><b>&nbsp;</b></td>
												  </tr>
									</table>";			 
						
				   echo "</center>
						</div>";
				  
				  
				  ?>
			  </div>
			  </div>
				<div class="card-action" align="right">
				   <?php
					 echo "<div class=\"table-responsive\">
									<table border=0>
									<tr>
										<td>
											<button type=\"button\" class=\"btn btn-primary\" onclick=\"printDokumen()\"><i class=\"fas fa-print\"></i> Cetak</button>
										</td>
										<td>
											<form method=\"post\" action=\"welcome.php?modul=cashflow&aksi=view\">
												<input type=\"hidden\" name=\"tgl1\" value=\"$tglx\">
												<input type=\"hidden\" name=\"tgl2\" value=\"$tgly\">
												   <button class=\"btn btn-danger\" type=\"submit\" value=\"\" name=\"\">
															<i class=\"fas fa-reply\"></i> Kembli
												</button>
											</form>
										</td>
									</tr>
									</table>
					    </div>";
					 ?>
				</div>
             
               
 
		 

<script>
    function printDokumen() {
        var printContents = document.getElementById('container').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>