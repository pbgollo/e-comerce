<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <base href="{{ url('') }}" />



    <title>{{ isset($title) ? $title . ' | ' : '' }}NOMAD</title>


    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <!-- Favicon -->
    <link href="{{ asset('assets/admin/images/favicon.png') }}" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Argon CSS -->
    <link type="text/css" href="assets/admin/css/vendor.css?v=<?= filemtime('assets/admin/css/vendor.css') ?>"
        rel="stylesheet">

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- Jquery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"
        integrity="sha512-XLo6bQe08irJObCc86rFEKQdcFYbGGIHVXcfMsxpbvF8ompmd1SNJjqVY5hmjQ01Ts0UmmSQGfqpt3fGjm6pGA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

    <!-- Fancybox -->
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <!-- CSS -->
    <link type="text/css" href="assets/admin/css/all.css?v=<?= filemtime('assets/admin/css/all.css') ?>"
        rel="stylesheet">

    <!-- translation view -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/css/jqueryui-editable.css"
        rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/js/jqueryui-editable.min.js"></script>

</head>
{{-- @dd($appearance) --}}
@if (!is_null($appearance))
    <style>
        :root {
            --primary-color: {{ $appearance['background_color_page'] }};
            --btn-save-color: {{ $appearance['btn_color_save'] }};
            --btn-view-color: {{ $appearance['btn_color_view'] }};
            --btn-delete-color: {{ $appearance['btn_color_delete'] }};
            --checkbox-color: {{ $appearance['checkbox_color'] }};
        }
    </style>
@endif

<body>

    <button class="btn-baixar" style="position: absolute; left:0; top:50vh; z-index:999; display:none">BAIXAR
        APP</button>



    @yield('layout')

    @stack('js')
    <script src="assets/admin/js/vendor.js?v=<?= filemtime('assets/admin/js/vendor.js') ?>"></script>
    <script src="assets/admin/js/all.js?v=<?= filemtime('assets/admin/js/all.js') ?>"></script>

</body>

</html>
