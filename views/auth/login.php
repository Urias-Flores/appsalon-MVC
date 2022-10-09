
<h1 class="nombre-pagina">Inicia sesion</h1>
<p class="descripcion-pagina">Inicia sesion con tus datos</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form class="form" method="post" action="/">
    <div class="campo">
        <label for="Email">Correo electronico</label>
        <input
                type="email"
                id="Email"
                name="Correo"
                placeholder="Ingresa tu correo..."
        >
    </div>

    <div class="campo">
        <label for="Contrasena">Contrasena</label>
        <input
                type="password"
                id="Contrasena"
                placeholder="Escribe tu contrasena"
                name="Contrasena"
        >
    </div>

    <input
            type="submit"
            class="boton"
            value="Iniciar sesion"
    >
</form>

<div class="actions">
    <a href="/create">Aun no tienes una cuenta? Crea una</a>
    <a href="/forgot">Olvidaste tu contrasena?</a>
</div>
