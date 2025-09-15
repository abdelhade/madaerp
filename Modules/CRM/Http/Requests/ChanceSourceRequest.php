<?php

namespace Modules\CRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChanceSourceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'branch_id' => 'required|exists:branches,id',
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'حقل العنوان مطلوب.',
            'title.string'   => 'يجب أن يكون العنوان نصاً.',
            'title.max'      => 'لا يمكن أن يزيد العنوان عن 255 حرفاً.',
            'branch_id.required' => 'الفرع مطلوب.',
            'branch_id.exists' => 'الفرع المختار غير صحيح.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
