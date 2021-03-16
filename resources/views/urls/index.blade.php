@extends('layouts.app')

@section('title', 'Список адресов')

@section('content')
<div class="starter-template text-center py-5 px-3">
        
    @if (isset($flash) and $flash === 'URL добавлен!')
        <div class="alert alert-success" role="alert">
            {{ $flash }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-nowrap">
        <tr>
            <th>ID</th>
            <th>Имя</th>
        </tr>
    @foreach ($urls as $url)
    <tr>
        <td>{{ $url->id }}</td>
        <td><a href="{{ route('urls.show', $url->id) }}"> {{ $url->name }} </a></td>
    </tr>
    @endforeach
        </table>
    </div>
</div>
@endsection