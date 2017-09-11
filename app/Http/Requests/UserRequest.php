<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if  (Request::input("id")){

            $id = Request::input("id");
            $this->createCustomOldPasswordValidationRule($id);

            return [
                "employee_id" => ["required", Rule::unique('users')->ignore($id)],
                "name"         => ["required", Rule::unique('users')->ignore($id)],
                "email"        => ["required", Rule::unique('users')->ignore($id)],
                "is_admin"     => "boolean",
                "old_password" => "old_password",
                "password"     => "confirmed|min:6"
            ];
        }

        return [
            "employee_id"  => "required|unique:users",
            "name"         => "required|unique:users",
            "email"        => "required|unique:users",
            "is_admin"     => "boolean",
            "password"     => "required|confirmed|min:6"
        ];
    }

    /**
     * @param $id
     * @internal param $user
     */
    protected function createCustomOldPasswordValidationRule($id)
    {
        $user =  \App\User::find($id);
        \Validator::extend('old_password', function ($attribute, $value) use ($user) {
            return \Hash::check($value, $user->password);
        });
    }
}
