<div class="container mt-4">
      
            <!-- diagram garis akan kita tampilkan disini -->
            <canvas id="myChart2"></canvas>
                        
        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        <script>
            //mebuat chart
            var myChart2 = new Chart(
                //masukan chart ke element canvas dengan id myChart2
                document.getElementById('myChart2'),
                {
                    //tipe chart yg digunakan adalah line chart atau diagram garis
                    type: 'line',
                    data: {
                        //data labels akan diganti dengan data api pada step berikutnya
                        labels: [
						
						<?php
						$sql = mysqli_query($conn,"SELECT DATE_FORMAT(tgl_transaksi, '%d/%m/%Y') as tgl FROM tbl_jurnal  WHERE kd_akun='4' GROUP BY tgl_transaksi ORDER BY tgl_transaksi DESC LIMIT 5") or die (mysqli_error());
					 
						while ($row = mysqli_fetch_array($sql)) {
							$tanggal = $row['tgl'];
						?>
                            "<?php echo $tanggal ?>",
							
						<?php
						}
						?>
                        ],
                        datasets: [{
                            label: 'Penjualan',
                            //data akan diganti dengan data api pada step berikutnya
                            data: [
							
							<?php
							$sql2 = mysqli_query($conn,"SELECT b.tgl_transaksi,(SELECT SUM(kredit-debet) AS jum FROM tbl_jurnal WHERE tbl_jurnal.tgl_transaksi<=b.tgl_transaksi AND tbl_jurnal.kd_akun='4') AS sal 
												 FROM tbl_jurnal b  WHERE b.kd_akun='4' GROUP BY b.tgl_transaksi DESC LIMIT 5") or die (mysqli_error());
						 
							while ($row2 = mysqli_fetch_array($sql2)) {
								$jumlah = $row2['sal'];
							?>
								"<?php echo $jumlah ?>",
								
							<?php
							}
							?>
                            ],
                            //line akan diwarnai dengan warna merah
                            backgroundColor: [
                            'rgb(255, 40, 0)',
                            ],
                            hoverOffset: 30
                        }]
                    }
                }
            );
        </script>

