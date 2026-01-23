<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak Semua Stiker Inventaris</title>
    <link rel="shortcut icon" href="<?php echo e(asset('images/RSU.png')); ?>" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 5mm;
            background: #fff;
        }

        .page {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1mm;
            page-break-after: always;
        }

        .sticker {
            border: 1px solid #000;
            padding: 1mm;
            height: 30mm;
            width: 95mm;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sticker-header {
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
            border-bottom: 1px solid #000;
            margin-bottom: 3mm;
        }

        .sticker-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-wrapper {
            display: flex;
            align-items: center;
        }

        .stiker-logo {
            margin-right: 6px;
        }

        .stiker-logo img {
            width: 45px;
            height: auto;
        }

        .info-section {
            font-size: 9pt;
            line-height: 1.2;
        }

        .info-section p {
            margin: 1px 0;
        }

        .barcode-section {
            text-align: center;
            flex-shrink: 0;
            margin-left: 8px;
        }

        .barcode-number {
            font-size: 8pt;
            margin-top: 2px;
            letter-spacing: 0.5px;
        }

        .no-print {
            text-align: center;
            margin-bottom: 10px;
        }

        .print-button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .print-button:hover {
            background: #0056b3;
        }

        @media print {
            .no-print {
                display: none;
            }

            @page {
                size: A4 portrait;
                margin: 5mm;
            }

            body {
                background: #fff;
            }
        }
    </style>
</head>

<body>
    <div class="no-print">
        <button onclick="window.print()" class="print-button">🖨️ Cetak Semua Stiker</button>
    </div>

    <?php
    $chunks = $records->chunk(18);
    ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $chunks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="page">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="sticker">
            <div class="sticker-header">LABEL INVENTARIS BARANG</div>
            <div class="sticker-body">
                <div class="info-wrapper">
                    <div class="stiker-logo">
                        <img src="<?php echo e(asset('images/RSU.png')); ?>" alt="logo">
                    </div>

                    <div class="info-section">
                        <p><strong>Nama Barang:</strong> <?php echo e($record->nama_perangkat); ?></p>
                        <p><strong>Kode Barang:</strong> <?php echo e($record->nomor_inventaris); ?></p>
                        <p><strong>Lokasi:</strong> <?php echo e($record->lokasi->nama_lokasi ?? 'N/A'); ?></p>
                        <p><strong>Tahun:</strong> <?php echo e($record->tahun_pengadaan); ?></p>
                    </div>
                </div>

                <div class="barcode-section">
                    <?php
                    $url = route('public.perangkat.show', ['perangkat' => $record->id]);
                    echo \SimpleSoftwareIO\QrCode\Facades\QrCode::size(60)->generate($url);
                    ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</body>

</html><?php /**PATH D:\Informatika V2\INVENTARIS MIPA\inventaris_rt3\resources\views/cetak-stiker-massal.blade.php ENDPATH**/ ?>