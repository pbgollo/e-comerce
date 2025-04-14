@extends('admin.master.admin')

@section('layout')
    @include('admin.components.sidebar')
    @include('admin.components.dynamics-sidebar')

    <div class="main-content" id="panel">

        @yield('content')

    </div>
@endsection
