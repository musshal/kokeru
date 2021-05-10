<?php
session_start();
require_once("./db_login.php");
$output = '';
if(isset($_GET["export"])){
   $query = "SELECT * FROM daily_record";
   $result = mysqli_query($db, $query);
   if(mysqli_num_rows($result) > 0){
      $output .= '<table class="table" bordered="1"> 
                <tr> 
                     <th>No</th> 
                     <th>No. Ruang</th>
                     <th>Nama CS</th>
                     <th>Status</th> 
                </tr>';
        $i=1;
      while($row = mysqli_fetch_array($result)){
         $output .= '<tr> 
                       <td>'.$row["id_ruang"].'</td> 
                       <td>'.$row["nama_cs"].'</td>
                       <td>'.$row["status"].'</td> 
                    </tr>';
            $i++;
         }
      $output .= '</table>';
      header('Content-Type: application/xls');
      header('Content-Disposition: attachment; filename=data.xls');
      echo $output;
   }
}
?>