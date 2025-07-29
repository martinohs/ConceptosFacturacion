# Proyecto Symfony 7

Aplicación de ejemplo desarrollada con **Symfony 7.3** y **PHP 8.4**. Sigue los siguientes pasos para una correcta instalación y ejecución del proyecto.

---

## 📋 Prerrequisitos

Asegúrate de tener instalado el siguiente software en tu sistema:

* **PHP 8.4** o superior ([Descargar](https://www.php.net/downloads.php))
* **Composer** ([Descargar](https://getcomposer.org/download/))
* **Symfony CLI** ([Instalar](https://symfony.com/download))
* **PostgreSQL** (un servidor de base de datos local o accesible)

---

## ⚙️ Instalación y Configuración

Sigue estos pasos en orden para configurar el entorno de desarrollo.

### 1. Clonar el Repositorio
Clona el proyecto en tu máquina local.
```bash
git clone git@github.com:martinohs/ConceptosFacturacion.git
cd ConceptosFacturacion
```

### 2. Instalar Dependencias
Instala todas las dependencias del proyecto utilizando Composer.
```bash
composer install
```

### 3. Configurar la Base de Datos
Crea una copia del archivo de entorno para tus configuraciones locales.
```bash
cp .env .env.local
```
Luego, abre el archivo `.env.local` y modifica la variable `DATABASE_URL` con tus credenciales de PostgreSQL.

```dotenv
# .env.local
DATABASE_URL="postgresql://[USER]:[PWD]@[HOST]:[PORT]/[DB_NAME]?serverVersion=16&charset=utf8"
```
* `[USER]`: Tu usuario de PostgreSQL (ej. `postgres`).
* `[PWD]`: La contraseña de tu usuario.
* `[HOST]`: La dirección del servidor (ej. `127.0.0.1`).
* `[PORT]`: El puerto de tu servidor (ej. `5432`).
* `[DB_NAME]`: El nombre que le darás a la base de datos (ej. `mi_proyecto_db`). (por defecto yo utilice 'postgres_ps')

### 4. Crear y Migrar la Base de Datos
Con la configuración lista, ejecuta los siguientes comandos para inicializar la base de datos y su estructura.

```bash
# Crea la base de datos si no existe
php bin/console doctrine:database:create

# Aplica las migraciones para crear las tablas
php bin/console doctrine:migrations:migrate
```
Si todo sale bien, deberías ver un mensaje de éxito:
 `[OK] Successfully migrated to version: ...`

### 5. Completar Parametricas 
Ejecuta el command para llenar las tablas paramétricas (`CondicionIva`, `Rubro`, `UnidadMedida`) con datos por defecto.
```bash
php bin/console app:seed-parametricas
```
---

## 🚀 Ejecutar la Aplicación

Finalmente, levanta el servidor de desarrollo de Symfony.

```bash
# con el CLI de Symfony
symfony server:start

# con php 
php -S 127.0.0.1:8000 -t public
```

La aplicación estará disponible por defecto en **http://127.0.0.1:8000/**.
