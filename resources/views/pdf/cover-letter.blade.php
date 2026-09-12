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

    .header { margin-bottom: 30px; }
    .header .name { font-size: 14pt; font-weight: bold; }
    .header .meta { font-size: 9.5pt; color: #555; }

    .to { margin-bottom: 20px; font-size: 10pt; color: #444; }

    .body p { margin-bottom: 12px; text-align: justify; }

    .signature { margin-top: 30px; }
</style>
</head>
<body>

    <div class="header">
        <div class="name">{{ $contact['name'] ?? '' }}</div>
        <div class="meta">
            {{ $contact['email'] ?? '' }}
            @if(!empty($contact['phone'])) · {{ $contact['phone'] }} @endif
            @if(!empty($contact['location'])) · {{ $contact['location'] }} @endif
        </div>
    </div>

    <div class="to">
        A la atención del equipo de selección{{ !empty($company) ? ' de '.$company : '' }}
    </div>

    <div class="body">
        @foreach(explode("\n", trim($coverLetter ?? '')) as $paragraph)
            @if(trim($paragraph) !== '')
                <p>{{ $paragraph }}</p>
            @endif
        @endforeach
    </div>

    <div class="signature">
        {{ $contact['name'] ?? '' }}
    </div>

</body>
</html>
