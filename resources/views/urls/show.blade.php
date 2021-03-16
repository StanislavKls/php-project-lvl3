@extends('layouts.app')

@section('title', 'Адрес')

@section('content')
<div class="starter-template text-center py-5 px-3">
<div class="table-responsive">
    <h4>Сайт {{ $url->name }}</h4>
        <table class="table table-bordered table-hover text-nowrap">
        <tr>
            <td>ID</td>
            <td>{{ $url->id }}</td>
            
        </tr>
        <tr>
            <td>Имя</td>
            <td>{{ $url->name }}</td>
        </tr>
        <tr>
            <td>Дата создания</td>
            <td>{{ $url->created_at }}</td>
        </tr>
        <tr>
            <td>Дата обновления</td>
            <td>{{ $url->updated_at }}</td>
        </tr>
        </table>
    </div>
</div>
@endsection