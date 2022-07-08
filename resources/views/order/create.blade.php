<x-app-layout>
    <x-slot name="title">
        {{ __('Add Order Data') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-validation-errors :errors="$errors" />
{{--                    <x-success-message />--}}

                    <form method="POST" action="{{ route('order.store') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Product Name')" />

                            <select id="name" name="name" class="text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required autofocus>
                                <option class="text-gray-500" selected>Choose a product</option>
                                @foreach($products as $product)
                                    <option class="text-gray-900" value="{{ $product->id }}">{{ $product->product_name }} (Stock: {{ $product->stock }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Quantity -->
                        <div class="mt-4">
                            <x-label for="quantity" :value="__('Quantity')" />

                            <x-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" required />
                        </div>

                        <!-- Price -->
                        <div class="mt-4">
                            <x-label for="price" :value="__('Total Price')" />

                            <x-input id="price" class="block mt-1 w-full" type="number" min="0" step="100" name="price" required />
                        </div>

                        <!-- Date -->
                        <div class="mt-4">
                            <x-label for="order_date" :value="__('Order Date')" />

{{--                            <x-input id="order_date" class="block mt-1 w-full" type="date" name="order_date" />--}}
                            <x-input datepicker datepicker-buttons datepicker-format="dd/mm/yyyy" id="order_date" class="block mt-1 w-full" type="text" name="order_date" placeholder="Select date" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-3">
                                {{ __('Add') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/datepicker.js"></script>
</x-app-layout>
