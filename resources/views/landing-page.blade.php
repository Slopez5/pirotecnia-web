<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Pirotecnia San Rafael | El Arte de la Luz</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-background font-body text-on-background selection:bg-secondary/20 selection:text-on-background">
    @php
        $heroStats = [
            ['value' => '20+', 'label' => 'años produciendo espectáculos'],
            ['value' => '100%', 'label' => 'operación con enfoque en seguridad'],
            ['value' => 'Colima', 'label' => 'cobertura metropolitana y foránea'],
        ];

        $eventTypes = [
            ['icon' => 'favorite', 'label' => 'Bodas'],
            ['icon' => 'cake', 'label' => 'XV Años'],
            ['icon' => 'church', 'label' => 'Religiosos'],
            ['icon' => 'groups', 'label' => 'Públicos'],
            ['icon' => 'business', 'label' => 'Corporativos'],
            ['icon' => 'festival', 'label' => 'Festivales'],
        ];

        $benefits = [
            [
                'icon' => 'person_check',
                'title' => 'Atención Personalizada',
                'description' => 'Diseñamos el evento según el momento, el recinto y el presupuesto.',
                'tone' => 'secondary',
            ],
            [
                'icon' => 'account_balance_wallet',
                'title' => 'Presupuestos Variables',
                'description' => 'Trabajamos propuestas escalables para eventos íntimos o masivos.',
                'tone' => 'warning',
            ],
            [
                'icon' => 'military_tech',
                'title' => 'Experiencia Profesional',
                'description' => 'Décadas de ejecución técnica respaldan cada show.',
                'tone' => 'accent',
            ],
            [
                'icon' => 'verified_user',
                'title' => 'Seguridad Operativa',
                'description' => 'Protocolos claros para montaje, disparo y cierre del evento.',
                'tone' => 'primary',
            ],
            [
                'icon' => 'verified',
                'title' => 'Confiabilidad',
                'description' => 'Planeación, puntualidad y seguimiento comercial antes del show.',
                'tone' => 'secondary',
            ],
        ];

        $testimonials = [
            [
                'quote' =>
                    'Superaron todas nuestras expectativas. El show de nuestra boda fue el momento más comentado por todos los invitados.',
                'initials' => 'MV',
                'name' => 'María V.',
                'role' => 'Boda Boutique',
            ],
            [
                'quote' =>
                    'Profesionalismo total desde la primera llamada. El equipo de San Rafael manejó el protocolo de seguridad con mucha claridad.',
                'initials' => 'RL',
                'name' => 'Ricardo L.',
                'role' => 'Director de Logística',
            ],
            [
                'quote' =>
                    'Las fiestas patronales nunca habían lucido así. El castillo y el cierre del espectáculo dejaron a todos impresionados.',
                'initials' => 'JP',
                'name' => 'Juan P.',
                'role' => 'Comité Organizador',
            ],
        ];

        $collaborators = ['diamond', 'castle', 'apartment', 'nightlife', 'festival', 'corporate_fare'];
    @endphp

    <nav
        class="fixed inset-x-0 top-0 z-50 border-b border-primary-700/50 bg-primary-900/90 text-on-primary backdrop-blur-xl">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-6 py-5 lg:px-8">
            <a class="flex flex-col leading-none" href="#inicio">
                <span class="font-display text-3xl uppercase tracking-[0.14em]">Pirotecnia</span>
                <span class="text-xs uppercase tracking-[0.45em] text-primary-200">San Rafael</span>
            </a>

            <div
                class="hidden items-center gap-8 text-xs font-bold uppercase tracking-[0.26em] text-primary-200 md:flex">
                <a class="transition-colors hover:text-on-primary" href="#nosotros">Nosotros</a>
                <a class="transition-colors hover:text-on-primary" href="#paquetes">Paquetes</a>
                <a class="transition-colors hover:text-on-primary" href="#eventos">Eventos</a>
                <a class="transition-colors hover:text-on-primary" href="#jugueteria">Juguetería</a>
                <a class="transition-colors hover:text-on-primary" href="#contacto">Contacto</a>
            </div>

            <a class="inline-flex items-center gap-2 rounded-full bg-secondary px-5 py-3 text-sm font-bold text-on-secondary shadow-card transition hover:bg-secondary-600"
                href="#cta-final">
                <span class="material-symbols-outlined text-base">rocket_launch</span>
                Reservar Show
            </a>
        </div>
    </nav>

    <header class="relative isolate overflow-hidden bg-primary-900 pt-28 text-on-primary" id="inicio">
        <div class="absolute inset-0">
            <img alt="Espectáculo de fuegos artificiales iluminando el cielo nocturno"
                class="h-full w-full object-cover opacity-30"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjIcw0TgBtQ7Xerjbue934bLZXe46pNPO64rctjXog-lAjPSSgigJH_eTv25mWLupPhJ_xd6bZIGZ8BkZGml7RTwCers1yem3P2qtsootseSUn7WV2VTeIIkJR89rVOm99pvtFBx3cPXzm-G5VvmFVA6FBvIFEhB9alzKzRIgxe220Vmq8hog_jzoPRFhkgzKrHAblg3o-z0cmOfpHSTwkHWP_YIDA1HBLAlSb08FsRug-CP7KVztWyT2NvExk4RDbXrJOQFp5fFM" />
            <div class="absolute inset-0 bg-gradient-to-b from-primary-900 via-primary-500/85 to-primary-100"></div>
            <div class="absolute -right-12 top-24 h-56 w-56 rounded-full bg-secondary/20 blur-3xl"></div>
            <div class="absolute bottom-16 left-0 h-64 w-64 rounded-full bg-accent/15 blur-3xl"></div>
        </div>

        <div
            class="relative mx-auto grid min-h-screen max-w-7xl items-center gap-16 px-6 pb-20 pt-10 lg:grid-cols-[1.15fr_0.85fr] lg:px-8">
            <div class="max-w-3xl">
                <span
                    class="inline-flex items-center gap-2 rounded-full border border-primary-300/35 bg-on-primary/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.28em] text-primary-100">
                    <span class="material-symbols-outlined text-sm text-warning">flare</span>
                    Espectáculos pirotécnicos premium
                </span>

                <h1 class="mt-8 font-heading text-5xl font-bold tracking-tight text-on-primary md:text-7xl">
                    Iluminamos tus <span class="text-secondary">mejores momentos</span> con precisión operativa y diseño
                    visual.
                </h1>

                <p class="mt-6 max-w-2xl text-lg leading-relaxed text-primary-100 md:text-xl">
                    Paquetes, producciones personalizadas y juguetería pirotécnica para bodas, ferias, eventos
                    religiosos, espectáculos públicos y celebraciones privadas.
                </p>

                <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:flex-wrap">
                    <a class="inline-flex items-center justify-center gap-2 rounded-full bg-secondary px-8 py-4 text-sm font-bold text-on-secondary shadow-card transition hover:bg-secondary-600"
                        href="#paquetes">
                        <span class="material-symbols-outlined text-base">inventory_2</span>
                        Ver paquetes
                    </a>
                    <a class="inline-flex items-center justify-center gap-2 rounded-full border border-primary-300/30 bg-on-primary/10 px-8 py-4 text-sm font-bold text-on-primary transition hover:bg-on-primary/15"
                        href="#cta-final">
                        <span class="material-symbols-outlined text-base">description</span>
                        Solicitar cotización
                    </a>
                    <a class="inline-flex items-center justify-center gap-2 rounded-full px-4 py-4 text-sm font-bold text-accent transition hover:text-accent-300"
                        href="#jugueteria">
                        <span class="material-symbols-outlined text-base">toys</span>
                        Ver juguetería
                    </a>
                </div>

                <div class="mt-12 grid gap-4 sm:grid-cols-3">
                    @foreach ($heroStats as $stat)
                        <div class="rounded-3xl border border-primary-700/70 bg-primary-800/80 p-5 backdrop-blur-sm">
                            <p class="text-3xl font-bold text-on-primary">{{ $stat['value'] }}</p>
                            <p class="mt-2 text-sm leading-relaxed text-primary-200">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="relative">
                <div class="absolute -left-8 top-8 h-28 w-28 rounded-full bg-warning/20 blur-3xl"></div>
                <div
                    class="rounded-[2rem] border border-primary-700/70 bg-primary-800/80 p-6 shadow-card backdrop-blur-lg">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.28em] text-primary-200">Producción
                                Integral</p>
                            <h2 class="mt-3 font-heading text-3xl font-bold text-on-primary">Shows pensados para
                                venderse,
                                montarse y ejecutarse bien.</h2>
                        </div>
                        <span class="rounded-2xl bg-accent/15 p-3 text-accent">
                            <span class="material-symbols-outlined text-3xl">celebration</span>
                        </span>
                    </div>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-3xl bg-primary-900/60 p-5">
                            <p class="text-xs font-bold uppercase tracking-[0.26em] text-primary-200">Bodas y Sociales
                            </p>
                            <p class="mt-3 text-sm leading-relaxed text-primary-100">Shows sincronizados para momentos
                                clave,
                                entradas, brindis o cierre de evento.</p>
                        </div>
                        <div class="rounded-3xl bg-primary-900/60 p-5">
                            <p class="text-xs font-bold uppercase tracking-[0.26em] text-primary-200">Ferias y
                                Patronales</p>
                            <p class="mt-3 text-sm leading-relaxed text-primary-100">Castillos, cierres de plaza y
                                secuencias de
                                mayor duración con enfoque operativo.</p>
                        </div>
                    </div>

                    <div class="mt-6 rounded-3xl border border-primary-700/60 bg-on-primary/10 p-5">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.26em] text-primary-200">Ruta Comercial
                                </p>
                                <p class="mt-2 text-sm text-primary-100">Diagnóstico, propuesta, apartado de inventario
                                    y
                                    planeación de ejecución.</p>
                            </div>
                            <span
                                class="rounded-2xl bg-warning px-3 py-2 text-xs font-bold uppercase tracking-[0.24em] text-on-warning">
                                Activa
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="bg-primary-100 py-24" id="nosotros">
        <div class="mx-auto grid max-w-7xl items-center gap-14 px-6 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
            <div class="relative">
                <div class="absolute -inset-4 rounded-[2rem] bg-accent/10 blur-2xl"></div>
                <div class="relative overflow-hidden rounded-[2rem] border border-border bg-surface shadow-card">
                    <img alt="Equipo profesional preparando un espectáculo pirotécnico"
                        class="h-[360px] w-full object-cover sm:h-[440px] lg:h-[520px]"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA25PSKUFLO91mOp-PA6fnd0DbSLNHOBLJUSDlrTd2v36TWsepkh5uffc_b1X1pP4u4wUItjvw1a1Vpcb8qY9LCdePWp6LdnBs0XYuobXwQvCXeSm3pjfsMMtW2NItuZAva7sT17Hs3BIu7fnX0BwYWMdQqIl1HQ_MV852f1lj2rGeR67e1xc29OB1LCy85LWN1JFzxKaBiRo7qiyMgzobWOPrrMOocyk6QAPk8Tl3sMuIOEoIWD4BFPPmUzWXDf3yIH-CuzRoNFAU" />
                </div>
            </div>

            <div class="space-y-6">
                <span class="text-sm font-bold uppercase tracking-[0.32em] text-secondary">Nuestro Taller</span>
                <h2 class="font-heading text-4xl font-bold tracking-tight text-on-background md:text-5xl">
                    Maestros del <span class="text-primary">arte celestial</span> con enfoque comercial y operativo.
                </h2>
                <div class="spark-divider w-28"></div>
                <p class="text-lg leading-relaxed text-muted">
                    En Pirotecnia San Rafael no solo lanzamos fuegos artificiales. Diseñamos experiencias visuales con
                    un proceso claro: diagnóstico del evento, propuesta técnica, selección de materiales, coordinación
                    del personal y seguimiento hasta el cierre.
                </p>
                <p class="text-lg leading-relaxed text-muted">
                    La calidad del espectáculo depende tanto del producto como de la ejecución. Por eso cada montaje se
                    planea con criterio técnico, control de inventario y protocolos de seguridad.
                </p>

                <div class="grid gap-4 pt-2 sm:grid-cols-2">
                    <div class="rounded-3xl border border-border bg-surface p-5 shadow-soft">
                        <p class="text-sm font-bold uppercase tracking-[0.22em] text-primary">Diseño Visual</p>
                        <p class="mt-3 text-sm leading-relaxed text-muted">Secuencias pensadas para el tipo de evento y
                            el
                            ritmo de la celebración.</p>
                    </div>
                    <div class="rounded-3xl border border-border bg-surface p-5 shadow-soft">
                        <p class="text-sm font-bold uppercase tracking-[0.22em] text-primary">Seguridad Real</p>
                        <p class="mt-3 text-sm leading-relaxed text-muted">Montaje y control con estándares claros
                            antes,
                            durante y después del disparo.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary-900 py-24 text-on-primary" id="paquetes">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span class="text-sm font-bold uppercase tracking-[0.32em] text-accent">Paquetes de Espectáculo</span>
                <h2 class="mt-4 font-heading text-4xl font-bold tracking-tight md:text-5xl">
                    Propuestas listas para vender, cotizar y ejecutar.
                </h2>
                <p class="mt-5 text-lg leading-relaxed text-primary-200">
                    Paquetes pensados para distintos alcances de producción, con estructura clara y lenguaje comercial
                    consistente para tu proceso de venta.
                </p>
            </div>

            <div class="mt-14 flex snap-x snap-mandatory gap-6 overflow-x-auto pb-4">
                <x-package-card />
                <x-package-card />
            </div>
        </div>
    </section>

    <section class="bg-surface-alt py-24" id="eventos">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span class="text-sm font-bold uppercase tracking-[0.32em] text-warning">Tipos de Evento</span>
                <h2 class="mt-4 font-heading text-4xl font-bold tracking-tight text-on-background md:text-5xl">
                    Eventos que <span class="text-secondary">transformamos</span> en un cierre memorable.
                </h2>
            </div>

            <div class="mt-14 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-6">
                @foreach ($eventTypes as $eventType)
                    <div
                        class="group aspect-square cursor-default rounded-3xl border border-border bg-surface p-4 shadow-soft transition duration-300 hover:-translate-y-1 hover:border-primary hover:bg-primary hover:text-on-primary">
                        <div class="flex h-full flex-col items-center justify-center text-center">
                            <span
                                class="material-symbols-outlined mb-4 text-4xl text-primary transition-colors group-hover:text-on-primary">
                                {{ $eventType['icon'] }}
                            </span>
                            <span
                                class="text-sm font-bold text-on-surface transition-colors group-hover:text-on-primary">
                                {{ $eventType['label'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-background py-24" id="jugueteria">
        <div class="mx-auto grid max-w-7xl gap-12 px-6 lg:grid-cols-[0.9fr_1.1fr] lg:px-8">
            <div class="overflow-hidden rounded-[2rem] border border-border bg-surface shadow-card">
                <div class="relative aspect-square overflow-hidden border-b border-border bg-surface-alt">
                    <img alt="Luces de bengala premium"
                        class="h-full w-full object-cover transition duration-700 hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIyKM8tnpOD_-gqfOwQ5OrsdR4wrqej-u9y7In3K9wnx3bhuF0xJ8XIYikLEsON144GaoGUC7OTJp6uMdauB3pd-xo8KZU0Gbj1HdAfg8cE15U49sG8IWLfz6wziGOw1V-XklaknhcSHAKum-FvaxwSeSW-yMCiPRT3Ja_9dXc-HxlsL6OAdq359vGHuflbd6dcO6VaNup25a6ef0EcWu4cLupFIq-Frmy4O_5gnn5uHNdRdZRDkdJw9UUMHzfCbtuGwRXrInVY30" />
                    <div
                        class="absolute left-6 top-6 rounded-full bg-warning px-4 py-2 text-xs font-bold uppercase tracking-[0.24em] text-on-warning">
                        Producto Destacado
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="font-heading text-3xl font-bold text-on-surface">Luces de Bengala Premium</h3>
                    <p class="mt-4 text-base leading-relaxed text-muted">Efecto dorado de larga duración para entradas,
                        brindis, sesiones y momentos protocolarios.</p>
                    <a class="mt-6 inline-flex items-center gap-2 rounded-full bg-secondary px-6 py-3 text-sm font-bold text-on-secondary transition hover:bg-secondary-600"
                        href="#cta-final">
                        <span class="material-symbols-outlined text-base">shopping_bag</span>
                        Consultar disponibilidad
                    </a>
                </div>
            </div>

            <div class="space-y-8">
                <div>
                    <span class="text-sm font-bold uppercase tracking-[0.32em] text-accent">Juguetería
                        Pirotécnica</span>
                    <h2 class="mt-4 font-heading text-4xl font-bold tracking-tight text-on-background md:text-5xl">
                        Luz y diversión segura para complementar tu celebración.
                    </h2>
                    <p class="mt-5 max-w-2xl text-lg leading-relaxed text-muted">
                        Además de espectáculos completos, trabajamos artículos pirotécnicos para momentos puntuales del
                        evento y venta especializada.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-border bg-surface p-6 shadow-soft">
                        <span class="material-symbols-outlined text-3xl text-accent">auto_awesome</span>
                        <h4 class="mt-4 text-lg font-bold text-on-surface">Momentos de foto</h4>
                        <p class="mt-3 text-sm leading-relaxed text-muted">Bengalas, chisperos y efectos de apoyo para
                            entrada, vals y brindis.</p>
                    </div>
                    <div class="rounded-3xl border border-border bg-surface p-6 shadow-soft">
                        <span class="material-symbols-outlined text-3xl text-warning">inventory</span>
                        <h4 class="mt-4 text-lg font-bold text-on-surface">Catálogo especializado</h4>
                        <p class="mt-3 text-sm leading-relaxed text-muted">Disponibilidad controlada y selección por
                            tipo de
                            uso, duración e intensidad.</p>
                    </div>
                </div>

                <a class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-[0.22em] text-primary transition hover:text-primary-700"
                    href="#cta-final">
                    Ver catálogo completo
                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

    <section class="border-y border-border bg-surface py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-5">
                @foreach ($benefits as $benefit)
                    @php
                        $toneClasses = match ($benefit['tone']) {
                            'secondary' => 'bg-secondary/15 text-secondary',
                            'warning' => 'bg-warning/20 text-warning-700',
                            'accent' => 'bg-accent/15 text-accent',
                            default => 'bg-primary/15 text-primary',
                        };
                    @endphp
                    <article class="rounded-3xl border border-border bg-surface-alt p-6 shadow-soft">
                        <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl {{ $toneClasses }}">
                            <span class="material-symbols-outlined text-3xl">{{ $benefit['icon'] }}</span>
                        </div>
                        <h3 class="mt-5 text-lg font-bold text-on-surface">{{ $benefit['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-muted">{{ $benefit['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-primary-900 py-24 text-on-primary">
        <div class="mx-auto max-w-[1600px] px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span class="text-sm font-bold uppercase tracking-[0.32em] text-secondary">Galería</span>
                <h2 class="mt-4 font-heading text-4xl font-bold tracking-tight md:text-5xl">
                    Momentos de <span class="text-warning">gloria</span>
                </h2>
            </div>

            <div class="mt-14 grid h-[520px] grid-cols-2 gap-4 sm:h-[680px] md:grid-cols-4 xl:h-[800px]">
                <div class="col-span-2 row-span-2 overflow-hidden rounded-[2rem]">
                    <img alt="Final épico de espectáculo pirotécnico"
                        class="h-full w-full object-cover transition duration-1000 hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqe40fTyi7lEUEIJVcKpWa2_Lw30bRvmI1-ET8rqc1F2qXXf-JKyhbHXnXThGkLsMTXJBb9VHs1eUOg3O1rm1z_1dv2P8f0aLfKCTXlObXbOufcgg-4lApnZNoYbfiEZHqnoWxo53f8V2ui87hAJJgok7P1olxCEWSFVlU39z6pXOTOM8JIm7712r4yGuXE6CtGXandGA9W4HqkKzkmu0yngqwufSbKV6JPeeV1IvU2p-XuJv2bWWzVJZh_LgRdisQIzahKySo3Mk" />
                </div>
                <div class="overflow-hidden rounded-[2rem]">
                    <img alt="Bengalas en una boda"
                        class="h-full w-full object-cover transition duration-1000 hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxvMnOgNGhll-gHhXsfrgwYduyufNKsnFj-JYYOUB278p3szgfL459fD8B7ki3aYc-ZMYWGFYBeELdswHADAK7_yCz2gd9jQyQZENZGpP1rin-pP05ZKuEiufUc6ZvRuxxEntKLogcZ4wzxE_1kxbmTvlw0F5V-931LHTMftYQBWtttzzdWd6r1sugLyqgpnvXkobDZVJsodCGOaRTMOZcylSW005S89X1MrD2geqO0M559wWthdZHhc6MM1yivzpf-EWidR2udvE" />
                </div>
                <div class="row-span-2 overflow-hidden rounded-[2rem]">
                    <img alt="Pirotecnia para concierto"
                        class="h-full w-full object-cover transition duration-1000 hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDEb_QxRoellb2kUZ9U_88Uq1aaVdJgCuydZwxwnYyUprESNtEJSAWTdCk6DqXSPl1pCFtPLbqQyOY0YsqfCLPmnMFzJWNwqJ9y_v1FnwqLnWBda22mhs03Au5LQBD3jXBSByXmVwTaVDoAvSOivQ9HpAVZOmHVBAf5V-rakdt_6ByW_Ooz_E6pAs43K4Y6EJzAuV1pLm2bFCOGjxjLimAtK0JlPmAxN-B-j5Lip8XaizrMR7bM3tjyvEI4Ig6S70rWbEEFaQ5romM" />
                </div>
                <div class="overflow-hidden rounded-[2rem]">
                    <img alt="Cascada pirotécnica"
                        class="h-full w-full object-cover transition duration-1000 hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCt6NbjHi0bk-SjX3PJCzwhW1jJj9ISp4E7AKgBBSOV-aMQLaQ9GkpZ6Z1BSRZeBOEFMClICDzYpd9jPHE6_3_Vivs7WN7Hm6Y-5gjgKhqSfoyQ26rX3Aeexaek1YuXbCOHPJMZSejS-f4ee9yKKlcEPu5nsc990nJasMMNQF7a2eAKM5qHGV9_aTJagamfYk1NpOpDtUhNAt00L-C91pItbi4tv9Nd7JBasb9Wk_6aHduaiHhntNf5CwWiPbYIEzAlEsGnxAjyXJM" />
                </div>
            </div>
        </div>
    </section>

    <section class="bg-background py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ($testimonials as $testimonial)
                    <article
                        class="flex h-full flex-col justify-between rounded-[2rem] border border-border bg-surface p-8 shadow-card">
                        <p class="text-lg italic leading-relaxed text-muted">"{{ $testimonial['quote'] }}"</p>
                        <div class="mt-8 flex items-center gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/15 font-bold text-primary">
                                {{ $testimonial['initials'] }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-on-surface">{{ $testimonial['name'] }}</p>
                                <p class="text-[11px] font-bold uppercase tracking-[0.26em] text-secondary">
                                    {{ $testimonial['role'] }}
                                </p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="border-y border-border bg-surface-alt py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span class="text-sm font-bold uppercase tracking-[0.32em] text-primary">Disponibilidad</span>
                <h2 class="mt-4 font-heading text-4xl font-bold tracking-tight text-on-background md:text-5xl">
                    Consulta fechas y planea tu evento con anticipación.
                </h2>
                <p class="mt-5 text-lg leading-relaxed text-muted">
                    Visualiza la disponibilidad del calendario y asegura tu fecha antes de pasar a producción.
                </p>
            </div>

            <div class="mt-14 grid gap-10 lg:grid-cols-3">
                <div class="space-y-6">
                    <div class="rounded-[2rem] border border-border bg-surface p-8 shadow-card">
                        <p class="text-xs font-bold uppercase tracking-[0.32em] text-primary">Semáforo de
                            Disponibilidad</p>
                        <div class="mt-8 space-y-5">
                            <div class="flex items-center gap-3">
                                <div class="h-4 w-4 rounded-full bg-accent"></div>
                                <span class="text-sm text-muted">Disponible</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="h-4 w-4 rounded-full bg-warning"></div>
                                <span class="text-sm text-muted">Disponibilidad limitada</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="h-4 w-4 rounded-full bg-secondary"></div>
                                <span class="text-sm text-muted">Alta demanda</span>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[2rem] border border-border bg-primary-900 p-8 text-on-primary shadow-card">
                        <p class="text-xs font-bold uppercase tracking-[0.32em] text-primary-200">Proceso</p>
                        <p class="mt-4 text-base leading-relaxed text-primary-100">
                            Elegimos la fecha, definimos la propuesta visual y apartamos el inventario necesario para tu
                            evento.
                        </p>
                    </div>
                </div>

                <livewire:calendar />
            </div>
        </div>
    </section>

    <section class="bg-background py-24" id="cta-final">
        <div class="mx-auto max-w-5xl px-6 lg:px-8">
            <div
                class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-primary to-primary-700 px-8 py-16 text-center text-on-primary shadow-card md:px-16">
                <div class="absolute -right-10 top-0 h-48 w-48 rounded-full bg-secondary/20 blur-3xl"></div>
                <div class="absolute -left-10 bottom-0 h-48 w-48 rounded-full bg-accent/20 blur-3xl"></div>
                <div class="relative">
                    <span class="text-sm font-bold uppercase tracking-[0.32em] text-primary-100">Cotización
                        Directa</span>
                    <h2 class="mt-4 font-heading text-4xl font-bold tracking-tight md:text-6xl">
                        Haz de tu evento un momento inolvidable.
                    </h2>
                    <p class="mx-auto mt-5 max-w-2xl text-lg leading-relaxed text-primary-100">
                        Estamos listos para diseñar una propuesta ajustada al tipo de evento, sede, aforo y presupuesto.
                    </p>
                    <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                        <a class="inline-flex items-center gap-3 rounded-full bg-secondary px-8 py-4 text-sm font-bold text-on-secondary transition hover:bg-secondary-600"
                            href="#contacto">
                            <span class="material-symbols-outlined text-base">chat</span>
                            WhatsApp Directo
                        </a>
                        <a class="inline-flex items-center gap-3 rounded-full border border-on-primary/20 bg-on-primary/10 px-8 py-4 text-sm font-bold text-on-primary transition hover:bg-on-primary/15"
                            href="#contacto">
                            <span class="material-symbols-outlined text-base">request_quote</span>
                            Solicitar cotización
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-surface py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-6 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
            <div class="space-y-8">
                <div>
                    <span class="text-sm font-bold uppercase tracking-[0.32em] text-secondary">Ubicación</span>
                    <h2 class="mt-4 font-heading text-4xl font-bold tracking-tight text-on-surface md:text-5xl">
                        Nuestra base operativa.
                    </h2>
                    <p class="mt-5 text-lg leading-relaxed text-muted">
                        Visítanos para conocer el catálogo, revisar alternativas de espectáculo y definir la logística
                        de tu evento.
                    </p>
                </div>

                <div class="space-y-5">
                    <div class="flex items-start gap-4 rounded-3xl border border-border bg-surface-alt p-5">
                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-secondary text-on-secondary">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-on-surface">Dirección</h3>
                            <p class="mt-2 text-sm leading-relaxed text-muted">Calzada de la Luz #450, Col. San Juan
                                Tlihuaca, Azcapotzalco, Ciudad de México, CP 02400.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 rounded-3xl border border-border bg-surface-alt p-5">
                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-accent text-on-accent">
                            <span class="material-symbols-outlined">schedule</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-on-surface">Horario de Atención</h3>
                            <p class="mt-2 text-sm leading-relaxed text-muted">Lunes a Viernes: 9:00 AM - 7:00 PM</p>
                            <p class="text-sm leading-relaxed text-muted">Sábados: 10:00 AM - 3:00 PM</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 rounded-3xl border border-border bg-surface-alt p-5">
                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-warning text-on-warning">
                            <span class="material-symbols-outlined">local_parking</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-on-surface">Estacionamiento</h3>
                            <p class="mt-2 text-sm leading-relaxed text-muted">Contamos con estacionamiento privado y
                                gratuito para clientes durante su visita.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative overflow-hidden rounded-[2rem] border border-border bg-primary-900 shadow-card">
                <img alt="Mapa de ubicación" class="h-[320px] w-full object-cover opacity-30 map-grayscale sm:h-[400px] lg:h-[460px]"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqe40fTyi7lEUEIJVcKpWa2_Lw30bRvmI1-ET8rqc1F2qXXf-JKyhbHXnXThGkLsMTXJBb9VHs1eUOg3O1rm1z_1dv2P8f0aLfKCTXlObXbOufcgg-4lApnZNoYbfiEZHqnoWxo53f8V2ui87hAJJgok7P1olxCEWSFVlU39z6pXOTOM8JIm7712r4yGuXE6CtGXandGA9W4HqkKzkmu0yngqwufSbKV6JPeeV1IvU2p-XuJv2bWWzVJZh_LgRdisQIzahKySo3Mk" />
                <div
                    class="absolute inset-0 flex items-center justify-center bg-gradient-to-b from-primary-900/40 to-primary-900/70">
                    <div class="text-center">
                        <div
                            class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-warning text-on-warning shadow-card">
                            <span class="material-symbols-outlined text-4xl"
                                style="font-variation-settings: 'FILL' 1;">
                                location_on
                            </span>
                        </div>
                        <div class="mt-5 rounded-2xl bg-on-primary/10 px-6 py-3 backdrop-blur-sm">
                            <p class="text-sm font-bold uppercase tracking-[0.24em] text-primary-200">San Rafael HQ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-background py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span class="text-sm font-bold uppercase tracking-[0.32em] text-primary">Colaboradores</span>
                <h2 class="mt-4 font-heading text-4xl font-bold tracking-tight text-on-background md:text-5xl">
                    Alianzas que fortalecen cada montaje.
                </h2>
                <p class="mx-auto mt-5 max-w-2xl text-lg leading-relaxed text-muted">
                    Trabajamos con recintos, proveedores y operadores que elevan la calidad de cada producción.
                </p>
            </div>

            <div class="mt-14 grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-6">
                @foreach ($collaborators as $icon)
                    <div
                        class="group flex items-center justify-center rounded-3xl border border-border bg-surface p-8 shadow-soft transition duration-300 hover:-translate-y-1 hover:border-primary hover:bg-primary hover:text-on-primary">
                        <span
                            class="material-symbols-outlined text-5xl text-muted transition-colors group-hover:text-on-primary">
                            {{ $icon }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-primary-900 pb-12 pt-20 text-primary-200" id="contacto">
        <div class="mx-auto grid max-w-7xl gap-12 px-6 text-sm md:grid-cols-4 lg:px-8">
            <div class="md:col-span-2">
                <div class="font-display text-3xl uppercase tracking-[0.14em] text-on-primary">Pirotecnia San Rafael
                </div>
                <p class="mt-6 max-w-md leading-loose text-primary-200">
                    Expertos en diseño y ejecución de espectáculos pirotécnicos de alto impacto. Convertimos el cielo en
                    una experiencia visual pensada para venderse bien y recordarse mejor.
                </p>
                <div class="mt-8 flex gap-4">
                    <a class="flex h-11 w-11 items-center justify-center rounded-full border border-primary-700 text-primary-200 transition hover:border-secondary hover:text-on-primary"
                        href="#">
                        <span class="material-symbols-outlined text-lg">public</span>
                    </a>
                    <a class="flex h-11 w-11 items-center justify-center rounded-full border border-primary-700 text-primary-200 transition hover:border-secondary hover:text-on-primary"
                        href="#">
                        <span class="material-symbols-outlined text-lg">share</span>
                    </a>
                    <a class="flex h-11 w-11 items-center justify-center rounded-full border border-primary-700 text-primary-200 transition hover:border-secondary hover:text-on-primary"
                        href="#">
                        <span class="material-symbols-outlined text-lg">camera</span>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-xs font-bold uppercase tracking-[0.32em] text-on-primary">Legal</h3>
                <ul class="mt-8 space-y-4">
                    <li><a class="transition-colors hover:text-secondary" href="#">Política de Privacidad</a>
                    </li>
                    <li><a class="transition-colors hover:text-secondary" href="#">Protocolos de Seguridad</a>
                    </li>
                    <li><a class="transition-colors hover:text-secondary" href="#">Términos de Envío</a></li>
                    <li><a class="transition-colors hover:text-secondary" href="#">Aviso Legal</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-xs font-bold uppercase tracking-[0.32em] text-on-primary">Contacto</h3>
                <ul class="mt-8 space-y-4">
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary">call</span>
                        +52 (55) 5000-0000
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary">location_on</span>
                        Ciudad de México, México
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary">mail</span>
                        contacto@sanrafael.com
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="mx-auto mt-16 max-w-7xl border-t border-primary-700/60 px-6 pt-8 text-center text-xs text-primary-300 lg:px-8">
            © 2026 Pirotecnia San Rafael. Todos los derechos reservados.
        </div>
    </footer>

    @livewireScriptConfig
</body>

</html>
