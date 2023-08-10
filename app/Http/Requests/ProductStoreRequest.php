<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * By default it returns false, change it to
         * something like this if u are checking authentication
         */
        return true;//; <-------
    }
        /**
         * You could also use something more granular, like
         * a policy rule or an admin validation like this:
         * return auth()->user()->isAdmin();
         *
         * Or just return true if you handle the authorisation
         * anywhere else:
         * return true;
         */

        /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name:ar'=>'required',
            'name:en'=>'required',
            'price'=>'required | max:10',
            'image'=>'required'
        ];
    }
}
