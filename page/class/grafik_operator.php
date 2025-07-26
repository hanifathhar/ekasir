<?php

$skpd  =  $_SESSION['skpd'];
$pptk = $_SESSION['username'];

?>
<html>
	<head>

	<script src="assets/js/highcharts.js"></script>
    <script src="assets/js/jquery-1.10.1.min.js"></script>
	
    <script type="text/javascript">
	
	var chart1;
	$(document).ready(function() {
		chart1 = new Highcharts.Chart({
			chart: {
            	renderTo: 'container',
	            type: 'column'
    	    },   
        	title: {
            	text: ''
	        },
    	    xAxis: {
        	    categories: ['Realisasi']
	        },
    	    yAxis: {
        	    title: {
            	text: ''
            }
        },
		series:             
            
			[
				<?php 

				
				
				
				$sql = mysqli_query($conn,"SELECT * FROM ms_jenisbos ORDER BY kd") or die (mysqli_error());
				while ($data = mysqli_fetch_array($sql)) {
					$kode = $data['kd'];
					$nama =  $data['nm'];
					
					
					$sqljumlahkelas = mysqli_query($conn,"SELECT IFNULL(SUM(nilai),0) AS jumlah FROM trdtransout_fktp WHERE bos_jns='$kode' and kd_skpd='$skpd'")
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
