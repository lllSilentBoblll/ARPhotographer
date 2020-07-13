<?php


namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryValidator
{
    /** Разрешаем конфликт при сохранении категории, с названием, которое уже существует, и по правилам будет ругаться
     * на уникальность.
     * We resolve the conflict while maintaining the category, with a name that already exists, and according
     * to the rules it will swear for uniqueness.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    public function validate(Request $request, $id)
    {
        return Validator::make($request->all(), [
            'title' => [
                'required',
                Rule::unique('categories')->ignore($id),
            ],
        ]);
    }
}
