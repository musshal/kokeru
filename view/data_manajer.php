
<!doctype html>
    <html>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>Daftar Manajer</title>
            <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
            <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
            <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
            <style>
            /*pop up form*/
            {box-sizing: border-box;}

            /* Button used to open the contact form - fixed at the bottom of the page */
            .open-button {
                background-color: #555;
                color: white;
                padding: 16px 20px;
                border: none;
                cursor: pointer;
                opacity: 0.8;
                position: fixed;
                bottom: 23px;
                right: 28px;
                width: 280px;
            }

            /* The popup form - hidden by default */
            .form-popup {
                display: none;
                position: fixed;
                bottom: 35%;
                right: 40%;
                border: 3px solid #f1f1f1;
                z-index: 9;
            }

            /* Add styles to the form container */
            .form-container {
                max-width: 300px;
                padding: 10px;
                background-color: white;
            }

            /* Full-width input fields */
            .form-container input[type=text], .form-container input[type=password] {
                width: 100%;
                padding: 15px;
                margin: 5px 0 22px 0;
                border: none;
                background: #f1f1f1;
            }

            /* When the inputs get focus, do something */
            .form-container input[type=text]:focus, .form-container input[type=password]:focus {
                background-color: #ddd;
                outline: none;
            }

            /* Set a style for the submit/login button */
            .form-container .btn {
                background-color: #4CAF50;
                color: white;
                padding: 16px 20px;
                border: none;
                cursor: pointer;
                width: 100%;
                margin-bottom:10px;
                opacity: 0.8;
            }

            /* Add a red background color to the cancel button */
            .form-container .cancel {
                background-color: red;
            }

            /* Add some hover effects to buttons */
            .form-container .btn:hover, .open-button:hover {
                opacity: 1;
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
                echo("<script>location.href ='login_manajer.php';</script>");
            }
            include('./header_manajer.html');
        ?><br>
            <div class="card mx-auto" style="width:70rem;">
                <div class="card-body">
                    <h1>Daftar Manajer</h1>
                    <table class="table">
                        <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No.Telp</th>
                        <th>Action</th>
                    
                    <?php
                        require_once('./db_login.php');
                        $sql="SELECT * FROM manajer";
                        $result= mysqli_query($db,$sql);
                        if (!$result){
                             die ("Could not query the database: <br />". $db->error ."<br>Query: ".$sql);
                        }
                        $i = 1;
                        while ($row = $result->fetch_object()){
                            echo '<tr>';
                            echo '<td>'.$row->id_manajer.'</td>';
                            echo '<td>'.$row->nama_manajer.'</td>';
                            echo '<td>'.$row->email_manajer.'</td>';
                            echo '<td>'.$row->telp_manajer.'</td>';
                            echo '<td><button class="btn btn-primary" id="'.$row->id_manajer.'" name="edit" onclick="">Edit</button>';
                            echo '<button class="btn btn-danger" id="'.$row->id_manajer.'" name="delete" onclick="">Delete</button></td>';
				            echo '</tr>';
                            $i++;
                        }
                    ?>
                    </table>
                    
                    </div>
                </div>
            </div>   
    </body>
        
</html>