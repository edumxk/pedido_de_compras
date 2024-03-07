<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificação de Atualização</title>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" style="background-color: #f4f4f4; padding: 50px;">
            <table width="600" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center" style="padding: 20px 0;">
                        <img src="http://kokar.com.br/email/logo-long.png" alt="Logo" width="200">
                    </td>
                </tr>
                <tr>
                    <td align="center" style="background-color: #ffffff; padding: 50px;">
                        <h1 style="font-size: 24px; margin: 0;">{{ $data['subject'] }}</h1>
                        <p style="font-size: 16px; line-height: 24px; margin: 20px 0;">
                            {{ $data['message'] }}
                        </p>
                        <p style="font-size: 16px; line-height: 24px; margin: 20px 0;">
                            {{ $data['name'] }} atualizou a ordem de compra #{{ $data['id'] }}.
                        </p>
                        <p style="font-size: 16px; line-height: 24px; margin: 20px 0;">
                            Para mais informações, acesse o sistema em <a href="https://compras.kokar.com.br" target="_blank">compras.kokar.com.br</a>.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding: 20px 0;">
                        <p style="font-size: 14px; line-height: 20px; color: #666666; margin: 0;">
                            © 2024 Kokar Tintas. Todos os direitos reservados.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
