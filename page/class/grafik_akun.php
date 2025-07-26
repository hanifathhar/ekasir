<html>
	<head>

	<script src="assets/js/highcharts.js"></script>
    <script src="assets/js/jquery-1.10.1.min.js"></script>
	
    <script type="text/javascript">
	
	var chart1;
	$(document).ready(function() {
		chart1 = new Highcharts.Chart({
			chart: {
            	renderTo: 'akun',
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
				
				$sql = mysqli_query($conn,"SELECT * FROM ms_akun ORDER BY kd_akun") or die (mysqli_error());
				while ($data = mysqli_fetch_array($sql)) {
					$kode = $data['kd_akun'];
					$nama =  $data['nm_akun'];
					
					
					$sqljumlahkelas = mysqli_query($conn,"SELECT IFNULL(IF(rk='D',SUM(debet-kredit),SUM(kredit-debet)),0) AS jumlah FROM tbl_jurnal WHERE kd_akun='$kode'")
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
