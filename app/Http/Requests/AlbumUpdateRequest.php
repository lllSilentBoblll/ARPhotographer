<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AlbumUpdateRequest
 * @package App\Http\Requests
 * @property array photosToDelete
 */
class AlbumUpdateRequest extends FormRequest
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
    public function rules()
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
}
