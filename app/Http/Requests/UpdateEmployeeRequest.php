<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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

    public function rules()
    {
        return  [
            'name' => 'required',
            'email' => 'required|email',
            'gender' => 'required|in:M,F',
            'department_id' => 'required|exists:departments,id',
            'newsletter' => 'in:1',
            'description' => 'required',
            'roles' => 'array|exists:roles,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio',
            'email.required' => 'El :attribute es obligatorio',
            'email.email' => 'El :attribute debe tener formato de correo electronico',
            'gender.required' => 'El :attribute es obligatorio',
            'gender.in' => 'El :attribute debe contener unicamente M o F',
            'department_id.required' => 'El :attribute es obligatorio',
            'department_id.exists' => 'El :attribute seleccionada no corresponde a una area',
            'newsletter.in' => 'El :attribute debe contener unicamente el valor 0 o 1',
            'description.required' => 'El :attribute es obligatorio',
            'roles.array' => 'El :attribute debe contener uno varios roles',
            'roles.exists' => 'El :attribute selecionaddos no corresponden a roles del sistema',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'email' => 'Correo electronico',
            'gender' => 'Genero',
            'department_id' => 'Area',
            'newsletter' => 'Boletin',
            'description' => 'Descripcion',
            'roles' => 'Roles',
        ];
    }
}
