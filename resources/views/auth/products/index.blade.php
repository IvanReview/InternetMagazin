@extends('auth.layout.master')

@section('title', 'Товары')

@section('content')
    <div class="col-md-12">
        <h1 style="text-align:center;">Товары</h1>
        <br>
        <a class="btn btn-primary" type="button" href="{{ route('products.create') }}">Добавить товар</a>

        <table class="table" style="margin-top: 40px">
            <tbody>
            <tr>
                <th>#</th>
                <th>Код</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Кол-во</th>
                <th>Действия</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id}}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }} Руб.</td>
                    <td>{{ $product->count }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                                <a class="btn btn-success" type="button"
                                   href="{{ route('products.show', $product) }}">Открыть</a>
                                <a class="btn btn-info" type="button"
                                   href="{{ route('products.edit', $product) }}">Редактировать</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Удалить"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$products->links()}}
    </div>
@endsection
