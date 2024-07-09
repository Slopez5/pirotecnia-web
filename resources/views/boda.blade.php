<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sergio & Yadira - Nuestra Boda</title>
    <link rel="stylesheet" href="{{ asset('bodaResource/style.css') }}">
</head>

<body>
    <header>
        <h1>Sergio & Yadira</h1>
        <p>7 de septiembre de 2024</p>
    </header>

    <nav>
        <ul>
            <li><a href="#nosotros">Nosotros</a></li>
            <li><a href="#detalles">Detalles de la Boda</a></li>
            <li><a href="#galeria">Galería</a></li>
            <li><a href="#confirmacion">Confirmación</a></li>
        </ul>
    </nav>

    <section id="nosotros">
        <h2>Nuestra Historia</h2>
        <p>Detalles sobre cómo se conocieron y su historia juntos.</p>
    </section>

    <section id="detalles">
        <h2>Detalles de la Boda</h2>
        <p>Información sobre la fecha, el lugar, y otros detalles importantes.</p>
    </section>

    <section id="galeria">
        <h2>Galería</h2>
        <p>Fotos de la pareja y eventos anteriores.</p>
    </section>

    <section id="confirmacion">
        <h2>Confirmación de Asistencia</h2>
        <form>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Confirmar</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Sergio & Yadira. Todos los derechos reservados.</p>
    </footer>

    <script>
        // main.js

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                alert('¡Gracias por confirmar tu asistencia!');
                form.reset();
            });
        });
    </script>
</body>

</html>
