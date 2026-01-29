<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPerangkatController;
use App\Http\Controllers\PublicMaintenanceController;
use App\Http\Controllers\ExportController;
use App\Models\Perangkat;

Route::get('/', function () {
  return redirect('/admin');
});

Route::get('/perangkat/{perangkat}', [PublicPerangkatController::class, 'show'])
  ->name('public.perangkat.show');
Route::get('/maintenance/{riwayat}', [PublicMaintenanceController::class, 'show'])
  ->name('public.maintenance.show');

Route::get('/cetak-semua-stiker', [PublicPerangkatController::class, 'cetakSemuaStiker'])
  ->name('cetak.semua.stiker');

Route::get('/cetak/stiker/{perangkat}', [PublicPerangkatController::class, 'cetakSatu'])
  ->name('cetak.satu.stiker');

Route::get('/export/perangkat-all', [ExportController::class, 'exportPerangkatAllExcel'])
  ->name('export.perangkat.all.excel');
Route::get('/export/kalibrasi-all', [ExportController::class, 'exportKalibrasiAllExcel'])
  ->name('export.kalibrasi.all.excel');
Route::get('/export/mutasi/resume-pdf', [ExportController::class, 'exportMutasiResumePdf'])
  ->name('mutasi.resume.pdf')
  ->middleware('auth');

Route::model('perangkat', Perangkat::class);
