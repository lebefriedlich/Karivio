<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Karivio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --bg: #f9fafb;
            --card-bg: #ffffff;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            background-color: var(--bg);
            color: var(--text-main);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .card {
            background: var(--card-bg);
            padding: 48px;
            border-radius: 24px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .header {
            text-align: center;
            margin-bottom: 48px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 8px;
            letter-spacing: -0.025em;
        }

        .updated {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin-top: 40px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        h2::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 24px;
            background: var(--primary);
            border-radius: 4px;
        }

        p {
            margin-bottom: 20px;
            color: #374151;
        }

        ul {
            padding-left: 20px;
            margin-bottom: 24px;
        }

        li {
            margin-bottom: 12px;
            color: #374151;
        }

        strong {
            color: #111827;
            font-weight: 600;
        }

        code {
            background: #f3f4f6;
            padding: 2px 6px;
            border-radius: 6px;
            font-family: ui-monospace, monospace;
            font-size: 0.9em;
            color: var(--primary);
        }

        a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .footer {
            margin-top: 48px;
            text-align: center;
            border-top: 1px solid #f3f4f6;
            padding-top: 32px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background: #f3f4f6;
            color: #4b5563;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .back-btn:hover {
            background: #e5e7eb;
            color: #111827;
            text-decoration: none;
            transform: translateY(-1px);
        }

        @media (max-width: 640px) {
            .card { padding: 24px; border-radius: 16px; }
            h1 { font-size: 2rem; }
            .container { margin: 30px auto; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>Privacy Policy</h1>
                <p class="updated">Last updated: {{ date('F d, Y') }}</p>
            </div>

            <p>Welcome to <strong>Karivio</strong>. We value your privacy and are committed to protecting your personal data. This Privacy Policy explains how we handle your information when you use our application.</p>

            <h2>1. Information We Collect</h2>
            <p>When you log in using Google, we collect your name, email address, profile picture (avatar), and a unique Google ID to create and manage your account.</p>

            <h2>2. How We Use Your Information</h2>
            <p>Your information is used solely for authentication and providing the core services of Karivio, such as managing your job applications and CVs.</p>

            <h2>3. Data Protection and Sharing</h2>
            <p>We implement industry-standard security measures, including <strong>encryption at rest and in transit</strong>, to protect your data from unauthorized access, disclosure, or destruction. Regarding your personal and Google user data:</p>
            <ul>
                <li><strong>No Sale:</strong> We do not sell your personal information or Google user data to any third parties.</li>
                <li><strong>No Sharing/Transfer:</strong> We do not share, transfer, or disclose your information to third parties for purposes other than those explicitly required to provide the Karivio service (e.g., communicating with Google APIs).</li>
                <li><strong>No Advertising:</strong> Your data is never used for targeted advertising, credit-worthiness assessment, or any purpose unrelated to the core functionality of Karivio.</li>
            </ul>

            <h2>4. Google User Data Usage</h2>
            <p>Karivio uses Google OAuth to allow you to send job applications directly from the platform. We request the <code>https://www.googleapis.com/auth/gmail.send</code> scope to facilitate this.</p>
            <ul>
                <li><strong>Access:</strong> We only access your Gmail account to send emails that you explicitly compose and trigger within Karivio.</li>
                <li><strong>Use:</strong> Your Google user data is used solely to provide and improve user-facing features. We do not use this data for any other purpose.</li>
                <li><strong>Prohibited Uses:</strong> We strictly prohibit the use of Google user data for:
                    <ul>
                        <li>Targeted, personalized, or interest-based advertising.</li>
                        <li>Training AI or machine learning models.</li>
                        <li>Selling to data brokers or information resellers.</li>
                    </ul>
                </li>
                <li><strong>Storage:</strong> We store your Google Refresh Token securely in our database using encryption. We do not store the content of your emails beyond what is necessary for logging and tracking your applications.</li>
            </ul>

            <h2>5. Data Retention and Deletion</h2>
            <p>Karivio is committed to the principle of data minimization and purposeful retention. Regarding Google user data:</p>
            <ul>
                <li><strong>Retention:</strong> We retain your Google user data (including email address and OAuth tokens) only as long as you have an active account with Karivio. If your account is inactive for more than 12 months, we will automatically delete your stored OAuth tokens and personal identifiers.</li>
                <li><strong>Deletion:</strong> You may request the deletion of your data at any time. Upon your request or when you delete your account, all Google user data (including refresh tokens and profile information) will be permanently purged from our database within 30 days.</li>
                <li><strong>Manual Deletion:</strong> You can also revoke Karivio's access to your Google account at any time through the <a href="https://myaccount.google.com/permissions" target="_blank">Google Security Settings page</a>.</li>
            </ul>

            <h2>6. Third-Party Services</h2>
            <p>We use Google OAuth for authentication and email services. Please refer to <a href="https://policies.google.com/privacy" target="_blank">Google's Privacy Policy</a> for information on how they handle your data.</p>

            <h2>7. Contact Us</h2>
            <p>If you have any questions about this Privacy Policy, please contact us at <strong>support@karivio.mhna.my.id</strong>.</p>

            <div class="footer">
                <a href="/" class="back-btn">
                    <svg style="width:20px;height:20px;margin-right:8px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>
