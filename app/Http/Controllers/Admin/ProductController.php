<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::paginate(10);
        return view('auth.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('auth.products.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {
        //Получаем данные из формы
        $data=$request->all();

        //если поле code не заполнено создаем автоматически
        if (empty($data['code'])) {
            $data['code'] = Str::slug($data['name'], '-');
        }

        //переопределение значения чекбокса с 'on' на 1 в мутаторе, который лежит в модели

        if ($request->has('image')){
        //получение пути к файлу и сохранение (store) в папку
        $path=$request->file('image')->store('products');
        //переназначение пути
        $data['image']=$path;
        }

        //создаем новую запись
        $success=Product::create($data);
        if ($success){
            session()->flash('success', 'Товар успешно создан!');
            return redirect()->route('products.index');
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('auth.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('auth.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsRequest $request, Product $product)
    {

        //получаем данные из формы
        $data=$request->all();
        //если code не заполнено создаем автоматически
        if (empty($data['code'])) {
            $data['code'] = Str::slug($data['name'], '-');
        }

        //переопределение значения чекбокса с 'on' на 1 в мутаторе, лежит в модели, если перемен не существует(чебокс не нажат) мутатор не срабатывает
        foreach (['new', 'hit','recommend'] as $fieldName){
            if (!isset($data[$fieldName])) {
                $data[$fieldName] = 0;
            }
        }


        if($request->has('image')){
            //удаляем старое изображение
            Storage::delete($product->image);
            //получение пути к файлу и store сохранение в папку
            $path=$request->file('image')->store('products');
            //переназначение пути
            $data['image']=$path;

        }

        //обновляеем данные
        $success=$product->update($data);
        if ($success){
            session()->flash('success', 'Товар успешно обновлен!');
            return redirect()->route('products.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
