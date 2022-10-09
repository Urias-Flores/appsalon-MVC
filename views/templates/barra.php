<div class="barra">
    <p>Hola! <?php echo $Nombre ?></p>
    <a class="boton" href="/logout">Cerrar sesion</a>
</div>

<?php
    if(isset($_SESSION['Admin'])):
        if($_SESSION['Admin']): ?>
            <div class="barra-servicio">
                <a class="boton" href="/admin">Ver citas</a>
                <a class="boton" href="/servicios">Ver servicios</a>
                <a class="boton" href="/servicios/crear">Nuevo servicio</a>
            </div>
        <?php endif;
    endif;
?>
