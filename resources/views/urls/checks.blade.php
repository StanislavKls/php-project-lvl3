@extends('layouts.app')

@section('title', 'Проверка')

@section('content')
<div class="starter-template text-center py-5 px-3">
<h1 class="mt-5 mb-3"> Сайт {{ $url->name }}</h1> 
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-wrap">
        <tr>
            <td><h6> ID </h6></td>
            <td>{{ $check->id }}</td>
        </tr>
        <tr>
            <td><h6> Код ответа </h6></td>
            <td>{{ $check->status_code }}</td>
        </tr>
        <tr>
            <td><h6> h1 </h6></td>
            <td>{{ $check->h1 }}</td>
        </tr>
        <tr>
            <td><h6> keywords </h6></td>
            <td>{{ $check->keywords }}</td>
        </tr>
        <tr>
            <td><h6> description </h6></td>
            <td>{{ $check->description }}</td>
        </tr>
        <tr>
            <td><h6> Дата создания </h6></td>
            <td>{{ $check->created_at }}</td>
        </tr>
        </table>
    </div>
</div>
@endsection