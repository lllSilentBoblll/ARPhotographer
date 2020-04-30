<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'title' => 'bail|required|min:5|max:150',
            'description' => 'string|max:500|nullable',
            'customer' => 'string|max:150|nullable',
            'model' => 'string|max:255|nullable',
            'camera' => 'string|max:100|nullable',
            'category_id' => 'required|integer|exists:categories,id'
        ];
    }

//    /**
//     * @return array
//     */
//    public function messages() : array
//    {
//        return [
//            'title.required' => 'Введите название альбома',
//            'title.min' => ':title не должно быть меньше :min символов',
//            'title.max' => ':title не должно быть больше :max символов',
//            'description.max' => ':description не должно быть больше :max символов'
//        ];
//    }
//
//    public function attributes() : array
//    {
//        return [
//            'title' => 'Название',
//            'description' => 'Описание',
//        ];
//    }
}
