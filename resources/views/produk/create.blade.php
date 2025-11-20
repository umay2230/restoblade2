<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-10 mb-10 px-10">
        <div class="grid grid-cols-8 gap-4 p-5">
            <div class="col-span-4 mt-2">
                <h1 class="text-3xl font-bold">
                    Produk Baru
                </h1>
            </div>
            <div class="col-span-4">
                {{-- Kosongkan atau tambahkan tombol kembali jika perlu --}}
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">There were some problems with your input.</span>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="bg-white p-5 rounded shadow-sm">
            <form action="{{ route('produkstore') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <x-input-label for="title" :value="__('Title Produk')" />
                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title') }}"
                           class="shadow appearance-none border @error('title') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Contoh: Bakso"
                           required>
                    @error('title')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-input-label for="description" :value="__('Deskripsi Produk')" />
                    <textarea id="description"
                              name="description"
                              rows="4"
                              class="shadow appearance-none border @error('description') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              placeholder="Jelaskan detail produk Anda di sini...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-input-label for="category" :value="__('Category')" />
                    <select id="category"
                            name="category"
                            required
                            class="block mt-1 w-full border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Category</option>
                        <option value="food">Food</option>
                        <option value="beverrage">Beverrage</option>
                        <option value="snack">Snack</option>
                        <option value="other">Other</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('category')" />
                </div>

                <div class="mb-4">
                    <x-input-label for="price" :value="__('Harga Produk')" />
                    <input type="number"
                           id="price"
                           name="price"
                           value="{{ old('price') }}"
                           class="shadow appearance-none border @error('price') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Contoh: 50000"
                           min="0"
                           required>
                    @error('price')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-input-label for="stock" :value="__('Stok Produk')" />
                    <input type="number"
                           id="stock"
                           name="stock"
                           value="{{ old('stock') }}"
                           class="shadow appearance-none border @error('stock') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Contoh: 100"
                           min="0"
                           required>
                    @error('stock')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <x-input-label for="image" :value="__('Gambar Produk')" />
                    <input type="file"
                           id="image"
                           name="image"
                           class="block w-full text-sm text-gray-900 border rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('image') border-red-500 @enderror"
                           accept="image/*">
                    <p class="mt-1 text-xs text-gray-500">Format: PNG, JPG, GIF hingga 2MB.</p>
                    @error('image')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-3">
                    <button type="submit"
                            class="inline-block px-6 py-2.5 bg-blue-600 text-black font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                        Save
                    </button>
                    <a href="{{ route('produkindex') }}"
                       class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">
                        Back
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>