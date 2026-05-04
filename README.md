## Aplicación para llevar el control de los gastos del mes

Cada que se haga un gasto se registra en la aplicación, definimos unos montos de alerta y peligro y al entrar veremos
el total gastado en el mes con el color correspondiente, esto nos permite saber de forma rápida si hemos gastado más
de lo presupuestado o si estamos cerca de hacerlo.

---

## Requisitos

- [Docker](https://docs.docker.com/get-docker/) con Docker Compose

---

## Instalación con Docker (primera vez)

### 1. Clonar el repositorio

```bash
git clone https://github.com/blonder413/Laravel-Gastos.git
cd Laravel-Gastos
```

### 2. Configurar el archivo de entorno

```bash
cp .env.example .env
```

Edita el `.env` con tus valores. Presta atención a estas variables:

```env
# URL de la app (debe coincidir con APP_PORT)
APP_URL=http://localhost:8080
APP_PORT=8080

# IMPORTANTE: DB_HOST debe ser "mysql", no localhost ni 127.0.0.1
DB_HOST=mysql
DB_PORT=3306

# Estos valores crean el usuario y la base de datos en MySQL la primera vez
DB_DATABASE=gastos
DB_USERNAME=blonder413
DB_PASSWORD=tu_password
DB_ROOT_PASSWORD=root_password

# Puerto para conectarse desde herramientas externas (DBeaver, TablePlus, etc.)
DB_EXTERNAL_PORT=3307

# Montos de alerta en la pantalla principal
MAX_GOOD_AMOUNT=4000000
MAX_WARNING_AMOUNT=5000000
MAX_CRITICAL_AMOUNT=7600000
```

> **Nota:** `DB_HOST=mysql` es el nombre del servicio dentro de Docker. Si pones `127.0.0.1` la app no podrá conectarse a la base de datos.

### 3. Levantar los contenedores

```bash
docker compose up -d --build
```

Al iniciar, el contenedor automáticamente:
- Instala las dependencias de Composer (si no existe `vendor/`)
- Espera a que MySQL esté listo
- Ejecuta las migraciones (`php artisan migrate`)

Para seguir el proceso en tiempo real:

```bash
docker compose logs -f app
```

Cuando veas `NOTICE: ready to handle connections`, la app está lista.

### 4. Abrir la aplicación

| Servicio | URL / Host |
|---|---|
| Laravel | http://localhost:8080 |
| MySQL (desde DBeaver, etc.) | localhost : `DB_EXTERNAL_PORT` |

---

## Uso diario

Una vez instalado, para iniciar y detener:

```bash
# Iniciar
docker compose up -d

# Detener (conserva la base de datos)
docker compose down
```

---

## Conectarse a la base de datos desde DBeaver / TablePlus

Usa el puerto **externo** (`DB_EXTERNAL_PORT`) desde tu máquina:

| Campo | Valor |
|---|---|
| Host | `localhost` |
| Port | valor de `DB_EXTERNAL_PORT` (ej: `3307`) |
| Database | valor de `DB_DATABASE` |
| Username | valor de `DB_USERNAME` |
| Password | valor de `DB_PASSWORD` |

Si el driver JDBC de DBeaver da el error *Public Key Retrieval is not allowed*, agrega estos parámetros a la URL de conexión:

```
?allowPublicKeyRetrieval=true&useSSL=false
```

---

## Comandos útiles

```bash
# Ver logs en tiempo real
docker compose logs -f app

# Ejecutar un comando Artisan
docker compose exec app php artisan <comando>

# Abrir una shell dentro del contenedor
docker compose exec app bash

# Recrear todo desde cero (BORRA la base de datos)
docker compose down -v
docker compose up -d --build
```

---

## Desarrollo con Vite (hot reload) y Mailpit

```bash
docker compose --profile dev up -d --build
```

Agrega al `.env`:

```env
MAIL_HOST=mailpit
MAIL_PORT=1025
```

| Servicio | URL |
|---|---|
| Mailpit (bandeja de correos) | http://localhost:8025 |
| Vite HMR | http://localhost:5173 |

---

## Instalación sin Docker

```bash
git clone https://github.com/blonder413/Laravel-Gastos.git
cd Laravel-Gastos
composer install
cp .env.example .env
# Edita .env con DB_HOST=127.0.0.1 y tus credenciales locales
php artisan key:generate
php artisan migrate
npm install && npm run dev
```

---

## SonarQube

```bash
php artisan test --coverage-clover=storage/coverage/coverage.xml
sonar-scanner
```
