<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules=  [
            'name'          => 'required|min:5|max:100',
            'code'          => 'max:200|unique:categories,code',
            'description'   => 'required|string|max:500|min:2',
            'price'         => 'required|numeric|min:1',
        ];

        //для обновления не тронутого поля unique, проверяем является ли роут update, исключаем текущий id из проверки
        //или создать 2 валидатора и не мучаться, дописав для unique третим параметром except
        if ($this->route()->named('products.update')){
            $rules['code'] .= ',' . $this->route()->parameter('product')->id;
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'Название',
            'description'=> 'Описание'
        ];
    }

    public function messages()
    {
        return [
            'required'      =>  'Поле :attribute обязательно для заполнения',
            'min'           =>  'Поле :attribute должно иметь минимум :min символа',
            'unique'        =>  'Поле :attribute должно быть уникадльным'
        ];
    }
}
