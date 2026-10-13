<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - SOLKIT</title>
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
            padding: 36px 36px 28px;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            border-bottom: 1px solid #1e293b;
            text-align: center;
        }
        .logo-text {
            font-size: 26px;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }
        .logo-text span {
            color: #6366f1;
        }
        .badge {
            display: inline-block;
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34d399;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 4px 12px;
            border-radius: 9999px;
            margin-top: 10px;
        }
        .content {
            padding: 36px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 14px;
        }
        .paragraph {
            font-size: 14px;
            line-height: 1.7;
            color: #cbd5e1;
            margin: 0 0 16px;
        }
        .summary-card {
            background-color: #020617;
            border: 1px solid #1e293b;
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
        }
        .summary-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #818cf8;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .summary-item {
            font-size: 13px;
            color: #94a3b8;
            margin-bottom: 8px;
        }
        .summary-item strong {
            color: #f1f5f9;
        }
        .cta-box {
            background: rgba(99, 102, 241, 0.08);
            border: 1px dashed rgba(99, 102, 241, 0.3);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin: 28px 0;
        }
        .cta-btn {
            display: inline-block;
            margin-top: 12px;
            padding: 12px 28px;
            background-color: #22c55e;
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            border-radius: 10px;
        }
        .footer {
            padding: 24px 36px;
            background-color: #020617;
            border-top: 1px solid #1e293b;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <div class="logo-text">SOL<span>KIT</span></div>
                <p style="margin: 0; font-size: 12px; color: #94a3b8; letter-spacing: 0.5px;">Solusi Kode Kita &bull; Software Engineering Studio</p>
                <span class="badge">✓ Konsultasi Diterima</span>
            </div>

            <div class="content">
                <p class="greeting">Halo, {{ $lead->name }}!</p>
                <p class="paragraph">
                    Terima kasih telah mempercayakan kebutuhan rekayasa teknologi dan solusi digital Anda kepada <strong>SOLKIT (Solusi Kode Kita)</strong>.
                </p>
                <p class="paragraph">
                    Pesan dan rincian kebutuhan konsultasi Anda telah berhasil kami terima. Senior Solution Architect dan tim teknis kami saat ini sedang meninjau ringkasan proyek Anda dan akan menghubungi Anda dalam <strong>1x24 jam kerja</strong>.
                </p>

                <div class="summary-card">
                    <div class="summary-title">Ringkasan Pengajuan Konsultasi</div>
                    <div class="summary-item">Layanan: <strong>{{ $lead->service_interest ?? 'Konsultasi Software' }}</strong></div>
                    @if($lead->budget_range)
                    <div class="summary-item">Estimasi Budget: <strong>{{ $lead->budget_range }}</strong></div>
                    @endif
                    @if($lead->company)
                    <div class="summary-item">Perusahaan/Brand: <strong>{{ $lead->company }}</strong></div>
                    @endif
                    <div class="summary-item" style="margin-top: 12px; padding-top: 10px; border-top: 1px solid #1e293b;">
                        Pesan Anda: <br>
                        <span style="color: #cbd5e1; font-style: italic;">"{{ $lead->message }}"</span>
                    </div>
                </div>

                <div class="cta-box">
                    <p style="margin: 0; font-size: 13px; color: #cbd5e1;">Butuh respons instan atau diskusi mendesak?</p>
                    <a href="https://wa.me/628814959247?text=Halo%20Tim%20SOLKIT%2C%20saya%20sudah%20mengirimkan%20form%20konsultasi%20atas%20nama%20{{ urlencode($lead->name) }}" target="_blank" class="cta-btn">
                        💬 Hubungi Kami via WhatsApp
                    </a>
                </div>

                <p class="paragraph" style="font-size: 12px; color: #94a3b8;">
                    Salam hangat,<br>
                    <strong style="color: #f1f5f9;">Tim Konsultan SOLKIT (Solusi Kode Kita)</strong><br>
                    Surabaya, Jawa Timur, Indonesia
                </p>
            </div>

            <div class="footer">
                <p style="margin: 0 0 4px;">&copy; {{ date('Y') }} SOLKIT (Solusi Kode Kita). All rights reserved.</p>
                <p style="margin: 0;">Email resmi: <a href="mailto:solusicodekita@gmail.com" style="color: #818cf8; text-decoration: none;">solusicodekita@gmail.com</a></p>
            </div>
        </div>
    </div>
</body>
</html>
