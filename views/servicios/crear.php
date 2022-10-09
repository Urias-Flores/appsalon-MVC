<h1 class="nombre-pagina">Nuevo servicio</h1>
<p class="descripcion-pagina">Agrega mas servicios a tu lista de servicios disponibles</p>

<?php include_once __DIR__ . '/../templates/barra.php';
    include __DIR__ . '/../templates/alertas.php';
?>

<form action="/servicios/crear" method="post" class="form">
    <?php include __DIR__ . '/formulario.php'?>
    <input type="submit" class="boton" value="Guardar servicio">
</form>
