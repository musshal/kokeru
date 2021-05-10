<!DOCTYPE html>

<html>
<head>	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="bootstrap-4.5.2-dist/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/umd/popper.min.js"></script>
        <script src="bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
		<title>Register Penulis</title>
	
	
	
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@500&family=Fredoka+One&display=swap" rel="stylesheet">
	
</head>
	<style>
	header{height: 65px;
       background-image: url("images/header.jpg");
}

header .logo{ color: black;
	      font-family: "Fredoka One", cursive;
	      float: left;
	      margin-left: 2em;
}

body {background-image: url("images/body.png");
     background-attachment: fixed;
     background-size: 100% 100%;
}

.btn{ padding: .1rem .5rem;
      background: #B80000;
      font-weight: bold;
      color: #f2f2f2;
      border: .1px solid transparent;
      border-radius: .25rem;
}

.card{
    width: 30%;
    margin: 20px auto;
    background-color: #f2f2f2;
    border-radius: 25px;
    padding: 15px 20px;
    font-family: "Commissioner", sans-serif;
    color: #000000;
    transition: 0.5s;
    font-weight: bold;
}


</style>

<body>
	
	<header>
			<div class="logo">
			<h1 class="logo-text" style="color:white;"><span>GamersReview!</span></h1>
			</div>

	</header>
					
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
                }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
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
		<br>
		<br>
		<br>
		<div class="card" style="width: 40rem;">
			<div class="card-header" style="text-align:center">
				Form Register
			</div>
			<br>
			<form autocomplete="on" id="contact-form" name="contact-form" method="POST" style="margin-left: 10%; margin-right: 10%;">
				<div class="form-group">
					<label for="nama">Nama:</label>
					<input type="text" class="form-control" id="nama" name="nama" maxlength="50" value="<?php if(isset($nama)){echo $nama;} ?>">
					<div class="error" style="color: red"><?php if(isset($error_nama)) echo $error_nama;?></div>
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" class="form-control" id="email" name="email" value="<?php if(isset($email)){echo $email;} ?>">
					<div class="error" style="color: red"><?php if(isset($error_email)) echo $error_email;?></div>
				</div>
				<div class="form-group">
					<label for="alamat">Alamat:</label>
					<textarea class="form-control" id="alamat" name="alamat" rows="5"><?php if(isset($alamat)){echo $alamat;} ?></textarea>
					<div class="error" style="color: red"><?php if(isset($error_alamat)) echo $error_alamat;?></div>
				</div>
				<div class="form-group">
					<label for="kota">Kota:</label>
					<input type="text" class="form-control" id="kota" name="kota" maxlength="50" value="<?php if(isset($kota)){echo $kota;} ?>">
					<div class="error" style="color: red"><?php if(isset($error_kota)) echo $error_kota;?></div>
				</div>
				<div class="form-group">
					<label for="no_telp">Nomor Telepon:</label>
					<input type="number" class="form-control" id="no_telp" name="no_telp" maxlength="50" value="<?php if(isset($telp)){echo $telp;} ?>">
					<div class="error" style="color: red"><?php if(isset($error_telp)) echo $error_telp;?></div>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password1" name="password1" maxlength="50">
					<input type="password" class="form-control" id="password2" name="password2" maxlength="50" placeholder="Masukkan kembali password">
					<div class="error" style="color: red"><?php if(isset($error_password)) echo $error_password;?></div>
				</div>
				<br>
				<!-- submit, reset dan button -->
				<button type="submit" class="btn btn-success" name="submit" value="submit">
					Submit
				</button>
				<a class="btn" href="Login_User.php">
					Cancel
				</a>
			</form>
			<br>

	</body>
</html>