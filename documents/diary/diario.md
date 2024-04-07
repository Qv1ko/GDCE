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
