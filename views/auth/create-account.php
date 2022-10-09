<h1 class="nombre-pagina">Crea tu cuenta</h1>
<p class="descripcion-pagina">llena el siguiente formulario para crear tu cuenta</p>

<?php

    include_once __DIR__ . '/../templates/alertas.php';

?>

<form class="form" method="post" action="/create">
    <div class="campo">
        <label for="Nombre">Nombre</label>
        <input
            id="Nombre"
            name="Nombre"
            type="text"
            placeholder="Escribe tu nombre..."
            value="<?php echo sanitizeHTML($Usuario->Nombre); ?>"
        >
    </div>

    <div class="campo">
        <label for="Apellido">Apellido</label>
        <input
            id="Apellido"
            name="Apellido"
            type="text"
            placeholder="Escribe tu apellido..."
            value="<?php echo sanitizeHTML($Usuario->Apellido); ?>"
        >
    </div>

    <div class="campo">
        <label for="Telefono">Numero telefonico</label>
        <input
            id="Telefono"
            name="Telefono"
            type="tel"
            placeholder="Escribe tu telefono..."
            value="<?php echo sanitizeHTML($Usuario->Telefono); ?>"
        >
    </div>

    <div class="campo">
        <label for="Correo">Correo electronico</label>
        <input
            id="Correo"
            name="Correo"
            type="email"
            placeholder="Escribe tu correo..."
            value="<?php echo sanitizeHTML($Usuario->Correo); ?>"
        >
    </div>

    <div class="campo">
        <label for="Contrasena">Contrasena</label>
        <input
            id="Contrasena"
            name="Contrasena"
            type="password"
            placeholder="Escribe tu contrasena..."
        >
    </div>

    <input type="submit" class="boton">
</form>

<div class="actions">
    <a href="/">Ya tienes una cuenta? Inicia sesion</a>
    <a href="/forgot">Olvidaste tu contrasena?</a>
</div>