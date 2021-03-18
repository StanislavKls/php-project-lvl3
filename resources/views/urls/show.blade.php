@extends('layouts.app')

@section('title', 'Адрес')

@section('content')
<div class="container-lg">

    <h1 class="mt-5 mb-3"> Сайт {{ $url->name }}</h1>
    <div class="table-responsive">
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
    <h2 class="mt-5 mb-3">Проверки</h2>  
    {{Form::open(['url' => route('urls.checks', $url->id), 'method' => 'POST'])}}
    {{Form::submit('Проверить')}}
    {{Form::close()}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-nowrap">
                <tr>
                    <th>ID</th>
                    <th>Код ответа</th>
                    <th>h1</th>
                    <th>keywords</th>
                    <th>description</th>
                    <th>Дата создания</th>
                </tr>
                @foreach($urlInfo as $info)
                <tr>
                        <td>{{ $info->id }}</td>
                        <td>{{ $info->status_code }}</td>
                        <td>{{ $info->h1 }}</td>
                        <td>{{ Str::limit($info->keywords, 50) }}</td>
                        <td>{{ Str::limit($info->description, 50) }}</td>
                        <td>{{ $info->created_at }}</td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection