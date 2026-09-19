# PHP MVC

Proyecto sencillo que aplica el patrón **MVC** en PHP (sin frameworks) para un CRUD de productos (nombre y precio) sobre PostgreSQL.

## Requisitos

- PHP 8.1 o superior con la extensión `pdo_pgsql`
- Docker (para la base de datos)
- Un servidor web apuntando a la carpeta `public/` (por ejemplo `php-mvc.test`)

## Puesta en marcha

1. Levantar la base de datos (crea la tabla `products` con dos productos de ejemplo):

   ```bash
   docker compose up -d
   ```

2. Ajustar los datos de conexión y la URL del sitio en `src/config/config.php`.
3. Abrir el sitio en el navegador (`URL_SITE`).

## Estructura

```
php-mvc/
├── database/
│   └── schema.sql              # Tabla products y datos de ejemplo
├── docker-compose.yml          # Contenedor de PostgreSQL
├── public/
│   └── index.php               # Punto de entrada y router
└── src/
    ├── config/config.php       # Constantes de configuración (URL y BD)
    ├── controllers/            # ProductController: recibe la petición y decide qué mostrar
    ├── core/
    │   ├── database.php        # Conexión PDO (una sola instancia)
    │   ├── helpers.php         # e(): escapa texto para HTML
    │   └── view.php            # View::render(): carga una vista dentro del layout
    ├── models/Product.php      # Consultas a la base de datos
    ├── routes/web.php          # Tabla de rutas
    └── views/
        ├── layouts/main.php    # Plantilla base (HTML, Bootstrap)
        └── products/           # index, create y edit
```

## Cómo funciona

1. Todas las peticiones entran por `public/index.php`.
2. Ahí se construye una clave `MÉTODO /ruta` (por ejemplo `GET /edit`) y se busca en `src/routes/web.php`.
3. Si existe, se instancia el controlador y se ejecuta la acción; si no, responde 404.
4. El controlador usa el **modelo** para leer o guardar datos y llama a `View::render()` con la **vista** correspondiente.
5. La vista se inserta dentro del layout `main.php`.

## Rutas

| Método | Ruta       | Acción                                |
|--------|------------|---------------------------------------|
| GET    | `/`        | Listar productos                      |
| GET    | `/create`  | Formulario de nuevo producto          |
| POST   | `/store`   | Guardar producto nuevo                |
| GET    | `/edit?id=`| Formulario de edición                 |
| POST   | `/update`  | Guardar cambios                       |
| POST   | `/destroy` | Eliminar producto                     |

## Consideraciones

- Es un proyecto didáctico, no tiene autenticación ni protección CSRF.
- Las consultas usan sentencias preparadas y las vistas escapan la salida con `e()`, para evitar inyección SQL y XSS.
- Validación en el servidor, el nombre es obligatorio (máx. 100 caracteres) y el precio debe ser mayor que 0 y no superar `99999999.99`.
- Las clases se cargan manualmente con `require` en `public/index.php`; al añadir un modelo o controlador nuevo hay que incluirlo ahí.
- Las redirecciones usan `URL_SITE`, así que hay que actualizarlo si cambia el dominio.
