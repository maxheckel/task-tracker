<?php

namespace App\Http\Requests;

use App\Models\Client;
use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GetBilledRequest extends FormRequest
{
    /** @var Client */
    public $client;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $client = Client::find($this->route()->parameters['clientId']);
        $this->client = $client;
        return $client->user_id == Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
