<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Edit') }}
        </h2>
    </x-slot>


    <a href="{{ route('invoice') }}" class="flex items-center justify-end mt-4">


        <x-primary-button class="ml-3">
            {{ __('Back') }}
        </x-primary-button>
    </a>



    <form method="post" action="{{ route('customer.update') }}" id="invoice-form"  enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id" value="{{$singleDatas->id}}" class="form-control" id="" placeholder="">

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="" class="block mt-1 w-full" type="text" name="customer_name"
                value="{{old('customer_name', $singleDatas->customer_name) }}" autofocus />

        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="customer_email"
                value="{{old('customer_email', $singleDatas->customer_email) }}" autofocus />

        </div>


        <div>
            <label for="qty" class="block font-medium text-sm text-gray-600">{{ __('Qty') }}</label>
            <input id="qty" type="number" class="block mt-1 w-full form-input rounded-md shadow-sm" name="qty"
                value="{{old('qty', $singleDatas->qty) }}" autocomplete="off" pattern="\d*">

        </div>

        <div>
            <label for="amount" class="block font-medium text-sm text-gray-600">{{ __('Amount') }}</label>
            <input id="amount" type="number" class="block mt-1 w-full form-input rounded-md shadow-sm" name="amount"
                value="{{old('amount', $singleDatas->amount) }}" autocomplete="off" pattern="\d*">

        </div>
        <div>
            <label for="total_amount" class="block font-medium text-sm text-gray-600">{{ __('Total Amount') }}</label>
            <input id="total_amount" type="number" class="block mt-1 w-full form-input rounded-md shadow-sm"
                name="total_amount" value="{{old('name', $singleDatas->total_amount) }}" autocomplete="off"
                pattern="\d*">

        </div>






        <div>
            <label for="tax_percentage" class="block font-medium text-sm text-gray-600">{{ __('Tax Percentage')
                }}</label>
            <select id="tax_percentage" class="block mt-1 w-full form-select rounded-md shadow-sm"
                name="tax_percentage">
                <option value="0" {{($singleDatas->tax_percentage == "0")? 'selected' : ''}}
                    value="{{$singleDatas->id}}">0%</option>

                <option value="5" {{($singleDatas->tax_percentage == "5")? 'selected' : ''}}>5%</option>
                <option value="12" {{($singleDatas->tax_percentage == "12")? 'selected' : ''}}>12%</option>
                <option value="18" {{($singleDatas->tax_percentage == "18")? 'selected' : ''}}>18%</option>
                <option value="28" {{($singleDatas->tax_percentage == "28")? 'selected' : ''}}>28%</option>

            </select>


        </div>


        <div>
            <label for="tax_amount" class="block font-medium text-sm text-gray-600">{{ __('Tax Amount') }}</label>
            <input id="tax_amount" type="number" class="block mt-1 w-full form-input rounded-md shadow-sm"
                name="tax_amount" value="{{old('tax_amount', $singleDatas->tax_amount) }}" autocomplete=" off"
                pattern="\d*">

        </div>


        <div>
            <label for="net_amount" class="block font-medium text-sm text-gray-600">{{ __('Net Amount') }}</label>
            <input id="net_amount" type="number" class="block mt-1 w-full form-input rounded-md shadow-sm"
                name="net_amount" value="{{old('net_amount', $singleDatas->net_amount) }}" autocomplete="off"
                pattern="\d*">

        </div>

        <div>
            <label for="invoice_date" class="block font-medium text-sm text-gray-600">{{ __('Invoice Date') }}</label>
            <input id="invoice_date" value="{{old('invoice_date', $singleDatas->invoice_date) }}" type="date"
                class="block mt-1 w-full form-input rounded-md shadow-sm" name="invoice_date">


        </div>

        <div class="form-group d-flex flex-column">
            <label>Image</label>
            <img style='width:100px;' src="{{asset('storage/images/' . $singleDatas->file_path) }}" alt="">
            <input type="file" name="file_path" class="form-control">
            @error('file_path')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>





        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ml-3">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>



</x-guest-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#invoice_date", {
                enableTime: false, // Disable time selection
                dateFormat: "Y-m-d", // Set the desired date format
            });
        });


        $(function() {
        $("#datepicker").datepicker();
        });
        
        $(document).ready(function () {
        
        
        $("#invoice-form").validate({
        rules: {
        customer_name: {
        required: true,
        alpha: true
        },
        customer_email: {
        required: true,
        email: true
        },
        qty: {
        required: true,
        number: true
        },
        amount: {
        required: true,
        number: true
        },
        
        },
        messages: {
        customer_name: {
        required: "Please enter a name.",
        alpha: "Name should only contain alphabetic characters."
        },
        customer_email: {
        required: "Please enter an email address.",
        email: "Please enter a valid email address."
        },
        qty: {
        required: "Please enter a quantity.",
        number: "Quantity should be a numeric value."
        },
        amount: {
        required: "Please enter an amount.",
        number: "Amount should be a numeric value."
        },
        
        }
        });
        
        
        
        
        
        
        });
        
       
        
        $("#invoice-form input, #invoice-form select").each(function(index){
        $(this).on('change', function() {
        let qty = $('#qty').val();
        let amount = $('#amount').val();
        let totalAmount = qty * amount;
        $('#total_amount').val(totalAmount);
        
        // second
        const taxPercentage = $('#tax_percentage').val();
        console.log(taxPercentage, 'taxPercentage');
        
        const taxAmount = taxPercentage / 100 * totalAmount;
        $('#tax_amount').val(taxAmount);
        
        // thirdd
        var netAmount=0;
        
        netAmount = totalAmount + taxAmount;
        console.log(netAmount, 'netAmount');
        $('#net_amount').val(netAmount);
        
        });
        });
        
        
        
    
</script>