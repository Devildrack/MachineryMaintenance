<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reestablecer Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            max-width: 150px;
        }

        .content {
            line-height: 1.6;
        }

        .content h2 {
            text-align: center;
            /* Centra solo el h2 */
        }

        .button {
            display: inline-block;
            background-color: #007BFF;
            color: #fff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #888;
        }

        .footer a {
            color: #007BFF;
            text-decoration: none;
        }

        .line {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .small-text {
            font-size: 12px;
            /* Reduce el tamaño del texto */
            word-wrap: break-word;
            /* Evita que el texto se salga del contenedor */
            max-width: 100%;
            /* Asegura que no se pase del contenedor */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>

        <div class="content">
            <p>Hola {{ $user->name }},</p>
            <p>Recibimos una solicitud para restablecer la contraseña de tu cuenta. Si fuiste tú, haz clic en el
                siguiente botón para restablecer tu contraseña:</p>
            <a href="{{ $url }}" class="button">Restablecer Contraseña</a>
            <p>Este enlace expirará en 60 minutos. Si no solicitaste el restablecimiento de la contraseña, puedes
                ignorar este correo.</p>

            <div class="line"></div>
            <p class="small-text">Si no puedes hacer clic en el botón "Restablecer Contraseña", copia y pega la
                siguiente URL en tu navegador:</p>
            <p class="small-text"><a href="{{ $url }}">{{ $url }}</a></p>
        </div>

        <div class="footer">
            <p>Atentamente, el equipo de Nombre Empresa</p>
        </div>
    </div>
</body>

</html>
