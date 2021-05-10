<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Kokeru - Login CS</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" href="../public/style.css">
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'></script>
</head>

<body oncontextmenu='return false' class='snippet-body'>
    <?php
    session_start();
    require_once('./db_login.php');

    if (isset($_POST["submit"])) {
        $valid = TRUE;
        $email = test_input($_POST['email']);
        if ($email == '') {
            $error_email = "Email is required";
            $valid = FALSE;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_email = "Invalid email format";
            $valid = FALSE;
        }
        $password = test_input($_POST['password']);
        if ($password == '') {
            $error_password = "Password is required";
            $valid = FALSE;
        }

        if ($valid) {
            $query = " SELECT * FROM cleaning_service WHERE email_cs='" . $email . "'AND pass='" . $password . "' ";
            $result = $db->query($query);
            if (!$result) {
                die("Could not query the database: <br />" . $db->error);
            } else {
                if ($result->num_rows > 0) {
                    $sesi = $result->fetch_object();
                    $_SESSION['userid'] = $sesi->id_cs;
                    header('Location: home_cs.php');
                    exit;
                } else {
                    echo '<span class="error">Combination of username and password are not correct.</span>';
                }
            }
            $db->close();
        }
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form class="box" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <h1>KOKERU</h1>
                        <p class="text-muted">Masukkan Nama Pengguna dan Kata Sandi Anda!</p>
                        <div class="form-group">
                            <p class="text-muted">Email</p>
                            <input type="email" class="form-control" id="email" name="email" size="30" value="<?php if (isset($email)) echo $email; ?>">
                            <div class="error"><?php if (isset($error_email)) echo $error_email; ?></div>
                        </div>
                        <div class="form-group">
                            <p class="text-muted">Password</p>
                            <input type="password" class="form-control" id="password" name="password" value="">
                            <div class="error"><?php if (isset($error_password)) echo $error_password; ?></div>
                        </div>
                        <a class="forgot text-muted" href="login_manajer.php">Login Manajer</a>
                        <br>
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>