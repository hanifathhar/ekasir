<html>
	<head>

	<script src="assets/js/highcharts.js"></script>
    <script src="assets/js/jquery-1.10.1.min.js"></script>
	
    <script type="text/javascript">
	
	var chart1;
	$(document).ready(function() {
		chart1 = new Highcharts.Chart({
			chart: {
            	renderTo: 'terlaris',
	            type: 'column'
    	    },   
        	title: {
            	text: ''
	        },
    	    xAxis: {
        	    categories: ['Jumlah']
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
				
				$sql = mysqli_query($conn,"SELECT  * FROM tbl_barang WHERE terjual<>'0' ORDER BY terjual DESC LIMIT 5") or die (mysqli_error());
				while ($data = mysqli_fetch_array($sql)) {
					$kode = $data['kd_barang'];
					$nama =  $data['nm_barang'];
					
					
					$sqljumlahkelas = mysqli_query($conn,"SELECT SUM(terjual) AS jumlah FROM tbl_barang WHERE kd_barang='$kode'")
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
