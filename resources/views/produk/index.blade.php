<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Produk') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-10 mb-10 px-10">
        <div class="grid grid-cols-8 gap-4 mb-4 p-5">
            <div class="col-span-4 mt-2">
                {{-- Tempat untuk judul atau informasi tambahan --}}
            </div>
            <div class="col-span-4">
                <div class="flex justify-end">
                    <a href="{{ route('produkcreate') }}"
                       class="inline-block px-6 py-2.5 bg-pink-300 text-black font-medium text-xs leading-tight uppercase rounded-full 
                       shadow-md hover:bg-pink-400 hover:shadow-lg focus:bg-pink-300 focus:shadow-lg focus:outline-none focus:ring-0 
                       active:bg-pink-800 active:shadow-lg transition duration-150 ease-in-out"
                       id="add-product-btn">Add Product</a>
                </div>
            </div>
        </div>

        <div class="bg-pink-300 p-5 rounded shadow-sm">
            <!-- Notifikasi menggunakan flash session data -->
            @if (session('success'))
                <div class="p-3 rounded bg-pink-300 text-green-100 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Category</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                            <th scope="col" class="px-6 py-3">Stock</th>
                            <th scope="col" class="px-6 py-3">Image</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $product->title }}</td>
                                <td class="px-6 py-4">{{ $product->description }}</td>
                                <td class="px-6 py-4">{{ $product->category }}</td>
                                <td class="px-6 py-4">{{ $product->price }}</td>
                                <td class="px-6 py-4">{{ $product->stock }}</td>
                                <td class="px-6 py-4">
                                    @if($product->image)
                                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}" class="w-16 h-16 object-cover">
                                    @else
                                        gambar tidak ada
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                          action="{{ route('produkdestroy', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <a href="{{ route('produkedit', $product) }}" id="{{ $product->id }}-edit-btn"
                                           class="inline-block px-6 py-2.5 bg-blue-400 text-black font-medium text-xs leading-tight 
                                           uppercase rounded-full shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 
                                           focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg 
                                           transition duration-150 ease-in-out">Edit</a>

                                        <button type="submit"
                                                class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight 
                                                uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 
                                                focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg 
                                                transition duration-150 ease-in-out"
                                                id="{{ $product->id }}-delete-btn">Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-sm text-gray-900 px-6 py-4 whitespace-nowrap" colspan="8">
                                    Data Empty
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>