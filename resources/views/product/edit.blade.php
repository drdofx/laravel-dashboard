<x-app-layout>
    <x-slot name="title">
        {{ __('Edit Product Data') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit a product data') }}
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
                                    <h3 class="mb-3 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product data?</h3>
                                    <form method="POST" action="{{ route('product.destroy', $product) }}">
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




                    <form method="POST" action="{{ route('product.update', $product) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Product Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $product->product_name }}" autofocus />
                        </div>

                        <!-- Stock -->
                        <div class="mt-4">
                            <x-label for="stock" :value="__('Stock')" />

                            <x-input id="stock" class="block mt-1 w-full" type="number" name="stock" value="{{ $product->stock }}" />
                        </div>

                        <!-- Price -->
{{--                        <div class="mt-4">--}}
{{--                            <x-label for="price" :value="__('Price')" />--}}

{{--                            <x-input id="price" class="block mt-1 w-full" type="number" min="0" step="100" name="price" value="{{ $product->price }}" />--}}
{{--                        </div>--}}

                        <!-- Image-->
                        <div class="mt-4">
                            <x-label for="image" :value="__('Image (Optional)')" />

                            @if (\Illuminate\Support\Facades\Storage::disk('public_uploads')->exists($product->file_name))
                                <p class="mt-1 text-xs text-gray-500" id="file_input_help">Existing image:</p>
                                <img class="mt-1 h-96 w-96" src="{{ \Illuminate\Support\Facades\Storage::disk('public_uploads')->url($product->file_name) }}" alt="Image of {{ $product->product_name }}">
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" value="true" type="checkbox" name="delete_image" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900">Delete image</label>
                                </div>
                            @endif

                            <x-input id="image" class="block mt-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:placeholder-gray-400" aria-describedby="file_input_help" type="file" name="image" />

                            <p class="ml-1 mt-2 text-xs italic text-gray-500" id="file_input_help">SVG, PNG, JPG or GIF.</p>

                        </div>

                        <!-- Created by (disabled) -->
                        <div class="mt-4">
                            <x-label for="created_by" :value="__('Created by')" />

                            <x-input id="created_by" class="block mt-1 w-full disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none" type="text" name="created_by" value="{{ $product->user->name }}" disabled />
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
</x-app-layout>
