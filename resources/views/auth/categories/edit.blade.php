@extends('auth.layout.master')

@isset($category)
    @section('title', 'Редактировать категорию ' . $category->name)
@endisset

@section('content')
    @if(isset($category))
    <div class="col-md-12">
            <h3>Редактировать категорию: <b>{{ $category->name }}</b></h3>

        <form method="POST" enctype="multipart/form-data" action="{{ route('categories.update', $category) }}">

            <div>
                @isset($category)
                    @method('PUT')
                @endisset
                @csrf
                    <div class="form-group">
                        <div>
                            <label for="code">Код: </label>
                            <input type="text" class="form-control" name="code" id="code" value="{{ old('code', $category->code) }}">
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
                            <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <div>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="description" >Описание: </label>
                            <textarea name="description" class="form-control" id="description" cols="72" rows="7">{{ $category->description }}</textarea>
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="image">Загрузить картинку: </label>
                        <input type="file" class="form-control-file"  name="image" id="image">
                    </div>


                <button class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
    @endif
@endsection

