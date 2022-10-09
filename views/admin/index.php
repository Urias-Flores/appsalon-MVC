<h1 class="nombre-pagina">Administrador</h1>
<p class="descripcion-pagina">Administra todas tus consultas desde este apartado</p>

<?php include_once __DIR__ . '/../templates/barra.php'; ?>

<h2>Buscar citas</h2>

<div class="search">
    <form class="form">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input
                    type="date"
                    id="fecha"
                    name="fecha"
                    value="<?php echo $Fecha ?>"
            >
        </div>
    </form>
</div>

<div id="citas-admin">
    <ul class="citas">
        <?php $idCita = -1; ?>
        <?php foreach ($Citas as $key => $cita): ?>

            <?php if($idCita !== $cita->ID): $idCita = $cita->ID; $total = 0?>
                    <li>
                    <p> ID: <span><?php echo $cita->ID ?></span> </p>
                    <p> Hora: <span><?php echo $cita->Hora ?></span> </p>
                    <p> Usuario: <span><?php echo $cita->Cliente ?></span> </p>
                    <p> Correo: <span><?php echo $cita->Correo ?></span> </p>
                    <p> Telefono: <span><?php echo $cita->Telefono ?></span> </p>
                    <h3>Servicios</h3>
                <?php endif; ?>
                    <p class="servicio"> <span><?php echo $cita->Servicio . ' ' . $cita->Precio ?></span> </p>
                    <?php $total += intval($cita->Precio) ?>
                <?php
                    $actual = $cita->ID;
                    $next = $Citas[$key + 1]->ID ?? 0;
                ?>
                    <?php if($actual != $next): ?>
                        <p class="total">Total: <span><?php echo '$'.$total ?></span></p>

                        <form method="post" action="/api/delete">
                            <input type="hidden" name="ID" value="<?php echo $cita->ID; ?>">
                            <input type="submit" class="boton-eliminar" value="Eliminar">
                        </form>
                    <?php endif; ?>
        <?php endforeach; ?>
    </ul>

    <?php echo count($Citas) === 0 ? '<h3>No se encontro ninguna cita</h3>' : ''; ?>
</div>

<?php
    $script = '<script src="build/js/buscador.js"></script>';
?>
