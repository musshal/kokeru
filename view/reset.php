<?php
    require_once('./db_login.php');
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
    $query="SELECT * FROM dashboard JOIN cleaning_service WHERE dashboard.id_cs=cleaning_service.id_cs";
    $sql="UPDATE dashboard SET status='BELUM', file_gambar=NULL WHERE id_ruang=".$id;
    $result=$db->query($sql);
    if (!$result){
        die ("Could not query the database: <br />". $db->error ."<br>Query: ".$sql);
    }  
    echo("<script>location.href ='home_manajer.php';</script>");
?>