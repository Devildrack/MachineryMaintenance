<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Correo</title>
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
            <h2>¡Gracias por registrarte en Nombre Empresa!</h2>
            <p>Hola {{ $user->name }},</p>
            <p>Gracias por registrarte en Nombre Empresa. Estamos emocionados de tenerte con nosotros.</p>
            <p>Para completar tu registro, por favor confirma tu dirección de correo electrónico haciendo clic en el
                siguiente enlace:</p>
            <a href="{{ $verificationUrl }}" class="button">Verificar Correo</a>
            <p>Si no te has registrado en nuestro sitio, puedes ignorar este correo.</p>

            <div class="line"></div>
            <p class="small-text">Si tienes problemas al hacer clic en el botón "Verificar Correo Electrónico", copia y
                pega la siguiente
                URL en tu navegador web: <a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a></p>
        </div>

        <div class="footer">
            <p>Atentamente, el equipo de Nombre Empresa</p>
        </div>
    </div>
</body>

</html>
