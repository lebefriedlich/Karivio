<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Karivio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('logo.svg') }}">
    <style>
        :root {
            --primary: #3b82f6;
            --primary-hover: #60a5fa;
            --text-main: #e5e7eb;
            --text-muted: #9ca3af;
            --bg-dark: #090d16;
            --card-bg: rgba(18, 24, 38, 0.6);
            --border-dark: rgba(255, 255, 255, 0.08);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            background-color: var(--bg-dark);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            position: relative;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Animated Grid Background */
        .grid-bg {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
            z-index: 1;
        }

        /* Glowing Orbs */
        .glow-orb-1,
        .glow-orb-2 {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
            filter: blur(80px);
        }

        .glow-orb-1 {
            top: 10%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.06) 0%, transparent 70%);
        }

        .glow-orb-2 {
            bottom: 10%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.06) 0%, transparent 70%);
        }

        .krv-bg-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
            pointer-events: none;
        }

        .container {
            max-width: 800px;
            margin: 60px auto;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 48px;
            border-radius: 24px;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-dark);
        }

        .header {
            text-align: center;
            margin-bottom: 48px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #ffffff;
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
            color: #ffffff;
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
            color: #d1d5db;
        }

        ul {
            padding-left: 20px;
            margin-bottom: 24px;
        }

        li {
            margin-bottom: 12px;
            color: #d1d5db;
        }

        strong {
            color: #ffffff;
            font-weight: 600;
        }

        code {
            background: rgba(255, 255, 255, 0.05);
            padding: 2px 6px;
            border-radius: 6px;
            font-family: ui-monospace, monospace;
            font-size: 0.9em;
            color: #60a5fa;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        a {
            color: var(--primary-hover);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .footer {
            margin-top: 48px;
            text-align: center;
            border-top: 1px solid var(--border-dark);
            padding-top: 32px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.05);
            color: #d1d5db;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s;
            border: 1px solid var(--border-dark);
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        @media (max-width: 640px) {
            .card {
                padding: 24px;
                border-radius: 16px;
            }

            h1 {
                font-size: 2rem;
            }

            .container {
                margin: 30px auto;
            }
        }
    </style>
</head>

<body>
    <!-- Grid & Glow Context -->
    <div class="krv-bg-wrapper">
        <div class="grid-bg"></div>
        <div class="glow-orb-1"></div>
        <div class="glow-orb-2"></div>
    </div>

    <div class="container">
        <div class="card">
            <div class="header">
                <h1>Privacy Policy</h1>
                <p class="updated">Last updated: {{ date('F d, Y') }}</p>
            </div>

            <p>Welcome to <strong>Karivio</strong>. We value your privacy and are committed to protecting your personal
                data. This Privacy Policy explains how we handle your information when you use our application.</p>

            <h2>1. Information We Collect</h2>
            <p>When you log in using Google, we collect your name, email address, profile picture (avatar), and a unique
                Google ID to create and manage your account.</p>

            <h2>2. How We Use Your Information</h2>
            <p>Your information is used solely for authentication and providing the core services of Karivio, such as
                managing your job applications and CVs.</p>

            <h2>3. Data Protection and Sharing</h2>
            <p>We implement industry-standard security measures, including <strong>encryption at rest and in
                    transit</strong>, to protect your data from unauthorized access, disclosure, or destruction.
                Regarding your personal and Google user data:</p>
            <ul>
                <li><strong>No Sale:</strong> We do not sell your personal information or Google user data to any third
                    parties.</li>
                <li><strong>No Sharing/Transfer:</strong> We do not share, transfer, or disclose your information to
                    third parties for purposes other than those explicitly required to provide the Karivio service
                    (e.g., communicating with Google APIs).</li>
                <li><strong>No Advertising:</strong> Your data is never used for targeted advertising, credit-worthiness
                    assessment, or any purpose unrelated to the core functionality of Karivio.</li>
            </ul>

            <h2>4. Google User Data Usage</h2>
            <p>Karivio uses Google OAuth to allow you to send job applications directly from the platform. We request
                the <code>https://www.googleapis.com/auth/gmail.send</code> scope to facilitate this.</p>
            <ul>
                <li><strong>Access:</strong> We only access your Gmail account to send emails that you explicitly
                    compose and trigger within Karivio.</li>
                <li><strong>Use:</strong> Your Google user data is used solely to provide and improve user-facing
                    features. We do not use this data for any other purpose.</li>
                <li><strong>Prohibited Uses:</strong> We strictly prohibit the use of Google user data for:
                    <ul>
                        <li>Targeted, personalized, or interest-based advertising.</li>
                        <li>Training AI or machine learning models.</li>
                        <li>Selling to data brokers or information resellers.</li>
                    </ul>
                </li>
                <li><strong>Storage:</strong> We store your Google Refresh Token securely in our database using
                    encryption. We do not store the content of your emails beyond what is necessary for logging and
                    tracking your applications.</li>
            </ul>

            <h2>5. Data Retention and Deletion</h2>
            <p>Karivio is committed to the principle of data minimization and purposeful retention. Regarding Google
                user data:</p>
            <ul>
                <li><strong>Retention:</strong> We retain your Google user data (including email address and OAuth
                    tokens) only as long as you have an active account with Karivio. If your account is inactive for
                    more than 12 months, we will automatically delete your stored OAuth tokens and personal identifiers.
                </li>
                <li><strong>Deletion:</strong> You may request the deletion of your data at any time. Upon your request
                    or when you delete your account, all Google user data (including refresh tokens and profile
                    information) will be permanently purged from our database within 30 days.</li>
                <li><strong>Manual Deletion:</strong> You can also revoke Karivio's access to your Google account at any
                    time through the <a href="https://myaccount.google.com/permissions" target="_blank">Google Security
                        Settings page</a>.</li>
            </ul>

            <h2>6. Third-Party Services</h2>
            <p>We use Google OAuth for authentication and email services. Please refer to <a
                    href="https://policies.google.com/privacy" target="_blank">Google's Privacy Policy</a> for
                information on how they handle your data.</p>

            <h2>7. Contact Us</h2>
            <p>If you have any questions about this Privacy Policy, please contact us at
                <strong>support@karivio.mhna.my.id</strong>.</p>

            <div class="footer">
                <a href="/" class="back-btn">
                    <svg style="width:20px;height:20px;margin-right:8px" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</body>

</html>