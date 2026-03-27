<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $templateKeys = array_keys(config('pagebuilder.templates', []));

        return [
            'title'            => ['required', 'string', 'max:120'],
            'slug'             => ['required', 'string', 'regex:/^\//', 'max:190', 'unique:pages,slug'],
            'meta_title'       => ['nullable', 'string', 'max:150'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'template'         => ['nullable', 'string', 'max:50', Rule::in($templateKeys)],
            'is_active'        => ['sometimes', 'boolean'],
        ];
    }
}
