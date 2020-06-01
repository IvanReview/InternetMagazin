<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        //чтобы нельзя было зайти в пустую корзину см. middleware BasketIsNotEmpty

        $orderId = session('orderId');
        //если сесстя не пуста берем заказ из таблицы
        if (!is_null($orderId)){
            $order=Order::findOrFail($orderId);
        }

        return view('basket', compact('order'));
    }


    //Вывод формы подтверждения заказа
    public function basketPlace()
    {
        $orderId = session('orderId');
        if (is_null($orderId)){
            return redirect()->route('index');
        } else{
            $order = Order::find($orderId);
        }

        return view('order', compact('order'));
    }

    //Отправка Формы Подтверждения заказа
    public function basketConfirm(Request $request)
    {
        $data=$request->all();
        $orderId = session('orderId');
        if (is_null($orderId)){
            return redirect()->route('index');
        } else{
            $order = Order::find($orderId); //находим модель заказа
            $success=$order->saveOrder($request->name, $request->phone);

            if ($success){
                session()->flash('success', 'Ваш заказ принят в обработку');
            }
            else{
                session()->flash('warning', 'Mistake!!');
            }
        }
        return redirect()->route('index');

    }


    //Добавление в корзину
    public function basketAdd($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)){
            //если сессия пустая добавляем запись в табл заказы(order) и запись в сессию
            $order=Order::create();
            session(['orderId'=>$order->id]);
        } else {
            //если в корзине есть продукты, выбирам объект модели(order) по id
            $order = Order::find($orderId);
        }
        //проверяем содержится ли данный продукт в корзине
        if($order->products->contains($productId)){
            //получаем доступ к промежуточной таблице и увеличивае столбец count
            $pivotRow =$order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();

        } else {
            $order->products()->attach($productId);//вставка записи в промежуточную таблицу (order_id есть, product_id передаем в attach)
        }

        //проверяем авторезирован ли пользователь и добавляем id в таблицу
        if (Auth::check()){
            $order->user_id = Auth::id();
            $order->save();
        }

        $product=Product::find($productId);
        session()->flash('success', 'Добавлен товар '.$product->name);
        return redirect()->route('basket');
    }


    //удаление записи
    public function basketRemove($productId)
    {
        //id заказа(orders) из сессии
        $orderId=session('orderId');

        if (is_null($orderId)){
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);
        if($order->products->contains($productId)){
            //получаем доступ к промежуточной таблице и увеличивае столбец count
            $pivotRow =$order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count<2){
                $order->products()->detach($productId);//находим нужный объект модели и открепляем запись в промежуточной табл order_product по $productId
            }
            else{
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        $product=Product::find($productId);
        session()->flash('warning', 'Товар удален '.$product->name);
        return redirect()->route('basket');
    }
}
