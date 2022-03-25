
## Instalacion del proyecto Laravel


- crear base de datos en blanco.
- copiar el archivo .env.example y pegarlo con el nombre de .env al mismo nivel.
- añadir parametros de la base de datos en los campos : DB_DATABASE DB_USERNAME DB_PASSWORD.
- entrar a la carpeta del proyecto.
- ejcutar php artisan migrate.
- si estan en linux se debe asignar www-data a todo el proyecto y dar permisos 775 a la carpeta storage .
- la ruta del proyecto esta en la raiz.
