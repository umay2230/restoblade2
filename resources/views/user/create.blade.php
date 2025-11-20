<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah User') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-10 mb-10 px-10">
        <div class="grid grid-cols-8 gap-4 p-5">
            <div class="col-span-4 mt-2">
                <h1 class="text-3xl font-bold">
                    Tambah User
                </h1>
            </div>
            <div class="col-span-4">
            </div>
        </div>

        <div class="bg-white p-5 rounded shadow-sm">
            @if (session('success'))
                <div class="p-3 rounded bg-green-500 text-green-100 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('userstore') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                </div>

                <!-- Role -->
                <div class="mt-4">
                    <x-input-label for="role" :value="__('Role')" />
                    <select
                        id="role"
                        name="role"
                        tabindex="4"
                        autocomplete="role"
                        required
                        class="block mt-1 w-full border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="kitchen">Kitchen</option>
                        <option value="kasir">Kasir</option>
                        <option value="waiters">Waiters</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                </div>

                <!-- Buttons -->
                <div class="mt-3">
                    <x-primary-button
                        class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md
                               hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                               active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                        Save
                    </x-primary-button>

                    <a href="{{ route('userindex') }}"
                       class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-medium text-xs leading-tight uppercase rounded-full shadow-md
                              hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0
                              active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>