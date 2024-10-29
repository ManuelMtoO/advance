<?php
// Array de vendedores con sus datos
$vendedores = [
    "7"=>[
        "nombre"=>"WILLIAM CESPEDES",
        "cia"=>"eyh",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "wcespedesv@equiposperu.com",
        "telefono" => "998150218",
        "foto" => "../img/vendedores/7.jpg"
    ],
	"100"=>[
        "nombre"=>"Juan Javier Garcia Pacheco Olaechea",
        "cia"=>"ih",
        "cargo" => "Gerente de Ventas",
        "email" => "jgarciapacheco@igardi.com",
        "telefono" => "993296047",
        "foto" => "../img/vendedores/100.jpg"
    ],
    "9"=>[
        "nombre"=>"LEVANO ZAVALA",
        "cia"=>"eyh",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "jlevano@equiposperu.com",
        "telefono" => "970395045",
        "foto" => "../img/vendedores/9.jpg"
    ],
    "26"=>[
        "nombre"=>"JHOSMEL JAMBO",
        "cia"=>"eyh",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "jjambo@equiposperu.com",
        "telefono" => "970388830",
        "foto" => "../img/vendedores/26.jpg"
    ],
    "34"=>[
        "nombre"=>"ALVARO CASTRO",
        "cia"=>"ih",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "acastro@igardi.com",
        "telefono" => "997366777",
        "foto" => "../img/vendedores/34.jpg"
    ],
    "38"=>[
        "nombre"=>"HVIDAURRE",
        "cia"=>"ih",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "jvidaurre@igardi.com",
        "telefono" => "997711248",
        "foto" => "../img/vendedores/38.jpg"
    ],
    "41"=>[
        "nombre"=>"RUBEN MEZA",
        "cia"=>"eyh",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "rmeza@equiposperu.com",
        "telefono" => "951515009",
        "foto" => "../img/vendedores/41.jpg"
    ],
    "48"=>[
        "nombre"=>"ANDERSON ROJAS",
        "cia"=>"eyh",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "arojas@equiposperu.com",
        "telefono" => "97039556",
        "foto" => "../img/vendedores/48.jpg"
    ],
    "54"=>[
        "nombre"=>"GIANCARLO VIDAURRE",
        "cia"=>"ih",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "ventasm01@igardi.com",
        "telefono" => "986912415",
        "foto" => "../img/vendedores/54.jpg"
    ],
    "68"=>[
        "nombre"=>"RENAN HERREROS",
        "cia"=>"eyh",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "rherreros@equiposperu.com",
        "telefono" => "970389533",
        "foto" => "../img/vendedores/68.jpg"
    ],
    "70"=>[
        "nombre"=>"JORGE ALEJANDRO",
        "cia"=>"ih",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "jalejandro@igardi.com",
        "telefono" => "910025174",
        "foto" => "../img/vendedores/70.jpg"
    ],
    "91"=>[
        "nombre"=>"KELLY MARCAQUISPE",
        "cia"=>"ih",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "kmarcaquispe@igardi.com",
        "telefono" => "906820112",
        "foto" => "../img/vendedores/91.jpg"
    ],
    "94"=>[
        "nombre"=>"JACKELYNE CHAMORRO",
        "cia"=>"ih",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "jchamorro@igardi.com",
        "telefono" => "963709120",
        "foto" => "../img/vendedores/94.jpg"
    ],
    "112"=>[
        "nombre"=>"RAPHAEL SANMIGUEL",
        "cia"=>"eyh",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "rsanmiguel@equiposperu.com",
        "telefono" => "970393918",
        "foto" => "../img/vendedores/112.jpg"
    ],
    "128"=>[
        "nombre"=>"HILDEBRANDO CACERES",
        "cia"=>"eyh",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "ventas@equiposperu.com",
        "telefono" => "981334062",
        "foto" => "../img/vendedores/128.jpg"
    ],
    "174"=>[
        "nombre"=>"JONATHAN MONTENEGRO",
        "cia"=>"ih",
        "cargo" => "Ejecutivo de Ventas",
        "email" => "ventasm03@igardi.com",
        "telefono" => "970388014",
        "foto" => "../img/vendedores/174.jpg"
    ],
];

// Verifica si se pasó un parámetro GET con el vendedor
$vend = isset($_GET['vend']) ? $_GET['vend'] : null;
$cia = isset($_GET['cia']) ? $_GET['cia'] : null;
$urlForm="../reg_visit/reg_cli_event.php?vend=$vend&cia=$cia";
if($cia == 'ih'){
	$urlImg = '../img/IGARDI.png';
	$urlWeb='www.igardi.com';
}else{
	$urlImg = '../img/equipos.png';
	$urlWeb='www.equiposperu.com';
}
//$urlImg = ($cia == 'ih') ? '../img/IGARDI.png' : '../img/equipos.png';
$url="http://143.0.250.67/comercial/reg_visit/reg_cli_event.php?vend=$vend&cia=$cia";
// Comprueba si el vendedor existe en el array
if (isset($vendedores[$vend])) {
    $vendedor = $vendedores[$vend];
} else {
    // Si el vendedor no existe, muestra un mensaje de error
    echo "Vendedor no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarjeta de Presentación - <?php echo $vendedor['nombre']; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para los íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            text-align: center;
        }
        .contact-info i {
            margin-right: 10px;
            color: #e63946;
        }
        .contact-info a {
            color: black;
            text-decoration: none;
        }
        .contact-info a:hover {
            text-decoration: underline;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .photo {
            max-width: 150px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <img src="<?php echo $urlImg; ?>" alt="Logo" class="logo">
                    <!-- Nombre y Cargo -->
                    <h3 class="mt-3"><?php echo $vendedor['nombre']; ?></h3>
                    <p class="text-muted"><?php echo $vendedor['cargo']; ?></p>
                    <!-- Foto -->
                    <img src="<?php echo $vendedor['foto']; ?>" alt="Foto de <?php echo $vendedor['nombre']; ?>" class="photo mb-3">
                    <!-- Información de Contacto -->
                    <div class="contact-info">
                        <p>
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:<?php echo $vendedor['email']; ?>"><?php echo $vendedor['email']; ?></a>
                        </p>
                        <p>
                            <i class="fas fa-phone-alt"></i>
                            <a href="https://wa.me/51<?php echo $vendedor['telefono']; ?>" target="_blank"> <?php echo $vendedor['telefono']; ?></a>
                        </p>
                        <p>
                            <i class="fas fa-globe"></i>
                            <a href="<?php echo 'https://'.$urlWeb; ?>" target="_blank"><?php echo $urlWeb; ?></a>
                        </p>
                        <p>
                            <i class="fas fa-file-alt"></i>
                            <a href="<?php echo $urlForm; ?>" target="_blank">Registar Cliente</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
