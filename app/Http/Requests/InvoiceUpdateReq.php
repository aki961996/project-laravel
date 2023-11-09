<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdateReq extends FormRequest
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
            'customer_name' => ['nullable'],
            'customer_email' => ['nullable'],
            'qty' => ['nullable'],
            'amount' => ['nullable'],
            'total_amount' => ['nullable'],
            'tax_percentage' => ['nullable'],
            'tax_amount' => ['nullable'],
            'net_amount' => ['nullable'],
            'invoice_date' => ['nullable'],
            'file_path' => 'required|file',



        ];
    }
}
