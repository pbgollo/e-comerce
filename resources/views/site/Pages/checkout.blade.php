@extends('site.master.page')

@section('js')
    <script src="{{ asset(mix('/assets/site/js/pages/checkout.js')) }}"></script>
@endsection

@section('css')
@endsection

@section('content')
    <section class="checkout">
        <div class="checkout__container" id="checkoutContainer">
            {{-- A estrutura do conteúdo será injetada pelo JS --}}
        </div>
    </section>
@endsection
