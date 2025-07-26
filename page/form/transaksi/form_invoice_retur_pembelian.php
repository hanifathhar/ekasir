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

$id = $_POST['id'];
$tgl1 = htmlspecialchars($_POST['tgl1'], ENT_QUOTES);
$tgl2 = htmlspecialchars($_POST['tgl2'], ENT_QUOTES);



$sql = mysqli_query($conn,"SELECT  *,DATE_FORMAT(tgl_transaksi, '%d/%m/%Y') AS tgl,IF(pembayaran=1,'Tunai','Kredit') as bayar,(select nm_pengguna from admin where id=tbl_retur_pembelian.user) as kasir,  
                           IF(nm_supplier<>'',nm_supplier,'Umum') as supplier from tbl_retur_pembelian where no_transaksi='$id'");
$data = mysqli_fetch_array($sql);



?>

         
		  
		  <?php
		  	
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Retur Pembelian</h4>
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
								<a href=\"#\">Transaksi</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Retur Pembelian</a>
							</li>
						</ul>
					</div>";
		  
		  ?>


	
            <div class="card mb-12">
                <div class="card-header">
									<div class="card-title"><i><i class="fas fa-print"></i> Retur Pembelian</i></div>
								</div>
                <div class="card-body">
                  
				  <?php
				  
				  echo "<div id=\"container\">
						<center>
						<table style='width:80%; font-size:9pt; font-family:calibri; border-collapse: collapse;' border = '0'>
						<td width='70px' align='left' style='padding-right:80px; vertical-align:top'>
						<span style='font-size:12pt'><b></b></span></br>
						</td>
						<td style='vertical-align:top' width='30%' align='left'>
						<b><span style='font-size:12pt'>RETUR PEMBELIAN</span></b></br>
						No Trans. : $id</br>
						Tanggal : $data[tgl]</br>
						</td>
						</table>
						<table style='width:80%; font-size:9pt; font-family:calibri; border-collapse: collapse;' border = '0'>
						<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
						Nama Supplier : $data[supplier]</br>
						Alamat : -
						</td>
						<td style='vertical-align:top' width='30%' align='left'>
						No Telp : -
						</td>
						</table>
						<table cellspacing='0' style='width:80%; font-size:9pt; font-family:calibri;  border-collapse: collapse;' border='1'>
						 
						<tr align='center'>
							<td width='5%'>Kode<br>Barang</td>
							<td width='30%'>Nama Barang</td>
							<td width='10%'>Harga</td>
							<td width='4%'>Qty</td>
							<td width='10%'>Total Harga</td>
						</tr>";
						
						$baca = mysqli_query($conn,"SELECT  * FROM tbl_retur_pembelian_det where no_transaksi='$id' ORDER BY id");
						$no = 1;	
						while($fetchArray = mysqli_fetch_array($baca)){
														
						echo "<tr>
								<td style='text-align:center'>$fetchArray[kd_barang]</td>
								<td>$fetchArray[nm_barang]</td>
								<td style='text-align:right'>".number_format($fetchArray['harga'])."</td>
								<td style='text-align:center'>$fetchArray[jumlah]</td>
								<td style='text-align:right'>".number_format($fetchArray['total'])."</td>
							</tr>";
						}
						
						echo " 
						<tr>
							<td colspan = '4'><div style='text-align:right'>Total Belanja : </div></td>
							<td style='text-align:right'>".number_format($data['total'])."</td>
						</tr>
						<tr>
							<td colspan = '4'><div style='text-align:right'>Diskon : </div></td>
							<td style='text-align:right'>-".number_format($data['diskon'])." %</td>
						</tr>
						<tr>
							<td colspan = '4'><div style='text-align:right'>Pajak : </div></td>
							<td style='text-align:right'>".number_format($data['pajak'])." %</td>
						</tr>
						<tr>
							<td colspan = '4'><div style='text-align:right'>Total Yang Harus Di Bayar : </div></td>
							<td style='text-align:right'>".number_format($data['grand_total'])."</td>
						</tr>
						<tr>
							<td colspan = '4'><div style='text-align:right'>Jumlah Bayar : </div></td>
							<td style='text-align:right'>".number_format($data['dibayar'])."</td>
						</tr>
						<tr>
							<td colspan = '4'><div style='text-align:right'>Sisa : </div></td>
							<td style='text-align:right'>".number_format($data['saldo'])."</td>
						</tr>
						</table>
						 
						<table style='width:80%; font-size:9pt;' cellspacing='2' border=0>
						<tr>
						<td align='center'>Diterima Oleh,</br></br><u>(....................................................)</u></td>
						<td align='center'>TTD,</br></br><u>($data[supplier])</u></td>
						</tr>
						</table>
						</center>
						</div>";
				  
				  
				  ?>
			
				    
					
			    
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
											<form method=\"post\" action=\"welcome.php?modul=returpembelian&aksi=view\">
												<input type=\"hidden\" name=\"tgl1\" value=\"$tgl1\">
												<input type=\"hidden\" name=\"tgl2\" value=\"$tgl2\">
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