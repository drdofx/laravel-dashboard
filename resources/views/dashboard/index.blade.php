@php
    $user = auth()->user();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-3xl font-bold">Selamat datang {{$user->name}}!</div>
                    <div class="text-2xl mt-3">Role Anda adalah @if($user->admin) <strong>Admin</strong> @else <strong>User</strong> @endif </div>
                </div>
            </div>

            @if($user->admin)
            <div class="grid grid-cols-3 lg:grid-cols-2 gap-5 w-full mt-4">
                <div class="bg-green-200 py-2 rounded-md ">
                    <div class="flex sm:ml-4">
                        <div>
                            <h2 class="text-base md:text-2xl lg:text-4xl sm:px-6 sm:py-4 px-2 py-0 whitespace-no-wrap text-gray-600">Total Users</h2>
                            <h2 class="text-base md:text-2xl lg:text-4xl sm:px-6 sm:py-2 px-2 py-0 text-gray-600">{{ $users }}</h2>
                        </div>
                        <div class="flex justify-center items-center sm:ml-4 pr-2">
                            <svg
                                class="w-10 h-10 md:w-20 md:h-20 lg:w-36 lg:h-36 text-gray-600 "
                                fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512"
                            >
                                <path
                                    d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"
                                ></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="grid grid-cols-3 lg:grid-cols-2 gap-5 w-full mt-4">
                <div class="bg-green-200 py-2 rounded-md ">
                    <div class="flex sm:ml-4">
                        <div>
                            <h2 class="text-base md:text-2xl lg:text-4xl sm:px-6 sm:py-4 px-2 py-0 whitespace-no-wrap text-gray-600">Total Suppliers</h2>
                            <h2 class="text-base md:text-2xl lg:text-4xl sm:px-6 sm:py-2 px-2 py-0 text-gray-600">{{ $suppliers }}</h2>
                        </div>
                        <div class="flex justify-center items-center sm:ml-4 pr-2">
                            <img class="h-20 sm:h-28" src="{{ asset('images/agreement.png') }}"/>
                        </div>
                    </div>
                </div>
                <div class="bg-yellow-200 py-2 rounded-md ">
                    <div class="flex sm:ml-4">
                        <div>
                            <h2 class="text-base md:text-2xl lg:text-4xl sm:px-6 sm:py-4 px-2 py-0 whitespace-no-wrap text-gray-600">Total Products</h2>
                            <h2 class="text-base md:text-2xl lg:text-4xl sm:px-6 sm:py-2 px-2 py-0 text-gray-600">{{ $products }}</h2>
                        </div>
                        <div class="flex justify-center items-center sm:ml-8 pr-2">
                            <img class="h-20 sm:h-28" src="{{ asset('images/products.png') }}"/>
                        </div>
                    </div>
                </div>
                <div class="bg-red-200 py-2 rounded-md ">
                    <div class="flex sm:ml-4">
                        <div>
                            <h2 class="text-base md:text-2xl lg:text-4xl sm:px-6 sm:py-4 px-2 py-0 whitespace-no-wrap text-gray-600">Total Orders</h2>
                            <h2 class="text-base md:text-2xl lg:text-4xl sm:px-6 sm:py-2 px-2 py-0 text-gray-600">{{ $orders }}</h2>
                        </div>
                        <div class="flex justify-center items-center sm:ml-12 pr-2">
                            <img class="h-20 sm:h-28" src="{{ asset('images/order.png') }}"/>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-200 py-2 rounded-md ">
                    <div class="flex sm:ml-4">
                        <div>
                            <h2 class="text-base md:text-2xl lg:text-4xl sm:px-6 sm:py-4 px-2 py-0 whitespace-no-wrap text-gray-600">Total Purchases</h2>
                            <h2 class="text-base md:text-2xl lg:text-4xl sm:px-6 sm:py-2 px-2 py-0 text-gray-600">{{ $purchases }}</h2>
                        </div>
                        <div class="flex justify-center items-center sm:ml-4 pr-2">
                            <img class="h-20 sm:h-28" src="{{ asset('images/shopping-cart.png') }}"/>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
