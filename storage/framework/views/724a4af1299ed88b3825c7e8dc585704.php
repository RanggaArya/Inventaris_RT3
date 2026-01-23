<?php
    use Illuminate\Support\Facades\Storage;
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Maintenance: <?php echo e($riwayat->perangkat?->nama_perangkat); ?> • <?php echo e($riwayat->tanggal_maintenance?->format('d M Y')); ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <link rel="shortcut icon" href="<?php echo e(asset('img/RSU.png')); ?>" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">
  <nav class="bg-white shadow-md sticky top-0 z-10 ">
    <div class="max-w-3xl mx-auto p-4 flex items-center space-x-3 border-green-600">
      <img src="<?php echo e(asset('img/RSU.png')); ?>" alt="gambar logo" width="50px">
      <span class="text-md font-bold text-gray-800">
        RSU Mitra Paramedika
      </span>
    </div>
  </nav>

  <main class="p-4 sm:p-8 shadow-md">
    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-5 sm:p-6">
      <div class="flex items-start justify-between gap-4 border-b-4 border-b-green-400 pb-4 mb-6">

        <div class="min-w-0">
          <h1 class="text-2xl font-bold text-gray-900">Detail Maintenance</h1>

          <p class="text-gray-600">
            <?php echo e($riwayat->perangkat?->nama_perangkat); ?> &middot;
            <?php echo e($riwayat->perangkat?->nomor_inventaris); ?>

          </p>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($riwayat->status_akhir): ?>
        <?php
        $map = [
        'berfungsi' => 'font-bold bg-green-100 text-green-800 ring-green-600/20',
        'berfungsi_sebagian' => 'font-bold bg-yellow-100 text-yellow-800 ring-yellow-600/20',
        'tidak_berfungsi' => 'font-bold bg-red-100 text-red-800 ring-red-600/20',
        ];
        $cls = $map[$riwayat->status_akhir] ?? 'bg-gray-100 text-gray-800 ring-gray-600/20';
        ?>

        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset <?php echo e($cls); ?> capitalize whitespace-nowrap flex-shrink-0">
          <?php echo e(str_replace('_',' ', $riwayat->status_akhir)); ?>

        </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 mb-6">
        <div>
          <dt class="text-sm text-gray-500">Tanggal Maintenance</dt>
          <dd class="text-gray-900"><?php echo e(optional($riwayat->tanggal_maintenance)->format('d M Y') ?? '-'); ?></dd>
        </div>
        <div>
          <dt class="text-sm text-gray-500">Lokasi</dt>
          <dd class="text-gray-900 uppercase"><?php echo e($riwayat->lokasi?->nama_lokasi ?? '-'); ?></dd>
        </div>
        <div>
          <dt class="text-sm text-gray-500">Pemilik/Pengguna</dt>
          <dd class="text-gray-900"><?php echo e($riwayat->nama_pemilik ?? '-'); ?></dd>
        </div>
        <div>
          <dt class="text-sm text-gray-500">Ditambahkan Oleh</dt>
          <dd class="text-gray-900"><?php echo e($riwayat->user?->name ?? '-'); ?></dd>
        </div>
        <div class="sm:col-span-2">
          <dt class="text-sm text-gray-500">Jenis Maintenance</dt>
          <dd class="mt-1 space-x-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $riwayat->maintenanceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <span class="inline-flex items-center rounded-md bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20 capitalize">
              <?php echo e($t->nama); ?>

            </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <span class="text-gray-500">-</span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </dd>
        </div>
      </dl>

      <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi Pekerjaan</h2>
        <p class="text-gray-800"><?php echo e($riwayat->deskripsi ?? '-'); ?></p>
      </div>

      <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Komponen <i class="fa-solid fa-arrow-right text-sm"></i> Aksi (Keterangan)</h2>
        <div class="space-y-2">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $riwayat->komponenDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gray-50 rounded-md p-3 border border-green-400 shadow-md">
            <div class="text-gray-900">
              <span class="font-medium capitalize"><?php echo e($row->komponen?->nama ?? '-'); ?></span>
              <i class="fa-solid fa-arrow-right text-sm"></i>
              <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([ 'uppercase text-xs tracking-wide px-1 py-0.5 rounded font-bold m-2' , 'bg-rose-400 text-black'=> strtolower($row->aksi) == 'diganti',
                'bg-yellow-400 text-black' => strtolower($row->aksi) != 'diganti',
                ]); ?>">
                <?php echo e($row->aksi ?? '-'); ?>

              </span>
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($row->keterangan): ?>
              <span class="text-gray-600"> (<?php echo e($row->keterangan); ?>)</span>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <p class="text-gray-500">Belum ada rincian komponen.</p>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>

      <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <!-- <div>
          <dt class="text-sm text-gray-500">Biaya</dt>
          <dd class="text-gray-900">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!is_null($riwayat->harga)): ?>
              Rp <?php echo e(number_format($riwayat->harga, 0, ',', '.')); ?>

            <?php else: ?>
              -
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </dd>
        </div> -->
        <div x-data="{ expanded: false }">
          <dt class="text-sm text-gray-500">Catatan Tambahan</dt>

          <dd class="text-gray-900"
            x-bind:class="expanded ? 'break-words' : 'truncate'">
            <?php echo e($riwayat->catatan ?? '-'); ?>

          </dd>

          <button x-show="!expanded" @click="expanded = true"
            class="text-sm text-blue-600 hover:underline mt-1">
            Selengkapnya <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
          </button>

          <button x-show="expanded" @click="expanded = false"
            class="text-sm text-blue-600 hover:underline mt-1"
            style="display: none;">
            Lebih sedikit <i class="fa-solid fa-chevron-up text-xs ml-1"></i>
          </button>
        </div>
      </dl>

      <?php
      $files = is_array($riwayat->foto) ? $riwayat->foto : [];
      ?>
      <div>
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Foto</h2>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($files)): ?>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $path): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e(Storage::disk('public')->url($path)); ?>" target="_blank" class="block">
            <img src="<?php echo e(Storage::disk('public')->url($path)); ?>" alt="Foto Maintenance"
              class="w-full h-40 object-cover rounded-md border" />
          </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <?php else: ?>
        <p class="text-gray-500">Tidak ada foto.</p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      <div class="mt-8">
        <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 rounded-lg bg-red-200 text-red-800 hover:bg-red-300">
          <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
        </a>
      </div>
    </div>
  </main>
</body>

</html><?php /**PATH D:\Informatika V2\INVENTARIS MIPA\inventaris_rt3\resources\views/public/maintenance/show.blade.php ENDPATH**/ ?>