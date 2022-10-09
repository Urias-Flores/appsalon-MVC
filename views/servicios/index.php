<h1 class="nombre-pagina">Servicios disponibles</h1>
<p class="descripcion-pagina">Servicios disponibles para ser realizados</p>

<?php include_once __DIR__ . '/../templates/barra.php'; ?>

<ul class="service">
    <?php foreach ($Servicios as $servicio): ?>
        <li>
           <p>Nombre:<span> <?php echo $servicio->Nombre ?> </span></p>
           <p>Precio:<span> <?php echo '$' . $servicio->Precio ?> </span></p>

            <div class="actions">
                <a href="/servicios/actualizar?id=<?php echo $servicio->ID ?>" class="boton">Actualizar</a>
                <form action="/servicios/eliminar" method="post">
                    <input type="hidden" name="ID" value="<?php echo $servicio->ID ?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

