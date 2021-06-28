<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TicketFormRequest extends FormRequest
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

    protected function failedValidation(Validator $validator)
    {
        //throw new HttpResponseException(response()->json($validator->errors(), 422));
        //return $validator->fails()
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required|max:255',
            'user_name' => 'required|max:80|min:3',
            'user_email' => 'required|email',
            'content'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'Укажите тему тикета',
            'subject.max' => 'Длинна темы тикета привышена',
            'user_name.required' => 'Укажите имя пользователя',
            'user_name.max' => 'Превышена длинна имени пользователя',
            'user_name.min' => 'Имя пользователя должно быть не менее 3-х символов',
            'user_email.required' => 'Укажите электронную почту пользователя',
            'user_email.email' => 'Электронная почта указана с ошибками',
            'content.required' => 'Заполните содержимое тикета'
        ];
    }
}
