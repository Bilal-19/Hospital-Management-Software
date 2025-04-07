<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset Email</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f6fa; padding: 20px;">

    <table width="100%" style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);">
        <tr>
            <td>
                <h2 style="color: #2f3640;">Hello,</h2>
                <p style="color: #353b48;">{{ $emailMessage }}</p>

                <p style="font-size: 18px; margin-top: 30px;"><strong>Your New Password:</strong></p>
                <p style="background-color: #f1f2f6; padding: 15px; font-size: 20px; text-align: center; border-radius: 5px; color: #e84118;">
                    {{ $password }}
                </p>

                <p style="color: #718093; margin-top: 40px;">Please log in using this new password and change it immediately for security reasons.</p>

                <p style="margin-top: 30px;">Best regards,<br><strong>Your App Team</strong></p>
            </td>
        </tr>
    </table>

</body>
</html>
