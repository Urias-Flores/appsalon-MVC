<h1 class="nombre-pagina">Olvidaste tu contrasena</h1>
<p class="descripcion-pagina">Reestablece tu contrasena escribiendo tu
    correo electronico a continuacion</p>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form class="form" method="post" action="/forgot">
    <div class="campo">
        <label for="Correo">Correo electronico</label>
        <input
            type="text"
            name="Correo"
            id="Correo"
            placeholder="Escribe tu correo..."
        >
    </div>

    <input type="submit" class="boton" value="Reestablecer">
</form>

<div class="actions">
    <a href="/">Ya tienes una cuenta? Inicia sesion</a>
    <a href="/create">No tienes una cuenta? Crea una</a>
</div>

