<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Add') }}
        </h2>
    </x-slot>


    <a href="{{ route('invoice') }}" class="flex items-center justify-end mt-4">


        <x-primary-button class="ml-3">
            {{ __('Back') }}
        </x-primary-button>
    </a>



    <form method="POST" action="{{ route('customer.store') }}" id="invoice-form" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input customer_name class="block mt-1 w-full" type="text" name="customer_name"
                value="{{ old('customer_name') }}" autofocus />
            @error('customer_name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="customer_email" class="block mt-1 w-full" type="email" name="customer_email"
                value="{{ old('customer_email') }}" autofocus />
            @error('customer_email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="qty" class="block font-medium text-sm text-gray-600">{{ __('Qty') }}</label>
            <input id="qty" type="number" class="block mt-1 w-full form-input rounded-md shadow-sm qty" name="qty"
                value="{{ old('qty') }}" autocomplete="off" pattern="\d*">
            @error('qty')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="amount" class="block font-medium text-sm text-gray-600">{{ __('Amount') }}</label>
            <input id="amount" type="number" class="block mt-1 w-full form-input rounded-md shadow-sm amount"
                name="amount" value="{{ old('amount') }}" autocomplete="off" pattern="\d*">
            @error('amount')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="total_amount" class="block font-medium text-sm text-gray-600">{{ __('Total Amount') }}</label>
            <input id="total_amount" type="number" value="{{old('total_amount')}}"
                class="block mt-1 w-full form-input rounded-md shadow-sm" name="total_amount"
                value="{{ old('total_amount') }}" autocomplete="off" pattern="\d*">
            @error('total_amount')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>



        <div>
            <label for="tax_percentage" class="block font-medium text-sm text-gray-600">{{ __('Tax Percentage')
                }}</label>
            <select id="tax_percentage" class="block mt-1 w-full form-select rounded-md shadow-sm" name="tax_percentage"
                required>
                <option value="0">0%</option>
                <option value="5">5%</option>
                <option value="12">12%</option>
                <option value="18">18%</option>
                <option value="28">28%</option>
            </select>
            @error('tax_percentage')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>




        <div>
            <label for="tax_amount" class="block font-medium text-sm text-gray-600">{{ __('Tax Amount') }}</label>
            <input id="tax_amount" type="number" class="block mt-1 w-full form-input rounded-md shadow-sm"
                name="tax_amount" value="{{ old('tax_amount') }}" autocomplete="off" pattern="\d*">
            @error('tax_amount')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="net_amount" class="block font-medium text-sm text-gray-600">{{ __('Net Amount') }}</label>
            <input id="net_amount" type="number" class="block mt-1 w-full form-input rounded-md shadow-sm"
                name="net_amount" value="{{ old('net_amount') }}" autocomplete="off" pattern="\d*">
            @error('net_amount')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="invoice_date" class="block font-medium text-sm text-gray-600">{{ __('Invoice Date') }}</label>
            <input id="datepicker" type="text" class="block mt-1 w-full form-input rounded-md shadow-sm"
                name="invoice_date" value="{{ old('invoice_date') }}">
            @error('invoice_date')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        <div>
            <x-input-label for="featured_image" value="file path" />
            <label class="block mt-2">
                <span class="sr-only">Choose image</span>
                <input type="file" id="file_path" name="file_path" class="block w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-violet-50 file:text-violet-700
                                            hover:file:bg-violet-100
                                        " />
            </label>
            {{-- <div class="shrink-0 my-2">
                <img id="featured_image_preview" class="h-64 w-128 object-cover rounded-md"
                    src="{{ isset($post) ? Storage::url($post->featured_image) : '' }}" alt="Featured image preview" />
            </div> --}}
            @error('file_path')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>





        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ml-3">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>



</x-guest-layout>

<script type="text/javascript">
    // document.addEventListener("DOMContentLoaded", function() {
    //         flatpickr("#invoice_date", {
    //             enableTime: false, // Disable time selection
    //             dateFormat: "Y-m-d", // Set the desired date format
    //         });
    //     });
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
        // Add validation rules for other fields here
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

    // logic start
    // $(document).on('change', '#qty, #amount', function() {
    //     // calculateTotalAmount();
    // });
   

    // $(document).on('change', '#tax_percentage', function() {
    // calculateTaxAmount();
    // });


    // $(document).on('change', '#total_amount, #tax_amount', function() {
    //     calculateNetAmount();
    // });
    
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
    
  

    // function calculateTaxAmount() {
    // const taxPercentage = ($('#tax_percentage').val());
    // // console.log(taxPercentage);
    // const totalAmount = ($('#total_amount').val());
    
    // const taxAmount = (taxPercentage / 100) * totalAmount;
    // $('#tax_amount').val(taxAmount);
    // }

    // function calculateTotalAmount() {
    // let qty = $('#qty').val();
    // let amount = $('#amount').val();
    // let totalAmount = qty * amount;
    // $('#total_amount').val(totalAmount);
    // }

    // function calculateNetAmount() {
    //     var netAmount=0;
    
    //     var totalAmount = parseInt($('#total_amount').val());
    //     var taxAmount = parseInt($('#tax_amount').val());
    //     netAmount = totalAmount + taxAmount;
    //     console.log(netAmount, 'netAmount');
    //     $('#net_amount').val(netAmount);
    // }


   

   


     
   

</script>