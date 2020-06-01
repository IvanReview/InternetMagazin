<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = [
        '_token'
    ];

    public function category(){
        return  $this->belongsTo(Category::class);
    }

    //подсчет общей стоимости (количество) одного товара
    public function getPriceForCount()
    {
        if (!is_null($this->pivot)){
            $totalPrice=$this->pivot->count * $this->price;
            return $totalPrice;
        }
        return $this->price;
    }


    //мутатор, внутреннее свойство attributes для доступа к полям
    public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value ? 1 : 0;
    }

    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value ? 1 : 0;
    }

    public function setRecommendAttribute($value)
    {
        $this->attributes['recommend'] = $value ? 1 : 0;
    }



    public function isHit()
    {
        return $this->hit == 1;
    }

    public function isNew()
    {
        return $this->new == 1;
    }

    public function isRecommend()
    {
        return $this->recommend === 1;
    }
}
