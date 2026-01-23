<?php

namespace App\Filament\Imports\Traits;

use App\Models\Jenis;
use App\Models\Kondisi;
use App\Models\Lokasi;
use App\Models\Status;
use App\Models\Kategori;
use PhpOffice\PhpSpreadsheet\Shared\Date;

trait MapsMaster
{
    protected array $lokasiMap = [];
    protected array $jenisMap = [];
    protected array $statusMap = [];
    protected array $kondisiMap = [];
    protected array $kategoriMap = [];
    protected array $kategoriCodeMap = [];
    
    // MAPPING: Excel Header (lowercase) => Model Attribute Database
    protected array $COLUMN_ALIASES = [
        // Identitas & Nomor
        'no_inventaris'    => 'nomor_inventaris',
        'nomor_asset'      => 'nomor_inventaris',
        'nomor_inventaris' => 'nomor_inventaris',
        
        // Nama & Kategori
        'nama_alat'        => 'nama_perangkat', // Excel: Nama Alat
        'nama_barang'      => 'nama_perangkat',
        'nama_perangkat'   => 'nama_perangkat',
        
        'jenis'            => 'jenis', 
        'kategori'         => 'kategori_excel',      // Helper utk cari ID
        'kode_kategori'    => 'kode_kategori_excel', // Helper utk cari ID
        
        // Spesifikasi (Sesuai Model Baru)
        'merek_alat'       => 'merek_alat', // Excel: Merek Alat -> DB: merek_alat
        'merek'            => 'merek_alat',
        'tipe'             => 'merek_alat', // Jaga-jaga kalau ada header 'tipe'
        
        // Kondisi & Lokasi
        'kondisi_alat'     => 'kondisi',
        'kondisi'          => 'kondisi',
        'lokasi'           => 'lokasi',
        
        // Pengadaan & Keuangan
        'tanggal_pengadaan'=> 'tanggal_pengadaan', // Excel: Tanggal Pengadaan -> DB: tanggal_pengadaan
        'tahun_pengadaan'  => 'tahun_pengadaan',
        'sumber_pendanaan' => 'sumber_pendanaan', // Excel: Sumber Pendanaan -> DB: sumber_pendanaan
        'sumber'           => 'sumber_pendanaan',
        'harga_beli'       => 'harga_beli',       // Excel: Harga Beli -> DB: harga_beli
        'harga'            => 'harga_beli',
        
        // Keterangan
        'keterangan'       => 'keterangan',       // Excel: Keterangan -> DB: keterangan
        'catatan'          => 'keterangan',
    ];

    protected function bootMasterMaps(): void
    {
        $this->lokasiMap  = Lokasi::pluck('id', 'nama_lokasi')->all();
        $this->statusMap  = Status::pluck('id', 'nama_status')->all();
        $this->kondisiMap = Kondisi::pluck('id', 'nama_kondisi')->all();

        $this->kategoriMap = Kategori::pluck('id', 'nama_kategori')->all();

        $this->kategoriCodeMap = [];
        foreach (Kategori::select('id', 'kode_kategori')->get() as $k) {
            $key = $this->normalizeKategoriKode($k->kode_kategori);
            if ($key !== null) {
                $this->kategoriCodeMap[$key] = (int) $k->id;
            }
        }

        $this->jenisMap = Jenis::all()
            ->pluck('id', 'nama_jenis')
            ->mapWithKeys(fn($id, $name) => [mb_strtolower(trim($name)) => $id])
            ->all();
    }

    // --- HELPER FUNCTIONS ---

    protected function getOrCreateId(array &$map, string $modelClass, string $column, $value): ?int
    {
        $name = trim((string)($value ?? ''));
        if ($name === '') return null;

        $lookup = mb_strtolower($name);
        if (isset($map[$lookup])) return (int)$map[$lookup];

        $id = $modelClass::whereRaw("LOWER($column)=?", [$lookup])->value('id');
        if ($id) {
            $map[$lookup] = (int)$id;
            return (int)$id;
        }

        $created = $modelClass::create([$column => $name]);
        $map[$lookup] = (int)$created->id;
        return (int)$created->id;
    }

    protected function parseTanggal($value): ?string
    {
        if (empty($value)) return null;
        if (is_numeric($value)) {
            try {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            } catch (\Throwable) { return null; }
        }
        try {
            return date('Y-m-d', strtotime((string)$value));
        } catch (\Throwable) { return null; }
    }

    protected function normalizeNomor(?string $v): ?string
    {
        $n = strtoupper(trim((string)$v));
        $empty = ['', 'NAN', 'NA', 'N/A', '-', '—', '0', '#N/A', 'NULL'];
        return ($n === '' || in_array($n, $empty, true)) ? null : $n;
    }

    public function normalizeRowKeys(array $row): array
    {
        $out = [];
        foreach ($row as $k => $v) {
            $key = strtolower(trim((string)$k));
            $key = str_replace([' ', '-'], '_', $key);
            $finalKey = $this->COLUMN_ALIASES[$key] ?? $key;
            $out[$finalKey] = $v;
        }
        return $out;
    }

    protected function normalizeDeviceName(string $name): string
    {
        return preg_replace('/\s+/u', ' ', mb_strtolower(trim($name)));
    }

    // --- KATEGORI RESOLVER (Prioritas Kode Kategori) ---
    protected function resolveKategoriByKodeAndName(?string $kodeExcel, string $namaPerangkat): ?Kategori
    {
        // 1. Prioritas: Kode Kategori dari Excel
        if (!empty($kodeExcel)) {
            $cleanKode = $this->normalizeKategoriKode($kodeExcel);
            if ($cleanKode && isset($this->kategoriCodeMap[$cleanKode])) {
                 return Kategori::find($this->kategoriCodeMap[$cleanKode]);
            }
            // Buat baru by Kode
            if ($cleanKode) {
                $created = Kategori::create([
                    'nama_kategori' => $namaPerangkat,
                    'kode_kategori' => $cleanKode,
                ]);
                $this->kategoriMap[mb_strtolower($created->nama_kategori)] = (int)$created->id;
                $this->kategoriCodeMap[$created->kode_kategori] = (int)$created->id;
                return $created;
            }
        }
        // 2. Fallback: Tebak dari nama
        return $this->resolveKategoriByNamaPerangkat($namaPerangkat);
    }

    protected function resolveKategoriByNamaPerangkat(string $namaPerangkat): ?Kategori
    {
        $lookup = mb_strtolower($namaPerangkat);
        if (isset($this->kategoriMap[$lookup])) return Kategori::find($this->kategoriMap[$lookup]);
        
        $kategori = Kategori::whereRaw('LOWER(nama_kategori)=?', [$lookup])->first();
        if ($kategori) {
             $this->kategoriMap[$lookup] = (int)$kategori->id;
             if ($kategori->kode_kategori) $this->kategoriCodeMap[$kategori->kode_kategori] = (int)$kategori->id;
             return $kategori;
        }

        $kodeBaru = $this->nextKategoriKode();
        $created = Kategori::create([
            'nama_kategori' => $namaPerangkat,
            'kode_kategori' => $kodeBaru,
        ]);
        $this->kategoriMap[mb_strtolower($created->nama_kategori)] = (int)$created->id;
        $this->kategoriCodeMap[$created->kode_kategori] = (int)$created->id;
        return $created;
    }

    protected function normalizeKategoriKode(?string $kode): ?string
    {
        if (!$kode) return null;
        $k = preg_replace('/\D+/', '', (string)$kode);
        return ($k === '') ? null : str_pad(substr($k, -3), 3, '0', STR_PAD_LEFT);
    }

    protected function nextKategoriKode(): string
    {
        $max = Kategori::query()->max('kode_kategori');
        $n = (int) preg_replace('/\D+/', '', (string)$max);
        return str_pad($n + 1, 3, '0', STR_PAD_LEFT);
    }

    protected function resolveOrCreateJenisByName(string $nama): ?Jenis
    {
         $key = mb_strtolower(trim($nama));
         if ($key === '') return null;
         if(isset($this->jenisMap[$key])) return Jenis::find($this->jenisMap[$key]);
         
         $jenis = Jenis::firstOrCreate(['nama_jenis' => $nama], ['prefix'=>'B', 'kode_jenis'=>'02.4']);
         $this->jenisMap[$key] = (int)$jenis->id;
         return $jenis;
    }
    
    // Helper untuk parsing Nomor Inventaris (jika perlu resolve Jenis dari NI)
    protected function parseNomorInventaris(string $ni): ?array
    {
        $re = '/^([A-Z])\.(\d{2}\.\d)\.(\d{3})\.(\d+)\.(\d{4})$/';
        if (!preg_match($re, trim($ni), $m)) return null;

        return [
            'prefix'     => $m[1],
            'kode_jenis' => $m[2],
            'kode_kat'   => $m[3],
            'urut'       => (int)$m[4],
            'tahun'      => (int)$m[5],
        ];
    }

    protected function resolveOrUpsertJenisFromNI(string $prefix, string $kodeJenis): int
    {
        $jenis = Jenis::firstOrCreate(
            ['kode_jenis' => $kodeJenis],
            ['prefix' => $prefix, 'nama_jenis' => 'Hardware']
        );
        return $jenis->id;
    }
}