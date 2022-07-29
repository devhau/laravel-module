@extends('test334::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('test334.name') !!}
    </p>
@endsection
