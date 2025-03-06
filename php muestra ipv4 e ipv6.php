<?php
// Obtener la dirección IPv4 del cliente
$ipv4 = $_SERVER['REMOTE_ADDR'];

// Obtener la dirección IPv6 del cliente (si está disponible)
$ipv6 = '';
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipv6 = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
    $ipv6 = $_SERVER['HTTP_CLIENT_IP'];
}

// Obtener el proveedor de la IP (ISP)
$isp = gethostbyaddr($ipv4); // Esto obtiene el nombre del host asociado a la IP
if ($isp === $ipv4) {
    $isp = "No se pudo determinar el proveedor";
}

// Mensaje predefinido para WhatsApp
$mensaje = "Mi dirección IPv4 es: $ipv4, mi dirección IPv6 es: $ipv6 y mi proveedor de internet es: $isp";
$mensajeCodificado = urlencode($mensaje);

// Número de WhatsApp
$numeroWhatsApp = "+528440000000";

// Enlace de WhatsApp
$enlaceWhatsApp = "https://wa.me/$numeroWhatsApp?text=$mensajeCodificado";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Dirección IP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.5rem;
            margin: 10px 0;
        }
        .isp {
            font-size: 1rem;
            color: #666;
            margin-top: 15px;
        }
        .icon {
            font-size: 1.5rem;
            margin-left: 10px;
        }
        .icon.valid {
            color: green;
        }
        .icon.invalid {
            color: red;
        }
        .whatsapp-button {
            margin-top: 30px;
            padding: 15px 30px;
            font-size: 1.2rem;
            color: #fff;
            background-color: #25d366;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .whatsapp-button:hover {
            background-color: #128c7e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mi Dirección IP</h1>
        <p>
            Tu dirección IPv4 es: <?php echo $ipv4; ?>
            <span class="icon <?php echo !empty($ipv4) ? 'valid' : 'invalid'; ?>">
                <?php echo !empty($ipv4) ? '✔️' : '❌'; ?>
            </span>
        </p>
        <p>
            Tu dirección IPv6 es: <?php echo !empty($ipv6) ? $ipv6 : 'No disponible'; ?>
            <span class="icon <?php echo !empty($ipv6) ? 'valid' : 'invalid'; ?>">
                <?php echo !empty($ipv6) ? '✔️' : '❌'; ?>
            </span>
        </p>
        <p class="isp">Proveedor de internet: <?php echo $isp; ?></p>
        <a href="<?php echo $enlaceWhatsApp; ?>" target="_blank" class="whatsapp-button">
            Enviar IP por WhatsApp
        </a>
    </div>
</body>
</html>
