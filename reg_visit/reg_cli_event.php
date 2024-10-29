<?php
session_start(); 
$cia = (isset($_GET["cia"]) && $_GET["cia"]) ? $_GET["cia"] : "";
$cod_ven = (isset($_GET["vend"]) && $_GET["vend"]) ? $_GET["vend"] : "";
$urlImg = ($cia == 'ih') ? '../img/IGARDI.png' : '../img/equipos.png';
$nameCia = ($cia == 'eyh') ? 'Equipos y Herramientas SAC' : 'Igardi Herramientas SAC';
$_SESSION['xcia'] = $cia;
$_SESSION['cod_ven'] = $cod_ven;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Importante para el diseño responsivo --> 
    <title>Registro de Visitas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/reg_cli.js"></script> <!-- Archivo externo de jQuery -->
    <style>
        body {
            /*background-img: #f8f9fa;*/
            
            background-image: url('../img/background/b2.jpg'); /* Ruta de la imagen de fondo */
            background-size: cover; /* La imagen cubre todo el fondo */
            background-position: center center; /* Centrar la imagen */
            background-attachment: fixed; /* Imagen fija al hacer scroll */
            background-repeat: no-repeat; /* No repetir la imagen */
        
        }
        .navbar {
            background-color: #fff; /* Color principal del logo */
        }
        .navbar-brand img {
            max-height: 40px;
            width: auto; /* Mantener la proporción */
        }
        .navbar-nav .nav-link {
            color: #000000; /* Color secundario del logo */
        }
        .container {
            margin-top: 20px; /* Ajuste de margen superior */
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 1);
            border: 1px solid #dc3545; /* Borde de tarjeta con color secundario del logo */
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con transparencia */
        }
        .card-header {
            background-color: #dc3545; /* Color principal del logo */
            color: #fff; /* Color secundario del logo */
        }
        .brand-section {
            padding: 20px 0;
            background-color: #f8f9fa;
            text-align: center;
        }
        .brand-section img {
            max-height: 80px;
            margin: 0 20px;
            transition: transform 0.3s ease-in-out;
        }
        .brand-section img:hover {
            transform: scale(1.1); /* Efecto hover para agrandar las imágenes */
        }
        .footer {
            margin: 20px 0 0 0;
            padding: 5px 0 5px 0;
            background-color: #fff; /* Color principal del logo */
            /*border-top: 1px solid #e7e7e7;*/
        }
        .footer p {
            color: #000; /* Color secundario del logo */
        }

        /* Estilos para pantallas grandes */
        @media (min-width: 992px) {
            .container {
                /*margin-top: 50px; /* Ajuste de margen superior para pantallas grandes */
            }
        }

        /* Estilos para pantallas medianas */
        @media (min-width: 768px) and (max-width: 991px) {
            .container {
                margin-top: 40px; /* Ajuste de margen superior para pantallas medianas */
            }
        }

        /* Estilos para pantallas pequeñas */
        @media (max-width: 767.98px) {
            .navbar-brand img {
                max-height: 30px; /* Ajuste para pantallas pequeñas */
            }
            .container {
                margin-top: 20px; /* Ajuste de margen superior para pantallas pequeñas */
            }
            .form-control, .btn {
                font-size: 14px; /* Reducir el tamaño del texto para pantallas pequeñas */
            }
            .card {
                margin: 10px; /* Añadir margen a las tarjetas para pantallas pequeñas */
            }
        }
    </style>
</head>
<body>
    <!-- Cabecera -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="<?php echo $urlImg ?>" alt="logo" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Acerca de</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
     <!-- Sección de marcas -->
     <!--<section class="brand-section">
        <div class="container">
            <img src="../img/logos/snapon.png" alt="Snapon">
            <img src="../img/marca2.png" alt="Marca 2">
            <img src="../img/marca3.png" alt="Marca 3">
            <img src="../img/marca4.png" alt="Marca 4">
        </div>
    </section>--> 
    <!-- Contenido Principal --> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">Registro Cliente</h2>
                    </div>
                    <div class="card-body">
                        <form id="registroForm" class="ajaxForm" data-url="controler.php">
                            <input type="hidden" name="accion" value="reg_cli">
                            <input type="hidden" id="tip_even" name="tip_even" value="">
                            <input type="hidden" id="cia" name="cia" value="<?php echo $cia ?>">
                            <input type="hidden" id="cod_ven" name="cod_ven" value="<?php echo $cod_ven ?>">
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="rs">Razón Social:</label>
                                    <input type="text" id="rs" name="rs" class="form-control">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="ruc">Ruc:</label>
                                    <input type="number" id="ruc" name="ruc" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="telefono">Telefono:</label>
                                    <input type="number" id="telefono" name="telefono" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo:</label>
                                <input type="email" id="correo" name="correo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="coment">Comentario:</label>
                                <textarea id="coment" name="coment" class="form-control" rows="4" cols="50"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <button type="submit" class="btn btn-danger btn-block">Registrar</button>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <button type="button" id="clearForm" class="btn btn-outline-secondary btn-block">Limpiar</button>
                                </div>
                            </div>
                            <div id="mensajeRegistro" style="display:none; margin-top: 10px;" class="alert alert-info">Registrando...</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de Página --> 
    <footer class="footer">
        <div class="container text-center">
            <p>&copy; 2024 <?php echo $nameCia; ?>. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>
