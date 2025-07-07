<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="ALL" />
    <meta property="og:title" content="{{ isset($seo['title']) ? $seo['title'] : '' }}" />
    <meta property="og:description" content="{{ isset($seo['description']) ? $seo['description'] : '' }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="description" content="{{ $seo['description'] ?? '' }}" />
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="600">
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
    <meta property="og:site_name" content="{{ isset($seo['title']) ? $seo['title'] : '' }}" />

    @if (!empty($seo['keywords']))
        <meta name="keywords"
            content="{{ (json_decode($seo['keywords']) ? implode(',', json_decode($seo['keywords'], true)) : $seo['keywords']) ?? '' }}" />
    @endif
    @if (!empty($seo['canonical']))
        <link rel="canonical" href="{{ $seo['canonical'] ?? '' }}" />
    @endif

    @if (!empty($general['favicon']))
        <link rel="icon" href="storage/{{ $general['favicon'] }}">
    @endif

    @if (isset($seo['seo_img']))
        <meta property="og:image" content="{{ resize('storage/' . $seo['seo_img'], 512) }}" />
    @endif

    <base href="{{ url('') }}" />

    <title>{{ isset($seo['title']) ? $seo['title'] : '' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="assets/site/css/vendor.css?v=<?= filemtime('assets/site/css/vendor.css') ?>" rel="stylesheet">
    <link href="assets/site/css/main.css?v=<?= filemtime('assets/site/css/main.css') ?>" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Onest:wght@100..900&display=swap"
        rel="stylesheet">

    @yield('css')

    {!! $general['script_head'] !!}

</head>

<body>

    {!! $general['script_body'] !!}

    @yield('content')

    @if (session()->has('user') && session('user'))
        <div class="cms-bar">
            <div class="cms-bar__row">
                <div class="text">
                    Deseja continuar editando o conteúdo do site?
                </div>
                <div class="button">
                    <a href="{{ session()->has('_previous') && strpos(session('_previous')['url'], 'gerenciador') !== false ? session('_previous')['url'] : route('admin.dashboard') }}"
                        class="btn">
                        VOLTAR PARA A EDIÇÃO
                    </a>
                </div>
            </div>
        </div>
    @endif

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="assets/site/js/vendor.js?v=<?= filemtime('assets/site/js/vendor.js') ?>"></script>
    <script src="assets/site/js/main.js?v=<?= filemtime('assets/site/js/main.js') ?>" type="module"></script>
    <script src="assets/site/js/services/appUserService.js?v=<?= filemtime('assets/site/js/services/appUserService.js') ?>"
        type="module"></script>

    </script>

    @yield('js')

    {!! $general['script_footer'] !!}

</body>

</html>
