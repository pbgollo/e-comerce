@extends("site.master.layout")

@section("content")

    @include("site.sections.header")

    @yield("content")

    @include("site.sections.footer")

@overwrite
