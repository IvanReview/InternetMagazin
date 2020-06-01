@extends('auth.layout.master')

@section('title', 'Создать товар')

@section('content')
    <div class="col-md-12">
            <h1>Добавить товар</h1>
        <form method="POST" enctype="multipart/form-data" action="{{ route('products.store') }}">
            <div>
                @csrf
                <div class="form-group  row">
                    <label for="code" class="col-sm-2 col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @include('auth.layout.error', ['fieldName' => 'code'])
                        <input type="text" class="form-control" name="code" id="code" value="">
                    </div>
                </div>

                <br>

                <div class="form-group  row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @include('auth.layout.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name" value="">
                    </div>
                </div>

                    <br>

                <div class="form-group  row">
                    <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                    <div class="col-sm-6">
                        @include('auth.layout.error', ['fieldName' => 'category_id'])
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <br>

                <div class="form-group  row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        @include('auth.layout.error', ['fieldName' => 'description'])
                        <textarea name="description" id="description" cols="72" rows="7"></textarea>
                    </div>
                </div>

                <br>


                <div class="form-group  row">
                    <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label class="btn btn-warning btn-file">
                            Загрузить <input type="file" style="display: none;" name="image" id="image">
                        </label>
                    </div>
                </div>
                <br>

                <div class="form-group  row">
                    <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                    <div class="col-sm-2">
                        @include('auth.layout.error', ['fieldName' => 'price'])
                        <input type="text" class="form-control" name="price" id="price" value="">
                    </div>
                </div>
                <br>

               {{-- <div class="form-group row">
                    <label for="count" class="col-sm-2 col-form-label">Кол-во: </label>
                    <div class="col-sm-2">
                        @include('auth.layout.error', ['fieldName' => 'count'])
                        <input type="text" class="form-control" name="count" id="count" value="">
                    </div>
                </div>--}}
                <br>
                @foreach ([
                'hit' => 'Хит',
                'new' => 'Новинка',
                'recommend' => 'Рекомендуемые'
                ] as $field => $title)
                    <div class="form-group row">
                        <label for="code" class="col-sm-2 col-form-label">{{ $title }}: </label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="{{$field}}" id="{{$field}}">
                        </div>
                    </div>
                    <br>
                @endforeach
                <button class="btn btn-primary">Сохранить</button>
            </div>
            <br>
        </form>
        <br>
    </div>
@endsection
