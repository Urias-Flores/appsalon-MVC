<h1 class="nombre-pagina">Reestablece tu contrasena ahora</h1>
<p class="descripcion-pagina">Escribe una nueva contrasena para tu cuenta</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<?php if($error) return; ?>
<form class="form" method="post">
    <div class="campo">
        <label for="Contrasena">Nueva contrasena</label>
        <input
            type="password"
            name="Contrasena"
            id="Contrasena"
            placeholder="Escribe tu nueva contrasena..."
        >
    </div>

    <input type="submit" class="boton" value="Reestablecer">
</form>

<div class="actions">
    <a href="/">Ya tienes una cuenta? Inicia sesion</a>
    <a href="/create">No tienes una cuenta? Crea una</a>
</div>

