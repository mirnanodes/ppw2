<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $data['subject'] ?? 'Notifikasi' }}</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f5f5fb; padding: 24px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden;">
        <tr>
            <td style="background: linear-gradient(90deg, #4f46e5, #7c3aed); padding: 20px; color: #fff; font-size: 18px; font-weight: 700;">
                Praktikum Pemrograman Web - Notifikasi
            </td>
        </tr>
        <tr>
            <td style="padding: 24px; color: #374151; font-size: 15px; line-height: 1.6;">
                <p>Halo {{ $data['name'] ?? 'User' }},</p>
                <p>{{ $data['message'] ?? '' }}</p>
                <p style="margin-top: 24px; font-size: 14px; color: #6b7280;">Email tujuan: {{ $data['email'] ?? '-' }}</p>
                <p style="margin-top: 16px;">Terima kasih.</p>
            </td>
        </tr>
    </table>
</body>
</html>
