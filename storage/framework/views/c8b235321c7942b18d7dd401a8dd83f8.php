<?php if (isset($component)) { $__componentOriginal166a02a7c5ef5a9331faf66fa665c256 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    <div class="overflow-x-auto border border-gray-300 rounded-lg shadow-sm" style="min-height: 400px;">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-200">
            <thead
                class="text-xs text-gray-900 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-300 border-b border-gray-300">
                <tr>
                    
                    <th rowspan="3"
                        class="px-4 py-2 border-r border-gray-300 text-center align-middle font-bold text-lg w-12">
                        No
                    </th>

                    
                    <th rowspan="3" class="px-4 py-2 border-r border-gray-300 text-center align-middle font-bold text-lg w-1/4 relative group 
                        <?php echo e(!empty($filter_nama) ? 'bg-yellow-50 dark:bg-yellow-900/20' : ''); ?>">

                        <div class="flex items-center justify-between px-2" x-data="{ open: false }">
                            <span class="flex-grow text-center">
                                Nama Alat
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filter_nama)): ?>
                                    <span
                                        class="text-[10px] font-normal block normal-case text-gray-500">(<?php echo e(count($filter_nama)); ?>

                                        dipilih)</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>

                            
                            <button @click="open = !open"
                                class="p-1 ml-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition focus:outline-none"
                                :class="open ? 'bg-gray-200 dark:bg-gray-700' : ''">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5 <?php echo e(!empty($filter_nama) ? 'text-primary-600' : 'text-gray-400 group-hover:text-gray-600'); ?>">
                                    <path fill-rule="evenodd"
                                        d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            
                            <div x-show="open" @click.outside="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                class="absolute top-10 right-0 mt-1 w-64 bg-white dark:bg-gray-800 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50 text-left flex flex-col max-h-80">

                                <div
                                    class="p-2 border-b dark:border-gray-700 bg-gray-50 dark:bg-gray-900 rounded-t-md flex justify-between items-center">
                                    <span class="text-xs font-bold text-gray-500 uppercase">Filter Item</span>

                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filter_nama)): ?>
                                        <button wire:click="$set('data.filter_nama', [])"
                                            class="text-xs text-red-500 hover:text-red-700 hover:underline">
                                            Clear Filter
                                        </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                
                                <div class="overflow-y-auto p-2 space-y-1" style="max-height: 250px;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($list_nama_alat) > 0): ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $list_nama_alat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label
                                                class="flex items-center space-x-2 px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded cursor-pointer">
                                                <input type="checkbox" value="<?php echo e($nama); ?>" wire:model.live="data.filter_nama"
                                                    class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                                <span class="text-sm text-gray-700 dark:text-gray-200 truncate"
                                                    title="<?php echo e($nama); ?>">
                                                    <?php echo e($nama); ?>

                                                </span>
                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php else: ?>
                                        <div class="text-center text-xs text-gray-400 py-2">Data Kosong</div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                <div
                                    class="p-2 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-900 rounded-b-md text-right">
                                    <button @click="open = false"
                                        class="text-xs text-gray-500 hover:text-gray-800">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </th>

                    
                    <th <?php if($filter_kondisi === 'all'): ?> colspan="4" <?php elseif($filter_kondisi === 'baik' || $filter_kondisi === 'rusak'): ?> colspan="2" <?php endif; ?>
                        class="px-4 py-2 border-r border-gray-300 text-center font-bold text-lg relative group 
                        <?php echo e($filter_kondisi === 'all' ? 'bg-blue-50 dark:bg-blue-900/20' : ($filter_kondisi === 'baik' ? 'bg-green-50 dark:bg-green-900/20' : 'bg-red-50 dark:bg-red-900/20')); ?>">
                        <div class="flex items-center justify-center gap-2" x-data="{ open: false }">
                            <span>
                                Kondisi Alat
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter_kondisi !== 'all'): ?>
                                    <span class="text-xs font-normal">(<?php echo e(ucfirst($filter_kondisi)); ?>)</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>

                            <button @click="open = !open"
                                class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition focus:outline-none"
                                :class="open ? 'bg-gray-200 dark:bg-gray-700' : ''">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5 <?php echo e($filter_kondisi !== 'all' ? 'text-primary-600' : 'text-gray-400 group-hover:text-gray-600'); ?>">
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
                                        class="block w-full px-4 py-2 text-sm text-left hover:bg-gray-100 dark:hover:bg-gray-700 <?php echo e($filter_kondisi === 'all' ? 'font-bold text-primary-600 bg-gray-50' : ''); ?>">All</button>
                                    <button wire:click="$set('data.filter_kondisi', 'baik'); open = false"
                                        class="block w-full px-4 py-2 text-sm text-left hover:bg-gray-100 dark:hover:bg-gray-700 <?php echo e($filter_kondisi === 'baik' ? 'font-bold text-green-600 bg-gray-50' : ''); ?>">Baik</button>
                                    <button wire:click="$set('data.filter_kondisi', 'rusak'); open = false"
                                        class="block w-full px-4 py-2 text-sm text-left hover:bg-gray-100 dark:hover:bg-gray-700 <?php echo e($filter_kondisi === 'rusak' ? 'font-bold text-red-600 bg-gray-50' : ''); ?>">Rusak</button>
                                </div>
                            </div>
                        </div>
                    </th>

                    <th colspan="2" rowspan="2"
                        class="px-4 py-2 text-center align-middle font-bold text-lg bg-gray-200 dark:bg-gray-700">Grand
                        Total</th>
                </tr>

                
                <tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter_kondisi === 'all' || $filter_kondisi === 'baik'): ?>
                        <th colspan="2"
                            class="px-2 py-1 border-r border-gray-300 text-center font-semibold bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400">
                            Baik</th>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter_kondisi === 'all' || $filter_kondisi === 'rusak'): ?>
                        <th colspan="2"
                            class="px-2 py-1 border-r border-gray-300 text-center font-semibold bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400">
                            Rusak</th>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tr>

                <tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter_kondisi === 'all' || $filter_kondisi === 'baik'): ?>
                        <th class="px-4 py-2 border-r border-t border-gray-300 text-right bg-green-50 dark:bg-green-900/20">
                            Jumlah</th>
                        <th class="px-4 py-2 border-r border-t border-gray-300 text-right bg-green-50 dark:bg-green-900/20">
                            Harga Beli</th>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter_kondisi === 'all' || $filter_kondisi === 'rusak'): ?>
                        <th class="px-4 py-2 border-r border-t border-gray-300 text-right bg-red-50 dark:bg-red-900/20">
                            Jumlah</th>
                        <th class="px-4 py-2 border-r border-t border-gray-300 text-right bg-red-50 dark:bg-red-900/20">
                            Harga Beli</th>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <th class="px-4 py-2 border-r border-t border-gray-300 text-right bg-gray-200 dark:bg-gray-700">
                        Jumlah</th>
                    <th class="px-4 py-2 border-t border-gray-300 text-right bg-gray-200 dark:bg-gray-700">Harga Beli
                    </th>
                </tr>
            </thead>

            
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $resume_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        <td class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 text-center font-medium">
                            <?php echo e($loop->iteration); ?></td>
                        <td class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 font-medium">
                            <?php echo e($row['nama_jenis'] ?? '-'); ?></td>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter_kondisi === 'all' || $filter_kondisi === 'baik'): ?>
                            <td class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 text-right text-green-600">
                                <?php echo e(number_format($row['baik_qty'], 0, ',', '.')); ?></td>
                            <td class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 text-right text-green-600">Rp
                                <?php echo e(number_format($row['baik_harga'], 0, ',', '.')); ?></td>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter_kondisi === 'all' || $filter_kondisi === 'rusak'): ?>
                            <td class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 text-right text-red-600">
                                <?php echo e(number_format($row['rusak_qty'], 0, ',', '.')); ?></td>
                            <td class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 text-right text-red-600">Rp
                                <?php echo e(number_format($row['rusak_harga'], 0, ',', '.')); ?></td>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <td
                            class="px-4 py-2 border-r border-gray-200 dark:border-gray-700 text-right font-bold bg-gray-50 dark:bg-gray-800">
                            <?php echo e(number_format($row['total_qty'], 0, ',', '.')); ?></td>
                        <td class="px-4 py-2 text-right font-bold bg-gray-50 dark:bg-gray-800">Rp
                            <?php echo e(number_format($row['total_harga'], 0, ',', '.')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="px-4 py-8 text-center text-gray-500 italic">
                            Tidak ada data perangkat ditemukan.
                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>

            
            <tfoot class="bg-gray-100 dark:bg-gray-800 border-t-2 border-gray-300 font-bold sticky bottom-0">
                <tr class="text-gray-900 dark:text-white">
                    <td class="px-4 py-3 border-r border-gray-300"></td>
                    <td class="px-4 py-3 border-r border-gray-300 text-center uppercase">Grand Total</td>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter_kondisi === 'all' || $filter_kondisi === 'baik'): ?>
                        <td class="px-4 py-3 border-r border-gray-300 text-right text-green-700">
                            <?php echo e(number_format($grand_total['baik_qty'], 0, ',', '.')); ?></td>
                        <td class="px-4 py-3 border-r border-gray-300 text-right text-green-700">Rp
                            <?php echo e(number_format($grand_total['baik_harga'], 0, ',', '.')); ?></td>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter_kondisi === 'all' || $filter_kondisi === 'rusak'): ?>
                        <td class="px-4 py-3 border-r border-gray-300 text-right text-red-700">
                            <?php echo e(number_format($grand_total['rusak_qty'], 0, ',', '.')); ?></td>
                        <td class="px-4 py-3 border-r border-gray-300 text-right text-red-700">Rp
                            <?php echo e(number_format($grand_total['rusak_harga'], 0, ',', '.')); ?></td>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <td class="px-4 py-3 border-r border-gray-300 text-right bg-gray-200 dark:bg-gray-700">
                        <?php echo e(number_format($grand_total['total_qty'], 0, ',', '.')); ?></td>
                    <td class="px-4 py-3 text-right bg-gray-200 dark:bg-gray-700">Rp
                        <?php echo e(number_format($grand_total['total_harga'], 0, ',', '.')); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $attributes = $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $component = $__componentOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?><?php /**PATH D:\Informatika V2\INVENTARIS MIPA\inventaris_rt3\resources\views/filament/resources/alat-rumah-tanggas/pages/resume-alat-rumah-tangga.blade.php ENDPATH**/ ?>