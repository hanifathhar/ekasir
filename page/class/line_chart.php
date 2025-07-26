<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Basic Line Chart - Apache ECharts Demo</title>
</head>
<style>
* {
  margin: 0;
  padding: 0;
}
#chart-container {
  position: relative;
  height: 100vh;
  overflow: hidden;
}
</style>
<body>
  <div id="chart-container"></div>
  <script src="https://echarts.apache.org/en/js/vendors/echarts/dist/echarts.min.js"></script>
  <script>
	var dom = document.getElementById('chart-container');
	var myChart = echarts.init(dom, null, {
	  renderer: 'canvas',
	  useDirtyRect: false
	});
	var app = {};
	
	
	var option;
	
	option = {
	  xAxis: {
		type: 'category',
		data: [
						<?php
						$sql = mysqli_query($conn,"SELECT * FROM ms_bulan ORDER BY kode") or die (mysqli_error());
					 
						while ($row = mysqli_fetch_array($sql)) {
							$kode = $row['kode'];
							$bulan = $row['nama'];
						?>
                            "<?php echo $bulan ?>",
							
						<?php
						}
						?>
		]
	  },
	  yAxis: {
		type: 'value'
	  },
	  series: [
		{
		  data: [
		  
		  					<?php
							$sql2 = mysqli_query($conn,"SELECT b.kode,(SELECT SUM(kredit-debet) AS jum FROM tbl_jurnal WHERE MONTH(tbl_jurnal.tgl_transaksi)=b.kode AND LEFT(tbl_jurnal.kd_akun,1)='4') AS sal 
								    FROM ms_bulan b  GROUP BY b.kode ") or die (mysqli_error());
						 
							while ($row2 = mysqli_fetch_array($sql2)) {
								$jumlah = $row2['sal'];
							?>
								"<?php echo $jumlah ?>",
								
							<?php
							}
							?>
		  
		  ],
		  type: 'line'
		}
	  ]
	};
	
	
	if (option && typeof option === 'object') {
	  myChart.setOption(option);
	}
	
	window.addEventListener('resize', myChart.resize);
	</script>

</body>
</html>