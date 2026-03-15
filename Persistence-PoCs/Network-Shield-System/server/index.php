<?php
// 1. Conexión a la base de datos (Ambos están en la carpeta /server)
require 'db_config.php'; 

try {
    // 2. CONSULTA DE DISPOSITIVOS
    // Traemos los dispositivos más recientes primero
    $sql = "SELECT * FROM dispositivos ORDER BY fecha_conexion DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    die("<div style='background:#000; color:red; padding:20px; font-family:monospace;'>
            [!] DATABASE_ERROR: " . $e->getMessage() . "
         </div>");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>C&C Panel - Network Shield</title>
    <meta http-equiv="refresh" content="10"> 
    <style>
        body { background: #0a0a0a; color: #00ff41; font-family: 'Courier New', monospace; padding: 20px; }
        h2 { text-shadow: 0 0 10px #00ff41; border-bottom: 1px solid #00ff41; padding-bottom: 10px; }
        .header-info { color: #666; margin-bottom: 20px; font-size: 0.9em; }
        table { width: 100%; border-collapse: collapse; background: #111; border: 1px solid #00ff41; }
        th, td { border: 1px solid #004400; padding: 12px; text-align: left; }
        th { background: #002200; color: #fff; text-transform: uppercase; font-size: 0.85em; }
        tr:hover { background: #001100; }
        .btn-control { 
            background: #00ff41; color: black; padding: 6px 12px; 
            text-decoration: none; font-weight: bold; border: none; cursor: pointer;
            font-family: 'Courier New', monospace; transition: 0.3s;
        }
        .btn-control:hover { background: #fff; box-shadow: 0 0 10px #fff; }
        .status-tag { color: #00ff41; font-weight: bold; }
        .os-tag { color: #00bcff; }
        .cmd-tag { color: #ffaa00; }
        code { background: #222; padding: 2px 5px; border-radius: 3px; }
        .no-data { color: #ff4444; padding: 20px; border: 1px dashed #ff4444; text-align: center; }
    </style>
</head>
<body>

    <h2>[ NETWORK SHIELD - COMMAND CENTER ]</h2>
    <div class="header-info">
        ESTADO: <span class="status-tag">ONLINE</span> | 
        PROYECTO: <span class="status-tag">Network-Shield-System</span> | 
        DB: <span class="status-tag">CONNECTED</span>
    </div>

    <?php if ($stmt->rowCount() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DIRECCIÓN IP</th>
                    <th>NOMBRE DEL EQUIPO</th>
                    <th>SISTEMA OPERATIVO</th>
                    <th>ÚLTIMA ACTIVIDAD</th>
                    <th>PENDIENTE</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch()): ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td><strong><?php echo htmlspecialchars($row['ip_address']); ?></strong></td>
                    <td><?php echo htmlspecialchars($row['nombre_dispositivo']); ?></td>
                    <td class="os-tag"><?php echo htmlspecialchars($row['sistema_operativo'] ?? 'Desconocido'); ?></td>
                    <td><?php echo $row['fecha_conexion']; ?></td>
                    <td class="cmd-tag"><code><?php echo htmlspecialchars($row['ultimo_comando'] ?: 'N/A'); ?></code></td>
                    <td>
                        <form action="control.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn-control">CONSOLA</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-data">
            [!] ESPERANDO CONEXIONES... El panel se actualizará automáticamente cuando un agente se reporte.
        </div>
    <?php endif; ?>

    <p style="font-size: 0.7em; color: #444; margin-top: 30px; text-align: center;">
        &copy; 2026 Network Shield System - Educational PoC
    </p>

</body>
</html>