<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payment Confirmation</title>
    <style type="text/css">
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; outline: none; text-decoration: none; }
        body { margin: 0 !important; padding: 0 !important; background-color: #f4f4f4; }
        @media only screen and (max-width: 620px) {
            .wrapper-table { width: 100% !important; }
            .content-td { padding: 24px 20px !important; }
            .header-td { padding: 24px 20px !important; }
            .footer-td { padding: 16px 20px !important; }
            .receipt-label { width: 45% !important; }
            .receipt-value { width: 55% !important; }
            .cta-btn { padding: 12px 24px !important; font-size: 14px !important; }
        }
    </style>
</head>
<body style="margin:0;padding:0;background-color:#f4f4f4;">

    <!-- Outer wrapper -->
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#f4f4f4;">
        <tr>
            <td align="center" style="padding:30px 10px;">

                <!-- Email card -->
                <table class="wrapper-table" role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08);">

                    <!-- Header -->
                    <tr>
                        <td class="header-td" align="center" style="background-color:#FF7A15;padding:32px 40px;">
                            <h1 style="color:#ffffff;margin:0;font-size:24px;font-weight:700;font-family:Arial,sans-serif;">&#10003; Payment Confirmed</h1>
                            <p style="color:rgba(255,255,255,0.85);margin:8px 0 0;font-size:14px;font-family:Arial,sans-serif;">Thank you for your payment. Your test is now active.</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td class="content-td" style="padding:36px 40px;font-family:Arial,sans-serif;color:#4E4E4E;">

                            <p style="font-size:16px;margin:0 0 8px;">Hi <strong>{{ $candidate->name }}</strong>,</p>
                            <p style="font-size:14px;color:#666666;margin:0 0 24px;">We've successfully received your payment for the Personality Assessment Test. Here's your receipt:</p>

                            <!-- Receipt box -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#f9f9f9;border:1px solid #e8e8e8;border-radius:10px;margin-bottom:24px;">
                                <tr>
                                    <td style="padding:20px 24px;">

                                        <p style="margin:0 0 14px;font-size:13px;font-weight:700;color:#FF7A15;text-transform:uppercase;letter-spacing:0.5px;font-family:Arial,sans-serif;">Transaction Details</p>

                                        <!-- Amount row -->
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-bottom:1px dashed #e8e8e8;">
                                            <tr>
                                                <td class="receipt-label" width="45%" style="padding:10px 0;font-size:14px;color:#888888;font-family:Arial,sans-serif;">Amount Paid</td>
                                                <td class="receipt-value" width="55%" style="padding:10px 0;font-size:18px;font-weight:700;color:#FF7A15;font-family:Arial,sans-serif;text-align:right;">
                                                    {{ $payment->transaction_currency ?? '' }} {{ $payment->transaction_amount ? number_format($payment->transaction_amount, 2) : '—' }}
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Transaction ID -->
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-bottom:1px dashed #e8e8e8;">
                                            <tr>
                                                <td class="receipt-label" width="45%" style="padding:10px 0;font-size:14px;color:#888888;font-family:Arial,sans-serif;">Transaction ID</td>
                                                <td class="receipt-value" width="55%" style="padding:10px 0;font-size:14px;font-weight:600;color:#4E4E4E;font-family:Arial,sans-serif;text-align:right;word-break:break-all;">
                                                    {{ $payment->transaction_id ?? '—' }}
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Payment Method -->
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-bottom:1px dashed #e8e8e8;">
                                            <tr>
                                                <td class="receipt-label" width="45%" style="padding:10px 0;font-size:14px;color:#888888;font-family:Arial,sans-serif;">Payment Method</td>
                                                <td class="receipt-value" width="55%" style="padding:10px 0;font-size:14px;font-weight:600;color:#4E4E4E;font-family:Arial,sans-serif;text-align:right;">
                                                    {{ $payment->payment_name ?? ($payment->payment_type ?? '—') }}
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Payment Date -->
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-bottom:1px dashed #e8e8e8;">
                                            <tr>
                                                <td class="receipt-label" width="45%" style="padding:10px 0;font-size:14px;color:#888888;font-family:Arial,sans-serif;">Payment Date</td>
                                                <td class="receipt-value" width="55%" style="padding:10px 0;font-size:14px;font-weight:600;color:#4E4E4E;font-family:Arial,sans-serif;text-align:right;">
                                                    {{ $payment->enrollment_date ? \Carbon\Carbon::parse($payment->enrollment_date)->format('d M Y, h:i A') : now()->format('d M Y, h:i A') }}
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Test Reference -->
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-bottom:1px dashed #e8e8e8;">
                                            <tr>
                                                <td class="receipt-label" width="45%" style="padding:10px 0;font-size:14px;color:#888888;font-family:Arial,sans-serif;">Test Reference</td>
                                                <td class="receipt-value" width="55%" style="padding:10px 0;font-size:14px;font-weight:600;color:#4E4E4E;font-family:Arial,sans-serif;text-align:right;">
                                                    {{ $enrollment->quiz_id ?? ('Test #' . $enrollment->id) }}
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Status -->
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td class="receipt-label" width="45%" style="padding:10px 0;font-size:14px;color:#888888;font-family:Arial,sans-serif;">Status</td>
                                                <td class="receipt-value" width="55%" style="padding:10px 0;text-align:right;">
                                                    <span style="display:inline-block;background-color:#e6f9ee;color:#28a745;border:1px solid #b7f0cb;padding:4px 12px;border-radius:20px;font-size:13px;font-weight:600;font-family:Arial,sans-serif;">&#10003; Paid</span>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            </table>
                            <!-- /Receipt box -->

                            <!-- CTA Button -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:24px 0 8px;">
                                <tr>
                                    <td align="center">
                                        <a class="cta-btn" href="{{ route('assessment.test.list') }}"
                                           style="display:inline-block;background-color:#FF7A15;color:#ffffff;text-decoration:none;padding:14px 36px;border-radius:8px;font-size:15px;font-weight:700;font-family:Arial,sans-serif;">
                                            View My Tests
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size:13px;color:#aaaaaa;text-align:center;margin:16px 0 0;font-family:Arial,sans-serif;">
                                You can download your full personality report from the Tests page.
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer-td" align="center" style="background-color:#f4f4f4;padding:20px 40px;">
                            <p style="margin:0 0 6px;font-size:12px;color:#aaaaaa;font-family:Arial,sans-serif;">This is an automated receipt from <strong>MentalClarity</strong>.</p>
                            <p style="margin:0;font-size:12px;color:#aaaaaa;font-family:Arial,sans-serif;">If you have any questions, please contact our support team.</p>
                        </td>
                    </tr>

                </table>
                <!-- /Email card -->

            </td>
        </tr>
    </table>

</body>
</html>
