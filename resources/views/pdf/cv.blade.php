<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
    @page { margin: 100px 40px 80px 40px; }

    * { box-sizing: border-box; }

    body {
        font-family: Helvetica, Arial, sans-serif;
        font-size: 10.5pt;
        line-height: 1.45;
        color: #1a1a1a;
    }

    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    h1 { font-size: 20pt; margin: 0 0 2px 0; font-weight: bold; }

    h2 {
        font-size: 11pt;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #333;
        padding-bottom: 3px;
        margin: 16px 0 8px 0;
        font-weight: bold;
    }

    .title { font-size: 12pt; color: #444; margin-bottom: 6px; }

    .contact { font-size: 9.5pt; color: #444; margin-bottom: 4px; }
    .contact span { margin-right: 10px; }

    p { margin: 0 0 6px 0; }

    .entry { margin-bottom: 10px; }
    .entry-left { float: left; font-weight: bold; }
    .entry-right { float: right; font-size: 9.5pt; color: #555; }
    .stack-line { font-size: 9pt; color: #555; margin: 2px 0 3px 0; clear: both; }

    ul { margin: 4px 0 0 16px; padding: 0; }
    li { margin-bottom: 2px; }

    .skills-grid p { font-size: 9.5pt; margin-bottom: 3px; }
    .skills-grid strong { display: inline-block; width: 95px; }
</style>
</head>
<body>

    <h1>{{ $data['contact']['name'] ?? '' }}</h1>
    <div class="title">{{ $data['contact']['title'] ?? '' }}</div>
    <div class="contact">
        @if(!empty($data['contact']['location']))<span>{{ $data['contact']['location'] }}</span>@endif
        @if(!empty($data['contact']['email']))<span>{{ $data['contact']['email'] }}</span>@endif
        @if(!empty($data['contact']['phone']))<span>{{ $data['contact']['phone'] }}</span>@endif
        @if(!empty($data['contact']['linkedin']))<span>{{ $data['contact']['linkedin'] }}</span>@endif
        @if(!empty($data['contact']['github']))<span>{{ $data['contact']['github'] }}</span>@endif
        @if(!empty($data['contact']['website']))<span>{{ $data['contact']['website'] }}</span>@endif
    </div>

    @if(!empty($data['summary']))
        <h2>Perfil</h2>
        <p>{{ $data['summary'] }}</p>
    @endif

    @if(!empty($data['experience']))
        <h2>Experiencia</h2>
        @foreach($data['experience'] as $exp)
            <div class="entry">
                <div class="clearfix">
                    <span class="entry-left">{{ $exp['role'] }} — {{ $exp['company'] }}</span>
                    <span class="entry-right">{{ $exp['period'] }}</span>
                </div>
                @if(!empty($exp['stack']))
                    <div class="stack-line">{{ implode(' · ', $exp['stack']) }}</div>
                @endif
                <p>{{ $exp['description'] }}</p>
            </div>
        @endforeach
    @endif

    @if(!empty($data['projects']))
        <h2>Proyectos</h2>
        @foreach($data['projects'] as $project)
            <div class="entry">
                <div class="clearfix">
                    <span class="entry-left">
                        {{ $project['name'] }}{{ !empty($project['url']) ? ' — '.$project['url'] : '' }}
                    </span>
                </div>
                @if(!empty($project['stack']))
                    <div class="stack-line">{{ implode(' · ', $project['stack']) }}</div>
                @endif
                <p>{{ $project['description'] }}</p>
            </div>
        @endforeach
    @endif

    @if(!empty($data['highlighted_projects']))
        <h2>Relevancia para esta oferta</h2>
        <ul>
            @foreach($data['highlighted_projects'] as $point)
                <li>{{ $point }}</li>
            @endforeach
        </ul>
    @endif

    @if(!empty($data['tech_stack']))
        <h2>Stack técnico</h2>
        <div class="skills-grid">
            @foreach($data['tech_stack'] as $category => $items)
                <p><strong>{{ ucfirst($category) }}:</strong> {{ implode(', ', $items) }}</p>
            @endforeach
        </div>
    @endif

    @if(!empty($data['education']))
        <h2>Formación</h2>
        @foreach($data['education'] as $edu)
            <p>{{ $edu['degree'] }} — {{ $edu['institution'] }} ({{ $edu['status'] }})</p>
        @endforeach
    @endif

    @if(!empty($data['soft_skills']))
        <h2>Habilidades personales</h2>
        <p>{{ implode(' · ', $data['soft_skills']) }}</p>
    @endif

    @if(!empty($data['languages']))
        <h2>Idiomas</h2>
        <p>
            @foreach($data['languages'] as $lang => $level)
                {{ $lang }}: {{ $level }}@if(!$loop->last) &nbsp;·&nbsp; @endif
            @endforeach
        </p>
    @endif

</body>
</html>
