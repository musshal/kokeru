<?php 
  ob_start();
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
	<title>Laporan Harian</title>

  <style type="text/css">
    html,
    body {
      font-size: 16px;
    }

		body {
			font-family: 'Open Sans', sans-serif;
		}

    .container {
      width: 100%;
      max-width: 1200px;
      margin: 1em auto;
      position: relative;
    }

    .title {
      text-align: center;
    }

		table {
			margin: 3em auto;
			border-collapse: collapse;
		}

		table th,
		table td {
			border: 1px solid #3c3c3c;
			padding: 3px 8px;
		}

		a {
			background: blue;
			color: #fff;
			padding: 8px 10px;
			text-decoration: none;
			border-radius: 2px;
		}

    .approval {
      position: absolute;
      right: 0;
      margin: 2em 6em 0 0;
    }
	</style>
</head>
<body>
  
  <?php 
    $tanggal = $_GET['date'];
    $status = $_GET['status'];
  ?>

  <div class="container">
    <div class="title">
      <h1>Laporan Kebersihan dan Kerapian Ruangan</h1>
      <h3>Tanggal: <?= date('d-m-Y', strtotime($tanggal)); ?></h3>
      <p><em>&lt;Tanggal cetak: <?= date('d F Y, h:i:s'); ?>&gt;</em></p>
    </div>
    
    <table border="1" style="width: 100%;">
      <tr>
        <th>No.</th>
        <th>Ruang</th>
        <th>Nama CS</th>
        <th>Status</th>
      </tr>
      
      <?php
        if ($status == 'semua' || $status == '') {
          $query = "select nama_ruang, nama, status 
                    from laporan 
                    JOIN jadwal ON laporan.id_jadwal = jadwal.id_jadwal 
                    JOIN cs ON cs.id_cs = jadwal.id_cs 
                    JOIN ruang ON jadwal.id_ruang = ruang.id_ruang 
                    where DATE(created_at) = '$tanggal'";       
        } else {
          $query = "select nama_ruang, nama, status
                    from laporan 
                    JOIN jadwal ON laporan.id_jadwal = jadwal.id_jadwal 
                    JOIN cs ON cs.id_cs = jadwal.id_cs 
                    JOIN ruang ON jadwal.id_ruang = ruang.id_ruang 
                    where DATE(created_at) = '$tanggal' AND status = '$status'";
        }

        // koneksi database
        $koneksi = mysqli_connect("localhost", "root", "", "kokeru");

        // menampilkan data pegawai
        $data = mysqli_query($koneksi, $query);
        $no = 1;
        while ($d = mysqli_fetch_array($data)) {
      ?>
      <tr>
        <td><?= $no++;?></td>
        <td><?= $d['nama_ruang']; ?></td>
        <td><?= $d['nama']; ?></td>
        <td><?= $d['status']; ?></td>
      </tr>
      <?php } ?>
    </table>

    <div class="approval">
      <span>Approval</span><br><br><br><br>
      <span><?= $_SESSION['user']->nama; ?></span><br>
      <span>Manager</span>
    </div>
  </div>

	<script>
		window.print();
	</script>
</body>
</html>