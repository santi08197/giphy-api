Challenge PHP - Santiago Gonzalez

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