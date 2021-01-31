<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AddTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Client::find($this->get('client_id'))->user_id == Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "name" => 'required',
            'description' => 'nullable',
            'client_id' => 'required',
            "rate" => 'required',
            "currency" => [
                'required',
                Rule::in(['USD', 'CAD', 'EUR']),
            ]
        ];
        if ($this->get('logNow') == true) {
            $rules['time'] = 'required';
            $rules['start_date'] = 'nullable|date';
        }

        return $rules;

    }
}
