@extends('layouts.app')

@section('content')

@include('Partials.navbar')

 <div class="container mt-5">
    <h1 class="py-5">{{ $episode->title }}</h1>
    @include($playerTemplate)
    <a class="btn btn-info" href="{{ url('/series/' .$episode->serie_id) }}" >กลับ</a><a class="btn btn-info" href="{{ url('/series/' .$episode->serie_id) }}" >แก้ไข</a><a class="btn btn-info" href="{{ url('/series/' .$episode->serie_id) }}" >Delete</a>
    </div>
    @endsection