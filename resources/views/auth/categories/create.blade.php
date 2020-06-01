@extends('auth.layout.master')

@section('title', 'Создать категорию')

@section('content')
    <div class="col-md-12">
            <h1>Добавить Категорию</h1>
        <br>

        <form method="POST" enctype="multipart/form-data" action="{{ route('categories.store') }}">
            <div>
                @csrf
                <div class="form-group">
                    <div>
                        <label for="code">Код: </label>
                        <input type="text" class="form-control" name="code" id="code" value="{{ old('code') }}">
                        @error('code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <div>
                        @error('name')
                             <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="name" >Название: </label>
                        <input type="text" class="form-control" name="name" id="name" value="">
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <div>
                        @error('description')
                             <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="description" >Описание: </label>
                        <textarea name="description" class="form-control" id="description" cols="72" rows="7"> </textarea>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label for="image">Загрузить картинку: </label>
                    <input type="file" class="form-control-file"  name="image" id="image">
                </div>

                <button class="btn btn-primary">Сохранить</button>
                <br>
            </div>
        </form>

    </div>
@endsection


