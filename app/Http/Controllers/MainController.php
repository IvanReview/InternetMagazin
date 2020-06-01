<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index(ProductsFilterRequest $request)
    {
        $productsQuery = Product::query();// возвращается объект билдера  к которому можно применить условия для поиска и уже потом метод пагинейт
        //фильтр товаров по цене
        if ($request->filled('price_from')){//filled проверяет является ли данное поле заполненым
            $productsQuery->where('price','>=', $request->price_from);
        }
        if ($request->filled('price_to')){//filled проверяет является ли данное поле заполненым
            $productsQuery->where('price','<=', $request->price_to);
        }

        foreach (['hit', 'new', 'recommend'] as $fieldName) {
            if ($request->has($fieldName)) {
                $productsQuery->where($fieldName, 1);
            }
        }
        //withPath позволяет настроить URI для вывода ссылок(добавляеет данные), чтобы при паринации не терялись гет параметры
        $products=$productsQuery->paginate(6)->withPath('?' . $request->getQueryString());
        return view('index', compact('products'));
    }


    //отображение всех категория
    public function categories()
    {
        $categories=Category::get();
        return view('categories', compact('categories'));
    }


    //отображение 1 категории вместе с продуктами
    public function category($categoryCode){
       $category=Category::where('code', $categoryCode)->with('products')->first();

        return view('category', compact('category'));
    }


    //отображение 1 продукта
    public function product($categories, $product=null)//если параметр не обязателен нужно давать дефольное значение
    {
        return view('product' , compact('product'));
    }
}
