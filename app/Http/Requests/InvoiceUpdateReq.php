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
            //  'name' => ['required'],
            // 'customer_name' => ['required'],
            // 'customer_email' => ['nullable'],
            // 'qty' => ['nullable'],
            // 'amount' => ['nullable'],
            // 'total_amount' => ['nullable'],
            // 'tax_percentage' => ['nullable'],


            // 'tax_amount' => ['nullable'],
            // 'net_amount' => ['nullable'],

            // 'invoice_date' => ['nullable'],
            // 'file_path' => ['nullable'],

            'qty' => 'required|numeric',
            'amount' => 'required|numeric',
            'total_amount' => 'numeric',
            'tax_percentage' => 'required|in:0,5,12,18,28',
            'tax_amount' => 'numeric',
            'net_amount' => 'numeric',
            'customer_name' => 'required|regex:/^[a-zA-Z]+$/u',
            'invoice_date' => 'required',
            'file_path' => 'required|file',
            'customer_email' => 'required|unique:invoices,customer_email,'


        ];
    }
}
