<x-app-layout>
    <x-slot name="title">
        {{ __('Add Product Data') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-validation-errors :errors="$errors" />
{{--                    <x-success-message />--}}

                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Product Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                        </div>

                        <!-- Stock -->
                        <div class="mt-4">
                            <x-label for="stock" :value="__('Initial Stock')" />

                            <x-input id="stock" class="block mt-1 w-full" type="number" name="stock" required />
                        </div>

                        <!-- Price -->
                        <div class="mt-4">
                            <x-label for="price" :value="__('Initial Price')" />

                            <x-input id="price" class="block mt-1 w-full" type="number" min="0" step="100" name="price" required />
                        </div>

                        <!-- Image-->
                        <div class="mt-4">
                            <x-label for="image" :value="__('Image (Optional)')" />

                            <x-input id="image" class="block mt-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:placeholder-gray-400" aria-describedby="file_input_help" type="file" name="image" />

                            <p class="ml-1 mt-2 text-xs italic text-gray-500" id="file_input_help">SVG, PNG, JPG or GIF.</p>

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
</x-app-layout>
