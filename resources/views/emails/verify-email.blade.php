<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verificación de Correo Electrónico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            max-width: 100px;
        }
        .content {
            text-align: center;
            padding: 20px 0;
        }
        .content h1 {
            color: #333333;
        }
        .content p {
            color: #666666;
        }
        .content a {
            text-decoration: none;
            color: #ffffff;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #82c0ff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            color: #999999;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">

        </div>
        <div class="content">
            <h1>Verifica tu correo electrónico</h1>
            <p>Gracias por registrarte. Por favor, haz clic en el botón de abajo para verificar tu dirección de correo electrónico.</p>
            <a href="{{ $url }}" class="button">Verificar Correo Electrónico</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Panamá Opina. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
