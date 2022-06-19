<x-app-layout>
    <x-slot name="title">
        {{ __('Add Supplier Data') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new supplier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-validation-errors :errors="$errors" />
{{--                    <x-success-message />--}}

                    <form method="POST" action="{{ route('supplier.store') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                        </div>

                        <!-- Phone Number -->
                        <div class="mt-4">
                            <x-label for="phone_number" :value="__('Phone Number (Type in all number, with length of 11 to 14)')" />

                            <x-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number" pattern="[0-9]{11,14}" placeholder="08777xxxxxxx" />
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
