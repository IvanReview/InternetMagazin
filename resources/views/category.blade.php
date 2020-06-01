@extends('layouts.master')
@section('title', 'Категория: '.$category->name)
@section('content')
        <h1>{{$category->name}}</h1>
        <h3>Количество товаров - {{$category->products->count()}}</h3>
        <p>
            {{$category->description}}
        </p>
        <div class="row">
            @foreach($category->products as $product)
                @include('card', compact('product'))
            @endforeach
        </div>
@endsection
