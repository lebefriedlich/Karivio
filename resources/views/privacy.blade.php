<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Karivio</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; max-width: 800px; margin: 40px auto; padding: 0 20px; color: #333; }
        h1 { color: #2563eb; }
        h2 { margin-top: 30px; }
    </style>
</head>
<body>
    <h1>Privacy Policy</h1>
    <p>Last updated: {{ date('F d, Y') }}</p>

    <p>Welcome to Karivio. We value your privacy and are committed to protecting your personal data. This Privacy Policy explains how we handle your information when you use our application.</p>

    <h2>1. Information We Collect</h2>
    <p>When you log in using Google, we collect your name, email address, profile picture (avatar), and a unique Google ID to create and manage your account.</p>

    <h2>2. How We Use Your Information</h2>
    <p>Your information is used solely for authentication and providing the core services of Karivio, such as managing your job applications and CVs.</p>

    <h2>3. Data Protection</h2>
    <p>We implement appropriate security measures to protect your data from unauthorized access or disclosure. We do not sell or share your personal information with third parties.</p>

    <h2>4. Google User Data Usage</h2>
    <p>Karivio uses Google OAuth to allow you to send job applications directly from the platform. We request the <code>https://www.googleapis.com/auth/gmail.send</code> scope to facilitate this.</p>
    <ul>
        <li><strong>Access:</strong> We only access your Gmail account to send emails that you explicitly compose and trigger within Karivio.</li>
        <li><strong>Use:</strong> Your Google user data (email address and tokens) is used to authenticate the "Send" action. We do not use this data for any other purpose.</li>
        <li><strong>Storage:</strong> We store your Google Refresh Token securely in our database to maintain your session. We do not store the content of your emails beyond what is necessary for logging and tracking the status of your applications.</li>
        <li><strong>Sharing:</strong> We do not share your Google user data with any third parties, except as required to provide the service (i.e., communicating with Google APIs).</li>
    </ul>

    <h2>5. Third-Party Services</h2>
    <p>We use Google OAuth for authentication and email services. Please refer to <a href="https://policies.google.com/privacy" target="_blank">Google's Privacy Policy</a> for information on how they handle your data.</p>

    <h2>6. Contact Us</h2>
    <p>If you have any questions about this Privacy Policy, please contact us at support@karivio.mhna.my.id.</p>

    <hr>
    <p><a href="/">Back to Home</a></p>
</body>
</html>
