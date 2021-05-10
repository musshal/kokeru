<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Home-Manajer</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
    <style>
        .card {
            margin: 0 auto; /* Added */
            float: none; /* Added */
            margin-bottom: 10px; /* Added */    
        }
        .notif-popup {
            display: none;
            position: fixed;
            bottom: 40%;
            right: 30%;
            border: 3px solid #f1f1f1;
            z-index: 9;
            background-color: white;
        }
    </style>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'></script>
</head>
<body oncontextmenu='return false' class='snippet-body'>
<?php
    session_start();
    require_once('db_login.php');
?>
<?php include('./header_manajer.html');?>
<br>
<div class="mx-auto">
    <div class="card" style="width:70rem;">
        <div class="card-body">
            <h1 style="text-align:center;">Monitor Kebersihan Ruang</h1>
            <h3 style="text-align:center;">Gedung Bersama Maju</h3>
            <h5 style="text-align:center;">Tanggal : <?php echo date('d/m/y')?></h5>
            <?php
                if(!isset($_SESSION['username']))
                {
                    echo("<script>location.href ='login_manajer.php';</script>");
                }else{
                    require_once('./db_login.php');
                    $query="SELECT * FROM dashboard JOIN cleaning_service WHERE dashboard.id_cs=cleaning_service.id_cs ORDER BY dashboard.id_ruang";
                    $result=mysqli_query($db,$query);
                    if (!$result){
                        die ("Could not query the database: <br />". $db->error ."<br>Query: ".$query);
                    }
                    $i=1;
                    echo'<div class="row">';
                    while($kotak = $result->fetch_object())
                    {
                        echo'<div class="col-sm-4">';
                        if($kotak->status=="BELUM")
                        {
                            echo '<div class="card text-white bg-danger mb-3" style="max-width: 15rem;">';
                        }
                        else if($kotak->id_cs==NULL)
                        {
                            echo '<div class="card text-white bg-secondary mb-3" style="max-width: 15rem;">';
                        }
                        else
                        {
                            echo '<div class="card text-white bg-success mb-3" style="max-width: 15rem;">';
                        }
                        echo '<div class="card-header">'.$kotak->status.'</div>';
                        echo '<div class="card-body">';
                        echo '<h2 class="card-title">R.'.$kotak->id_ruang.'</h5>';
                        if ($kotak->id_cs==NULL)
                        {
                            echo '<p class="card-text">CS Belum Tersedia</p>';
                        }
                        else
                        {
                            echo '<p class="card-text">'.$kotak->nama_cs.'</p>';
                        }
                        if($kotak->status=="BELUM")
                        {
                            echo '<a href="#" class="btn btn-secondary"> Belum Ada Bukti</a>';
                        }
                        else if($kotak->id_cs==NULL)
                        {
                            echo '<br><p>Gunakan fitur Edit Ruang untuk menambahkan CS</p>';
                        }
                        else
                        {
                            echo '<a href="uploads/'.$kotak->file_gambar.'" class="btn btn-primary" style="margin-right:20px">Bukti</a>';
                            echo '<a class="btn btn-danger" href="reset.php?id='.$kotak->id_ruang.'" name="reset" value="">Reset</a>';
                        }
                        echo '</div>';
                        echo '</div>';
                        echo'</div>';
                        $i++;   
                    }
                    echo '</div>';
                }    
            ?>
            <div class="notif-popup" id="notif" name="notif">
                <p style="margin-left:10px;margin-top:20px;margin-right:10px;">Mereset semua data akan memasukkan data ke record harian.<br>Setelah dimasukkan data hari ini tidak boleh dimasukkan lagi.</p>
                <a class="btn btn-secondary" name="cancel" id="cancel" onclick="closeNotif()" style="margin-left:140px;margin-bottom:20px;">Batal</a>
                <a class="btn btn-danger" name="reset" id="reset" value="reset" href="reset_all.php" style="margin-left:20px;margin-bottom:20px;">Reset</a>
            </div>
            <a class="btn btn-success" name="edit" id="edit" value="" href="" style="margin-left:50px; margin-right: 10px;">Tambah Ruang</a>
            <a class="btn btn-success" name="edit" id="edit" value="" href="" style="margin-right: 10px;">Edit Ruang</a>
            <a class="btn btn-danger" name="resetall" id="reset-notif" value="reset" onclick="openNotif()" >Reset Semua Data Harian</a>
        </div>
    </div>
</div>
<script>
    function openNotif(){
        document.getElementById("notif").style.display = "block";
    }
    function closeNotif(){
        document.getElementById("notif").style.display = "none";
    }
</script>
</body>
</html>
