{{-- msg --}}
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

{{-- @if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif --}}
@if(session('success'))
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ session('success') }}
            </div>
        </div>
    </div>
</div>
@endif



@if(session('warning'))
<div class="alert alert-warning">
    {{ session('warning') }}
</div>
@endif

@if(session('info'))
<div class="alert alert-info">
    {{ session('info') }}
</div>
@endif

@if(session()->has('message'))
<div class="alert alert-info">
    {{ session('message') }}
</div>
@endif