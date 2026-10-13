<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi Baru Masuk - SOLKIT</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0b0f19;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #f1f5f9;
        }
        .wrapper {
            width: 100%;
            background-color: #0b0f19;
            padding: 40px 15px;
            box-sizing: border-box;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }
        .header {
            padding: 32px 36px 24px;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            border-bottom: 1px solid #1e293b;
        }
        .badge {
            display: inline-block;
            background: rgba(99, 102, 241, 0.15);
            border: 1px solid rgba(99, 102, 241, 0.3);
            color: #818cf8;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 4px 12px;
            border-radius: 9999px;
            margin-bottom: 12px;
        }
        .title {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
        }
        .subtitle {
            margin: 6px 0 0;
            font-size: 13px;
            color: #94a3b8;
        }
        .content {
            padding: 32px 36px;
        }
        .info-grid {
            width: 100%;
            margin-bottom: 24px;
            border-collapse: separate;
            border-spacing: 0;
        }
        .info-row td {
            padding: 10px 0;
            border-bottom: 1px solid #1e293b;
            font-size: 13px;
        }
        .info-label {
            color: #64748b;
            font-weight: 600;
            width: 36%;
        }
        .info-value {
            color: #f1f5f9;
            font-weight: 500;
        }
        .message-box {
            background-color: #020617;
            border: 1px solid #1e293b;
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
        }
        .message-box-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6366f1;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .message-box-content {
            font-size: 14px;
            line-height: 1.6;
            color: #e2e8f0;
            white-space: pre-wrap;
            margin: 0;
        }
        .actions {
            margin-top: 28px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            margin: 4px;
        }
        .btn-primary {
            background-color: #4f46e5;
            color: #ffffff;
        }
        .btn-secondary {
            background-color: #0284c7;
            color: #ffffff;
        }
        .footer {
            padding: 24px 36px;
            background-color: #020617;
            border-top: 1px solid #1e293b;
            text-align: center;
            font-size: 11px;
            color: #475569;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <span class="badge">🔥 New Lead / Inquiry</span>
                <h1 class="title">Konsultasi Baru Masuk</h1>
                <p class="subtitle">Sistem otomatis SOLKIT merekam calon klien potensial baru dari landing page.</p>
            </div>
            
            <div class="content">
                <table class="info-grid">
                    <tr class="info-row">
                        <td class="info-label">Nama Pengirim</td>
                        <td class="info-value"><strong>{{ $lead->name }}</strong></td>
                    </tr>
                    <tr class="info-row">
                        <td class="info-label">Email</td>
                        <td class="info-value"><a href="mailto:{{ $lead->email }}" style="color: #818cf8; text-decoration: none;">{{ $lead->email }}</a></td>
                    </tr>
                    <tr class="info-row">
                        <td class="info-label">No. Telepon / WhatsApp</td>
                        <td class="info-value">{{ $lead->phone ?? '-' }}</td>
                    </tr>
                    <tr class="info-row">
                        <td class="info-label">Perusahaan / Brand</td>
                        <td class="info-value">{{ $lead->company ?? '-' }}</td>
                    </tr>
                    <tr class="info-row">
                        <td class="info-label">Pilihan Layanan</td>
                        <td class="info-value" style="color: #38bdf8; font-weight: 700;">{{ $lead->service_interest ?? 'Konsultasi Software' }}</td>
                    </tr>
                    <tr class="info-row">
                        <td class="info-label">Estimasi Budget</td>
                        <td class="info-value" style="color: #34d399; font-weight: 700;">{{ $lead->budget_range ?? '-' }}</td>
                    </tr>
                    <tr class="info-row">
                        <td class="info-label">Waktu Pengiriman</td>
                        <td class="info-value">{{ $lead->created_at ? $lead->created_at->format('d M Y, H:i') . ' WIB' : now()->format('d M Y, H:i') . ' WIB' }}</td>
                    </tr>
                </table>

                <div class="message-box">
                    <div class="message-box-title">Pesan / Kebutuhan Klien:</div>
                    <p class="message-box-content">{{ $lead->message }}</p>
                </div>

                <div class="actions">
                    <a href="mailto:{{ $lead->email }}?subject=Tanggapan%20Konsultasi%20Solkit%20Tech%20-%20{{ urlencode($lead->name) }}" class="btn btn-primary">
                        ✉️ Balas via Email
                    </a>
                    @if($lead->phone)
                        @php
                            $cleanPhone = preg_replace('/[^0-9]/', '', $lead->phone);
                            if (str_starts_with($cleanPhone, '0')) {
                                $cleanPhone = '62' . substr($cleanPhone, 1);
                            }
                        @endphp
                        <a href="https://wa.me/{{ $cleanPhone }}?text=Halo%20{{ urlencode($lead->name) }}%2C%20kami%20dari%20tim%20SOLKIT%20(Solusi%20Kode%20Kita)%20menindaklanjuti%20inquiry%20konsultasi%20Anda." target="_blank" class="btn btn-secondary">
                            💬 Chat WhatsApp
                        </a>
                    @endif
                </div>
            </div>

            <div class="footer">
                <p style="margin: 0 0 6px;">SOLKIT (Solusi Kode Kita) &bull; Enterprise Software Engineering Studio</p>
                <p style="margin: 0;">Pemberitahuan otomatis ini dikirim ke <span style="color: #64748b;">{{ config('mail.from.address') }}</span></p>
            </div>
        </div>
    </div>
</body>
</html>
