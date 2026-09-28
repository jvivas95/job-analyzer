<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
    @page { margin: 100px 50px 80px 50px; }

    body {
        font-family: Helvetica, Arial, sans-serif;
        font-size: 11pt;
        line-height: 1.6;
        color: #1a1a1a;
    }

    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    .header { margin-bottom: 26px; }
    .header .name { font-size: 14pt; font-weight: bold; }

    .subject { margin-bottom: 18px; font-size: 10.5pt; }
    .to { margin-bottom: 20px; font-size: 10pt; color: #444; }

    .body p { margin: 0 0 12px 0; text-align: left; }

    .signature { margin-top: 28px; }
    .signature .name { font-weight: bold; }
    .signature .meta { margin-top: 3px; font-size: 9.5pt; color: #555; }
</style>
</head>
<body>

    <div class="header">
        <div class="name">{{ $contact['name'] ?? '' }}</div>
    </div>

    <div class="subject">
        <strong>Asunto:</strong> Candidatura para {{ $title ?? 'la oferta' }}{{ !empty($company) ? ' en '.$company : '' }}
    </div>

    <div class="to">
        A la atención del equipo de selección{{ !empty($company) ? ' de '.$company : '' }}
    </div>

    <div class="body">
        @foreach(preg_split('/\R[ \t]*\R/u', trim($coverLetter ?? '')) ?: [] as $paragraph)
            @if(trim($paragraph) !== '')
                <p>{!! nl2br(e(trim($paragraph))) !!}</p>
            @endif
        @endforeach
    </div>

    <div class="signature">
        <div class="name">{{ $contact['name'] ?? '' }}</div>
        <div class="meta">
            @if(!empty($contact['email'])){{ $contact['email'] }}@endif
            @if(!empty($contact['phone'])){{ !empty($contact['email']) ? ' · ' : '' }}{{ $contact['phone'] }}@endif
            @if(!empty($contact['website'])){{ !empty($contact['email']) || !empty($contact['phone']) ? ' · ' : '' }}{{ $contact['website'] }}@endif
        </div>
    </div>

</body>
</html>
