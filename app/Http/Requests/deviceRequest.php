<?php namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class deviceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "ip"        => ["ip","required", Rule::unique('devices')->ignore(Request::input("id"))],
            "location"  => "required",
            "temp_min"                  => "numeric|required|max:" . Request::input("temp_max"),
            "temp_max"                  => "numeric|required|min:" . Request::input("temp_min"),
            "rh_min"                    => "numeric|required|max:" . Request::input("rh_max"),
            "rh_max"                    => "numeric|required|min:" . Request::input("rh_min"),
        ];
    }
}
