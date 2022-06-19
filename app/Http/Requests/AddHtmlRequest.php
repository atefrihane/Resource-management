<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddHtmlRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:200',
            'description' => 'required|max:500',
            'snippet' => 'required|max:1000'
        ];
    }
}
