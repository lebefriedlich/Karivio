<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CV - {{ $cv->full_name }}</title>
    <style>
        @page {
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            color: #000;
            line-height: 1.2;
            font-size: 11pt;
            margin-top: 1.27cm;
            margin-left: 1.27cm;
            margin-bottom: 1.27cm;
            margin-right: 1cm;
        }

        .container {
            width: 100%;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 15pt;
        }

        .header h1 {
            font-size: 16pt;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 4pt;
        }

        .contact-info {
            font-size: 10pt;
        }

        .contact-info span {
            display: inline-block;
        }

        .contact-info a {
            color: #0000FF;
            text-decoration: underline;
        }

        /* Sections */
        .section {
            margin-bottom: 12pt;
        }

        .section-title {
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            margin-bottom: 6pt;
            display: block;
            width: 100%;
            page-break-after: avoid;
        }

        /* Content Blocks */
        .content-block {
            margin-bottom: 8pt;
            page-break-inside: avoid;
        }

        .flex-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            width: 100%;
        }

        .left-col {
            text-align: left;
            font-weight: bold;
        }

        .right-col {
            text-align: right;
            font-weight: bold;
        }

        .sub-left {
            font-style: italic;
        }

        .sub-right {
            text-align: right;
            font-style: italic;
        }

        /* Text Styles */
        .description-text {
            text-align: justify;
            margin-top: 2pt;
        }

        .bullet-list {
            margin-top: 2pt;
            padding-left: 15pt;
        }

        .bullet-list li {
            margin-bottom: 2pt;
            text-align: justify;
        }

        /* Grid for skills if still needed, but image shows bullet style or text */
        .skills-text {
            margin-top: 2pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>{{ $cv->full_name }}</h1>
            <div class="contact-info">
                {{ $cv->phone }} | 
                <a href="mailto:{{ $cv->email }}">{{ $cv->email }}</a> | 
                @if ($cv->linkedin_url)
                    <a href="{{ $cv->linkedin_url }}">Linkedin Profil</a> | 
                @endif
                @if ($cv->portfolio_url)
                    <a href="{{ $cv->portfolio_url }}">Portofolio</a> | 
                @endif
                {{ $cv->location }}
            </div>
        </div>

        @php
            $formatDate = function($date) {
                if (!$date) return '';
                if (strtolower($date) == 'sekarang' || strtolower($date) == 'present') return 'Sekarang';
                
                $months = [
                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                ];

                try {
                    $dt = \Carbon\Carbon::parse($date);
                    $m = $dt->format('m');
                    $y = $dt->format('Y');
                    return ($months[$m] ?? $dt->format('F')) . ' ' . $y;
                } catch (\Exception $e) {
                    return $date;
                }
            };
        @endphp

        <!-- Profil -->
        @if ($cv->professional_summary)
            <div class="section">
                <div class="section-title">Profil</div>
                <div class="description-text">{{ $cv->professional_summary }}</div>
            </div>
        @endif

        <!-- Pendidikan -->
        @if ($cv->education && count($cv->education) > 0)
            <div class="section">
                <div class="section-title">Pendidikan</div>
                @foreach ($cv->education as $edu)
                    <div class="content-block">
                        <table style="width: 100%;">
                            <tr>
                                <td class="left-col">{{ $edu['institution'] ?? '' }}</td>
                                <td class="right-col">{{ $formatDate($edu['start_date'] ?? '') }} – {{ ($edu['is_current'] ?? false) ? 'Sekarang' : $formatDate($edu['end_date'] ?? '') }}</td>
                            </tr>
                            <tr>
                                <td class="sub-left">{{ $edu['major'] ?? '' }}</td>
                                <td class="sub-right">@if(!empty($edu['score'])) (IPK: {{ $edu['score'] }}) @endif</td>
                            </tr>
                        </table>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Pengalaman Profesional -->
        @if ($cv->work_experiences && count($cv->work_experiences) > 0)
            <div class="section">
                <div class="section-title">Pengalaman Profesional</div>
                @foreach ($cv->work_experiences as $work)
                    <div class="content-block">
                        <table style="width: 100%;">
                            <tr>
                                <td class="left-col" style="text-transform: uppercase;">{{ $work['company'] }}</td>
                                <td class="right-col">{{ $formatDate($work['start_date']) }} – {{ ($work['is_current'] ?? false) ? 'Sekarang' : $formatDate($work['end_date'] ?? '') }}</td>
                            </tr>
                            <tr>
                                <td class="sub-left" colspan="2">{{ $work['position'] }}</td>
                            </tr>
                        </table>
                        @if ($work['description'])
                            <ul class="bullet-list">
                                @foreach(explode("\n", str_replace("\r", "", $work['description'])) as $line)
                                    @if(trim($line))
                                        <li>{{ ltrim(trim($line), '- ') }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Pengalaman Asistensi -->
        @if ($cv->assistance_experiences && count($cv->assistance_experiences) > 0)
            <div class="section">
                <div class="section-title">Pengalaman Asistensi</div>
                @foreach ($cv->assistance_experiences as $ast)
                    <div class="content-block">
                        <table style="width: 100%;">
                            <tr>
                                <td class="left-col" style="text-transform: uppercase;">{{ $ast['role'] }}</td>
                                <td class="right-col">{{ $formatDate($ast['start_date']) }} – {{ ($ast['is_current'] ?? false) ? 'Sekarang' : $formatDate($ast['end_date'] ?? '') }}</td>
                            </tr>
                            <tr>
                                <td class="sub-left" colspan="2">{{ $ast['location'] }}</td>
                            </tr>
                        </table>
                        @if ($ast['description'])
                            <ul class="bullet-list">
                                @foreach(explode("\n", str_replace("\r", "", $ast['description'])) as $line)
                                    @if(trim($line))
                                        <li>{{ ltrim(trim($line), '- ') }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Organization -->
        @if ($cv->organization_experiences && count($cv->organization_experiences) > 0)
            <div class="section">
                <div class="section-title">Pengalaman Organisasi</div>
                @foreach ($cv->organization_experiences as $org)
                    <div class="content-block">
                        <table style="width: 100%;">
                            <tr>
                                <td class="left-col" style="text-transform: uppercase;">{{ $org['role'] }}</td>
                                <td class="right-col">{{ $formatDate($org['start_date']) }} – {{ ($org['is_current'] ?? false) ? 'Sekarang' : $formatDate($org['end_date'] ?? '') }}</td>
                            </tr>
                            <tr>
                                <td class="sub-left" colspan="2">{{ $org['organization'] }}</td>
                            </tr>
                        </table>
                        @if (!empty($org['description']))
                            <ul class="bullet-list">
                                @foreach(explode("\n", str_replace("\r", "", $org['description'])) as $line)
                                    @if(trim($line))
                                        <li>{{ ltrim(trim($line), '- ') }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Skills & Languages -->
        @php
            $techSkills = $cv->technical_skills ?? [];
            $softSkills = $cv->soft_skills ?? [];
            $hasSkills = count($techSkills) > 0 || count($softSkills) > 0 || ($cv->languages && count($cv->languages) > 0);
        @endphp

        @if ($hasSkills)
            <div class="section">
                <div class="section-title">SKILLS</div>
                <table style="width: 100%; border: none;">
                    <tr>
                        <td style="width: 60%; padding-right: 15pt;">
                                @if (count($techSkills) > 0)
                                    <div style="font-weight: bold; text-transform: uppercase; margin-bottom: 4pt; font-size: 10pt;">Hard Skill</div>
                                    <ul class="bullet-list" style="margin-top: 0;">
                                        @foreach ($techSkills as $skill)
                                            <li>
                                                @if(is_array($skill))
                                                    <span style="font-weight: bold;">{{ $skill['category'] ?? 'Skill' }}:</span> {{ $skill['skills'] ?? '' }}
                                                @else
                                                    {{ $skill }}
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                        </td>
                        <td style="width: 40%;">
                                @if (count($softSkills) > 0)
                                    <div style="font-weight: bold; text-transform: uppercase; margin-bottom: 4pt; font-size: 10pt;">Soft Skill</div>
                                    <ul class="bullet-list" style="margin-top: 0;">
                                        @foreach ($softSkills as $skill)
                                            <li>{{ $skill }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if ($cv->languages && count($cv->languages) > 0)
                                    <div style="font-weight: bold; text-transform: uppercase; margin-bottom: 4pt; font-size: 10pt;">Bahasa</div>
                                    <ul class="bullet-list" style="margin-top: 0;">
                                        @foreach ($cv->languages as $lang)
                                            <li>{{ $lang['language'] }} ({{ $lang['proficiency'] }})</li>
                                        @endforeach
                                    </ul>
                                @endif
                        </td>
                    </tr>
                </table>
            </div>
        @endif
    </div>
</body>
</html>
