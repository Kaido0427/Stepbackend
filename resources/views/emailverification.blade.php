<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification d'email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        td {
            padding: 20px;
            border-radius: 4px;
            text-align: center;
        }

        h1 {
            font-size: 1.8em;
            color: #3496FF;
            text-decoration: none;
            font-weight: 600;
            margin: 0;
        }

        img {
            width: 50px;
            height: auto;
        }

        p {
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .otp {
            background: #3496FF;
            color: #fff;
            padding: 5px 16px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 0 auto;">
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left" valign="middle">
                            <img src="votre-image-url" alt="Logo">
                        </td>
                        <td align="right" valign="middle">
                            <h1>{{ $app_name }}</h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                @php
                    $hour = date('H');
                    $greeting = $hour >= 0 && $hour < 12 ? 'Bonjour' : 'Bonsoir';
                @endphp
                <p>{{ $greeting }},</p>
                <p>Merci de vous être inscrit sur {{ $app_name }}. Utilisez le code OTP suivant pour finaliser votre
                    inscription.</p>
                <h2 class="otp">{{ $otp }}</h2>
            </td>
        </tr>
    </table>
</body>

</html>
