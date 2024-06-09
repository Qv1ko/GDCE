## Diario de trabajo

**12/11/2023**
- Entrega del proyecto inicial.

**28/12/2023**
- Desarrollo de la portada, encabezado y puntos principales del anteproyecto.

**29/12/2023**
 -Elaboración de la presentación del problema planteado.

**30/12/2023**
- Desarrollo del análisis DAFO y descripción de la documentación a entregar.

**31/12/2023**
- Redacción de la descripción técnica.

**04/01/2024**
- Definición y desarrollo de los objetivos.

**05/01/2024**
- Creación del diagrama de Gantt.

**07/01/2024**
- Planificación del trabajo y estimación temporal.

**08/01/2024**
- Implementación del DAFO, corrección de la descripción técnica, y mejora de los objetivos y la planificación del trabajo.

**09/01/2024**
- Mejora del diagrama de Gantt y ajuste de la planificación del trabajo.

**15/01/2024**
- Modificación del nombre de la tabla de Aplicaciones debido a un problema durante la creación del CRUD.

**26/01/2024**
- Creación de la tabla de Cursos para mejorar la implementación de turnos para los alumnos.

**31/01/2024**
- Entrega del primer prototipo de la aplicación con CRUD.

**02/02/2024**
- Creación del proyecto en GitLab.

**21/02/2024**
- Eliminación de la tabla Ratones por falta de utilidad en la aplicación.
- Modificación del diagrama entidad-relación para incluir el conjunto de entidades Cursos y eliminar el conjunto Ratones.
- Búsqueda y selección de una portada para la documentación.
- Cambio de la tipografía de Dosis a Roboto para mejorar la visibilidad y alinearla con la interfaz de la aplicación.

**23/02/2024**
- Actualización del diagrama relacional incluyendo las tablas Cursos, Cursan y Cargan, eliminando la tabla Ratones.
- Modificación del script de creación de la base de datos para reflejar los cambios en las tablas y eliminar la tabla Ratones.
- Simplificación de la relación entre las tablas en los diagramas entidad-relación y relacional, eliminando la relación entre Cargadores y Alumnos.
- Creación de scripts para la estructura y el llenado de la base de datos con datos de ejemplo.

**26/02/2024**
- Configuración de la aplicación.
- Incorporación de backup a la carpeta de datos de la aplicación.
- Implementación de modelos y CRUD.

**27/02/2024**
- Selección de la portada para la documentación.
- Ajustes en los colores debido a problemas de contexto en su elección.

**28/02/2024**
- Desarrollo del gráfico de "estado de portátiles" para la página de inicio.
- Modificación de la estructura de la base de datos para hacer tanto el nombre como el año del curso clave única.
- Cambio del color principal por ser demasiado oscuro.

**29/02/2024**
- Desarrollo del gráfico de "estado de cargadores" para la página de inicio.

**02/03/2024**
- Desarrollo del gráfico de "uso por cursos" para la página de inicio.

**03/03/2024**
- Creación de la estructura básica de la documentación.
- Corrección de las dimensiones del DAFO.
- Desarrollo adicional de gráficos para la página de inicio.
- Implementación de la librería 2amigos/chartjs.
- Modificación de la interfaz en Figma.

**04/03/2024**
- Configuración de páginas y logotipo en el encabezado.
- Configuración del favicon.

**05/03/2024**
- Reestructuración de elementos del pie de página.
- Cambio en la alineación del encabezado.
- Búsqueda de información sobre FontAwesome y su widget para Yii2.

**06/03/2024**
- Configuración de colores del encabezado.
- Configuración de iconos en el pie de página con enlaces.
- Cambio de logotipo por problemas de visibilidad.
- Cambio del favicon y corrección de la ruta para que se visualice en todas las páginas.

**07/03/2024**
- Configuración de gráficos tipo pie.
- Cambio de la configuración del gráfico pie de PHP a JavaScript por problemas con los labels.
- Añadido el gráfico de los almacenes.

**08/03/2024**
- Ajuste en la visualización de items del encabezado para diferenciar acceso entre usuarios invitados y registrados.

**09/03/2024**
- Añadida separación entre secciones de gráficos.
- Página de inicio modificada: gráficos trasladados a otra página, dejando la página de inicio para la sección de QR, la parte principal de la aplicación.

**10/03/2024**
- Desarrollo de redirección a la página de inicio para usuarios invitados.

**11/03/2024**
- Cambio en las redirecciones de cadenas a variables.
- Reestructuración de la página de gráficos y añadidos títulos.
- Cambio de la interfaz del inicio de sesión.
- Desarrollo del gráfico de la capacidad de los almacenes.

**12/03/2024**
- Corrección del gráfico de capacidad de los almacenes debido a errores en el widget (problemas con labels y el valor mínimo).
- Cancelación del gráfico de uso anual por falta de implementación en la base de datos.

**13/03/2024**
- Investigación para desarrollar lector de códigos QR.
- Búsqueda de ejemplos de dashboards para mejorar la página de gráficos.
- Modificación de la página de gestión de portátiles.

**14/03/2024**
- Desarrollo de una nueva interfaz en Figma.

**21/03/2024**
- Documentación de la tipografía.

**22/03/2024**
- Desarrollo de la vista "Portátil" para mostrar información del dispositivo escaneado.

**23/03/2024**
- Continuación del desarrollo de la vista "Portátil".
- Implementación de nuevos iconos para la aplicación.
- Desarrollo de un estilo de caja para visualizar la información de los portátiles.

**24/03/2024**
- Investigación para implementar un desplegable.
- Modificaciones en las columnas del grid en la página de Almacenes.
- Documentación de la tipografía añadida a la documentación final.
- Búsqueda de información y ejemplos para el lector de códigos QR.

**25/03/2024**
- Pruebas con la librería html5-qrcode para escaneo de códigos QR.

**26/03/2024**
- Añadido bloque de búsqueda de portátiles en la página de inicio.
- Rediseño completo de la página de inicio para mejorar su apariencia y funcionalidad.

**27/03/2024**
- Cambio de los estilos de los iconos a estilos en línea.
- Modificación de la estructura del buscador de portátiles por problemas de responsividad.

**28/03/2024**
- Reestructuración de la página de inicio y adición de contenido.
- Configuración de SSL para localhost para probar el lector de códigos QR en dispositivos móviles.

**29/03/2024**
- Configuración de SSL y DNS personalizado para la aplicación web.
- Pruebas exitosas del lector de códigos QR en dispositivos móviles.
- Modificación de la interfaz de la página de inicio para adaptarla al lector de QR.

**30/03/2024**
- Fusión del lector de códigos QR con el buscador en la página de inicio.
- Solución de problemas con la recarga de la página y permisos de cámara al escanear códigos QR incorrectos.

**31/03/2024**
- Añadida una columna con checkbox a la página de gestión de almacenes.

**01/04/2024**
- Eliminación de la columna de checkboxes en la gestión de almacenes para evitar eliminación accidental.
- Añadido buscador y modificados los botones en la gestión de almacenes.
- Comentarios y refactorización del código de la página de inicio y cambios en las clases Bootstrap.
- Actualización de estilos del lector de códigos QR.
- Pruebas y mejoras en la responsividad del footer en móviles.

**02/04/2024**
- Mejora de la responsividad de la página de inicio.
- Reubicación del botón de crear almacenes y añadido de botones de importar/exportar.
- Añadidos iconos para funciones CRUD.

**03/04/2024**
- Desarrollo de la función para cambiar el estado de un portátil según la hora y su ocupación.

**04/04/2024**
- Configuración de columnas y contenido en la gestión de portátiles, cargadores y almacenes.
- Añadido botón para listar aplicaciones de cada portátil.

**05/04/2024**
- Implementado botón de exportación en la gestión de almacenes.

**07/04/2024**
- Integración de la creación de almacenes en la página index con popup al pulsar el botón de crear.

**08/04/2024**
- Eliminación de la leyenda en gráficos y añadido de color degradado al gráfico de uso por ciclo.

**09/04/2024**
- Reestructuración y cambio de estilos en la página de gráficos, inspirada en dashboards.

**10/04/2024**
- Cambio de tipo de gráfico en el gráfico de uso por ciclo.
- Añadido texto informativo en el gráfico de estados.

**12/04/2024**
- Reconfiguración del diseño del dashboard.

**13/04/2024**
- Implementación fallida de un modal en la página de inicio para reemplazar la página de portátiles.
- Añadidos contenidos y cambios de estilos en la página de gráficos.

**14/04/2024**
- Configuración de títulos y cambio de tipo de gráfico a donut.
- Ajuste de estilos para encabezados y párrafos.

**15/04/2024**
- Configuración de los gráficos en la página de gráficos.

**16/04/2024**
- Eliminación de franjas blancas en el footer en dispositivos móviles y ajuste de alineación vertical.
- Desarrollado nuevo modal para la página de inicio.

**17/04/2024**
- Problemas al implementar modal para el menú de inicio, y fallos en la configuración de exportación de datos en la gestión de almacenes.

**18/04/2024**
- Eliminación de botones de importar/exportar.
- Problemas al implementar modal para el acceso a portátiles escaneados.

**19/04/2024**
- Renombrada la página de Gráficos a Panel.
- Implementación de botones para listar portátiles y cargadores.
- Implementación de modal con GridView, con problemas de adaptación.

**20/04/2024**
- Implementación de GridView en modales.
- Problemas al usar Kartik GridView debido a conflictos con Bootstrap.
- Dificultades con consultas a dos tablas en GridView.

**21/04/2024**
- Configuración de GridView para mostrar columnas y eliminación del summary.
- Documentación del prototipo de la interfaz.

**22/04/2024**
- Documentación de diferentes prototipos de la interfaz.

**23/04/2024**
- Desarrollo del diagrama de clases.

**24/04/2024**
- Desarrollo del diagrama de casos de uso y corrección de cardinalidades en el diagrama de clases.

**25/04/2024**
- Documentación de prototipos y diagramas de clase y casos de uso.

**26/04/2024**
- Corrección en el diagrama de casos de uso.

**27/04/2024**
- Implementación de modal para visualizar información del portátil.

**28/04/2024**
- Ajustes en el modal para que no muestre el pie de página y eliminación del padding superior.
- Problemas con la visualización del modal en dispositivos móviles.
- Elección de la plantilla para la presentación.

**29/04/2024**
- Añadidos títulos a iconos del pie de página.
- Ajustes en los estilos del modal del portátil.

**30/04/2024**
- Estilización del modal.

**01/05/2024**
- Actualización de estilos de botones y otros elementos del modal de la página de inicio.

**02/05/2024**
- Desarrollo de consultas para la función de actualización del estado del portátil.

**03/05/2024**
- Implementada y probada la función de actualización del estado del portátil al abrir el modal.
- Desarrollo del selector de alumnos de tarde con la librería select2.

**04/05/2024**
- Configuración de las páginas de gestión de portátiles.
- Desarrollo de una barra de búsqueda para la gestión de almacenes.

**05/05/2024**
- Implementación de la barra de búsqueda en la página de gestión de almacenes.

**06/05/2024**
- Creación de un backup de la base de datos.
- Configuración de estilos para la página del panel.
- Implementación de una función para la sincronización de alumnos, eliminando portátiles si no están matriculados o están averiados.

**07/05/2024**
- Corrección del título del modal al escanear un código QR.

**08/05/2024**
- Problemas con el reinicio del escáner de códigos QR (escanea continuamente al mantener la cámara en un QR).
- Implementación de recarga al cerrar el modal para reiniciar el escáner de QR.

**09/05/2024**
- Intento fallido de implementación de Dropbox (conflictos con Bootstrap y no funcionalidad en modal).

**10/05/2024**
- Corrección del diagrama de casos de uso.
- Documentación sobre color.
- Implementación de una función para actualizar relaciones entre alumnos y cursos, eliminando relaciones con alumnos no matriculados.

**11/05/2024**
- Corrección de errores en funciones getAlumnosManana y getAlumnosTarde.
- Error en la ruta del modal en web/index.php.
- Desarrollo de una función para crear relaciones con cursos al crear un alumno.
- Desarrollo de botones desplegables con formularios.
- Configuración de reglas del modelo de Cursos y función para guardar la sigla de un nuevo curso.

**12/05/2024**
- Implementación de un modal para crear un nuevo curso en la gestión de cursos.
- Configuración del GridView y buscador en la gestión de cursos.
- Configuración del formulario de la gestión de cursos.
- Implementación de un modal para actualizar cursos.

**13/05/2024**
- Ampliación de reglas del modelo Alumnos.
- Implementación de validación de DNI.
- Error en la base de datos: campo DNI limitado a 8 caracteres en vez de 9.

**14/05/2024**
- Edición de la base de datos: cambio de "nombre_corto" a "sigla" en la tabla Cursos y ajuste del campo "dni" en Alumnos.
- Modificación del GridView, con problemas al añadir columna con el nombre del curso del alumno.

**15/05/2024**
- Corrección del diagrama entidad-relación y relacional.
- Búsqueda de nuevos colores para la aplicación.
- Implementación del modal de inicio con Bootstrap 4.
- Implementación de desplegable para alumnos disponibles.
- Pruebas de actualización de datos en la reserva.

**16/05/2024**
- Desarrollo de las reglas de negocio en la fase de análisis.
- Pruebas de actualización de alumnos al reservar portátil con POST.

**17/05/2024**
- Añadida sección de público objetivo y nombre de la aplicación en la fase de análisis.

**18/05/2024**
- Implementación de actualización de alumnos para asignar portátiles reservados usando JavaScript.
- Implementación de condicionales para ocultar botones si el portátil está averiado y para evitar ejecución de Ajax con valores nulos.
- Implementación de función para sincronizar portátiles, cargadores y sus cargas.
- Desarrollo de reglas de atributos de todos los modelos.
- Corrección de consulta para sincronizar modelo "cursan".

**19/05/2024**
- Implementación de buscadores en páginas de gestión de alumnos, portátiles y cargadores.
- Ajuste del número de elementos por paginación.
- Fallo en la función de sincronización de alumnos por error en la estructura de datos.

**20/05/2024**
- Corrección de sincronización de alumnos debido a duplicación de campos.
- Maquetación del GridView de la gestión de alumnos.

**21/05/2024**
- Corrección del método de sincronización de alumnos por error en el DNI.
- Intento de creación de label en formulario de alumno para relación con el modelo "cursan".

**22/05/2024**
- Corrección de reglas de portátiles y reserva.
- Intento de implementación de formularios múltiples en creación de alumnos para relación con cursos.
- Problemas al implementar selector múltiple de cursos (descartado por errores con widgets).

**23/05/2024**
- Corrección y finalización del DAFO.
- Documentación del análisis en Markdown.
- Validación y sincronización de valores NIE en el campo de DNI de Alumnos.
- Problemas al crear campo "cursan" en formulario de creación de alumnos.
- Decisión de usar modales solo para formularios de creación de modelos.
- Configuración completa de la gestión de almacenes.

**24/05/2024**
- Corrección en actualización y creación de almacenes.
- Configuración de iconos en botones.
- Finalización del CRUD de Almacenes.
- Desarrollo del GridView de la gestión de cargadores.
- Problemas al guardar valor de almacén en nuevos cargadores.

**25/05/2024**
- Desarrollo de modal para crear cargadores.
- Implementación de botón para descargar códigos QR de cargadores.
- Actualización de vista para actualizar cargadores.
- Configuración del buscador de cargadores.
- Error al no mostrar mensaje en duplicados de cargadores y almacenes.
- Documentación de pruebas.

**26/05/2024**
- Pruebas de estilos en columnas y botones de gestión en GridView.
- Configuración de botones en GridView de gestión de portátiles.
- Implementación de checkboxes para seleccionar aplicaciones de nuevos portátiles.
- Implementación de botón de descarga de QR en gestión de portátiles.
- Desarrollo del formulario de creación de portátiles.

**27/05/2024**
- Eliminación de botón de aplicaciones en gestión de portátiles por complicaciones (implementadas en columna de GridView).
- Implementación de ListView para página de aplicaciones.
- Implementación de un modal para crear aplicaciones.
- Desarrollo de función de sincronización de aplicaciones.

**28/05/2024**
- Implementación de un modal para mostrar aplicaciones de cada portátil.
- Funciones de actualización y eliminación de aplicaciones con sincronización.
- Desarrollo de actualización de portátiles.

**29/05/2024**
- Desarrollo de página de actualización de portátiles, incluyendo selección de aplicaciones y cargadores.
- Cambio de paleta de colores.
- Desarrollo de reglas de negocio de la aplicación.
- Implementación de animación en la barra de navegación.

**30/05/2024**
- Implementación de una función para crear alumnos.
- Pruebas del modelo de alumnos.
- Implementación de una función para actualizar alumnos.
- Eliminación de vistas de modelos "cursan" y "cargan".

**31/05/2024**
- Cambio de logo de la aplicación.
- Desarrollo del README.md.
- Desarrollo de un modal que aparece al escanear un código QR de un cargador.

**01/06/2024**
- Implementada la vinculación de cargadores a portátiles mediante escaneo de QR.
- Actualización de colores y finalización de la documentación sobre colores y tipografía.

**02/06/2024**
- Corrección del array para el listado de aplicaciones en portátiles para evitar errores cuando no hay aplicaciones.
- Arreglado el cálculo del porcentaje de dispositivos disponibles, corrigiendo errores con valores cero.
- Añadida regla para definir valores mínimos en tablas de portátiles, cargadores y almacenes.
- Traducción y configuración del escáner de códigos QR.
- Ajuste de los GridView en la página del panel para mostrar la información correctamente.
- Configuración de buscadores para búsquedas por atributos múltiples.
- Implementación de mensaje de error en duplicación de valores únicos en formularios de modal.
- Creación de un modal de actualización para la gestión de cursos.

**03/06/2024**
- Corrección del envío de datos por Ajax en el modal de actualización de cursos.
- Añadida responsividad a los GridView de alumnos y cursos.
- Corrección de caracteres con tilde en siglas.
- Configuración de modal de actualización para alumnos y portátiles.
- Corrección de validación del NIE.
- Añadido al GridView la representación del año del curso de cada alumno.
- Implementado modal de actualización para aplicaciones.
- Ajuste en la selección de portátiles para que solo estén disponibles portátiles completamente disponibles.
- Mejora en la maquetación de páginas de creación y actualización de portátiles para una visualización clara de errores.

**04/06/2024**
- Implementación de modal de actualización para cargadores y almacenes.
- Desarrollada condición para eliminar la relación de almacenes con portátiles y cargadores si la capacidad máxima es menor que la ocupación.
- Simplificación de mensajes de reglas para modelos de alumnos, aplicaciones y cursos.
- Implementación de mensajes de notificación para operaciones en modelos.
- Configuración de gráficos y GridViews en la vista de panel.
- Ajuste de estilos en GridViews.
- Corrección en la actualización de portátiles para que aparezcan en el desplegable.
- Ajuste en la reserva de portátiles para alumnos matriculados en cursos de diferentes turnos.

**05/06/2024**
- Corrección de labels en GridViews de cargadores y alumnos.
- Añadida cantidad máxima a la capacidad de almacenes.
- Cambios en la sincronización de cargadores para establecer su estado como "No disponible" si están vinculados a un portátil.
- Documentación de la planificación, análisis y diseño.
- Añadidos títulos a los iconos.
- Desarrollo de bibliografía.
- Ajuste del tamaño de containers en GridViews de portátiles y almacenes.
- Configuración para que filas de GridView no se salten de línea.
- Disposición responsiva de iconos en el footer.

**06/06/2024**
- Documentación de la bibliografía y pruebas.
- Alineación de registros en GridViews.
- Corrección de documentación y diagrama de casos de uso.
- Desarrollo de conclusiones e introducción.
- Maquetación de la vista de login.
- Implementación de contraseñas encriptadas.
- Ajuste de estilos en la página de inicio y corrección de la función de reserva de portátiles.

**07/06/2024**
- Corrección de la documentación.
- Agregada reflexión personal en conclusiones.
- Edición de la presentación.

**08/06/2024**
- Corrección y documentación del diario de trabajo.
- Mejora de la interfaz de los modales para la reserva de portátiles y vinculación de cargadores.
- Comentarios y refactorización del código.
- Finalización de la fase de desarrollo en la presentación.
- Maquetación de la página de error.
- Desarrollo de la base de la presentación.

**09/06/2024**
- Continuación de los comentarios y la refactorización del código.
- Ampliación de las conclusiones y añadido encabezado a la documentación.
- Corrección y simplificación de apartados de la presentación.
- Implementación de estilos al panel para formato de pantalla pequeña.
- Eliminación de la condición de autenticación que impedía reservar portátiles y vincular cargadores.
- Actualización del backup.
- Ordenamiento alfabético de los listados de selección.
- Finalización de la presentación.
