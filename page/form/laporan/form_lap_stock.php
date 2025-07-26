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

$jenis = htmlspecialchars($_POST['jenis'], ENT_QUOTES);

if($jenis=='0'){
	$ket = 'Semua Barang';
}else
if($jenis=='1'){
	$ket = 'Barang Limit';
}else
if($jenis=='2'){
	$ket = 'Barang Terlaris';
}


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
						<h4 class=\"page-title\">Laporan Stock Barang</h4>
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
								<a href=\"#\">Laporan Stock Barang</a>
							</li>
						</ul>
					</div>";
		  
		  ?>


	
            <div class="card mb-12">
                <div class="card-header">
									<div class="card-title"><i><i class="fas fa-print"></i> Laporan Stock Barang</i></div>
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
								<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\" colspan=5><h3><b>LAPORAN STOCK BARANG<br><i>($ket)</i></b></h3></td>
							</tr>
							
							<tr>
								<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>&nbsp;</td>
							</tr>
					 </table>";
					 
					 echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\" >
											<thead>
												  <tr>
													<th class=\"text-center\" style=\"font-size:12px;\" width=5>No.</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=5>Kode Barang</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=200>Nama Barang</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=10>Satuan</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=80>Harga Beli</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=80>Harga Jual</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=50>Stock<br>Barang</th>
													<th class=\"text-center\" style=\"font-size:12px;\" width=50>Jumlah<br>Terjual</th>
												  </tr>
											</thead>
											<tbody>";
											 if($jenis=='0'){
											 $baca = mysqli_query($conn,"SELECT  *,IFNULL((stock-terjual),0) as saldo FROM tbl_barang");
											 }else
											 if($jenis=='1'){
											 $baca = mysqli_query($conn,"SELECT  *,IFNULL((stock-terjual),0) as saldo FROM tbl_barang WHERE IFNULL((stock-terjual),0) < 10 LIMIT 3");
											 }else
											 if($jenis=='2'){
											 $baca = mysqli_query($conn,"SELECT  *,IFNULL((stock-terjual),0) as saldo FROM tbl_barang WHERE terjual<>'0' ORDER BY terjual DESC LIMIT 5");
											 }
						$no = 1;	
						while($fetchArray = mysqli_fetch_array($baca)){
						
						 					if($fetchArray['saldo']<'1'){
											   echo "<tr style=\"color:#FF0000;\">
													<td class=\"text-center\" style=\"font-size:12px;\">$no</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[kd_barang]</td>
													<td class=\"text-left\" style=\"font-size:12px;\">$fetchArray[nm_barang]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[satuan]</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['harga_beli'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['harga_jual'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['saldo'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['terjual'])."</td>
												  </tr>";
											}else{
												echo "<tr>
													<td class=\"text-center\" style=\"font-size:12px;\">$no</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[kd_barang]</td>
													<td class=\"text-left\" style=\"font-size:12px;\">$fetchArray[nm_barang]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[satuan]</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['harga_beli'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['harga_jual'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['saldo'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['terjual'])."</td>
												  </tr>";
											 }
						
						$no++;
						}
						
						echo "</tbody>
							</table>";
							
								 
						
				   echo "</center>
						</div>";
				  
				  
				  ?>
			  </div>
			  </div>
				<div class="card-action" align="right">
				     <button type="button" class="btn btn-primary" onclick="printDokumen()"><i class="fas fa-print"></i> Cetak</button>
					 <a href="welcome.php?modul=stock&aksi=view"><button type="button" class="btn btn-danger"><i class="fas fa-reply"></i> Kembli</button></a>
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