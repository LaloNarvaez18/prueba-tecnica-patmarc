# Prueba técnica

Solución de la prueba técnica solicitada. Para ello:
- Se implementan operaciones CRUD para productos y categorías.
- Se filtran productos al seleccionar varias categorías.
- API de productos con endpoints para consultar listado de productos, producto por ID y productos según categoría.

## Instalación y configuración

Una vez clonado el proyecto, en la raíz, se debe crear el archivo `.env` y copiar el contenido disponible en el archivo `.env.example`.

## Levantar Servicios

### Opción 1 - Docker

Esta sección describe cómo iniciar los servicios con `docker-compose`.

### Requisitos previos

Tener instalado `docker` y `docker-compose` en tu máquina.

### Comandos

1. Ejecutar el siguiente comando para iniciar todos los servicios en segundo plano:
    ```
    docker-compose up -d --build
    ```

2. Ejecutar las migraciones y poblar la base de datos:
    ```
    docker-compose exec app php artisan migrate --seed
    ```

3. Para detener los servicios:
    ```
    docker-compose down
    ```
### Opción 2 - Local

En esta sección se describe cómo levantar los servicios en local.

#### Requisitos

- PHP >=8.2
- Composer

#### Pasos para ejecutar en local

1. Instala las dependencias con `composer`:
    ```sh
    composer install
    ```

2. Genera la `APP_KEY`:
    ```sh
    php artisan key:generate
    ```

3. Configura las variables de entorno con las credenciales de la base de datos:
    ```env
    DB_CONNECTION=
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ```
4. Ejecuta las migraciones y puebla la base de datos:
    ```sh
    php artisan migrate --seed
    ```

5. Instala las dependencias de `node`:
    ```sh
    npm install
    ```

6. Compila y levanta el servidor de `vite`:
    ```sh
    npm run dev
    ```

7. En otra terminal, levanta el servidor local en el puerto `:8000`:
    ```sh
    php artisan serve --port=8000
    ```
    
## Uso

Una vez que los servicios estén ejecutándose, ya sea en `Docker` o de forma local, accede en el navegador a la URL: http://localhost:8000 e inicia sesión con las siguientes credenciales:

```sh
Correo: admin@example.com
Contraseña: password
```

## Documentación API

La URL base de la API es: `/api/v1`

### Endpoints

#### ```GET``` /products

Obtener todos los productos disponibles.

#### Parámetros

El endpoint no requiere parámetros de entrada.

#### Respuesta

Al consultar el endpoint, se debe esperar una respuesta de este tipo:

```json
{
    "results": 41,
    "products": [
        {
            "id": 1,
            "name": "Producto 1",
            "description": "Lorem",
            "price": 123456,
            "stock": 10,
            "image": null,
            "expiration_date": null,
            "categories": [
                {
                    "id": 1,
                    "name": "Tecnología",
                    "description": "Productos tecnológicos"
                },
                {
                    "id": 3,
                    "name": "Electrodomésticos",
                    "description": "Equipos eléctricos"
                }
            ]
        },
        ...
    ]
}
```

#### ```GET``` /products/{id}

Obtener el producto según ID.

#### Parámetros

El endpoint requiere que se le pase el parámetro ```id```.

#### Respuesta

Al consultar el endpoint, se debe esperar una respuesta de este tipo:

```json
{
    "product": {
        "id": 1,
        "name": "Product 1",
        "description": "Lorem.",
        "price": 123456,
        "stock": 10,
        "image": null,
        "expiration_date": null,
        "categories": [
            {
                "id": 1,
                "name": "Tecnología",
                "description": "Productos tecnológicos"
            },
            {
                "id": 3,
                "name": "Electrodomésticos",
                "description": "Equipos eléctricos"
            }
        ]
    }
}
```

#### ```GET``` /products/categories?name=

Obtener todos los productos según categoría.

#### Parámetros

El endpoint requiere que se le pase el parámetro ```name```, que corresponde a los nombres de las categorías separadas por comas, ejemplo: 'Ropa,Calzado'.

#### Respuesta

Al consultar el endpoint, se debe esperar una respuesta de este tipo:

```json
{
    "results": 2,
    "products": [
        {
            "id": 3,
            "name": "Producto 3",
            "description": "",
            "price": 45677,
            "stock": 5,
            "image": null,
            "expiration_date": null,
            "categories": [
                {
                    "id": 5,
                    "name": "Calzado",
                    "description": "Zapatos y botas"
                }
            ]
        },
        {
            "id": 4,
            "name": "Producto 4",
            "description": "",
            "price": 123456,
            "stock": 2,
            "image": null,
            "expiration_date": null,
            "categories": [
                {
                    "id": 4,
                    "name": "Ropa",
                    "description": "Prendas de vestir"
                }
            ]
        }
    ]
}
```

## Postman

Se puede importar la colección de `Postman` disponible en el proyecto para probar los endpoints disponibles.

```
📁 Archivo: /postman/productos_api_postman.json
```
