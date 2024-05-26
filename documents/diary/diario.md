## Diario de trabajo

**12/11/2023**
- Entrega del proyecto inicial.

**21/12/2023**
- Entrega del anteproyecto.

**15/01/2024**
- Modificación del nombre de la tabla de `Aplicaciones` debido a un problema durante la creación del CRUD.

**26/01/2024**
- Creación de la tabla de `Cursos` para mejorar la implementación de turnos para los alumnos.

**31/01/2024**
- Entrega del primer prototipo de la aplicación con CRUD.

**02/02/2024**
- Creación del proyecto en GitLab.

**21/02/2024**
- Eliminación de la tabla "Ratones" por falta de utilidad en la aplicación.
- Modificación del diagrama entidad-relación para incluir el conjunto de entidades "Cursos" y eliminar el conjunto "Ratones".
- Búsqueda y selección de una portada para la documentación.
- Cambio de la tipografía de "Dosis" a "Roboto" para mejorar la visibilidad y alinearla con la interfaz de la aplicación.

**23/02/2024**
- Actualización del diagrama relacional incluyendo las tablas "Cursos", "Cursan" y "Cargan", mientras se elimina la tabla "Ratones".
- Modificación del script de creación de la base de datos para reflejar los cambios en las tablas y eliminar la tabla "Ratones".
- Simplificación de la relación entre las tablas en los diagramas entidad-relación y relacional, eliminando la relación entre "Cargadores" y "Alumnos".
- Creación de scripts para la estructura y el llenado de la base de datos con datos de ejemplo.

**26/02/2024**
- Configuración de la aplicación.
- Incorporación de backup a la carpeta de datos de la aplicación.
- Implementación de modelos y CRUD.

**27/02/2024**
- Selección de la portada para la documentación.
- Ajustes en los colores debido a problemas de contexto en su elección.

**28/02/2024**
- Desarrollo del grafico de "estado de portatiles" para la página de inicio.
- Modificación de la estructura de la base de datos para hacer tanto el nombre como el año del curso como clave única.
- Cambio del color principal por ser demasiado oscuro.

**29/02/2024**
- Desarrollo del grafico de "estado de cargadores" para la página de inicio.

**02/03/2024**
- Desarrollo del grafico de "uso por cursos" para la página de inicio.

**03/03/2024**
- Creación de la estructura básica de la documentación.
- Corrección de dimensiones del DAFO.
- Desarrollo adicional de gráficos para la página de inicio.
- Implementación de la libreria de 2amigos "chartjs".
- Modificación de la interfaz en Figma.

**04/03/2024**
- Configuración de las páginas y del logotipo en el header.
- Configuración del favicon.

**05/03/2024**
- Reestructuración de los elementos del footer.
- Cambio en la alineación del header.
- Búsqueda de información sobre FontAwesome y su widget para Yii2.

**06/03/2024**
- Configuración de los colores del header.
- Configuración de iconos en el footer con enlaces.
- Cambio de logotipo debido a problemas de visibilidad.
- Cambio de favicon y corrección de la ruta para que se visualice en todas las páginas.

**07/03/2024**
- Configuración de los graficos de tipo pie
- Cambio de la configuración del grafico pie de PHP a JavaScript, ya que los labels no se muestran correctamente en este tipo de gráfico.
- Gráfico de los almacenes añadido.

**08/03/2024**
- Cambio en la visualización de los items del header para diferenciar el acceso entre usuarios invitados y registrados.

**09/03/2024**
- Añadida una separación entre las secciones de los gráficos.
- Página de inicio cambiada y los gráficos trasladados a otra página, dejando la página de inicio para la sección de QR, que es la parte principal de la aplicación.

**10/03/2024**
- Desarrollo de una redirección a la página de inicio cuando el usuario sea invitado.

**11/03/2024**
- Cambio en las redirecciones pasando de usar una cadena con la ruta a una variable.
- Reestructuración de la página de gráficos y títulos añadidos.
- Cambio de la interfaz del inicio de sesión.
- Desarrollo del gráfico de la capacidad de los almacenes.

**12/03/2024**
- Cambio en la gráfica de la capacidad de los almacenes debido a un error en el widget, ya que los labels y el valor mínimo del gráfico se representaba incorrectamente.
- Cancelado el gráfico de uso anual debido a la falta de implementación en la base de datos.

**13/03/2024**
- Búsqueda de información para desarrollar el lector de códigos QR.
- Búsqueda de ejemplos de dashboards para cambiar la página de gráficos.
- Cambio en la página de gestión de portátiles.

**14/03/2024**
- Desarrollo de una nueva interfaz en Figma.

**21/03/2024**
- Desarrollo de la documentación de la tipografía.

**22/03/2024**
- Desarrollo de la vista "Portatil", que permitirá al usuario ver la información del portátil que escaneó.

**23/03/2024**
- Desarrollo de la vista de "Portatil".
- Implementación de nuevos iconos para la aplicación.
- Desarrollo de un estilo de caja para visualizar la información sobre los portátiles.

**24/03/2024**
- Búsqueda de información para implementar un desplegable.
- Modificaciones en las columnas del grid en la página de Almacenes.
- Documentación de la tipografía añadida a la documentación final.
- Búsqueda de información y ejemplos para implementar un lector de código QR.

**25/03/2024**
- Pruebas en la implementación de la librería html5-qrcode utilizando código JavaScript para la función de escaneo de códigos QR.

**26/03/2024**
- Añadido un bloque de búsqueda de portátiles en la página de inicio.
- Rediseño completo de la página de inicio para mejorar su apariencia y funcionalidad.

**27/03/2024**
- Cambio de los estilos de los iconos a estilos en línea.
- Modificación de la estructura del buscador de portátiles debido a problemas de responsividad.

**28/03/2024**
- Cambio de la estructura de la página de inicio añadiendo contenido.
- Configuración de SSL para el localhost con el fin de probar el lector de códigos QR desde dispositivos móviles.

**29/03/2024**
- Configuración de SSL y DNS personalizado para la aplicación web.
- Realización de pruebas exitosas del lector de códigos QR en dispositivos web y móviles.
- Cambio en la interfaz de la página de inicio para adaptarla al lector de QR.

**30/03/2024**
- Fusión del lector de códigos QR con el buscador en la página de inicio.
- Problemas relacionados con la recarga de la página y la solicitud de permisos de cámara al escanear un código QR con un patrón incorrecto.

**31/03/2024**
- Añadida una columna con checkbox a la página de gestión de almacenes.

**01/04/2024**
- Columna de checkboxes eliminada de la página de gestión de almacenes, para evitar que el usuario elimine toda la información por error.
- Añadido buscador en la página de gestión de almacenes.
- Botones de la columna derecha de la página de gestión de almacenes modificados.
- Código de la página de inicio comentado.
- Refactorización del código de la página de inicio y cambios en las clases de Bootstrap para hacer un código limpio y estructurado.
- Cambio en los estilos del lector de códigos QR.
- Pruebas con los estilos del footer para mejorar su responsabilidad en dispositivos móviles.

**02/04/2024**
- Mejorando la responsividad en la página de inicio.
- Botón de crear almacenes movido a la parte inferior de la página junto con dos botones de importar y exportar añadidos.
- Añadidos iconos para las funciones principales del CRUD.

**03/04/2024**
- Desarrollando la función para cambiar el estado de un portátil dependiendo de la hora del día y su ocupación.

**04/04/2024**
- Configuración de disposición de las columnas y su contenido en las páginas de gestión de portátiles, cargadores y almacenes.
- Implementación de un botón para listar las aplicaciones de cada portátil en la página de gestión de portátiles.

**05/04/2024**
- Implementación de un botón de exportación para la página de gestión de almacenes.

**07/04/2024**
- Unión del código de la página de creación de almacenes en la página index para implementar un popup al pulsar el botón de crear almacén.

**08/04/2024**
- Eliminación de la leyenda en los gráficos de la página de gráficos.
- Añadido color degradado para el fondo del gráfico del uso por ciclo.

**09/04/2024**
- Cambio en la maquetación y estilos de la página de gráficos, tomando como ejemplo dashboards de otras páginas web.

**10/04/2024**
- Cambio en el tipo de gráfico del gráfico de uso por ciclo.
- Añadido texto de información sobre el gráfico de los estados.

**12/04/2024**
- Cambio en la maquetación del dashboard.

**13/04/2024**
- Intento de implementación de un modal en la página de inicio para sustituir a la página de portátiles.
- Cambio en los estilos de la página de gráficos.
- Añadido contenido a la página del panel.

**14/04/2024**
- Configuración de los títulos de los gráficos.
- Cambio en el tipo de gráfico de tipo pastel a tipo donut para una mejor visión de la información.
- Configuración de los estilos de los encabezados y párrafos para adecuarlos al estilo de la página.

**15/04/2024**
- Configuración de los gráficos de la página de los gráficos.

**16/04/2024**
- Eliminación de franjas blancas en la parte inferior del footer en dispositivos móviles y la franja lateral derecha parcialmente, debido a que el widget de GridView en dispositivos móviles no se hace responsive correctamente.
- Alineación vertical de los elementos del footer.
- Desarrollado un nuevo modal al pulsar el botón de la página de inicio.

**17/04/2024**
- Intento de implementación de un modal para el menú de inicio, falla al intentar obtener el modal de otra vista para que esta obtenga los datos del portátil buscado.
- Fallo en la implementación de otras librerías para modificar la configuración de la exportación de los datos de la base de datos de Almacenes.

**18/04/2024**
- Botones de importar y exportar eliminados, porque no es una función necesaria para la aplicación.
- Configurado de nuevo un modal para el acceso al portátil escaneado/buscado sin éxito por un fallo al implementar el código del modal en la página de inicio.

**19/04/2024**
- Cambio de nombre de la página de Gráficos a Panel.
- Eliminación de los iconos de exportar e importar.
- Implementación de botones en la página de gráficos para listar los portátiles y cargadores disponibles, además de los averiados, desde diferentes botones.
- Implementado un modal que se mostrará al pulsar los botones de listado, con un GridView que no se adapta a las dimensiones del modal.

**20/04/2024**
- Implementación de GridView en el modal de cada botón.
- Configuración de GridView con Kartik, finalmente eliminada porque necesitaba implementar una librería de Bootstrap que rompía los estilos de las páginas.
- Dificultad al implementar el GridView con una consulta de dos tablas, porque los valores de la segunda tabla no se muestran.

**21/04/2024**
- Configuración de los GridView de la página de Panel para que mostraran las columnas correspondientes y eliminar el summary de los GridView.
- Documentación de la sección del prototipo de la interfaz.

**22/04/2024**
- Documentación sobre los diferentes prototipos de la interfaz.

**23/04/2024**
- Desarrollo del diagrama de clases.

**24/04/2024**
- Desarrollo del diagrama de casos de uso.
- Corrección del diagrama de clases añadiendo las cardinalidades.

**25/04/2024**
- Documentación de los prototipos y diagramas de clase y de casos de uso añadidos.

**26/04/2024**
- Corrección del diagrama de casos de uso.

**27/04/2024**
- Agregado modal que visualiza la vista de información del portátil.

**28/04/2024**
- Configuración del modal para que no aparezca el pie de página y eliminar el padding superior.
- El modal no muestra nada en dispositivos móviles.
- Elección de la plantilla para la presentación.

**29/04/2024**
- Añadidos títulos a los iconos del pie de página para facilitar la navegación.
- Cambio en los estilos del modal del portátil.

**30/04/2024**
- Estilización del modal.

**01/04/2024**
- Cambio en los estilos de los botones y otros estilos relacionados con el modal de la página de inicio.

**02/04/2024**
- Desarrollo de las consultas necesarias para la función de actualización del estado del portátil.

**03/05/2024**
- Implementación y prueba de la función de actualización del estado del portátil al entrar al modal.
- Desarrollo del selector de los alumnos de tarde con la librería select2.

**04/05/2024**
- Configuración de las páginas de gestión de portátiles.
- Desarrollo de una barra de búsqueda en la página de gestión de almacenes.

**05/05/2024**
- Implementación de la barra de búsqueda en la página de gestión de almacenes.

**06/05/2024**
- Creado backup de la base de datos.
- Configurando estilos de la página de panel.
- Implementada una función de sincronización de los alumnos que elimina el portátil asociado si no están matriculados o si el portátil está averiado.

**07/05/2024**
- Corrección del título del modal al escanear el código QR.

**08/05/2024**
- Implementé el reinicio del escáner de códigos QR mediante la instanciación de la variable scanner en diferentes puntos del código, pero no funcionaba porque al mantener la cámara apuntando a un código QR, lo escaneaba continuamente.
- Implementación de una recarga al salir del modal de la página de inicio para reiniciar el escáner de códigos QR.

**09/05/2024**
- Intento de implementación del Dropbox sin éxito, debido a que en el modal no funcionaba y al probarlo en la página de inicio necesitaba una nueva librería de Bootstrap que rompía los estilos de la página de inicio.

**10/05/2024**
- Corrección del diagrama de casos de uso.
- Desarrollo de la documentación relacionada con el color.
- Función para actualizar la relación entre los alumnos y los cursos, eliminando las relaciones con alumnos en estado 'No matriculado' implementada.

**11/05/2024**
- Corrección de una ambigüedad en la función de getAlumnosManana y getAlumnosTarde que provocaba un error que impedía ejecutar correctamente el modal de la página de inicio.
- El error de la página web/index.php que no muestra el modal es por la ruta que se usa en el método que lo ejecuta, sigo buscando soluciones.
- Desarrollada función para que al crear un alumno, se cree automáticamente la relación con cursan.
- Desarrollo de botones desplegables usando formularios.
- Configuración de las reglas del modelo de Cursos y función para guardar la sigla de un nuevo curso.

**12/05/2024**
- Implementado en la página de gestión de cursos el modal de crear un nuevo curso.
- Configurado el GridView de la página de gestión de cursos.
- Implementado un buscador para la página de gestión de cursos.
- Configurado el formulario de la gestión de cursos.
- Implementación de un modal para actualizar los cursos.

**13/05/2024**
- Ampliación de las reglas del modelo Alumnos.
- Implementación de funciones para validar el DNI de los alumnos.
- Descubierto un error en la base de datos: el campo del DNI de los alumnos está limitado a 8 caracteres cuando el DNI tiene 9 caracteres.

**14/05/2024**
- Edicción en la base de datos, cambiando el nombre del campo "nombre_corto" por "sigla" en la tabla Cursos y modificando la longitud del campo "dni" en la tabla Alumnos.
- Modificación del Gridview, con problemas al intentar implementar una columna con el nombre del curso que cursa el alumno en caso de que esté matriculado.

**15/05/2024**
- Corrección del diagrama entidad-relación y relacional basado en los cambios del campo "nombre_corto".
- Búsqueda de nuevos colores porque el color principal de la aplicación es muy saturado.
- Implementación del modal de inicio con la librería Modal de Bootstrap 4.
- Implementación del desplegable con los alumnos disponibles para reservar.
- Pruebas de actualización de los datos en la reserva.

**16/05/2024**
- Desarrollo de las reglas de negocio en la fase de análisis.
- Pruebas para actualizar los alumnos al reservar el portátil con POST.

**17/05/2024**
- Añadida una sección de público objetivo y otra de nombre de la aplicación en la fase de análisis.

**18/05/2024**
- Implementación de la actualización de los alumnos para añadirles el portátil reservado usando JavaScript.
- Implementación de condicionales para que los botones de selección no aparezcan si el portátil está averiado y otro condicional que no ejecuta el código Ajax si los valores son nulos, que no funciona correctamente.
- Implementación de la función para sincronizar portátiles, cargadores y sus cargas.
- Desarrollo de las principales reglas de los atributos de todos los modelos.
- Corrección de la consulta que sincroniza el modelo "cursan", eliminando las relaciones que estén en el mismo curso académico y en el mismo turno cursado por el mismo alumno.

**19/05/2024**
- Implementación de buscadores en las páginas de gestión de alumnos, portátiles y cargadores, además de modificar el número de elementos por paginación en los buscadores ya establecidos.
- La función de sincronización de alumnos falló debido a un error en la estructura de los datos, que causaba un fallo constante.

**20/05/2024**
- Corregida la sincronización de los alumnos debido a que, al haber dos campos iguales, daba error y no se guardaban los cambios.
- Maquetado el gridview de la página de gestión de alumnos.

**21/05/2024**
- Corregido el método de sincronización de alumnos causado por un error en el DNI.
- Intento de crear un label en el formulario de creación de un alumno que se relacionase con el modelo de "cursan" para crear un nuevo curso.

**22/05/2024**
- Corregidas las reglas de los portátiles.
- Corregida la reserva de los portátiles ya que el código JavaScript tenía un error.
- Intento de implementar varios formularios en la página de creación de un nuevo alumno, para crear a su vez la relación entre el alumno y los cursos.
- Intento de crear un selector de cursos múltiple, pero por errores con diferentes widgets probados tuvo que ser descartado.

**23/05/2024**
- Corrección y finalización del DAFO.
- Implementación de los apartados del análisis en formato Markdown.
- Añadida la validación y sincronización de valores NIE en el campo de DNI del modelo Alumnos.
- Intento de implementar el formulario de creación de alumnos y la relación de "cursan" pero hay un error al crear el campo de "cursan" ya que este no se crea.
- Dado que la implementación de modales se está complicando, solo voy a hacer modales para los formularios de creación de los modelos.
- Configuración de la página de gestión de almacenes, incluyendo formularios, gridview, validaciones, y las operaciones de crear, actualizar y borrar.

**24/05/2024**
- Corrección de elementos en la actualización y creación de almacenes.
- Implementación y configuración de iconos en los botones.
- Finalización de la configuración del CRUD de Almacenes.
- Desarrollo del gridview de la página de gestión de cargadores.
- Problemas al añadir nuevos cargadores al intentar guardar el valor del almacén con un dropdown.

**25/05/2024**
- Desarrollado el modal para crear cargadores.
- Implementado un botón para descargar los códigos QR de los cargadores.
- Actualizada la vista para actualizar los cargadores.
- Configurado el buscador de los cargadores.
- Error al no mostrar el mensaje cuando hay un cargador y almacén duplicado.
- Documentación de las pruebas.

**26/06/2024**
- Probando diferentes estilos de las columnas de los gridview y los botones de gestión.
- Configuración de los botones del gridview de la página de gestión de portátiles.
- Implementación de una sección de checkboxes para seleccionar las aplicaciones que tendrá un nuevo portátil.
- Implementación del botón de descarga del código QR en la página de gestión de portátiles.
- Desarrollo del formulario para la creación de portátiles.
