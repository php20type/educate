<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Site Title -->
    <title></title>

    <!-- Character Set and Responsive Meta Tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
</head>

<body style="background: #0C1018; font-family: Arial, sans-serif; margin: 0px; padding: 0px;">

<table align="center" width="100%" height="100vh" cellspacing="0" cellpadding="0" style="max-width: 800px; margin: 160px auto; text-align: center;">
    <tr>
        <td style="padding: 20px 0;">
            <img src="{{ url('img/logo/logo-png.png') }}" alt="">
        </td>
    </tr>
    <tr>
        <td style="color: #ffffff; font-size: 24px; font-weight: 500; line-height: 36px; padding: 20px 0;">
            Your One Time Password (OTP) for registration is:
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 0;">
            <span style="background: #367BF5; color: #ffffff; font-weight: bold; padding: 10px 20px; border-radius: 2px; display: inline-block; font-size: 18px;">
                {{ $otp }}
            </span>
        </td>
    </tr>
    <tr>
        <td style="color: #ffffff; font-size: 16px; font-weight: 400; padding: 20px 0;">
            If you did not request a code, you do not have to do anything.
        </td>
    </tr>
    <tr>
        <td style="color: #ffffff; font-size: 16px; font-weight: 400; padding: 20px 0;">
            All rights reserved 2024.
        </td>
    </tr>
</table>

</body>
</html>
