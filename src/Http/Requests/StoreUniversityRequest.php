<?php

namespace Wovosoft\BdAcademicComponents\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUniversityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "name"    => ["string", "required"],
            "bn_name" => ["string", "nullable"],
            "code"    => ["string", "nullable"],
            "website" => ["string", "nullable"],
            "details" => ["string", "nullable"],
            "type"    => ["string", "nullable"],
            "logo"    => ["string", "nullable"],
        ];
    }
}
