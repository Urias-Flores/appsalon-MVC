<h1 class="nombre-pagina">Elige tus servicio</h1>
<p class="descripcion-pagina">Selecciona todos los servicios que desees realizarte</p>

<?php include_once __DIR__ . '/../templates/barra.php'; ?>

<div class="app">

    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Informacion</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion show">
        <h2>Servicios</h2>
        <p class="text-center">Elije tus servicios acontinuacion...</p>
        <div id="services" class="list-services"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Informacion de tu cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tus citas</p>

        <form class="form">
            <div class="campo">
                <label for="Nombre">Nombre:</label>
                <input
                    id="Nombre"
                    type="text"
                    placeholder="Escribe tu nombre..."
                    value="<?php echo $Nombre ?>"
                    readonly
                >
            </div>

            <div class="campo">
                <label for="Fecha">Fecha:</label>
                <input
                    id="Fecha"
                    type="date"
                    min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>"
                >
            </div>

            <div class="campo">
                <label for="Hora">Hora:</label>
                <input
                    id="Hora"
                    type="time"
                    min="9:00"
                    max="5:00"
                >
            </div>
            <input type="hidden" name="ID" id="ID" value="<?php echo $ID; ?>">
        </form>
    </div>

    <div id="paso-3" class="seccion container-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que toda tu informacion este bien</p>
    </div>

    <div class="pagination">
        <button type="button" class="boton" id="previous">
            &laquo; Anterior
        </button>

        <button type="button" class="boton" id="next">
            Siguiente &raquo;
        </button>
    </div>
</div>

<?php $script = '
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="build/js/app.js"></script>';