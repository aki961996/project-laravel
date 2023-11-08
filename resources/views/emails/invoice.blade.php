@component('mail::message')
# Hello {{ $user->customer_name }},

This is a mail for Invoice details:

- Invoice date: {{ $user->invoice_date }}
- Tax amount: {{ $user->tax_amount }}
- Total amount: {{ $user->total_amount }}

-image :<img style='width:100px;' src="{{ asset('storage/images/' . $user->file_path) }}" alt="">

In case you have any issues, please contact us.

Thanks,
{{ config('app.name') }}
@endcomponent