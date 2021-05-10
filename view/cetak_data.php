<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Cetak Laporan</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
    <style>
        .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
    }
    </style>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'></script>
</head>
<body oncontextmenu='return false' class='snippet-body'>
    <?php 
        session_start();
        if(!isset($_SESSION['username']))
        {
            echo("<script>location.href ='login_cs.php';</script>");
        }
    ?>
    <?php include('./header_manajer.html');?>
    <?php
        require_once("./db_login.php");
        $output = '';
        if(isset($_GET["export"])){
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=data.xls');
            if($status=='SEMUA'||$status=='')
            {
                $query = "SELECT * FROM daily_record";
            }
            else{
                $query = "SELECT * FROM daily_record WHERE status='$status'";
            }
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) > 0){
                echo '<table class="table" bordered="1">'; 
                echo '<tr>'; 
                echo '<th>No</th>'; 
                echo '<th>No. Ruang</th>';
                echo '<th>Nama CS</th>';
                echo '<th>Status</th>'; 
                echo '</tr>';
                $i=1;
            while($row = mysqli_fetch_array($result)){
                echo'<tr>'; 
                echo '<td>'.$i.'</td>';
                echo '<td>'.$row["id_ruang"].'</td>' ;
                echo '<td>'.$row["nama_cs"].'</td>';
                echo '<td>'.$row["status"].'</td>'; 
                echo '</tr>';
                $i++;
            }
            echo '</table>';
            }
        }
    ?>
    <br>
    <div class="card" style="width:70rem;">
        <div class="card-body">
            <h1>Cetak Laporan Harian</h1><br>
            <p>Masukkan tanggal dan status kebersihan yang ingin dicetak</p>
            <form action="" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id;?>">
                <div class=row>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Laporan</label>
                            <input type="date" class="form-control "id="tanggal" value="<?= isset($_GET['date']) ? $_GET['date'] : date("Y-m-d"); ?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="status_bersih">Status</label>
                            <select class="form-control" name="status_bersih">
                                <option value="">--Pilih Status--</option>
                                <option value="semua" <?php if (isset($_GET['status']) && $_GET['status'] == 'semua') { echo 'selected'; } ?>>SEMUA</option>
                                <option value="sudah" <?php if (isset($_GET['status']) && $_GET['status'] == 'sudah') { echo 'selected'; } ?>>SUDAH</option>
                                <option value="belum" <?php if (isset($_GET['status']) && $_GET['status'] == 'belum') { echo 'selected'; } ?>>BELUM</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" name="export "class="btn btn-success" style="margin-right: 10px;" id="export" value="export">Export to Excel</button>
                <button type="submit" name="tampil" class="btn btn-primary" style="margin-right: 10px;">Tampilkan</button>
            </form>
                <table>
                    <tr>
                        <th>No.</th>
                        <th>No. Ruang</th>
                        <th>Nama CS</th>
                        <th>Status</th>
                    </tr>
            <?php
                 if(isset($_GET['tampil']))
                 {
                    $status=$_GET['status'];
                    $date=$_GET['date'];
                    if($status=''||$status=='semua')
                    {
                        $query="SELECT * FROM daily_record WHERE date='$date'";
                    }
                    else
                    {
                        $query="SELECT * FROM daily_record WHERE date='$date' AND status='$status' "; 
                    }
                    $result=mysqli_query($db,$query);
                    if(!$result)
                    {
                        die ("Could not query the database: <br />". $db->error ."<br>Query: ".$query);
                    }
                    $i=1;
                    while($row=$result->fetch_object())
                    {
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$row->id_ruang.'</td>';
                        echo '<td>'.$row->nama_cs.'</td>';
                        echo '<td>'.$row->status.'</td>';
                        echo '</tr>';
                        $i++;
                    }
                 }
            ?>
            </table>
            </div>
    </div>
</body>
</html>