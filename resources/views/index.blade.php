@extends('layouts.app')

@section('title', 'Главная')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger" role="alert">
    <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (isset($flash))
        <div class="alert alert-danger" role="alert">
            {{ $flash }}
        </div>
@endif

<p class="lead">Page Analyzer – сайт, который анализирует указанные страницы на SEO пригодность.</p>
<div class="starter-template text-center py-5 px-3">
<h4> Введите адрес </h4>
{{Form::open(['url' => route('urls.store'), 'method' => 'POST'])}}
    {{Form::url('url[name]')}}
    {{Form::submit('Добавить')}}
{{Form::close()}}
</div>
@endsection
