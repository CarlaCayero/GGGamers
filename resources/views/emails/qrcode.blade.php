<!DOCTYPE html>
<html>
<head>
    <title>Tu código QR</title>
</head>
<body>
    <h1>¡Gracias por participar en el evento!</h1>
    <p><strong>Evento:</strong> {{ $evento['nombre'] }}</p>
    <p><strong>Fecha:</strong> {{ $evento['fecha_inicio'] }} - {{ $evento['fecha_fin'] }}</p>
    <p><strong>Descripción:</strong> {{ $evento['descripcion'] }}</p>
    <p>Adjunto encontrarás tu código QR para participar en el evento.</p>
</body>
</html>
