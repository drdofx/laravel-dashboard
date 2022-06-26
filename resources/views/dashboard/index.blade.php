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
                    <div class="text-2xl font-bold">Selamat datang {{$user->name}}!</div>
                    <div class="mt-3">Role Anda adalah @if($user->admin) <strong>Admin</strong> @else <strong>User</strong> @endif </div>
                </div>
            </div>

            <div class="flex mt-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="text-2xl font-bold">Selamat datang {{$user->name}}!</div>
                        <div class="mt-3">Role Anda adalah @if($user->admin) <strong>Admin</strong> @else <strong>User</strong> @endif </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
