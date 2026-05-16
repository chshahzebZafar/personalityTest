<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Personality Test Result | RTCAT Offer</title>
    <style>
        /* General reset & email-safe styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #e9f0f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.5;
            padding: 20px 12px;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        }
        /* Header brand */
        .brand-header {
            background: linear-gradient(115deg, #0b2b3b 0%, #1b4f6e 100%);
            padding: 20px 28px;
        }
        .brand-name {
            font-size: 22px;
            font-weight: 800;
            color: white;
            letter-spacing: -0.2px;
        }
        .brand-tag {
            font-size: 12px;
            color: #cae3f2;
            margin-top: 6px;
        }
        /* Content padding */
        .content-padding {
            padding: 32px 30px 28px;
        }
        /* Headings */
        h1 {
            font-size: 26px;
            color: #1a3a4f;
            margin: 0 0 8px 0;
            font-weight: 700;
        }
        .greeting-text {
            font-size: 16px;
            color: #2c4a6e;
            margin-bottom: 20px;
        }
        /* Button styles */
        .btn-download {
            display: inline-block;
            background: linear-gradient(100deg, #1f5e3a, #2a7f4b);
            color: white !important;
            font-weight: 700;
            font-size: 18px;
            text-decoration: none;
            padding: 14px 34px;
            border-radius: 60px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.08);
            text-align: center;
            transition: 0.2s;
            letter-spacing: 0.3px;
        }
        .btn-download:hover {
            background: linear-gradient(100deg, #144e2f, #1e6a3e);
        }
        .btn-offer {
            display: inline-block;
            background: #f4a261;
            color: #1e2f3a !important;
            font-weight: 800;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 60px;
            font-size: 18px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        hr {
            margin: 24px 0;
            border: 0;
            height: 1px;
            background: #e2eaf1;
        }
        .offer-highlight {
            background: #fff7eb;
            border-left: 6px solid #f4a261;
            padding: 16px 20px;
            border-radius: 20px;
            margin: 18px 0;
        }
        .price-strike {
            text-decoration: line-through;
            color: #8f9eb2;
            font-weight: normal;
            margin-left: 8px;
        }
        .discount-badge {
            background: #e76f51;
            color: white;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            display: inline-block;
        }
        .checklist-grid {
            background: #f8fafd;
            border-radius: 24px;
            padding: 20px 24px;
            margin: 20px 0;
            border: 1px solid #e2edf2;
        }
        .check-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }
        .check-mark {
            color: #2c7a4d;
            font-weight: 800;
            font-size: 18px;
            min-width: 24px;
        }
        .check-text strong {
            color: #1d4e6e;
            display: block;
            font-size: 15px;
            margin-bottom: 4px;
        }
        .check-text span {
            color: #4f6f8f;
            font-size: 14px;
        }
        .why-box {
            background: #eef4fa;
            border-radius: 20px;
            padding: 18px 22px;
            margin: 22px 0 20px;
        }
        .footer-links {
            margin-top: 28px;
            text-align: center;
            font-size: 13px;
            border-top: 1px solid #e2ecf5;
            padding-top: 24px;
        }
        .footer-bottom {
            background: #f7fafc;
            text-align: center;
            padding: 20px 24px;
            font-size: 12px;
            color: #5d7f9e;
            border-top: 1px solid #e2edf2;
        }
        @media only screen and (max-width: 550px) {
            .content-padding {
                padding: 24px 20px;
            }
            .btn-download, .btn-offer {
                display: block;
                width: 100%;
                text-align: center;
            }
            .check-item {
                flex-direction: column;
                gap: 4px;
            }
            .check-mark {
                margin-bottom: 2px;
            }
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="email-wrapper">
    <!-- header -->
    <div class="brand-header">
        <div class="brand-name">Resource Intelligentsia</div>
        <div class="brand-tag">Personality Assessment Center</div>
    </div>
    
    <div class="content-padding">
        <!-- Greeting exactly as reference -->
        <h1>Dear {{ $candidate->name ?? 'Candidate' }},</h1>
        <p class="greeting-text">Congratulations on completing your <strong>Personality Assessment</strong> with Resource Intelligentsia.<br>
        Your results are now ready and can be accessed instantly.</p>
        
        <!-- Download Button section (exactly like reference: [Download Your Result] and click note) -->
        <div style="text-align: center; margin: 16px 0 12px;">
            <a href="{{ route('assessment.test.download.result',['quiz_id' => $personalityTest->id]) }}" class="btn-download">📥 Download Your Result</a>
            <p style="font-size: 13px; color: #6c8fae; margin-top: 12px;">(Click the button above to access your detailed personality profile and insights.)</p>
        </div>
        
        <hr>
        
        <!-- Exclusive Bumper Offer Section (exact wording) -->
        <div style="margin: 8px 0 6px;">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
                <h2 style="font-size: 22px; color: #b85c1a; margin: 0; font-weight: 800;">🎉 Exclusive Bumper Offer</h2>
                <span class="discount-badge">90% OFF</span>
            </div>
            <p style="font-size: 15px; color: #2c4f6e; margin: 12px 0 8px;"><strong>Unlock Your Full Career Potential</strong><br>
            Once you download your result, you will receive a special coupon to upgrade your profile with the <strong>RTCAT</strong> (Resource Intelligentsia Computer Adaptive Test) at an exclusive <strong>90% discount</strong>.</p>
            
            <div class="offer-highlight">
                <span style="font-size: 20px; font-weight: 800; color: #1e4a6b;">💰 Pay Only Rs. 490</span>
                <span class="price-strike">(Instead of Rs. 4,990)</span>
            </div>
        </div>
        
        <!-- What You Get with RTCAT (exactly as described with bullet items) -->
        <h3 style="font-size: 22px; margin: 20px 0 8px 0; color: #1f5a7a;">🚀 What You Get with RTCAT</h3>
        <p style="color: #2a577b; margin-bottom: 14px;">By availing this offer, you will gain access to a complete <strong>Employability & Career Advancement Ecosystem</strong>:</p>
        
        <div class="checklist-grid">
            <!-- Item 1 -->
            <div class="check-item">
                <div class="check-mark">✔</div>
                <div class="check-text">
                    <strong>RTCAT Employability Test Results</strong>
                    <span>Get scientifically assessed on aptitude, digital readiness, business communication, ethics, and more.</span>
                </div>
            </div>
            <div class="check-item">
                <div class="check-mark">✔</div>
                <div class="check-text">
                    <strong>National Percentile Ranking</strong>
                    <span>Know where you stand among candidates across Pakistan through a dynamic ranking system.</span>
                </div>
            </div>
            <div class="check-item">
                <div class="check-mark">✔</div>
                <div class="check-text">
                    <strong>CV / Profile Ranking</strong>
                    <span>Your profile is automatically evaluated and ranked for employer visibility.</span>
                </div>
            </div>
            <div class="check-item">
                <div class="check-mark">✔</div>
                <div class="check-text">
                    <strong>RTCAT Certificate</strong>
                    <span>Receive a recognized certificate to strengthen your professional profile.</span>
                </div>
            </div>
            <div class="check-item">
                <div class="check-mark">✔</div>
                <div class="check-text">
                    <strong>Auto-Generated Professional CV</strong>
                    <span>Get a smart, editable CV based on your verified data—valid for long-term use.</span>
                </div>
            </div>
            <div class="check-item">
                <div class="check-mark">✔</div>
                <div class="check-text">
                    <strong>Employer Visibility (Pakistan & Gulf)</strong>
                    <span>Become visible to thousands of employers actively hiring through RTCAT for job opportunities and interviews.</span>
                </div>
            </div>
            <div class="check-item">
                <div class="check-mark">✔</div>
                <div class="check-text">
                    <strong>Data-Driven Job Matching</strong>
                    <span>Get shortlisted based on your actual performance, not just CV or GPA.</span>
                </div>
            </div>
        </div>
        
        <!-- Why Upgrade? (exact phrase) -->
        <div class="why-box">
            <h3 style="font-size: 20px; margin: 0 0 8px 0; color: #1c5d7a;">🌟 Why Upgrade?</h3>
            <p style="font-size: 15px; color: #1e4a6e; margin: 0;">Your personality test has revealed your behavioral strengths. Now, take the next step and prove your professional capability through <strong>RTCAT</strong> to unlock real career opportunities.<br><br>
            <strong>Don’t miss this limited-time opportunity</strong> to transform your profile into a high-impact, employer-ready portfolio.</p>
        </div>
        
        <!-- Upgrade CTA button (similar style to match email) -->
        <div style="text-align: center; margin: 10px 0 18px;">
            <a href="#" class="btn-offer">🎯 Claim 90% OFF – Upgrade Now</a>
            <p style="font-size: 12px; color: #6f94b3; margin-top: 12px;">Coupon will be available after downloading result | Limited offer</p>
        </div>
        
        <hr>
        
        <!-- Warm closing -->
        <p style="font-size: 15px; color: #1e4762;">We look forward to supporting your career journey.</p>
        <p style="margin: 22px 0 10px 0; font-size: 16px; font-weight: 600; color: #144e6b;">Warm regards,<br>
        <span style="color: #1f5a78;">Resource Intelligentsia</span><br>
        <span style="font-size: 13px; color: #4c7a9b;">Building Careers | Powering Employers | Connecting Talent Globally</span></p>
        
        <!-- Website links -->
        <div class="footer-links">
            <a href="#" style="color: #2a7f6e; font-weight: 500; text-decoration: none;">🌐 www.myrtcat.com</a> &nbsp;|&nbsp;
            <a href="#" style="color: #2a7f6e; font-weight: 500; text-decoration: none;">🌐 www.resourceintelligentsia.com</a>
        </div>
        
        <div style="font-size: 11px; color: #8faac2; text-align: center; margin-top: 20px; border-top: 1px solid #e2ecf5; padding-top: 16px;">
            *Offer valid for first-time RTCAT upgrade after personality assessment. Terms apply.
        </div>
    </div>
    
    <!-- footer additional info -->
    <div class="footer-bottom">
        <p style="margin: 0;">Resource Intelligentsia – Empowering Careers | support@myrtcat.com</p>
        <p style="margin: 6px 0 0 0; font-size: 11px;">You received this email because you completed the Personality Assessment. Add us to your contacts.</p>
    </div>
</div>
</body>
</html>