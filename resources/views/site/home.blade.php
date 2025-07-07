@extends('site.master.page')

@section('js')
    <script src="{{ asset(mix('/assets/site/js/pages/home.js')) }}"></script>
@endsection

@section('css')
@endsection

@section('content')
    <section id="home" class="home">
        <div class = "home__topcarousel">
            @include ('site.components.homebanner')
        </div>
        <div class = "home__listing">
            <div class = "home__listing__label">
                <h1>Mega Julho</h1>
            </div>
            <div class = "home__listing__items">
                @include ('site.components.product', [$products])
            </div>
        </div>
    </section>
@endsection
