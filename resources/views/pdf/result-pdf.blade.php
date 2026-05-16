<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        /* ✅ Force table to fit entirely on one PDF page */
.fit-to-page {
    transform: scale(0.60); /* Reduce scale further */
    transform-origin: top left;
    width: 167%; /* Compensate for smaller scale (100/0.6 ≈ 167%) */
    page-break-inside: avoid !important;
    break-inside: avoid !important;
}

        .your_test_score_table th, .your_test_score_table td {
            border: 0.5px solid #000000;
            padding: 2px;
            text-align: center;
            font-size: 12px;
        }

.fit-to-page table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

.fit-to-page-table
{
    font-size: 12px;
    page-break-inside: avoid !important;
}
.fit-to-page th,
.fit-to-page td {
    border: 0.5px solid #000;
    padding: 3px 4px;
    vertical-align: top;
}

.fit-to-page th {
    background-color: #d9ead3;
}

tr, td, th {
    page-break-inside: avoid !important;
}

        header, .footer {
            position: fixed;
            width: 100%;
            /*text-align: center;*/
            font-size: 12px;
            color: #666;
        }

        header {
            top: 0;
            padding: 10px 0;
        }

        .footer {
            bottom: 0;
            padding: 10px 0;
        }

        .content {
            margin: 0px 20px 50px; /* Adjusted for proper alignment */
            page-break-inside: avoid;
        }
        .content p {
            font-size: 0.8rem;
        }

        h1, h2 {
            text-align: left;
            color: #536d93;
        }

        h1 {
            font-size: 26px;
        }

        h2 {
            font-size: 20px;
            margin-top: 40px; /* Adjusted spacing */
        }


        .your_test_score_table {
            width: 100%;
            border-collapse: collapse;
            margin: 2px 0;
            border: 1px solid #ff5733;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        table tr:hover {
            background-color: #ffebcc;
        }

        .highlight {
            color: #0c0000;
            font-weight: bold;
        }

        .page-break {
            page-break-after: always;
        }

        .chart img {
            width: 100%;
            height: 420px;
            /*align-content: center;*/
            /*max-width: 500px;*/
            margin: 0 auto;
        }

        .footer {
            font-size: 12px;
            text-align: center;
        }

        p{
            text-align: justify;
        }
        ul {
            margin: 20px 0;
            padding: 0;
            list-style: none;
        }

        ul li {
            margin-bottom: 10px;
        }
        .footer {
            /*position: fixed;*/
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
        }
        .footer .rtcat-id {
            margin-top: 10px;
            text-align: center;
        }
        .footer .powered-by {
            text-align: right;
            display: flex;
            margin-top: -20px;
            /*align-items: center;*/
        }
        .footer .powered-by img {
            height: 95px;
            position: relative;
            /*margin-right: -200px;*/
            margin-top: -30px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 45%;
            width: 90%;
            height: 70%;
            transform: translate(-50%, -50%);
            opacity: 0.1; /* Adjust opacity as needed */
            z-index: -1;
        }

        .pdf-first-page-footer {
            position: absolute;
            bottom: -40px; /* بلکل نیچے رکھے گا */
            left: 0;
            width: 100%; /* مکمل چوڑائی لے گا */
            text-align: center; /* تصویر کو درمیان میں رکھے گا */
        }

        .pdf-first-page-footer img {
            width: 100%; /* اگر پوری لائن پر چاہیے تو */
            height: auto; /* aspect ratio برقرار رکھے گا */
        }
        table td:first-child,
        table th:first-child {
            text-align: left !important;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between; /* Left & Right Alignment */
        }

        .col-lg-6 {
            width: 48%; /* Each column takes nearly half width */
        }

        /* Responsive: Stack columns on small screens */
        @media (max-width: 992px) {
            .col-lg-6 {
                width: 100%; /* Full width on smaller screens */
            }
        }
        /* CANDIDATE NAME - VERTICAL CENTER FOCUS */
        .candidate-name {
            margin: 250px 0 20px 0;
        }
        .candidate-name .name {
            font-size: 2.8rem;
            font-weight: 600;
            text-transform: uppercase;
            background: linear-gradient(135deg, #1e2a3e, #2c3e50);
            background-clip: text;
            -webkit-background-clip: text;
            color: #1e2a3e;
            letter-spacing: 1px;
            line-height: 1.2;
            text-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .test-date {
            font-size: 1.2rem;
            color: #4b5563;
            font-weight: 500;
            margin-top: 12px;
            border-top: 2px solid #e9ecef;
            display: inline-block;
            padding-top: 12px;
        }
        .personality-subtitle {
            background: none;
            font-weight: 600;
        }
        /* new subtitle text */
        .personality-subtitle {
            font-size: 1rem;
            font-weight: 500;
            color: #9F8A42;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            background: rgba(159, 138, 66, 0.08);
            display: inline-block;
            padding: 6px 18px;
            border-radius: 40px;
            margin-top: 12px;
            backdrop-filter: blur(2px);
        }

    </style>

</head>
<body>
<img src="{{ public_path('user/img/watermark.png') }}" class="watermark" alt="Watermark">
    <!-- Centered content section -->
    <div style="flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
        <h1 style="color: #53266F; font-size: 3rem; font-weight: bolder; margin: 40px 10px 20px 0;">
            <span style="border-bottom: 6px solid #9F8A42; padding-bottom: 5px;">REPORT</span> CARD
        </h1>
        <div class="candidate-name">
            <div class="name">
            {{ $candidate->name }}
            </div>
            <div class="personality-subtitle">
                Personality Assessment Test
            </div>
        </div>
        <div class="test-date">
            TEST DATE: {{ $quizDate }}
        </div>
    </div>
    </div>
</div>
<header>
    <img src="{{ public_path('user/img/header_img1.png') }}" style="position: absolute; margin-top: -60px;margin-left: 40px;height: 100px" class="header_two_bars" alt="Header Image">
    <div style="text-align: right;">
        <img src="{{ public_path('user/img/login/1733810127.webp') }}" alt="RTCAT Logo" style="width: 120px;height: 60px">
    </div>
</header>
<footer class="footer pdf-footer">
    <div class="rtcat-id" style="color: #F98226;">
        In case of any query, feedback or suggestions, please visit
        <a style="text-decoration: none; color: #F98226;" href="https://myrtcat.com">myrtcat.com</a>
    </div>
    <div class="powered-by">
        <img src="{{ public_path('user/img/img.png') }}" style="width: 20%; height: 100%; top: 50%;" alt="Resource Intelligentsia">
    </div>
</footer>

<!--<div class="page-break"></div>-->
<div class="content" style="margin-top: 70px">
    <br><br>
    <h2>B. Your Personality</h2>
    @if ($errorMessage)
    <div style="text-align: justify; color: red; border: 1px solid red; padding: 10px; font-size: 14px; line-height: 1.6;">
        {!! nl2br(e($errorMessage)) !!}
    </div>
    @else
        <div class="chart">
            <img src="{{ public_path('assets/images/personality_test_charts/'.$jobRolesData['matching_combination'].'.jpg') }}" alt="Personality Chart">
        </div>
        {!! preg_replace('/<strong>(.*?)<\/strong>/', '<br><strong style="color: #833C0B;">\1</strong>', $jobRolesData['details']['personality_traits']) !!}
        <h2>Your Job Fit</h2>
        <strong>Suitable Role Type:</strong> {!! $jobRolesData['details']['role_type'] !!}<br>
        <strong>Suitable Job Roles:</strong> {!! $jobRolesData['details']['job_role'] !!}<br>
        <strong>Your Employability Relevance:</strong> {!! $jobRolesData['details']['description_for_employability_and_relevance'] !!}
    @endif
</div>
<!--<div class="page-break"></div>-->
@if (!$errorMessage)
<div class="content">
    <br>
    <h2>Your Career Pathways & Growth Guide</h2>
    <p  style="font-style: italic;font-size: 12px">Based on your personality profile, we have mapped broad occupational pathways where your traits are most suitable. Each pathway shows how your strengths align with different job areas and highlights a growth path to help you adapt and succeed. Remember, these are not limitations but opportunities to guide your career choices with a growth mindset.</p>
    <div class="fit-to-page">
    <table class="fit-to-page-table">
    <thead>
        <tr style="background-color: #d9ead3;">
            <th style="border: 1px solid #000; padding: 8px; width: 20%;">Occupation Bundles</th>
            <th style="border: 1px solid #000; padding: 8px; width: 25%;">Major Job Areas</th>
            <th style="border: 1px solid #000; padding: 8px; width: 25%;">Trait Fit – Why You Are Suitable Candidate</th>
            <th style="border: 1px solid #000; padding: 8px; width: 30%;">Growth Path – What You Need to Improve</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{!! $jobRolesData['details']['headings']['heading1'] !!}</td>
            <td>{!! $jobRolesData['details']['education_and_training_major_job_area'] !!}</td>
            <td>{!! $jobRolesData['details']['education_and_training_trait_it_why_you_are_suitable_candidate'] !!}</td>
            <td>{!! $jobRolesData['details']['education_and_training_growth_path_what_you_need_to_improve'] !!}</td>
        </tr>

        <tr>
            <td>{!! $jobRolesData['details']['headings']['heading2'] !!}</td>
            <td>{!! $jobRolesData['details']['healthcare_and_social_services_major_job_area'] !!}</td>
            <td>{!! $jobRolesData['details']['healthcare_and_social_services_trait_it_why_you_are_suitable_candidate'] !!}</td>
            <td>{!! $jobRolesData['details']['healthcare_and_social_services_growth_path_what_you_need_to_improve'] !!}</td>
        </tr>

        <tr>
            <td>{!! $jobRolesData['details']['headings']['heading3'] !!}</td>
            <td>{!! $jobRolesData['details']['business_management_and_entrepreneurship_major_job_area'] !!}</td>
            <td>{!! $jobRolesData['details']['business_management_and_entrepreneurship_trait_it_why_you_are_suitable_candidate'] !!}</td>
            <td>{!! $jobRolesData['details']['business_management_and_entrepreneurship_growth_path_what_you_need_to_improve'] !!}</td>
        </tr>

        <tr>
            <td>{!! $jobRolesData['details']['headings']['heading4'] !!}</td>
            <td>{!! $jobRolesData['details']['marketing_sales_and_customer_engagement_major_job_area'] !!}</td>
            <td>{!! $jobRolesData['details']['marketing_sales_and_customer_engagement_trait_it_why_you_are_suitable_candidate'] !!}</td>
            <td>{!! $jobRolesData['details']['marketing_sales_and_customer_engagement_growth_path_what_you_need_to_improve'] !!}</td>
        </tr>

        <tr>
            <td>{!! $jobRolesData['details']['headings']['heading5'] !!}</td>
            <td>{!! $jobRolesData['details']['hr_and_people_function_major_job_area'] !!}</td>
            <td>{!! $jobRolesData['details']['hr_and_people_function_trait_it_why_you_are_suitable_candidate'] !!}</td>
            <td>{!! $jobRolesData['details']['hr_and_people_function_growth_path_what_you_need_to_improve'] !!}</td>
        </tr>
        <tr>
            <td>{!! $jobRolesData['details']['headings']['heading6'] !!}</td>
            <td>{!! $jobRolesData['details']['finance_law_and_policy_major_job_area'] !!}</td>
            <td>{!! $jobRolesData['details']['finance_law_and_policy_trait_it_why_you_are_suitable_candidate'] !!}</td>
            <td>{!! $jobRolesData['details']['finance_law_and_policy_growth_path_what_you_need_to_improve'] !!}</td>
        </tr>

        <tr>
            <td>{!! $jobRolesData['details']['headings']['heading7'] !!}</td>
            <td>{!! $jobRolesData['details']['engineering_and_technical_services_major_job_area'] !!}</td>
            <td>{!! $jobRolesData['details']['engineering_and_technical_services_trait_it_why_you_are_suitable_candidate'] !!}</td>
            <td>{!! $jobRolesData['details']['engineering_and_technical_services_growth_path_what_you_need_to_improve'] !!}</td>
        </tr>

        <tr>
            <td>{!! $jobRolesData['details']['headings']['heading8'] !!}</td>
            <td>{!! $jobRolesData['details']['research_analysis_and_consultancy_services_major_job_area'] !!}</td>
            <td>{!! $jobRolesData['details']['research_analysis_and_consultancy_trait_it_why_you_are_suitable_candidate'] !!}</td>
            <td>{!! $jobRolesData['details']['research_analysis_and_consultancy_growth_path_what_you_need_to_improve'] !!}</td>
        </tr>
    </tbody>
</table>
</div>

</div>
@endif
</body>
</html>
