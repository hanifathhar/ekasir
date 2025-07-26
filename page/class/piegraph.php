<?php
$user = $_SESSION['username'];
$pass = $_SESSION['password'];

?>
<!DOCTYPE html>
<html lang="en">
<head>

<script src="assets/js/highcharts.js"></script>
<script src="assets/js/jquery-1.10.1.min.js"></script>
	<!-- Bagian css -->
	<script>
		var chart; 
		$(document).ready(function() {
			  chart = new Highcharts.Chart(
			  {
				  
				 chart: {
					renderTo: 'mygraph_belanja',
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				 },   
				 title: {
					text: ''
				 },
				 tooltip: {
					formatter: function() {
						return '<b>'+
						this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' % ';
					}
				 },
				 
				
				 plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							color: '#000000',
							connectorColor: 'green',
							formatter: function() 
							{
								return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.percentage, 2) +' % ';
							}
						}
					}
				 },
       
					series: [{
					type: 'pie',
					name: 'Browser share',
					data: [
					<?php
						$sql = mysqli_query($conn,"SELECT * FROM tbl_barang") or die (mysqli_error());
					 
						while ($row = mysqli_fetch_array($sql)) {
							$kode = $row['kd_barang'];
							//$nama = ucwords(strtolower($row['nm_beban']));
							$nama = $row['nm_barang'];
							
								$data = mysqli_query($conn,"SELECT IFNULL(SUM(stock),0) AS jumlah from tbl_barang where kd_barang='$kode'")
						            or die (mysqli_error());
							
							
							while ($datajumlah = mysqli_fetch_array($data)) {
						           $jumlah = $datajumlah['jumlah'];
					        }
							
							?>
							[ 
								'<?php echo $nama ?>', <?php echo $jumlah; ?>
							],
							<?php
						}
						?>
			 
					]
				}]
			  });
		});	
	</script>
	<script src="assets/js/highcharts.js"></script>
    <script src="assets/js/jquery-1.10.1.min.js"></script>
	
</head>
</html>
