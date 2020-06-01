@extends('layouts.master')
@section('title', 'Все категории')
@section('content')

        @foreach($categories as $category)
            <div class="panel" ">
                <a href="{{route('category', $category->code)}}">
                    <img src="{{Storage::url($category->image)}}" style="width: 200px">
                    <h2 style="color: #000">{{$category->name}}</h2>
                </a>
                <p style="color: #606f7b ">{{$category->description}}</p>
            </div>
        @endforeach

@endsection
