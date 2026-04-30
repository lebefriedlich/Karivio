<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cover Letter - {{ $coverLetter->full_name }}</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            margin: 1.27cm 1cm 1.27cm 1.27cm;
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.15;
            color: #000;
        }
        .header {
            text-align: right;
            margin-bottom: 30pt;
        }
        .header .name {
            font-weight: bold;
            font-size: 12pt;
            text-transform: capitalize;
        }
        .date-place {
            margin-bottom: 20pt;
        }
        .recipient {
            margin-bottom: 15pt;
        }
        .recipient .bold {
            font-weight: bold;
        }
        .content {
            text-align: justify;
        }
        .content p {
            margin: 0 0 10pt 0;
            text-align: justify;
        }
        .signature {
            margin-top: 20pt;
        }
        a {
            color: #000;
            text-decoration: none;
        }
        .phone-link {
            color: black;
        }
        .email-link {
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="name">{{ $coverLetter->full_name }}</div>
        <div><a href="https://wa.me/{{ $coverLetter->phone }}" class="phone-link">{{ $coverLetter->phone }}</a></div>
        <div><a href="mailto:{{ $coverLetter->email }}" class="email-link">{{ $coverLetter->email }}</a></div>
    </div>

    <div class="date-place">
        {{ $coverLetter->city }}, {{ \Carbon\Carbon::parse($coverLetter->date)->translatedFormat('d F Y') }}
    </div>

    <div class="recipient">
        Kepada Yth.<br>
        Tim Rekrutmen<br>
        <span class="bold">{{ $coverLetter->company_name }}</span><br>
        {{ $coverLetter->company_address }}
    </div>

    <div class="content">
        @php
            $bodyText = str_replace('Dengan hormat,', '<div style="text-align: left; margin-bottom: 10pt;">Dengan hormat,</div>', $body);
            $paragraphs = explode("\n", $bodyText);
            foreach($paragraphs as $p) {
                $p = trim($p);
                if (!empty($p)) {
                    if (strpos($p, '<div') !== false) {
                        echo $p; // Don't wrap the "Dengan hormat" div in a p tag
                    } else {
                        echo '<p>' . $p . '</p>';
                    }
                }
            }
        @endphp
    </div>

    <div class="signature">
        Hormat Saya,<br><br><br><br>
        <strong>{{ $coverLetter->full_name }}</strong>
    </div>
</body>
</html>
