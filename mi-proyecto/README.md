# Alta de Ticket — Arquitectura en Tres Capas (PHP)

Aplicación web en PHP que permite registrar tickets con título y descripción.  
Todo ticket nuevo se crea automáticamente con estado **pendiente** (regla de negocio).

---

## Arquitectura

| Capa | Carpeta | Archivos |
|---|---|---|
| Presentación | `public/tickets/` | `crear.php` |
| Negocio | `negocio/` | `Ticket.php` |
| Persistencia | `datos/` | `Conexion.php`, `TicketRepository.php` |

---

## Instalación y uso

### 1. Base de datos
Importar el script `db/tickets_db.sql` en **phpMyAdmin** (XAMPP).

### 2. Configuración
Copiar `config/config.ejemplo.php` como `config/config.php` y completar las credenciales:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'tickets_db');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 3. Servidor
Colocar la carpeta `mi-proyecto/` dentro de `htdocs/` de XAMPP y acceder a:

```
http://localhost/mi-proyecto/public/tickets/crear.php
```

---

> ⚠️ El archivo `config/config.php` está excluido del repositorio mediante `.gitignore`.
