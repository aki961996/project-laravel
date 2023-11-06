<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <a href="{{ route('invoice') }}" class="flex items-center justify-end mt-4">


        <x-primary-button class="ml-3">
            {{ __('Back') }}
        </x-primary-button>
    </a>



    <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="" class="block mt-1 w-full" type="text" name="customer_name" :value="old('name')"
                autofocus />
            @error('customer_name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="customer_email" :value="old('email')"
                autofocus />
            @error('customer_email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="qty" class="block font-medium text-sm text-gray-600">{{ __('Qty') }}</label>
            <input id="qty" type="number" class="block mt-1 w-full form-input rounded-md shadow-sm" name="qty"
                value="{{ old('qty') }}" autocomplete="off" pattern="\d*">
            @error('qty')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="amount" class="block font-medium text-sm text-gray-600">{{ __('Amount') }}</label>
            <input id="amount" type="number" class="block mt-1 w-full form-input rounded-md shadow-sm" name="amount"
                value="{{ old('amount') }}" autocomplete="off" pattern="\d*">
            @error('amount')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="total_amount" class="block font-medium text-sm text-gray-600">{{ __('Total Amount') }}</label>
            <input id="total_amount" type="number" class="block mt-1 w-full form-input rounded-md shadow-sm"
                name="total_amount" value="{{ old('total_amount') }}" autocomplete="off" pattern="\d*">
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
            <input id="invoice_date" type="date" class="block mt-1 w-full form-input rounded-md shadow-sm"
                name="invoice_date">
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
            <x-input-error class="mt-2" :messages="$errors->get('file_path')" />
        </div>





        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ml-3">
                {{ __('Submit') }}
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
</script>