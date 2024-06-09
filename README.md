<p align="center">
    <img src="./web/images/logo_lg.png" height="100px">
    <h1 align="center">GDCE</h1>
    <br>
</p>

GDCE es una aplicación web creada para gestionar la reserva de portátiles en centros de estudios.

La aplicación se basa en una sección inicial para todos los usuarios donde podrán escanear el código QR de los portátiles y reservarlos. Por otra parte, a los usuarios administradores se les añade el acceso a un panel con información y gráficas, así como a las páginas para gestionar los dispositivos, alumnos, cursos y almacenes.

![Bootstrap 4](https://img.shields.io/badge/Bootstrap_4-7952B3?style=for-the-badge&logo=bootstrap&logoColor=E3E3E3&labelColor=333333)
![Composer 2.6.6](https://img.shields.io/badge/Composer_2.6.6-885630?style=for-the-badge&logo=composer&logoColor=E3E3E3&labelColor=333333)
![PHP 7.2](https://img.shields.io/badge/PHP_7.2-777BB4?style=for-the-badge&logo=php&logoColor=E3E3E3&labelColor=333333)
![Yii2](https://img.shields.io/badge/Yii2-8ABC4B?style=for-the-badge&logo=yii2&logoColor=E3E3E3&labelColor=333333)
![Xampp 3.2.3](https://img.shields.io/badge/Xampp_3.2.3-FB7A24?style=for-the-badge&logo=xampp&logoColor=E3E3E3&labelColor=333333)

ESTRUCTURA DE DIRECTORIOS
-------------------

      assets/             contiene la definición de los assets
      commands/           contiene los comandos de la consola (controladores)
      config/             contiene la configuración de la aplicación
      controllers/        contiene las clases de controladores de la aplicación web
      data/               contiene la copia de seguridad de la base de datos
      documents/          contiene la documentación del proyecto
      mail/               contiene el diseño para correos electrónicos
      models/             contiene las clases de modelos
      runtime/            contiene los ficheros generados durante la ejecución
      tests/              contiene varios tests para la aplicación
      vendor/             contiene paquetes dependientes de terceros
      views/              contiene las vistas de la aplicación web
      web/                contiene el script de entrada, los recursos, el archivo CSS y los archivos JavaScript


PROGRAMAS REQUERIDOS
------------

- Composer (v2.6.6)
- Git
- PHP (v7.2)
- Xampp (v3.2.3)


INSTALACIÓN
------------

Clona el repositorio en el directorio web base (si usas Xampp, en `xampp/htdocs/`)

```
git clone https://github.com/Qv1ko/GDCE.git
```
```
git clone https://gitlab.com/vgarcia3301646/gdce.git
```

Dentro del repositorio clonado ejecuta el siguiente comando:
```
composer update
```

Importa la base de datos en MySQL ([estructura](/documents/implementation/estructura_bd.sql) / [backup](/data/backup.sql))
