<?php
    require_once('./db_login.php');
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
    $query="UPDATE dashboard SET id_cs=NULL WHERE id_cs=".$id;
    $result1=$db->query($query);
    if (!$result){
        die ("Could not query the database: <br />". $db->error ."<br>Query: ".$sql);
    }  
    $sql="DELETE FROM cleaning_service WHERE id_cs=".$id;
    $result=$db->query($sql);
    if (!$result){
        die ("Could not query the database: <br />". $db->error ."<br>Query: ".$sql);
    }  
    echo("<script>location.href ='data_cs.php';</script>");
?>