<html>
	<head>

	<script src="assets/js/highcharts.js"></script>
    <script src="assets/js/jquery-1.10.1.min.js"></script>
	
    <script type="text/javascript">
	
	var chart1;
	$(document).ready(function() {
		chart1 = new Highcharts.Chart({
			chart: {
            	renderTo: 'penjualan',
	            type: 'column'
    	    },   
        	title: {
            	text: ''
	        },
    	    xAxis: {
        	    categories: ['Tanggal']
	        },
    	    yAxis: {
        	    title: {
            	text: ''
            }
        },
		series:             
            
			[
				<?php 

				
				
				$tahun = date('Y');
				
				$sql = mysqli_query($conn,"SELECT tgl_transaksi AS kode,DATE_FORMAT(tgl_transaksi, '%d/%m/%Y') AS nama FROM tbl_pembayaran GROUP BY tgl_transaksi ORDER BY tgl_transaksi DESC LIMIT 5") or die (mysqli_error());
				while ($data = mysqli_fetch_array($sql)) {
					$kode = $data['kode'];
					$nama =  $data['nama'];
					
					
					$sqljumlahkelas = mysqli_query($conn,"SELECT IFNULL(SUM(grand_total),0) AS jumlah FROM tbl_pembayaran WHERE tgl_transaksi='$kode'")
						or die (mysqli_error());
					
					while ($datajumlah = mysqli_fetch_array($sqljumlahkelas)) {
						$jumlah = $datajumlah['jumlah'];
					}
				?>
				
					{
						name: '<?php echo "$nama"; ?>',
						data: [<?php echo $jumlah; ?>]
					},
				<?php 
				} 
				?>
            ]
		});
	});	
    </script>

	</head>
</html>
