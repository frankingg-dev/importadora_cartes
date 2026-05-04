# Importadora de Vehículos RCV - Proyecto Tópicos I

## 📝 Descripción del Problema
En el mercado de Punta Arenas, existe una falta de información precisa y confiable al cotizar unidades de segunda mano o importadas. Las plataformas actuales suelen carecer de datos técnicos exhaustivos y claridad sobre los métodos de pago, lo que genera desconfianza en los clientes.

## 💡 Solución Propuesta
**Importadora RCV** es una plataforma web de alta transparencia diseñada para eliminar la incertidumbre. El sistema entrega información técnica completa para una decisión informada, respaldada por un entorno digital profesional y seguro:
* **Identificación:** Información técnica completa (VIN).
* **Estado:** Kilometraje real y estado logístico.
* **Gestión:** Claridad en el proceso de adquisición.

---

## 🛠️ Stack Tecnológico
Para materializar esta solución, se ha definido el siguiente stack técnico:

* **Backend:** PHP 8.5 con el framework **Laravel** para gestionar la lógica comercial.
* **Frontend:** Integración con **Inertia.js** para una experiencia de usuario fluida y reactiva.
* **Base de Datos:** **MySQL** para garantizar la integridad y centralización de la información.
* **Seguridad:** Implementación de paquetes de **Spatie** para el control de roles y permisos.
* **Diseño:** Sistema "Precision & Prestige" (grilla de 8px y principios de *Glassmorphism*).

---

## 📈 Avances del Proyecto (al 20 de abril de 2026)
El proyecto se encuentra en una 2da etapa inicial consolidada con los siguientes logros:
1. **Configuración del Entorno:** Instalación de Laravel, Inertia, Spatie y MySQL.
2. **Arquitectura de Datos:** Base de datos `importadora_cartes` creada y conectada exitosamente.
3. **Autenticación:** Sistema de usuarios operativo, permitiendo el ingreso del administrador.
4. **Prototipado:** Primer boceto funcional de la página principal (Home) validado.

---

## 🚀 Cómo iniciar el proyecto
Para poner en marcha el servidor localmente, sigue estos pasos:

1. **Configurar el entorno:** Asegúrate de tener tu archivo `.env` configurado con las credenciales de tu base de datos MySQL.
2. **Instalar dependencias:**
   ```bash
   composer install
   npm install
3. **Ejecutar todas las migraciones de laravel**
    ```bash
    php artisan migrate --seeder
    php artisan migrate

4. **Ejecutar el servidor de Laravel:**
    ```bash
    php artisan serve

5. **Ejecutar el compilador de Frontend (Vite/Inertia):**
En una terminal nueva, ejecuta:
    ```bash
    npm run dev

---

👥 **Información Académica**
* **Alumno:** Franco Cartes Vera. 
* **Asignatura:** Tópicos I.
* **Profesor:** Patricia Maldonado.
