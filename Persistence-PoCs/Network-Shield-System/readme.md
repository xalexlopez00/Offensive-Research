<p align="center">
  <img src="https://img.shields.io/badge/Network_Shield-Remote_Admin-007bff?style=for-the-badge&logo=opsgenie" alt="Shield Badge">
  <img src="https://img.shields.io/badge/Status-PoC-brightgreen?style=for-the-badge" alt="Status PoC">
  <img src="https://img.shields.io/badge/Security-Educational-f44336?style=for-the-badge&logo=eset" alt="Security Educational Badge">
</p>

# <p align="center">🛡️ Network Shield</p>
### <p align="center">Remote Administration System (PoC)</p>

---

> <p align="center"><b>Una Prueba de Concepto (PoC) para el estudio de sistemas de administración remota (C2) y técnicas de persistencia en entornos Windows.</b></p>

---

### <p align="center"><b>⚠️ AVISO LEGAL CRÍTICO ⚠️</b></p>

<p align="center">
  <i>Este software ha sido creado exclusivamente con fines educativos y de investigación en ciberseguridad. El autor no se hace responsable del mal uso de este código. El uso en sistemas sin autorización es ilegal.</i>
</p>

---

## 🛠️ Requisitos del Sistema

Para desplegar este entorno, asegúrate de contar con:

* **XAMPP**: Servidor Apache y MySQL (MariaDB).
* **Python 3.x**: Instalado correctamente en el PATH de tu sistema.
* **Librerías Python**: Ejecuta el siguiente comando en tu terminal para instalar las dependencias: `pip install requests`.
* **Base de Datos**: Importar el esquema de base de datos incluido en el archivo `server/db.txt`.

---

## 🚀 Guía de Instalación y Configuración

Sigue estos pasos para poner en marcha tu entorno de pruebas:

### 1. Preparación de la Base de Datos

1.  Inicia los módulos **Apache** y **MySQL** desde el panel de control de XAMPP.
2.  Accede a tu gestor de base de datos en: `http://localhost/phpmyadmin`.
3.  Crea una nueva base de datos llamada `network_shield_db`.
4.  Importa el contenido de `server/db.txt` utilizando la pestaña **SQL** de phpMyAdmin.

---

### 2. Configuración del Servidor Web

1.  Mueve la carpeta completa `Network-Shield-System` a la ruta `C:\xampp\htdocs\`.
2.  El panel de control será accesible en: `http://localhost/Network-Shield-System/server/index.php`.

---

## 📡 Ejecución y Pruebas

Sigue este orden estricto para establecer el enlace correctamente:

### 🟢 Paso 1: Iniciar el Receptor (Master)

Abre una terminal en la carpeta `master/` y lanza el centro de control ejecutando el siguiente comando:
**python receptor.py**

---

### 🔵 Paso 2: Lanzar el Agente (Client)

Ejecuta el script en el equipo objetivo para iniciar la conexión:

* **Modo Manual**: `python client/agente.py`
* **Modo Invisible**: Renombra el archivo a `agente.pyw` y ejecútalo.
* **Simulación Web**: Accede desde un navegador a la URL: `http://localhost/Network-Shield-System/server/trampa.php`.

---

## 🔐 Implementación de Persistencia

La persistencia permite que el agente se ejecute automáticamente cada vez que el usuario inicie sesión en Windows.

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

| Carpeta | Descripción |
| :--- | :--- |
| **📁 server/** | Panel de control web, API de reporte y gestión de base de datos. |
| **📁 client/** | Script del agente para ejecución en el objetivo. |
| **📁 master/** | Consola interactiva C2 (Command & Control) para el administrador. |

---

## 📋 Comandos de Auditoría Disponibles

Una vez establecida la conexión en el receptor, puedes utilizar estos comandos:

<p align="center">
  <img src="https://img.shields.io/badge/Comando- Sistema-555555?style=flat" alt="Shield Sistema">
  <img src="https://img.shields.io/badge/Comando- Archivos-555555?style=flat" alt="Shield Archivos">
  <img src="https://img.shields.io/badge/Comando- Remoto-555555?style=flat" alt="Shield Remoto">
  <img src="https://img.shields.io/badge/Comando- Finalizar-555555?style=flat" alt="Shield Finalizar">
</p>

* 💻 **Información del Sistema**: whoami, systeminfo, tasklist, ipconfig.
* 📂 **Gestión de Archivos**: dir, cd .., type archivo.txt.
* 🌐 **Interacción Remota**: start https://google.com, msg * "Acceso detectado".
* 🚪 **Finalizar Sesión**: **exit** (Cierra la conexión de forma segura).

---

## 🛠️ Solución de Problemas (Troubleshooting)

* **¿No conecta?**: Verifica que el puerto **4444** esté abierto en el Firewall de Windows.
* **¿Agente invisible en la Web?**: Asegúrate de que la URL en `agente.py` sea idéntica a tu ruta en XAMPP.
* **¿Error de SQL?**: Asegúrate de que el usuario de MySQL sea **root** y la base de datos exista.

---

<p align="center">
  Desarrollado con ❤️ para la comunidad de ciberseguridad.
</p>
