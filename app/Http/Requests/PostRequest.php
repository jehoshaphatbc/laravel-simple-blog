<?php

namespace App\Http\Requests;

use App\Enums\StatusPost;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:60',
            'content' => 'required|string',
            'publish_date' => 'nullable|date',
            'status' => ['required', new Enum(StatusPost::class)],
        ];
    }
}
