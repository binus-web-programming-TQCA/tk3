<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Barang') }}
        </h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">{{ $error }}</span>
                </div>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="py-12">
            <div class="relative overflow-x-auto max-w-7xl mx-auto sm:px-6 lg:px-8">

                <form action="{{ route('barang.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="nama_barang"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Barang</label>
                            <input value="{{ $data->nama_barang}}" type="text" id="nama_barang" name="nama_barang"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Nama Barang" required>
                        </div>
                        <div>
                            <label for="jenis_barang"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                                Barang</label>
                            <input value="{{ $data->jenis_barang}}" type="text" id="jenis_barang" name="jenis_barang"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Jenis Barang" required>
                        </div>

                    </div>
                    <div class="mb-6">
                        <label for="deskripsi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Deskripsi Barang .......">{{ $data->deskripsi}}</textarea>

                    </div>
                    <div class="mb-6">
                        <div>
                            <label for="stock_barang"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Barang</label>
                            <input value="{{ $data->stock_barang}}" type="number" id="stock_barang" name="stock_barang"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Stok Barang" required>
                        </div>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="harga_beli"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Beli</label>
                            <input value="{{ $data->harga_beli}}" type="number" id="harga_beli" name="harga_beli"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Harga Beli" required>
                        </div>
                        <div>
                            <label for="harga_jual"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Jual</label>
                            <input value="{{ $data->harga_jual}}" type="number" id="harga_jual" name="harga_jual"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Harga Jual" required>
                        </div>

                    </div>
                    <div class="mb-6">
                        <div>
                            <label for="gambar_barang"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar
                                Barang</label>
                            @if ($data->gambar_barang)
                            <figure class="max-w-lg mt-10 mx-auto mb-10">
                                <img class="h-auto max-w-full rounded-lg" src="{{ Storage::url($data->gambar_barang) }}"
                                    alt="{{ $data->gambar_barang}}">
                            </figure>
                            @else
                            <p class="mb-2">Tidak ada gambar</p>
                            @endif
                            <input type="file" id="gambar_barang" name="gambar_barang"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Gambar Barang" required>

                        </div>

                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </x-slot>
</x-app-layout>
