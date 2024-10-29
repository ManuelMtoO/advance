<?php
session_start(); 
$cia = (isset($_GET["cia"]) && $_GET["cia"]) ? $_GET["cia"] : "";
$urlImg = ($cia == 'ih') ? '../img/IGARDI.png' : '../img/equipos.png';
$nameCia = ($cia == 'Igardi Herramientas SAC') ? 'Equipos y Herramientas SAC' : '../img/equipos.png';
$_SESSION['xcia'] = $cia;
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
    <script src="../js/visit.js"></script> <!-- Archivo externo de jQuery -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #EAE6E2; /* Color principal del logo */
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #dc3545; /* Borde de tarjeta con color secundario del logo */
        }
        .card-header {
            background-color: #dc3545; /* Color principal del logo */
            color: #fff; /* Color secundario del logo */
        }
        .footer {
            padding: 20px 0;
            background-color: #000000; /* Color principal del logo */
            border-top: 1px solid #e7e7e7;
        }
        .footer p {
            color: #ff6600; /* Color secundario del logo */
        }

        /* Estilos para pantallas grandes */
        @media (min-width: 992px) {
            .container {
                margin-top: 50px; /* Ajuste de margen superior para pantallas grandes */
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

    <!-- Contenido Principal -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">Registro de Visitas</h2>
                    </div>
                    <div class="card-body">
                        <form id="registroForm" class="ajaxForm" data-url="controler.php">
                            <input type="hidden" name="accion" value="reg_visit">
                            <input type="hidden" id="ruc_cli" name="ruc_cli" value="">
                            <input type="hidden" id="cia" name="cia" value="<?php echo $cia ?>">
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="vendedor">Vendedor:</label>
                                    <select id="vendedor" name="vendedor" class="form-control" required>
                                        <option value="">Seleccionar...</option>
                                        <!-- Agrega las opciones de vendedores -->
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="motivo">Motivo:</label>
                                    <select id="motivo" name="motivo" class="form-control" required>
                                        <option value="">Seleccionar...</option>
                                        <!-- Agrega las opciones de motivos -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="fecha">Fecha:</label>
                                    <input type="date" id="fecha" name="fecha" class="form-control" required>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="hora">Hora:</label>
                                    <input type="time" id="hora" name="hora" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre_cliente">Nombre de Cliente:</label>
                                <input type="text" id="nombre_cliente" name="nombre_cliente" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input type="text" id="direccion" name="direccion" class="form-control" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="provincia">Provincia:</label>
                                    <select id="provincia" name="provincia" class="form-control" required>
                                        <option value="">Seleccionar...</option>
                                        <!-- Agrega las opciones de provincias -->
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="distrito">Distrito:</label>
                                    <select id="distrito" name="distrito" class="form-control" required>
                                        <option value="">Seleccionar...</option>
                                        <!-- Agrega las opciones de distritos -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="observacion">Observación:</label>
                                <textarea id="observacion" name="observacion" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="contacto">Contacto:</label>
                                    <input type="text" id="contacto" name="contacto" class="form-control" required>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="nro_contacto">Nro de Contacto:</label>
                                    <input type="number" id="nro_contacto" name="nro_contacto" class="form-control" required>
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <label for="mail_contacto">Correo Contacto:</label>
                                <input type="text" id="mail_contacto" name="mail_contacto" class="form-control" required>
                            </div>-->
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
