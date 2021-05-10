<?php
    require_once('./db_login.php');
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
    $sql="DELETE FROM manajer WHERE id_manajer=".$id;
    $result=$db->query($sql);
    if (!$result){
        die ("Could not query the database: <br />". $db->error ."<br>Query: ".$sql);
    }  
    echo("<script>location.href ='data_manajer.php';</script>");
?>