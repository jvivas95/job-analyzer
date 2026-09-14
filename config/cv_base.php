<?php

declare(strict_types=1);

/**
 * Estructura base de tu perfil profesional.
 * Esta es la "fuente de verdad" que la IA usará como contexto
 * para evaluar el fit y generar el CV adaptado + carta de presentación.
 *
 * Edítalo una vez y todo el sistema lo reutiliza.
 */

return [

    'contact' => [
        'name'     => 'Jefferson Vivas Vásquez',
        'title'    => 'Desarrollador PHP · Laravel & Symfony',
        'location' => 'Barcelona, España',
        'email'    => 'jefferson.vivas.95@gmail.com',
        'phone'    => '+34 654 483 183',
        'linkedin' => 'linkedin.com/in/jefferson-vivas',
        'github'   => 'github.com/jvivas95',
        'website'  => 'www.jvivas.es',
    ],

    'summary' => 'Desarrollador FullStack especializado en PHP (Laravel y Symfony), con experiencia '
        . 'adicional en Python/Flask'
        . 'que aporta una perspectiva orientada a negocio poco común en perfiles técnicos junior. '
        . 'Autor de proyectos full-stack desplegados en producción (InkInspire, Mail Router) y en '
        . 'transición activa hacia DevOps (Docker, CI/CD, AWS, Terraform).',

    'education' => [
        [
            'degree'      => 'Grado Superior en Desarrollo de Aplicaciones Web (DAW)',
            'institution' => 'iFP',
            'status'      => 'Sep 2022 – Mar 2025',
        ],
        [
            'degree'      => 'Ingeniería Informática',
            'institution' => 'Universitat Oberta de Catalunya (UOC)',
            'status'      => 'En curso',
        ],
        [
            'degree'      => 'AWS Nivel 1: Cloud Computing iniciación',
            'institution' => 'IT Academy de Barcelona Activa',
            'status'      => 'Mar 2026',
        ],
        [
            'degree'      => 'Symfony 7',
            'institution' => 'SymfonyCasts',
            'status'      => 'Mar 2025 – May 2025',
        ],
        [
            'degree'      => 'Laravel 12',
            'institution' => 'Udemy',
            'status'      => 'Mar 2025 – May 2025',
        ],
    ],

    'experience' => [
        [
            'role'        => 'Backend Developer (Prácticas)',
            'company'     => 'SDWEB Solucions Dixitais SL — Barcelona (Híbrido)',
            'period'      => 'Sep 2024 – Mar 2025',
            'stack'       => ['PHP 8', 'Symfony', 'MVC'],
            'description' => 'Desarrollo de nuevas funcionalidades y métricas en eHabilis Manager, '
                . 'plataforma SaaS de gestión de formaciones.',
        ],
        [
            'role'        => 'Ventas y atención al cliente',
            'company'     => 'Consultor de servicios y retail — Barcelona',
            'period'      => '2018 – 2022',
            'stack'       => [],
            'description' => 'Varios años gestionando clientes, detectando necesidades y cerrando '
                . 'acuerdos — experiencia que ahora aplica al negocio detrás de cada proceso que automatiza.',
        ],
    ],

    'projects' => [
        [
            'name'        => 'InkInspire',
            'url'         => 'https://www.inkinspire.es/',
            'stack'       => ['Laravel 13', 'MySQL', 'Docker', 'Alpine.js', 'Pest', 'Render', 'Aiven'],
            'description' => 'Plataforma de reseñas de libros y comunidad literaria, desplegada en producción '
                . 'con Docker y MySQL gestionado en Aiven (cloud). Demuestra dominio completo del stack PHP moderno.',
        ],
        // [
        //     'name'        => 'Mail Router (Python)',
        //     'url'         => null,
        //     'stack'       => ['Python', 'Flask', 'IMAP', 'SMTP', 'SQLite'],
        //     'description' => 'App para gestionar el enrutamiento de correos electrónicos según reglas de '
        //         . 'negocio, con niveles de usuario, panel de administración y actualización en tiempo real.',
        // ],
        [
            'name'        => 'Mail Router (Laravel)',
            'url'         => null,
            'repo'        => 'https://github.com/jvivas95/mailrouter',
            'stack'       => ['Laravel', 'PHP', 'MySQL', 'IMAP', 'SMTP'],
            'description' => 'App para gestionar el enrutamiento de correos electrónicos según las reglas del'
                . 'negocia, con niveles de usuario, panel de administración y actualización en tiempo real.'
                . 'desplegada en AWS para el departamento comercial de una empresa.',
        ],
    ],

    'tech_stack' => [
        'backend'    => ['PHP (Laravel, Symfony)', 'Python (Flask)', 'Java'],
        'frontend'   => ['JavaScript', 'HTML5', 'CSS3', 'Bootstrap', 'Tailwind CSS', 'React', 'Astro', 'Chart.js'],
        'databases'  => ['MySQL', 'MariaDB', 'SQLite', 'MongoDB', 'PostgreSQL (básico)'],
        'testing'    => ['Pest (PHP)', 'pruebas unitarias y de funcionalidad'],
        'devops'     => ['Docker', 'Render', 'Vercel', 'InfinityFree', 'Linux CLI', 'FTP/SFTP', 'AWS (iniciación)'],
        'tools'      => ['Git', 'GitHub', 'Google Books API'],
        'methodologies' => ['Scrum', 'Metodologías ágiles'],
    ],

    'soft_skills' => [
        'Trabajo en equipo', 'Resolución de problemas', 'Orientación al usuario', 'Aprendizaje rápido',
        'Atención al detalle', 'Comunicación con perfiles no técnicos', 'Organización y gestión del tiempo',
    ],

    'languages' => [
        'Español'   => 'Nativo (C2)',
        'Catalán'   => 'Nativo (C2)',
        'Inglés'    => 'Comprensión B2 / Expresión oral A2',
        'Portugués' => 'Básico (A1)',
    ],
];
