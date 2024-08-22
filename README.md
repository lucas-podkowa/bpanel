# Sobre el Sistema
bpanel es una solución de software desarrollada en Laravel 8 para resolver el siguiente inconveniente:
## Problema
Existe un sistema de conferencia web de código abierto **BigBlueButton** el cual fue instalado en los servidores de la Facultad de Ingeniería (UNaM) para ser utilizado por los docentes de la casa de estudio. Dicho sofware fue enlazado al Sistema Aula Virtual Moodle, a través del cual se podían iniciar videoconferencias y grabar las clases durante la pandemia del Covid-19. Sin embargo, BigBlueButton en su versión gratuita no poseía una interfaz de usuario para analizar los logs generados por el sistema, aunque lo almacenaba en archivos XML, eran imposibles de interpretar por alguien que no conozca el lenguaje. De modo que las autoridades responsables no podían hacer un seguimiento efectivo de las actividades online que se realizaban en ese período

## Solución
He desarrollado un software con Laravel que **analiza los achivos XML generados por BigBlueButton y los muestra en una interfaz de usuario amigable**, donde el personal directivo fuera capaz de ver en cualquier momento datos como los detalles de las sesiones que se estaba llevando a cabo en éste momento, el hisotrial de las sesiones realizadas organizadas por asignatura y/o anfitriones
Es un sistema muy pequeño que puede resumirse en las siguientes rutas

* llamada al presionar "Ahora" para ver las sesiones actuales con datos como la cantidad de micrófonos abiertos y cerrados, cantidad de participantes, etc.
    * Route::get('/', [XmlController::class, 'index'])->name('sesiones.index');

* llamada al presionar "Historial" para ver y filtrar sesiones finalizadas
    * Route::get('/salas', [SalaController::class, 'index'])->name('salas.index');

* llamado al presionar los botones de las tablas tanto de "Ahora" como de "Hitorial", para mostrar los detalles sobre una sesión específica, tales como cantidad de participantes, hora de inicio, rol de los participantes, entre otras.
    * Route::get('/salas/{show}', [SalaController::class, 'show',])->name('asistentes.show');

* muestra todos los asistentes actuales sin considerar las salas donde estén
    * Route::get('/asistentes', [AsistenteController::class, 'index'])->name('asistentes.index');

