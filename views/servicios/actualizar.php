<h1 class="nombre-pagina">Actualiza el servicio</h1>
<p class="descripcion-pagina">Actualiza los precios o nombres de los servicios actuales</p>

<?php include_once __DIR__ . '/../templates/barra.php';
include __DIR__ . '/../templates/alertas.php';
?>

<form method="post" class="form">
    <?php include __DIR__ . '/formulario.php'?>
    <input type="submit" class="boton" value="Guardar servicio">
</form>
