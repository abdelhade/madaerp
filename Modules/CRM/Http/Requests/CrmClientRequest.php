<?php

namespace Modules\CRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrmClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'type'    => ['required', 'in:person,company'],
            'phone'   => ['required', 'string', 'max:20'],
            'email'   => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'notes'   => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'الاسم مطلوب.',
            'name.string'       => 'يجب أن يكون الاسم نصاً.',
            'name.max'          => 'الاسم لا يجب أن يتجاوز 255 حرفاً.',

            'type.required'     => 'نوع العميل مطلوب.',
            'type.in'           => 'نوع العميل يجب أن يكون شخص أو شركة فقط.',

            'phone.required'    => 'رقم الهاتف مطلوب.',
            'phone.string'      => 'يجب أن يكون رقم الهاتف نصاً.',
            'phone.max'         => 'رقم الهاتف لا يجب أن يتجاوز 20 رقم.',

            'email.email'       => 'يجب إدخال بريد إلكتروني صحيح.',
            'email.max'         => 'البريد الإلكتروني لا يجب أن يتجاوز 255 حرفاً.',

            'address.string'    => 'يجب أن يكون العنوان نصاً.',
            'address.max'       => 'العنوان لا يجب أن يتجاوز 255 حرفاً.',

            'notes.string'      => 'يجب أن تكون الملاحظات نصاً.',
        ];
    }
}
