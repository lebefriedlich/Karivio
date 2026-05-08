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
        {{ $coverLetter->city }},
        {{ \Carbon\Carbon::parse($coverLetter->date)->locale($coverLetter->language ?? 'id')->translatedFormat('d F Y') }}
    </div>

    <div class="recipient">
        @if(($coverLetter->language ?? 'id') == 'en')
            To,<br>
            Recruitment Team<br>
        @else
            Kepada Yth.<br>
            Tim Rekrutmen<br>
        @endif
        <span class="bold">{{ $coverLetter->company_name }}</span><br>
        <span class="bold">{{ $coverLetter->company_address }}</span>
    </div>

    <div class="content">
        @php
            $greeting = ($coverLetter->language ?? 'id') == 'en' ? 'Dear Hiring Manager,' : 'Dengan hormat,';
            $bodyText = str_replace($greeting, '<div style="text-align: left; margin-bottom: 10pt;">' . $greeting . '</div>', $body);
            $paragraphs = explode("\n", $bodyText);
            foreach ($paragraphs as $p) {
                $p = trim($p);
                if (!empty($p)) {
                    if (strpos($p, '<div') !== false) {
                        echo $p;
                    } else {
                        echo '<p>' . $p . '</p>';
                    }
                }
            }
        @endphp
    </div>

    <div class="signature">
        @if(($coverLetter->language ?? 'id') == 'en')
            Sincerely,<br><br><br><br>
        @else
            Hormat Saya,<br><br><br><br>
        @endif
        <strong>{{ $coverLetter->full_name }}</strong>
    </div>
</body>

</html>