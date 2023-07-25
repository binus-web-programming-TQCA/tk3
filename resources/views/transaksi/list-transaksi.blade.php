<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List Transaksi') }}
        </h2>
    </x-slot>
    @if(session('success'))
    <div id="toast-default"
        class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 mt-10"
        role="alert">
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function () {
                setTimeout(() => {

                    document.querySelector('#toast-default').classList.add('hidden');
                }, 2000);

            });

        </script>
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-800 dark:text-blue-200">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.147 15.085a7.159 7.159 0 0 1-6.189 3.307A6.713 6.713 0 0 1 3.1 15.444c-2.679-4.513.287-8.737.888-9.548A4.373 4.373 0 0 0 5 1.608c1.287.953 6.445 3.218 5.537 10.5 1.5-1.122 2.706-3.01 2.853-6.14 1.433 1.049 3.993 5.395 1.757 9.117Z" />
            </svg>
            <span class="sr-only">Fire icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">{{session('success')}}</div>
        <button type="button"
            class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            data-dismiss-target="#toast-default" aria-label="Close">
            <span class="sr-only">Close</span>

        </button>
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Barang
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Harga Barang
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Stok
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Pembeli
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                       {{$item->nama_barang}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$item->harga_jual}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->stock_barang}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item->user_name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($item->status == 0)
                                            Pending
                                        @else
                                            Sukses
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($item->status == 0 && $item->stock_barang > 0)
                                        <a href="{{ route('transaksi.submit', $item->transaksi_id) }}">
                                            <button type="button" class="focus:outline-none text-white bg-blue-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Approve</button>
                                        </a>
                                        @else
                                            
                                        @endif
                                        
                                        {{-- <form action="{{ route('staffs.destroy', $item->id) }}" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus data staff ini?')">Hapus</button>
                                        </form> --}}
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
