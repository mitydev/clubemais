<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PageUpdateRequest extends PageStoreRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = parent::rules();

        $page = $this->route('page'); // model bound
        $id   = $page ? $page->id : null;

        // mantém a mesma regex (precisa começar com /), mas ignora o próprio ID na unicidade
        $rules['slug'] = [
            'required',
            'string',
            'regex:/^\//',
            'max:190',
            Rule::unique('pages', 'slug')->ignore($id),
        ];

        return $rules;
    }
}
