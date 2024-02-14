Challenge PHP - Santiago Gonzalez

Dockerfile
    - Abrir una terminal en el directorio raíz del proyecto y ejecutar:
    $ docker build -t nombre-imagen .
    Reemplazar nombre-imagen con el nombre deseado.

    Luego de construir la imagen Docker se puede ejecutar un contenedor utilizando esta imagen:
    $ docker run -p 8000:80 nombre-imagen

Si el dockerfile no funciona realizar los siguiente pasos:

    -ejecutar $ composer install

    -ejecutar $ php artisan migrate

    -ejecutar $ php artisan passport:keys (use passport para autenticacion y este comando genera las keys que necesita funcionar)

    - ejecutar $ php artisan serve

    Siguiendo esos pasos la API deberia estar lista para usarse!

Testing

    Para testear ejecutar $ php artisan test. 
    
    Por cuestiones de tiempo no llegue a configurar una base de datos para testing pero entiendo que no es lo ideal usar la base de datos principal para testear.

Informacion Adicional

    Los diagramas y la collecion Postman se encuentran en la carpeta challenge_documentation.
    Recordar tambien importar el enviroment y asignarselo a la colleccion.