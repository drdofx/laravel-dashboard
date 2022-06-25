<x-app-layout>
    <x-slot name="title">
        {{ __('Edit Purchase Data') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit a purchase data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-validation-errors :errors="$errors" />


                    <button class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 mb-2" type="button" data-modal-toggle="popup-modal">
                        Delete data
                    </button>
                    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center" aria-hidden="true">
                        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                                <div class="p-6 text-center">
                                    <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <h3 class="mb-3 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this order data?</h3>
                                    <form method="POST" action="{{ route('purchase.destroy', $purchase) }}">
                                        @method('DELETE')
                                        @csrf
                                        <div class="py-2 align-middle inline-block min-w-full">

                                            <x-button-red data-modal-toggle="popup-modal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                {{ __('Delete') }}
                                            </x-button-red>
                                        </div>
                                    </form>
                                    <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-4 py-2 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>




                    <form method="POST" action="{{ route('purchase.update', $purchase) }}">
                        @method('PUT')
                        @csrf
                        <!-- Product -->
                        <div>
                            <x-label for="product" :value="__('Product Name')" />

                            <select id="product" name="product" class="text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required autofocus>
                                <option class="text-gray-500" value="">Choose a product</option>
                                @foreach($products as $product)
                                    @if ($product->id == $purchase->product_id)
                                        <option class="text-gray-900" value="{{ $product->id }}" selected>{{ $product->product_name }}</option>
                                    @else
                                        <option class="text-gray-900" value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- Supplier -->
                        <div class="mt-4">
                            <x-label for="supplier" :value="__('Supplier')" />

                            <select id="supplier" name="supplier" class="text-sm rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required autofocus>
                                <option class="text-gray-500" value="">Choose a supplier</option>
                                @foreach($suppliers as $supplier)
                                    @if ($supplier->id == $purchase->supplier_id)
                                        <option class="text-gray-900" value="{{ $supplier->id }}" selected>{{ $supplier->supplier_name }}</option>
                                    @else
                                        <option class="text-gray-900" value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- Quantity -->
                        <div class="mt-4">
                            <x-label for="quantity" :value="__('Quantity')" />

                            <x-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" value="{{ $purchase->quantity }}" required />
                        </div>

                        <!-- Date -->
                        <div class="mt-4">
                            <x-label for="purchase_date" :value="__('Order Date')" />

                            {{--                            <x-input id="purchase_date" class="block mt-1 w-full" type="date" name="purchase_date" />--}}
                            <x-input datepicker datepicker-buttons datepicker-format="dd/mm/yyyy" id="purchase_date" class="block mt-1 w-full" type="text" name="purchase_date" placeholder="Select date" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $purchase->purchase_date)->locale('id_ID')->translatedFormat('d F Y') }}" required />
                        </div>

                        <!-- Created by (disabled) -->
                        <div class="mt-4">
                            <x-label for="created_by" :value="__('Created by')" />

                            <x-input id="created_by" class="block mt-1 w-full disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none" type="text" name="created_by" value="{{ $purchase->user->name }}" disabled />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-3">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/datepicker.js"></script>
</x-app-layout>
