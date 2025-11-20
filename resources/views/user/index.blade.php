<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-10 mb-10 px-10">
        <div class="grid grid-cols-8 gap-4 mb-4 p-5">
            <div class="col-span-4 mt-2">
            </div>
            <div class="col-span-4">
                <div class="flex justify-end">
                    <a href="{{ route('usercreate') }}"
                       class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-full 
shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 
active:shadow-lg transition duration-150 ease-in-out"
                       id="add-user-btn">Add User</a>
                </div>
            </div>
        </div>

        <div class="bg-white p-5 rounded shadow-sm">
            <!-- Notifikasi menggunakan flash session data -->
            @if (session('success'))
                <div class="p-3 rounded bg-green-500 text-green-100 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="container mx-auto p-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Role</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">{{ $user->role }}</td>
                                <td class="px-6 py-4">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                          action="{{ route('userdestroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ route('useredit', $user) }}" id="{{ $user->id }}-edit-btn"
                                           class="inline-block px-6 py-2.5 bg-blu-400 text-black font-medium text-xs leading-tight uppercase 
rounded-full shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 
active:shadow-lg transition duration-150 ease-in-out">Edit</a>

                                        <button type="submit"
                                                class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight 
uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 
active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                                                id="{{ $user->id }}-delete-btn">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-sm text-gray-900 px-6 py-4 whitespace-nowrap" colspan="6">
                                    Data Empty
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>