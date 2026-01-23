<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak Stiker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="shortcut icon" href="<?php echo e(asset('images/RSU.png')); ?>" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 5mm;
            padding: 5mm;
            background-color: #f4f4f4;
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
            margin: 20px auto;
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

        .print-button-wrapper {
            text-align: center;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            background: #fff;
            margin: -5mm -5mm 15px -5mm;
        }

        .print-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background: #007bff;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .print-button:hover {
            background: #0056b3;
        }

        @media print {
            .print-button-wrapper {
                display: none;
            }

            @page {
                size: auto;
                margin: 5mm;
            }

            body {
                background: #fff;
                margin: 0;
                padding: 0;
            }

            .sticker {
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <div class="print-button-wrapper">
        <button onclick="window.print()" class="print-button">
            <i class="fa fa-print"></i> Cetak Stiker Ini
        </button>
        <button onclick="window.location.href='<?php echo e(route('cetak.semua.stiker')); ?>'" class="print-button"
            style="background: #28a745;">
            <i class="fa fa-layer-group"></i> Cetak Semua Stiker
        </button>
    </div>

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

</body>

</html><?php /**PATH D:\Informatika V2\INVENTARIS MIPA\inventaris_rt3\resources\views/cetak-stiker.blade.php ENDPATH**/ ?>