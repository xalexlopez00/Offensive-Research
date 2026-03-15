<?php
/**
 * DB_CONFIG.PHP
 * Configuración de conexión centralizada para el Network-Shield-System.
 */

// 1. Parámetros de conexión
$host    = 'localhost';
$db      = 'network_shield_db';
$user    = 'root';
$pass    = ''; 
$charset = 'utf8mb4';

// 2. Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// 3. Opciones de PDO para seguridad y rendimiento
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Reporte de errores proactivo
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Resultados como array asociativo
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Consultas preparadas reales (seguridad)
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"     // Asegura codificación correcta
];

try {
    // 4. Inicialización de la conexión global $pdo
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Si estás haciendo debug, puedes descomentar la siguiente línea:
    // echo "Conexión establecida correctamente";

} catch (\PDOException $e) {
    // 5. Gestión de errores crítica
    // En producción, podrías loguear esto en un archivo en lugar de mostrarlo
    die("<div style='background:#111; color:#ff4444; padding:15px; border:1px solid red; font-family:monospace;'>
            [!] DATABASE_CONNECTION_FAILED: " . $e->getMessage() . "
         </div>");
}
?>