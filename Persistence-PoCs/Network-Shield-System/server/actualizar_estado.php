<?php
/**
 * ACTUALIZAR_ESTADO.PHP
 * Actúa como el receptor de "heartbeats" del agente.
 * Ubicación: Network-Shield-System/server/
 */

require 'db_config.php';

// Solo procesamos peticiones POST (las que envía el agente)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Captura de datos con detección de IP automática si falla el envío
    $ip     = $_POST['ip'] ?? $_SERVER['REMOTE_ADDR'];
    $nombre = $_POST['nombre'] ?? 'PC-Unknown';
    $os     = $_POST['os'] ?? 'Generic OS';

    try {
        // Query de inserción o actualización (Upsert)
        $sql = "INSERT INTO dispositivos (ip_address, nombre_dispositivo, sistema_operativo) 
                VALUES (:ip, :nombre, :os) 
                ON DUPLICATE KEY UPDATE 
                nombre_dispositivo = :nombre, 
                sistema_operativo  = :os, 
                fecha_conexion     = CURRENT_TIMESTAMP";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':ip'     => $ip, 
            ':nombre' => $nombre, 
            ':os'     => $os
        ]);

        // Respuesta para el agente (depuración)
        header('Content-Type: text/plain');
        echo "[SUCCESS] Agente registrado/actualizado: " . $nombre;

    } catch (PDOException $e) {
        // En caso de error, devolvemos el código 500
        header('HTTP/1.1 500 Internal Server Error');
        echo "[ERROR] Database failure: " . $e->getMessage();
    }
} else {
    // Si alguien intenta entrar por el navegador (GET), denegamos el acceso
    header('HTTP/1.1 403 Forbidden');
    echo "[!] Acceso restringido. Este endpoint solo acepta transmisiones de agentes.";
}
?>