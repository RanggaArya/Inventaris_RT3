<x-filament-panels::page>

    <div class="overflow-x-auto border border-gray-300 rounded-lg shadow-sm" style="min-height: 400px;">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-200">
            <thead
                class="text-xs text-gray-900 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-300 border-b border-gray-300">
                <tr>
                    {{-- KOLOM NO --}}
                    <th rowspan="3"
                        class="px-4 py-2 border-r border-gray-300 text-center align-middle font-bold text-lg w-12">
                        No
                    </th>

                    {{-- KOLOM NAMA ALAT DENGAN CHECKBOX FILTER --}}
                    <th rowspan="3" class="px-4 py-2 border-r border-gray-300 text-center align-middle font-bold text-lg w-1/4 relative group 
                        {{ !empty($filter_nama) ? 'bg-yellow-50 dark:bg-yellow-900/20' : '' }}">

                        <div class="flex items-center justify-between px-2" x-data="{ open: false }">
                            <span class="flex-grow text-center">
                                Nama Alat
                                @if(!empty($filter_nama))
                                    <span
                                        class="text-[10px] font-normal block normal-case text-gray-500">({{ count($filter_nama) }}
                                        dipilih)</span>
                                @endif
                            </span>

                            {{-- Button Icon Filter --}}
                            <button @click="open = !open"
                                class="p-1 ml-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition focus:outline-none"
                                :class="open ? 'bg-gray-200 dark:bg-gray-700' : ''">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5 {{ !empty($filter_nama) ? 'text-primary-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                                    <path fill-rule="evenodd"
                                        d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            {{-- POPUP CHECKBOX LIST (EXCEL STYLE) --}}
                            <div x-show="open" @click.outside="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                class="absolute top-10 right-0 mt-1 w-64 bg-white dark:bg-gray-800 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50 text-left flex flex-col max-h-80">

                                <div
                                    class="p-2 border-b dark:border-gray-700 bg-gray-50 dark:bg-gray-900 rounded-t-md flex justify-between items-center">
                                    <span class="text-xs font-bold text-gray-500 uppercase">Filter Item</span>

                                    {{-- Tombol Reset --}}
                                    @if(!empty($filter_nama))
                                        <button wire:click="$set('data.filter_nama', [])"
                                            class="text-xs text-red-500 hover:text-red-700 hover:underline">
                                            Clear Filter
                                        </button>
                                    @endif
                                </div>

                                {{-- AREA SCROLLABLE CHECKBOX --}}
                                <div class="overflow-y-auto p-2 space-y-1" style="max-height: 250px;">
                                    @if(count($list_nama_alat) > 0)
                                        @foreach($list_nama_alat as $nama)
                                            <label
                                                class="flex items-center space-x-2 px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded cursor-pointer">
                                                <input type="checkbox" value="{{ $nama }}" wire:model.live="data.filter_nama"
                                                    class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                                <span class="text-sm text-gray-700 dark:text-gray-200 truncate"
                                                    title="{{ $nama }}">
                                                    {{ $nama }}
                                                </span>
                                            </label>
                                        @endforeach
                                    @else
                                        <div class="text-center text-xs text-gray-400 py-2">Data Kosong</div>
                                    @endif
                                </div>

                                <div
                                    class="p-2 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-900 rounded-b-md text-right">
                                    <button @click="open = false"
                                        class="text-xs text-gray-500 hover:text-gray-800">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </th>

                    {{-- HEADER KONDISI ALAT (Filter Dropdown) --}}
                    <th @if($filter_kondisi === 'all') colspan="4" @elseif($filter_kondisi === 'baik' || $filter_kondisi === 'rusak') colspan="2" @endif
                        class="px-4 py-2 border-r border-gray-300 text-center font-bold text-lg relative group 
                        {{ $filter_kondisi === 'all' ? 'bg-blue-50 dark:bg-blue-900/20' : ($filter_kondisi === 'baik' ? 'bg-green-50 dark:bg-green-900/20' : 'bg-red-50 dark:bg-red-900/20') }}">
                        <div class="flex items-center justify-center gap-2" x-data="{ open: false }">
                            <span>
                                Kondisi Alat
                                @if($filter_kondisi !== 'all')
                                    <span class="text-xs font-normal">({{ ucfirst($filter_kondisi) }})</span>
                                @endif
                            </span>

                            <button @click="open = !open"
                                class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition focus:outline-none"
                                :class="open ? 'bg-gray-200 dark:bg-gray-700' : ''">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5 {{ $filter_kondisi !== 'all' ? 'text-primary-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                                    <path fill-rule="evenodd"
                                        d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open" @click.outside="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                class="absolute top-full right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50 text-left"
                                style="display: none;">

                                <div class="py-1">
                                    <div
                                        class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase border-b dark:border-gray-700">
                                        Filter Status</div>
                                    <button wire:click="$set('data.filter_kondisi', 'all'); open = false"
                                        class="block w-full px-4 py-2 text-sm text-left hover:bg-gray-100 dark:hover:bg-gray-700 {{ $filter_kondisi === 'all' ? 'font-bold text-primary-600 bg-gray-50' : '' }}">All</button>
                                    <button wire:click="$set('data.filter_kondisi', 'baik'); open = false"
                                        class="block w-full px-4 py-2 text-sm text-left hover:bg-gray-100 dark:hover:bg-gray-700 {{ $filter_kondisi === 'baik' ? 'font-bold text-green-600 bg-gray-50' : '' }}">Baik</button>
                                    <button wire:click="$set('data.filter_kondisi', 'rusak'); open = false"
                                        class="block w-full px-4 py-2 text-sm text-left hover:bg-gray-100 dark:hover:bg-gray-700 {{ $filter_kondisi === 'rusak' ? 'font-bold text-red-600 bg-gray-50' : '' }}">Rusak</button>
                                </div>
                            </div>
                        </div>
                    </th>

                    <th colspan="2" rowspan="2"
                        class="px-4 py-2 text-center align-middle font-bold text-lg bg-gray-200 dark:bg-gray-700">Grand
                        Total</th>
                </tr>

                {{-- SUB HEADERS --}}
                <tr>
                    @if($filter_kondisi === 'all' || $filter_kondisi === 'baik')
                        <th colspan="2"
                            class="px-2 py-1 border-r border-gray-300 text-center font-semibold bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400">
                            Baik</th>
                    @endif
                    @if($filter_kondisi === 'all' || $filter_kondisi === 'rusak')
                        <th colspan="2"
                            class="px-2 py-1 border-r border-gray-300 text-center font-semibold bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400">
                            Rusak</th>
                    @endif
                </tr>

                <tr>
                    @if($filter_kondisi === 'all' || $filter_kondisi === 'baik')
                        <th class="px-4 py-2 border-r border-t border-gray-300 text-right bg-green-50 dark:bg-green-900/20">
                            Jumlah</th>
                        <th class="px-4 py-2 border-r border-t border-gray-300 text-right bg-green-50 dark:bg-green-900/20">
                            Harga Beli</th>
                    @endif
                    @if($filter_kondisi === 'all' || $filter_kondisi === 'rusak')
                        <th class="px-4 py-2 border-r border-t border-gray-300 text-right bg-red-50 dark:bg-red-900/20">
                            Jumlah</th>
                        <th class="px-4 py-2 border-r border-t border-gray-300 text-right bg-red-50 dark:bg-red-900/20">
                            Harga Beli</th>
                    @endif
                    <th class="px-4 py-2 border-r border-t border-gray-300 text-right bg-gray-200 dark:bg-gray-700">
                        Jumlah</th>
                    <th class="px-4 py-2 border-t border-gray-300 text-right bg-gray-200 dark:bg-gray-700">Harga Beli
                    </th>
                </tr>
            </thead>

            {{-- BODY TABLE --}}
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                @forelse($resume_data as $row)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        <td class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 text-center font-medium">
                            {{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 font-medium">
                            {{ $row['nama_jenis'] ?? '-' }}</td>

                        @if($filter_kondisi === 'all' || $filter_kondisi === 'baik')
                            <td class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 text-right text-green-600">
                                {{ number_format($row['baik_qty'], 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 text-right text-green-600">Rp
                                {{ number_format($row['baik_harga'], 0, ',', '.') }}</td>
                        @endif

                        @if($filter_kondisi === 'all' || $filter_kondisi === 'rusak')
                            <td class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 text-right text-red-600">
                                {{ number_format($row['rusak_qty'], 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 text-right text-red-600">Rp
                                {{ number_format($row['rusak_harga'], 0, ',', '.') }}</td>
                        @endif

                        <td
                            class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 text-right font-bold bg-gray-50 dark:bg-gray-800">
                            {{ number_format($row['total_qty'], 0, ',', '.') }}</td>
                        <td class="px-4 py-2 text-right font-bold bg-gray-50 dark:bg-gray-800">Rp
                            {{ number_format($row['total_harga'], 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-8 text-center text-gray-500 italic">
                            Tidak ada data perangkat ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>

            {{-- FOOTER --}}
            <tfoot class="bg-gray-100 dark:bg-gray-800 border-t-2 border-gray-300 font-bold sticky bottom-0">
                <tr class="text-gray-900 dark:text-white">
                    <td class="px-4 py-3 border-r border-gray-300"></td>
                    <td class="px-4 py-3 border-r border-gray-300 text-center uppercase">Grand Total</td>

                    @if($filter_kondisi === 'all' || $filter_kondisi === 'baik')
                        <td class="px-4 py-3 border-r border-gray-300 text-right text-green-700">
                            {{ number_format($grand_total['baik_qty'], 0, ',', '.') }}</td>
                        <td class="px-4 py-3 border-r border-gray-300 text-right text-green-700">Rp
                            {{ number_format($grand_total['baik_harga'], 0, ',', '.') }}</td>
                    @endif

                    @if($filter_kondisi === 'all' || $filter_kondisi === 'rusak')
                        <td class="px-4 py-3 border-r border-gray-300 text-right text-red-700">
                            {{ number_format($grand_total['rusak_qty'], 0, ',', '.') }}</td>
                        <td class="px-4 py-3 border-r border-gray-300 text-right text-red-700">Rp
                            {{ number_format($grand_total['rusak_harga'], 0, ',', '.') }}</td>
                    @endif

                    <td class="px-4 py-3 border-r border-gray-300 text-right bg-gray-200 dark:bg-gray-700">
                        {{ number_format($grand_total['total_qty'], 0, ',', '.') }}</td>
                    <td class="px-4 py-3 text-right bg-gray-200 dark:bg-gray-700">Rp
                        {{ number_format($grand_total['total_harga'], 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</x-filament-panels::page>