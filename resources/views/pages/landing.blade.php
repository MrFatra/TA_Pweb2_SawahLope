@extends('layouts.app')


@section('content')
<div class="flex flex-col gap-10">
    @include('sections.hero')
    @include('sections.layanan')
    @include('sections.infografis')
    @include('sections.makanan')
    @include('sections.list-artikel')
    @include('sections.quotes')
    @include('sections.tiket')
</div>
@endsection