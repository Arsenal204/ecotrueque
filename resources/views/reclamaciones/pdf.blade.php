<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reclamación #{{ $reclamacion->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #333;
        }

        h1 {
            color: #5C3F94;
        }

        .section {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Reclamación #{{ $reclamacion->id }}</h1>

    <div class="section">
        <strong>Motivo:</strong> {{ $reclamacion->motivo }}<br>
        <strong>Descripción:</strong> {{ $reclamacion->descripcion }}<br>
        <strong>Estado:</strong> {{ ucfirst($reclamacion->estado_reclamacion) }}<br>
        <strong>Fecha:</strong> {{ $reclamacion->fecha_reclamacion }}
    </div>

    <div class="section">
        <strong>Reclamante:</strong> {{ $reclamacion->emisor->name }}<br>
        <strong>Reclamado:</strong> {{ $reclamacion->reclamado->name }}
    </div>

    @if ($reclamacion->intercambio)
        <div class="section">
            <strong>Objeto ofrecido:</strong><br>
            @if ($reclamacion->intercambio && $reclamacion->intercambio->objetoEmisor->imagenes->first())
                @php
                    $ruta = public_path(
                        'storage/' . $reclamacion->intercambio->objetoEmisor->imagenes->first()->ruta_imagen,
                    );
                @endphp
                <img src="{{ $ruta }}" style="width:150px; height:auto;">
            @endif
            <br>
            <strong>Objeto recibido:</strong><br>
            @if ($reclamacion->intercambio && $reclamacion->intercambio->objetoReceptor->imagenes->first())
                @php
                    $ruta = public_path(
                        'storage/' . $reclamacion->intercambio->objetoReceptor->imagenes->first()->ruta_imagen,
                    );
                @endphp
                <img src="{{ $ruta }}" style="width:150px; height:auto;">
            @endif
            <br>
        </div>
    @endif



    @if ($reclamacion->ruta_imagen)
        <div class="section">
            <strong>Imagen enviada:</strong><br>
            <img src="{{ public_path('storage/' . $reclamacion->ruta_imagen) }}" width="200">
        </div>
    @endif
</body>

</html>
