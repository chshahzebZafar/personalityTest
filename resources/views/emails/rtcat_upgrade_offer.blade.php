{{-- email/rtcat_upgrade_offer.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unlock RTCAT at 90% OFF</title>
    <style>
        /* Reset & Base Styles */
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.5;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .email-body {
            padding: 32px 28px;
        }
        
        /* Typography */
        h1 {
            color: #1a3e50;
            font-size: 26px;
            margin-top: 0;
            margin-bottom: 16px;
            font-weight: 700;
            line-height: 1.2;
        }
        h2 {
            color: #1e4a6b;
            font-size: 20px;
            margin: 24px 0 12px 0;
            font-weight: 600;
            border-left: 4px solid #f5a623;
            padding-left: 14px;
        }
        .greeting {
            font-size: 16px;
            color: #2c3e4e;
            margin-bottom: 20px;
        }
        .highlight-box {
            background-color: #fef7e0;
            border-left: 5px solid #f5a623;
            padding: 16px 20px;
            margin: 24px 0;
            border-radius: 12px;
        }
        .price-tag {
            font-size: 22px;
            font-weight: bold;
            color: #2c6e2c;
        }
        .strike {
            text-decoration: line-through;
            color: #a0a0a0;
            font-size: 18px;
            font-weight: normal;
        }
        .coupon {
            background-color: #1e4a6b;
            color: #ffffff;
            display: inline-block;
            padding: 8px 20px;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 1px;
            border-radius: 40px;
            margin: 10px 0;
            font-family: monospace;
        }
        
        /* Bordered Paragraphs */
        .bordered-paragraph {
            border: 2px solid #dceef5;
            border-radius: 16px;
            padding: 18px 22px;
            margin: 28px 0;
            background-color: #fefefe;
            transition: all 0.2s ease;
        }
        .bordered-paragraph p {
            margin: 0 0 12px 0;
        }
        .bordered-paragraph p:last-child {
            margin-bottom: 0;
        }
        
        /* Features List */
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        .feature-list li {
            padding: 8px 0 8px 28px;
            position: relative;
            font-size: 15px;
            border-bottom: 1px solid #eef2f5;
        }
        .feature-list li:last-child {
            border-bottom: none;
        }
        .feature-list li:before {
            content: "✔";
            color: #2c7a4d;
            font-weight: bold;
            position: absolute;
            left: 0;
            top: 8px;
            font-size: 16px;
        }
        
        /* Steps */
        .step-list {
            margin: 20px 0;
            padding-left: 24px;
        }
        .step-list li {
            margin: 10px 0;
            color: #2c3e4e;
        }
        
        /* HR Styling */
        hr {
            border: none;
            height: 2px;
            background: linear-gradient(90deg, #cbdde6, #f5a623, #cbdde6);
            margin: 28px 0;
        }
        .hr-light {
            height: 1px;
            background: #e2e8f0;
            margin: 24px 0;
        }
        
        /* Button */
        .btn {
            display: inline-block;
            background-color: #f5a623;
            color: #1a3e50 !important;
            text-decoration: none;
            font-weight: bold;
            padding: 14px 28px;
            border-radius: 50px;
            margin: 20px 0 10px;
            font-size: 16px;
            text-align: center;
            transition: background 0.2s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .btn:hover {
            background-color: #e6951a;
        }
        
        /* Footer */
        .footer {
            background-color: #f0f5f9;
            padding: 24px 28px;
            text-align: center;
            font-size: 13px;
            color: #5f7f9c;
            border-top: 1px solid #dce5ec;
        }
        .footer a {
            color: #1e4a6b;
            text-decoration: none;
        }
        .social-links {
            margin-top: 12px;
        }
        
        @media (max-width: 600px) {
            .email-body {
                padding: 24px 18px;
            }
            h1 {
                font-size: 22px;
            }
            .price-tag {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-body">
            <!-- Main Heading -->
            <h1>🎯 Unlock RTCAT at <span style="color:#f5a623;">90% OFF</span><br>Your Exclusive Coupon Inside!</h1>
            
            <!-- Greeting + First bordered paragraph (Thank you message) -->
            <div class="greeting">Dear {{ $candidate->name ?? 'Candidate' }},</div>
            
            <div class="bordered-paragraph">
                <p>Thank you for downloading your Personality Test Result. We hope the insights help you better understand your strengths and career direction.</p>
            </div>
            
            <!-- Upgrade Offer Section -->
            <h2>✨ Your Exclusive Upgrade Offer is Here</h2>
            <p>As promised, you are eligible for a special <strong>90% discount</strong> on the RTCAT (Resource Intelligentsia Computer Adaptive Test).</p>
            
            <div class="highlight-box">
                <div class="price-tag">💰 Pay Only Rs. 499 <span class="strike">(Instead of Rs. 4,990)</span></div>
                <div style="margin: 12px 0 4px;">🎟 Your Coupon Code:</div>
                <div class="coupon">PERTEST</div>
            </div>
            
            <hr>  {{-- gradient hr as requested --}}
            
            <!-- What You Unlock with RTCAT -->
            <h2>🚀 What You Unlock with RTCAT</h2>
            <p>Upgrade now to access a complete Employability & Career Advancement Ecosystem:</p>
            <ul class="feature-list">
                <li>RTCAT Test with Detailed Results & National Percentile Ranking</li>
                <li>CV / Profile Ranking for Employer Shortlisting</li>
                <li>RTCAT Certificate for Professional Credibility</li>
                <li>Auto-Generated & Editable Professional CV</li>
                <li>Visibility to Thousands of Employers (Pakistan & Gulf)</li>
                <li>Shortlisting for Jobs & Interviews based on Real Performance Data</li>
            </ul>
            
            <hr>  {{-- another hr before How to Register --}}
            
            <!-- How to Register (with steps and border) -->
            <h2>📋 How to Register</h2>
            <div class="bordered-paragraph">
                <ol class="step-list" style="margin:0; padding-left:20px;">
                    <li>Visit <strong><a href="https://www.myrtcat.com" style="color:#1e4a6b;">www.myrtcat.com</a></strong></li>
                    <li>Click on <strong>Enrol Now Button</strong> and Create your account / Complete your profile</li>
                    <li>Select any upcoming RTCAT test batch from <strong>Start Your Assessment</strong></li>
                    <li>Enter Coupon Code: <strong>PERTEST</strong> at checkout</li>
                    <li>Pay the discounted fee <strong>(Rs. 499 only)</strong></li>
                    <li>Get ready to take the test and unlock opportunities</li>
                </ol>
            </div>
            
            <!-- Call to action + motivational message -->
            <div style="text-align: center; margin: 24px 0 16px;">
                <a href="https://www.myrtcat.com/enrol" class="btn">👉 Claim Your 90% OFF Now 👈</a>
            </div>
            
            <div class="bordered-paragraph" style="background-color:#fafcfd;">
                <p>✨ This is your chance to move beyond insights and prove your capabilities through a scientific, data-driven system.</p>
                <p style="margin-bottom:0;">We look forward to seeing you excel.</p>
            </div>
            
            <hr class="hr-light">
            
            <!-- Warm regards + signature -->
            <p style="margin: 16px 0 4px;">Warm regards,</p>
            <p style="margin: 0; font-weight: 600; font-size: 16px;">Resource Intelligentsia</p>
            <p style="margin: 4px 0 0; color:#5f7f9c;">Building Careers | Powering Employers | Connecting Talent Globally</p>
            <p style="margin: 12px 0 0;">
                🌐 <a href="https://www.myrtcat.com">www.myrtcat.com</a><br>
                🌐 <a href="https://www.resourceintelligentsia.com">www.resourceintelligentsia.com</a>
            </p>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>© {{ date('Y') }} Resource Intelligentsia. All rights reserved.<br>
            You received this email because you downloaded your Personality Test Result.<br>
            <a href="#">Unsubscribe</a> | <a href="#">Privacy Policy</a></p>
            <div class="social-links">🔵 🟠 🟢</div>
        </div>
    </div>
</body>
</html>