<?php
session_start();
require_once('db_login.php');
if (isset($_POST['upload'])) {
    $msg = '';
    $valid = TRUE;
    $idruang = test_input($_POST['idruang']);
    if ($idruang == '') {
        $error_idruang = "idruang is required";
        $valid = FALSE;
        echo '<div class="notif-popup" id="notif" name="notif">';
        echo '<p style="margin-left:10px;margin-top:20px;margin-right:10px;">' . $error_idruang . '</p>';
        echo '<button class="btn btn-danger" onclick="closeNotif()" style="margin-left:140px;margin-bottom:20px;">Close</button>';
        echo '</div>';
    } else {
        $query = "SELECT * FROM dashboard WHERE id_ruang = $idruang";
        $hasil = mysqli_query($db, $query);
        if (!$hasil) {
            die("Could not query the database: <br />" . $db->error . "<br>Query: " . $sql);
        }
        $idtugas = $hasil->fetch_object();
        if ($idtugas->id_cs != $_SESSION['userid']) {
            $error_idruang = "ruangan ini bukan tanggung jawab anda";
            $valid = FALSE;
            echo '<div class="notif-popup" id="notif" name="notif">';
            echo '<p style="margin-left:10px;margin-top:20px;margin-right:10px;">' . $error_idruang . '</p>';
            echo '<button class="btn btn-danger" onclick="closeNotif()" style="margin-left:140px;margin-bottom:20px;">Close</button>';
            echo '</div>';
        }
    }
    if (test_input($_FILES['bukti']['name']) == '' || test_input($_FILES['bukti']['name']) == NULL) {
        $error_bukti = "photo required";
        $valid = FALSE;
        echo '<div class="notif-popup" id="notif" name="notif">';
        echo '<p style="margin-left:10px;margin-top:20px;margin-right:10px;">' . $error_bukti . '</p>';
        echo '<button class="btn btn-danger" onclick="closeNotif()" style="margin-left:140px;margin-bottom:20px;">Close</button>';
        echo '</div>';
    }

    if ($valid) {
        $target = "./uploads" . basename($_FILES['bukti']['name']);
        $file_gambar = $_FILES['bukti']['name'];
        $tgl = date("d/m/y");
        $sql = "UPDATE dashboard SET status='SUDAH', file_gambar='" . $file_gambar . "'WHERE id_ruang=" . $idruang;
        mysqli_query($db, $sql);

        if (move_uploaded_file($_FILES['bukti']['tmp_name'], $target)) {
            $msg = "Post upload success";
        } else {
            $msg = "There was a problem uploading image";
        }
    }
}
?>
<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Home-Cleaning Service</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <style>
        .card {
            margin: 0 auto;
            /* Added */
            float: none;
            /* Added */
            margin-bottom: 10px;
            /* Added */
        }

        /*pop up form*/
            {
            box-sizing: border-box;
        }

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
            bottom: 25%;
            right: 40%;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        .notif-popup {
            display: block;
            position: fixed;
            bottom: 40%;
            right: 40%;
            border: 3px solid #f1f1f1;
            z-index: 9;
            background-color: white;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text],
        .form-container input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus,
        .form-container input[type=password]:focus {
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
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }
    </style>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'></script>
</head>

<body oncontextmenu='return false' class='snippet-body'>
    <?php
    require_once('./db_login.php');
    ?>
    <?php include('./header_cs.html'); ?><br>

    <div class="card" style="width:70rem;">
        <div class="card-body">
            <h5><?php echo date('d/m/y') ?></h5>
            <h4>Anda ditugaskan untuk membersihkan ruangan</h4>
            <table class="table">
                <tr>
                    <th>ID Ruang</th>
                    <th>Status</th>
                    <th>Bukti</th>

                    <?php
                    if (!isset($_SESSION['userid'])) {
                        echo ("<script>location.href ='login_cs.php';</script>");
                    } else {
                        require_once('./db_login.php');
                        $cs_id = $_SESSION['userid'];
                        $sql = "SELECT * FROM dashboard JOIN cleaning_service ON dashboard.id_cs=cleaning_service.id_cs AND dashboard.id_cs=$cs_id";
                        $result = mysqli_query($db, $sql);
                        if (!$result) {
                            die("Could not query the database: <br />" . $db->error . "<br>Query: " . $sql);
                        }
                        $i = 1;
                        while ($row = $result->fetch_object()) {
                            echo '<tr>';
                            echo '<td>R.' . $row->id_ruang . '</td>';
                            echo '<td>' . $row->status . '</td>';
                            echo '<td>' . $row->file_gambar . '</td>';
                            echo '</tr>';
                            $i++;
                        }
                    }
                    ?>
            </table>

            <button class="btn btn-primary" onclick="openForm()">Upload Bukti</button>
            <div class="form-popup" id="myForm" name="popform">
                <form action="home_cs.php" class="form-container" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for id="idruang">No. Ruang</label>
                        <select class="form-control" name="idruang" id="idruang" value="<?php if (isset($idruang)) {
                                                                                            echo $idruang;
                                                                                        } ?>">
                            <option value="">--Kode Ruang--</option>
                            <?php
                            require_once('db_login.php');
                            $query = "SELECT * FROM dashboard JOIN cleaning_service ON dashboard.id_cs=cleaning_service.id_cs AND dashboard.id_cs=$cs_id ORDER BY dashboard.id_ruang";
                            $result = $db->query($query);
                            if (!$result) {
                                die("Could not query the database: <br />" . $db->error);
                            }
                            while ($row = $result->fetch_object()) {
                                echo '<option value="' . $row->id_ruang . '">R.' . $row->id_ruang . '</option>';
                            }
                            $result->free();
                            $db->close();
                            ?>
                        </select>
                        <div class="error"><?php if (isset($error_idruang)) echo $error_idruang; ?></div>
                    </div>
                    <p>Upload foto bukti</p>
                    <input type="hidden" name="size" value="1000000">
                    <div>
                        <input type="file" name="bukti">
                        <div class="error"><?php if (isset($error_bukti)) echo $error_bukti; ?></div>
                    </div>
                    <br>
                    <button class="btn btn-success" type="submit" name="upload" id="upload" value="upload image">Upload Bukti</a>
                        <button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }

        function closeNotif() {
            document.getElementById("notif").style.display = "none";
        }
    </script>
</body>

</html>