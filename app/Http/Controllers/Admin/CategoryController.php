<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::get();
        return view('auth.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('auth.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, Category $category)
    {
        $data=$request->all();

        //Присваивание значения поля code если пустое
        if (empty($data['code'])) {
            $data['code'] = Str::slug($data['name'], '-');
        }

        if ($request->has('image')){
            //получение пути к файлу и store сохранение в папку
            $path=$request->file('image')->store('categories');
            //переназначение пути
            $data['image']=$path;
        }

        $save=$category->create($data);
        if ($save){
            session()->flash('success', "Успешно сохранено");
            return redirect()->route('categories.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::find($id);
        return view('auth.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::find($id);

        return view('auth.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        //Валидация в соответствующем Request

        //получаем данные из формы
        $data=$request->all();

        //Присваивание значения поля code если пустое
        if (empty($data['code'])){
            $data['code']= Str::slug($data['name'], '-');
        }


        //if request has image
        if($request->has('image')){
            //удаляем старое изображение
            Storage::delete($category->image);
            //получение пути к файлу и store сохранение в папку
            $path=$request->file('image')->store('categories');
            //переназначение пути
            $data['image']=$path;
        }


        $success=$category->update($data);
        if ($success){
            session()->flash('success', "Успешно изменено");
            return redirect()->route('categories.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return back();
    }
}
