<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        $category = Category::find($this->route('category'));              //взято с примера документации
//        return $category && $this->user()->can('update', $category);          // еще не проверенно

        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'bail|required|unique:categories,title,except,id|max:150'
        ];
    }
}
