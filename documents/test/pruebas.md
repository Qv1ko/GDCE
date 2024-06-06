# Pruebas

## Gestión de los registros y validaciones

### Pruebas realizadas

- Actualización de registros en almacenes, portátiles, aplicaciones, cargadores, alumnos y cursos.
- Creación de registros en portátiles, aplicaciones, cargadores, almacenes, alumnos y cursos.
- Sincronización de almacenes con capacidades máximas negativas.
- Introducción de valores negativos.
- Introducción de valores demasiado altos en la capacidad de los almacenes.
- Introducción de NIE en vez de DNI.

### Resultados obtenidos

- Implementar una función para convertir a positivo un valor de capacidad máxima negativa.
- Limitar los almacenes que no tienen más capacidad.
- Restringir los valores del atributo estado al crear un cargador a "Disponible" y "Averiado".
- Al cambiar el nombre de una aplicación, actualizarlo en todas las relaciones correspondientes.
- Implementar la actualización de los atributos aplicaciones y cargadores relacionados con portátiles.
- Separar en el formulario de alumnos la selección de cursos entre cursos de mañana y tarde.
- Corregir la función que genera la sigla para que guarde las letras sin tildes.
- Añadir validaciones para valores enteros mínimos.
- Al añadir una aplicación con un nombre largo y sin espacios, el nombre sale fuera de la caja en la página de gestión de aplicaciones.
- Modificar las reglas de los cursos para que las siglas no excedan el límite y se guarden correctamente.
- Corrigir la función que genera la sigla para que en vez de generarla con las letras con tilde las guarde sin tilde.
- Eliminar el mensaje de error al cargar el modal de actualización de curso.
- Corregir la regla de atributo DNI en el modelo de alumnos para permitir valores NIE.
- Implementar una regla para limitar el valor máximo de capacidad de los almacenes.

## Claves foraneas

### Pruebas realizadas

- Eliminación de registros en almacenes, aplicaciones, portátiles, cargadores, alumnos y cursos.
- Reserva de portátiles.
- Actualización de registros de cargadores y portátiles.

### Resultados obtenidos

- Implementar que al borrar un almacén, poner en null los campos id_almacen en sus relaciones.
- Implementar un sincronizador que elimine las aplicaciones relacionadas con una aplicación borrada.
- Implementar que los alumnos con matriculación en cursos de mañana y tarde solo puedan reservar un portatil disponible en ambos turnos.
- Modificar la sincronización de cargadores para que no estén disponibles si están relacionados con un portátil.

## Pruebas con usuarios

### Pruebas realizadas

- Pruebas a usuarios relacionados con el desarrollo de software.
- Pruebas a usuarios del sector de la informática no relacionados con el desarrollo de software.
- Pruebas a usuarios no relacionados con la informática.

### Resultados obtenidos

- Los colores de la paleta son muy saturados.
- Cambiar los registros del gridview para que ocupen solo una línea.
- Corregir funciones que fallan si la base de datos está vacía.
- Cambiar los colores de las tablas y los botones.
- Reorganizar el formulario de actualizar cursos.
- Mostrar el curso del grado en la tabla de alumnos (1º o 2º).
- Ordenar la tabla de cursos por nombre y año.
