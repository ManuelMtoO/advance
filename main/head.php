<?php
$cia = (isset($_GET["cia"]) && $_GET["cia"]) ? $_GET["cia"] : "";
$urlImg = ($cia == 'ih') ? '../img/IGARDI.png' : '../img/equipos.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Dashboard</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    


    <!-- Custom Styles -->
    <link rel="stylesheet" href="../styles/main.css"> 
    <link rel="stylesheet" href="../styles/reguser.css">
    <!-- <link rel="stylesheet" href="../styles/login.css"> -->
    <!-- <link rel="stylesheet" href="../styles/home.css"> -->

    <!-- Jquery -->
    <script src="../lib/jquery/query-min.js"></script>
    <script src="../lib/jquery/query-ui-min.js"></script>
    <script src="../js/login.js"></script>
    <script src="../js/reguser.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../img/CRMlogo.png" alt="logo" class="img-fluid">
                </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if($cia){ ?>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Customers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Logout</a>
                        </li>
                    </ul>
                </div>
            <?php } ?>
            
        </div>
    </nav>
