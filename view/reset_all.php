<?php
    require_once('./db_login.php');
    $date=date("d/m/y");
    $query="SELECT * FROM dashboard JOIN cleaning_service WHERE dashboard.id_cs=cleaning_service.id_cs";
    $result1=$db->query($query);
    if (!$result1){
        die ("Could not query the database: <br />". $db->error ."<br>Query: ".$query);
    }
    
    while($row=$result1->fetch_object())
    {
        $rekam="INSERT INTO daily_record(id_ruang,id_cs,nama_cs,status,date) VALUES (".$row->id_ruang.",".$row->id_cs.",'".$row->nama_cs."','".$row->status."','".$date."')";
        $record=$db->query($rekam);
        if (!$record){
            die ("Could not query the database: <br />". $db->error ."<br>Query: ".$rekam);
        }
    }  
    
    $sql="UPDATE dashboard SET status='BELUM', file_gambar=NULL WHERE id_ruang>=1";
    $result=$db->query($sql);
    if (!$result){
        die ("Could not query the database: <br />". $db->error ."<br>Query: ".$sql);
    }  
    echo("<script>location.href = 'home_manajer.php';</script>");
?>