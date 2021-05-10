<!doctype html>
    <html>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>Home-Cleaning Service</title>
            <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
            <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
            <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
            <style>body {
                 background: #eee
            }

            .header2 {
                font-family: "Montserrat", sans-serif;
                color: #8d97ad;
                font-weight: 300
            }

            .header2.bg-success-gradiant {
                background: #2cdd9b;
                background: -webkit-linear-gradient(legacy-direction(to right), #2cdd9b 0%, #1dc8cc 100%);
                background: -webkit-gradient(linear, left top, right top, from(#2cdd9b), to(#1dc8cc));
                background: -webkit-linear-gradient(left, #2cdd9b 0%, #1dc8cc 100%);
                background: -o-linear-gradient(left, #2cdd9b 0%, #1dc8cc 100%);
                background: linear-gradient(to right, #2cdd9b 0%, #1dc8cc 100%)
            }

            .header2 .font-12 {
                font-size: 12px
            }

            .header2 .dropdown-item {
                padding: 8px 1rem;
                color: #8d97ad
            }

            .header2 .h2-nav .navbar-nav .nav-item .nav-link {
                padding: 12px 0px;
                color: #ffffff;
                font-weight: 400
            }

            .header2 .h2-nav .navbar-nav .nav-item .nav-link:hover {
                color: #263238
            }

            .header2 .h2-nav .navbar-nav .nav-item {
                margin: 0 20px
            }

            @media (min-width: 1024px) {
                .header2 .navbar-nav>.dropdown .dropdown-menu {
                    min-width: 210px;
                    margin-top: 0px
                }
            }

            @media (min-width: 1024px) {
                .header2 .dropdown-submenu:hover>.dropdown-menu {
                    display: block
                }
            }

            .header2 .dropdown-toggle::after {
                display: none
            }

            @media (min-width: 1024px) {
                .header2 .hover-dropdown .navbar-nav>.dropdown:hover>.dropdown-menu {
                    display: block;
                    margin-top: 0px
                }
            }

            .header2 .btn-dark {
                color: #fff;
                background-color: #343a40;
                border-color: #343a40
            }

            .header2 .btn-dark:hover {
                color: #fff;
                background-color: #23272b;
                border-color: #1d2124
            }

            .header2 .h2-nav .navbar-nav .nav-item .btn {
                opacity: 0.5
            }

            .header2 .h2-nav .navbar-nav .nav-item .btn:hover {
                opacity: 1
            }

            .header2 .dropdown-submenu>.dropdown-menu {
                top: 0;
                left: 100%;
                margin-left: 0;
                border-radius: 0.25rem;
                display: none
            }</style>
            <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
            <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'></script>
            <script type='text/javascript'></script>
        </head>
        <body oncontextmenu='return false' class='snippet-body'>
        <?php
            session_start();
            require_once('db_login.php');
        ?>
        <?php include('./header_cs.html');?>
            <br>
            <div class="card" style="width: 12cm; height: 10cm; left: 35%; top: 15%;">
                <div class="card-header"></div>
                <div class="card-body">
                    <table>
                    <?php
								
				
                        require_once('./db_login.php');
                        $query = "SELECT nama_cs, email_cs, telp_cs FROM cleaning_service WHERE id_cs = '".$_SESSION['userid']."'";
            $result = $db->query($query);
                        if (!$result){
                             die ("Could not query the database: <br />". $db->error ."<br>Query: ".$query);
                        }
                        
                        while ($row = $result->fetch_object()){
                            echo '<tr>';
                            echo '<td>Nama</td>';
                            echo '<td>'.$row->nama_cs.'</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>Email</td>';
                            echo '<td>'.$row->email_cs.'</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>No. Telp.</td>';
                            echo '<td>'.$row->telp_cs.'</td>';
				            echo '</tr>';
                            
                        }
                    ?>
                    
                    </table>
                    <br>
                    <br>
                    <button type="button" class="btn btn-success" id="edit profile" href="#">Edit</button>
                </div>
            </div>
        </body>
        <script>
        </script>
        </html>