<?php
$tahun = $tahun;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
</head>
<style>
* {
  margin: 0;
  padding: 0;
}
#chart-container {
  position: relative;
  height: 50vh;
  overflow: hidden;
}

</style>
<body>
  <div id="chart-container"></div>
  <script src="https://echarts.apache.org/en/js/vendors/echarts/dist/echarts.min.js"></script>
  <script>
var dom = document.getElementById('chart-container');
var myChart = echarts.init(dom, 'dark', {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};


var option;

option = {
  tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'cross',
      crossStyle: {
        color: '#999'
      }
    }
  },
  toolbox: {
    feature: {
      dataView: { show: true, readOnly: false },
      magicType: { show: true, type: ['line', 'bar'] },
      restore: { show: true },
      saveAsImage: { show: true }
    }
  },
  legend: {
	data: ['Pembelian', 'Penjualan']
  },
  xAxis: [
    {
      type: 'category',
      data: [
	  				   <?php
						$sql2 = mysqli_query($conn,"SELECT * FROM ms_bulan ORDER BY kode") or die (mysqli_error());
					 
						while ($row2 = mysqli_fetch_array($sql2)) {
							$kode = $row2['kode'];
							$bulan = $row2['nama'];
						?>
              "<?php echo $bulan ?>",
							
						<?php
						}
						?>
	  ],
      axisPointer: {
        type: 'shadow'
      }
    }
  ],
  yAxis: [
    {
      type: 'value',
      name: '',
      min: 0,
      max: 50000000,
      interval: 5000000,
      axisLabel: {
        formatter: '{value}'
      }
    }
  ],
  series: [
    {
      name: 'Pembelian',
      type: 'bar',
      tooltip: {
        valueFormatter: function (value) {
          return value + '';
        }
      },
      data: [
        			<?php
							  $sql3 = mysqli_query($conn,"SELECT b.kode,(SELECT IFNULL(SUM(debet-kredit),0) AS jum FROM tbl_jurnal 
                    WHERE MONTH(tbl_jurnal.tgl_transaksi)=b.kode AND left(tbl_jurnal.kd_akun,3)='5.1' AND YEAR(tbl_jurnal.tgl_transaksi)='$tahun') AS sal 
								    FROM ms_bulan b  GROUP BY b.kode ") or die (mysqli_error());
						 
							  while ($row3 = mysqli_fetch_array($sql3)) {
								$belanja = $row3['sal'];
							?>
								"<?php echo $belanja ?>",
								
							<?php
							}
							?>
      ]
    },
    {
      name: 'Penjualan',
      type: 'bar',
      tooltip: {
        valueFormatter: function (value) {
          return value + '';
        }
      },
      data: [
        			<?php
							  $sql4 = mysqli_query($conn,"SELECT b.kode,(SELECT IFNULL(SUM(kredit-debet),0) AS jum FROM tbl_jurnal 
                    WHERE MONTH(tbl_jurnal.tgl_transaksi)=b.kode AND left(tbl_jurnal.kd_akun,3)='4.1' AND YEAR(tbl_jurnal.tgl_transaksi)='$tahun') AS sal 
								    FROM ms_bulan b  GROUP BY b.kode ") or die (mysqli_error());
						 
							  while ($row4 = mysqli_fetch_array($sql4)) {
								$pendapatan = $row4['sal'];
							?>
								"<?php echo $pendapatan ?>",
								
							<?php
							}
							?>
      ]
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