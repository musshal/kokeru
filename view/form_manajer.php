<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Form Data Manajer</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
    <style>

    </style>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'></script>
</head>
<body oncontextmenu='return false' class='snippet-body'>
<?php include('./header_manajer.html');?>
<?php
	require_once('./db_login.php');
    if(isset($_POST['submit']))
	{
		$valid = TRUE;
        $nama = test_input($_POST['nama']);
        if(empty($nama)){
            $error_nama = "<b>Nama harus diisi!</b>";
			$valid = FALSE;
        }elseif(!preg_match("/^[a-zA-Z ]*$/",$nama))
		{
            $error_nama = "<b>Nama hanya dapat berisi huruf dan spasi!";
			$valid = FALSE;
        }
        $email = test_input($_POST['email']);
		$query = "SELECT email FROM penulis where email='".$email."'";
        $result = $db->query($query);
		if (!$result){
			die ("Could not query the database: <br />". $db->error ."<br>Query: ".$query);
		}
		$i = 0;
		while ($row = $result->fetch_object()){
			$i++;
		}
        if($email =='')
		{
            $error_email = "<b>Email harus diisi!</b>";
			$valid = FALSE;
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
            $error_email = "<b>Format email tidak benar!</b>";
			$valid = FALSE;
        }
		elseif($i>0)
		{
			$error_email = "<b>Email sudah terdaftar!</b>";
			$valid = FALSE;
		}
        $alamat = test_input($_POST['alamat']);
        if ($alamat == '')
		{
            $error_alamat = "<b>Alamat harus diisi!</b>";
			$valid = FALSE;
        }
		$alamat = test_input($_POST['alamat']);
        if ($alamat == '')
		{
            $error_alamat = "<b>Alamat harus diisi!</b>";
			$valid = FALSE;
        }
		$kota = test_input($_POST['kota']);
        if ($kota == '')
		{
            $error_kota = "<b>Kota harus diisi!</b>";
			$valid = FALSE;
        }
		$telp = test_input($_POST['no_telp']);
        if ($telp == '')
		{
            $error_telp = "<b>Nomor telepon harus diisi!</b>";
			$valid = FALSE;
        }
		$password1 = test_input($_POST['password1']);
		$password2 = test_input($_POST['password2']);
        if ($password1 == '' || $password2 == '')
		{
            $error_password = "<b>Password harus diisi!</b>";
			$valid = FALSE;
        }
		elseif($password1 != $password2)
		{
			$error_password = "<b>Password tidak sama!</b>";
			$valid = FALSE;
		}
		if($valid)
		{
            $query = "INSERT INTO penulis (idpenulis,nama,email,password,alamat,kota,no_telp) VALUES(NULL,'".$nama."','".$email."','".md5($password1)."','".$alamat."','".$kota."',".$telp.")";
            $result = $db->query($query);
            if(!$result){
                die ("Could not query the database: <br />". $db->error. '<br>Query:'.$query);
            }else{
				$message = "Selamat, akun anda sekarang sudah terdaftar";
				echo "<script type='text/javascript'>alert('$message');</script>";
                $db->close();
                echo("<script>location.href = 'Login_User.php';</script>");
            }
        }
	}  
?>
<div class="card" style="width: 40rem;">