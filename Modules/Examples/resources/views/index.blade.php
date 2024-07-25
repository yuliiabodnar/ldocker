@extends('examples::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('examples.name') !!}</p>
@endsection
