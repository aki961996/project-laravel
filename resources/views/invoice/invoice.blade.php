<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoice') }}
        </h2>
    </x-slot>



    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice List') }}
        </h2>
    </x-slot>

    <a href="{{ route('customer.add') }}">
        <x-primary-button class="ml-3 flex items-center justify-end mt-4">
            {{ __('Add customer') }}
        </x-primary-button>
    </a>


    @include('message')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full">
                                <div class="shadow  border-b border-gray-200 sm:rounded-lg">

                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer Name</th>
                                                    <th> Customer email</th>
                                                    <th> Qty</th>


                                                    <th> Total Amount</th>

                                                    <th> Tax Amount</th>


                                                    <th> Invoice Date</th>
                                                    <th> Image</th>


                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($data as $task)
                                                <tr>
                                                    <th scope="row">{{$data->firstItem() + $loop->index}}</th>
                                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-black-500">
                                                        {{ $task->id }}
                                                    </td> --}}
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black-500">
                                                        {{ $task->customer_name }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black-500">
                                                        {{ $task->customer_email }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black-500">
                                                        {{ $task->qty }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black-500">
                                                        {{ $task->total_amount }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black-500">
                                                        {{ $task->tax_amount }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black-500">
                                                        {{ $task->invoice_date_formated }}
                                                    </td>
                                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-black-500">
                                                        {{ $task->file_path }}
                                                    </td> --}}

                                                    <td class="align-middle">
                                                        <img style='width:100px;'
                                                            src="{{ asset('storage/images/' . $task->file_path) }}"
                                                            alt="">
                                                    </td>

                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        {{-- <a href=""
                                                            class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
                                                        <a href="{{route('customer.edit',encrypt($task->id))}}">
                                                            <x-primary-button
                                                                class="ml-3 flex items-center justify-end mt-4">
                                                                {{ __('Edit') }}
                                                            </x-primary-button>
                                                        </a>
                                                    </td>

                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        {{-- <a href=""
                                                            class="text-indigo-600 hover:text-indigo-900">Delete</a>
                                                        --}}
                                                        <a href="{{route('customer.delete',encrypt($task->id))}}">
                                                            <x-danger-button
                                                                class="ml-3 flex items-center justify-end mt-4">
                                                                {{ __('Delete') }}
                                                            </x-danger-button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>


                                    </div>

                                    {{-- <div style="padding: 10px; float:right;">
                                        {!!
                                        $data->appends(\Illuminate\Support\Facades\Request::except('page'))->links()
                                        !!}
                                    </div> --}}
                                    {{ $data->links() }}


                                </div>
                                <div class="mt-4">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>