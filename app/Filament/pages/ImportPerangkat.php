<?php

namespace App\Filament\Pages;

use App\Models\Perangkat;
use App\Models\Jenis; // Pastikan model ini ada, atau ganti ke JenisPerangkat jika perlu
use App\Models\Lokasi;
use App\Models\Status;
use App\Models\Kondisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use App\Models\User as AppUser;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Imports\Traits\MapsMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Actions\Action;
use UnitEnum;

class ImportPerangkat extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use MapsMaster; // Logic mapping kolom Excel diambil dari Trait ini

    // --- PERBAIKAN TIPE DATA (FIX FATAL ERROR) ---
    // Tipe data harus sama persis dengan parent class Filament\Pages\Page
    
    protected static string | Htmlable | null $navigationIcon  = 'heroicon-o-arrow-up-tray';
    protected static string | Htmlable | null $navigationLabel = 'Import Perangkat (Preview)';
    protected static string | Htmlable | null $title           = 'Import Perangkat (Preview)';
    protected static ?string $slug                             = 'perangkat/import-preview';
    
    // Ini yang menyebabkan error "must be UnitEnum|string|null":
    protected static string | UnitEnum | null $navigationGroup = 'Manajemen Inventaris';

    public array $data = [
        'file'   => null,
        'policy' => 'skip',
    ];
    public array $dupes = [];
    public int $totalRows = 0;
    public ?string $scanToken = null;
    public array $headers = [];
    public array $previewRows = [];
    public int $previewLimit = 50;
    protected int $skippedNoName = 0;
    protected int $skippedDupes = 0;

    // --- ACCESS CONTROL ---
    // Sesuaikan logic ini dengan sistem role/permission Anda
    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user instanceof AppUser && method_exists($user, 'canDo') && $user->canDo('perangkat.import');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }

    public function mount(): void
    {
        $this->bootMasterMaps(); // Load data mapping dari database via Trait
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Upload File')
                ->description('Unggah Excel, klik Scan untuk melihat duplikat sebelum import.')
                ->schema([
                    Forms\Components\FileUpload::make('file')
                        ->label('File Excel')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                        ])
                        ->directory('imports')
                        ->disk('public')
                        ->required(),
                    Forms\Components\Radio::make('policy')
                        ->label('Kebijakan saat duplikat')
                        ->options([
                            'skip'      => 'Skip semua duplikat',
                            'overwrite' => 'Overwrite semua duplikat',
                            'selective' => 'Pilih per item (checklist)',
                        ])
                        ->default('skip')
                        ->afterStateUpdated(function ($set, $state) {
                            if ($state !== 'selective') {
                                $set('selective', []);
                            }
                        })
                        ->inline(),
                    Forms\Components\Actions::make([
                        Forms\Components\Actions\Action::make('scan')
                            ->label('Scan File')
                            ->action('scanFile')
                            ->color('primary')
                            ->icon('heroicon-o-magnifying-glass'),
                    ])->alignLeft(),
                ])->columns(2),

            Forms\Components\Section::make('Preview Isi File')
                ->description('Cuplikan isi file setelah dinormalisasi header (maks. ' . $this->previewLimit . ' baris).')
                ->schema([
                    Forms\Components\View::make('filament.import.preview-table')
                        ->visible(fn() => $this->scanToken !== null),
                ])
                ->visible(fn() => $this->scanToken !== null),

            Forms\Components\Section::make('Preview Duplikat')
                ->description('Nomor inventaris yang sudah ada di database.')
                ->schema([
                    Forms\Components\View::make('filament.import.preview-summary')
                        ->visible(fn() => $this->scanToken !== null),

                    Forms\Components\CheckboxList::make('selective')
                        ->options(fn() => collect($this->dupes)
                            ->map(fn($n) => strtoupper(trim((string)$n)))
                            ->unique()
                            ->mapWithKeys(fn($n) => [$n => $n])
                            ->all())
                        ->columns(2)
                        ->reactive()
                        ->bulkToggleable(false)
                        ->visible(fn() => $this->scanToken !== null && ($this->data['policy'] ?? 'skip') === 'selective'),

                    Forms\Components\Actions::make([
                        Forms\Components\Actions\Action::make('run')
                            ->label('Jalankan Import')
                            ->action('runImport')
                            ->color('success')
                            ->icon('heroicon-o-play')
                            ->requiresConfirmation()
                            ->visible(fn() => $this->scanToken !== null),
                    ])->alignLeft(),
                ])
                ->visible(fn() => !empty($this->dupes) || $this->scanToken !== null),
        ])->statePath('data');
    }

    protected static string $view = 'filament.pages.import-perangkat';

    public function scanFile(): void
    {
        $state = $this->form->getState();
        if (empty($state['file'])) {
            Notification::make()->title('File belum dipilih')->danger()->send();
            return;
        }

        $this->data['policy'] = $state['policy'] ?? 'skip';
        $fullPath = Storage::disk('public')->path($state['file']);

        // Anonymous class untuk membaca Excel
        $collector = new class($this) implements ToCollection, WithHeadingRow {
            public array $rows = [];
            public function __construct(private ImportPerangkat $page) {}
            public function collection(Collection $collection)
            {
                foreach ($collection as $row) {
                    $raw = array_change_key_case($row->toArray(), CASE_LOWER);
                    // PENTING: Gunakan method normalizeRowKeys dari TRAIT MapsMaster
                    $raw = $this->page->normalizeRowKeys($raw);
                    $this->rows[] = $raw;
                }
            }
        };

        try {
            Excel::import($collector, $fullPath);
        } catch (\Exception $e) {
            Notification::make()->title('Gagal membaca file')->body($e->getMessage())->danger()->send();
            return;
        }

        $rows = $collector->rows;
        $this->totalRows = count($rows);

        // Kumpulkan semua keys untuk Header Preview
        $allKeys = [];
        foreach ($rows as $r) {
            foreach (array_keys($r) as $k) {
                $allKeys[$k] = true;
            }
        }

        // List Kolom Prioritas (Sesuai Model Baru & Trait MapsMaster)
        $preferred = [
            'nomor_inventaris',
            'nama_perangkat', 
            'jenis',
            'lokasi',
            'status',
            'kondisi',
            'kategori_excel',      
            'kode_kategori_excel', 
            'merek_alat',     
            'sumber_pendanaan', 
            'tahun_pengadaan',
            'harga_beli',     
            'keterangan',
            'tanggal_pengadaan',
        ];
        
        $others = array_values(array_diff(array_keys($allKeys), $preferred));
        $this->headers = array_values(array_unique(array_merge($preferred, $others)));

        $this->previewRows = array_slice($rows, 0, $this->previewLimit);

        // Cek Duplikat di DB
        $numbers = [];
        foreach ($rows as $r) {
            $n = $this->normalizeNomor($r['nomor_inventaris'] ?? '');
            if ($n) $numbers[] = $n;
        }
        $numbers = array_values(array_unique($numbers));

        $exist = [];
        if (!empty($numbers)) {
            $exist = Perangkat::query()
                ->whereIn('nomor_inventaris', $numbers)
                ->pluck('nomor_inventaris')
                ->all();
        }

        $this->dupes = $exist;
        $this->data['selective'] = [];

        // Cache hasil scan
        $this->scanToken = (string) Str::uuid();
        cache()->put("import_scan:{$this->scanToken}", [
            'file'   => $state['file'],
            'policy' => $this->data['policy'],
            'dupes'  => $this->dupes,
            'total'  => $this->totalRows,
        ], now()->addMinutes(30));

        Notification::make()->title('Scan selesai')->success()->send();
    }

    public function runImport(): void
    {
        if (!$this->scanToken) {
            Notification::make()->title('Belum dilakukan scan')->danger()->send();
            return;
        }
        $scan = cache()->pull("import_scan:{$this->scanToken}");
        if (!$scan) {
            Notification::make()->title('Sesi scan kedaluwarsa, scan ulang')->danger()->send();
            return;
        }

        $filePath = Storage::disk('public')->path($scan['file']);
        $policy   = $this->data['policy'] ?? 'skip';

        // Baca ulang file (untuk memastikan data fresh)
        $collector = new class($this) implements ToCollection, WithHeadingRow {
            public array $rows = [];
            public function __construct(private ImportPerangkat $page) {}
            public function collection(Collection $collection)
            {
                foreach ($collection as $row) {
                    $raw = array_change_key_case($row->toArray(), CASE_LOWER);
                    $raw = $this->page->normalizeRowKeys($raw);
                    $this->rows[] = $raw;
                }
            }
        };
        Excel::import($collector, $filePath);
        $rows = $collector->rows;

        // Siapkan daftar Overwrite
        $allowOverwrite = [];
        if ($policy === 'selective') {
            $allowOverwrite = collect($this->data['selective'] ?? [])
                ->map(fn($n) => strtoupper(trim((string) $n)))
                ->unique()
                ->values()
                ->all();
        }

        $inserted = 0;
        $updated  = 0;
        $this->skippedNoName = 0;
        $this->skippedDupes  = 0;

        DB::beginTransaction();
        try {
            foreach ($rows as $row) {
                // 1. Validasi Nama
                $nama = trim((string) ($row['nama_perangkat'] ?? ''));
                if ($nama === '') {
                    $this->skippedNoName++;
                    continue;
                }

                // 2. Validasi Nomor Inventaris
                $nomor = $this->normalizeNomor($row['nomor_inventaris'] ?? null);

                // 3. Resolve Master Data (Lokasi, Kondisi, Status)
                $lokasi_id  = $this->getOrCreateId($this->lokasiMap,  Lokasi::class,  'nama_lokasi',  $row['lokasi'] ?? null);
                $status_id  = $this->getOrCreateId($this->statusMap,  Status::class,  'nama_status',  $row['status'] ?? 'Baik');
                $kondisi_id = $this->getOrCreateId($this->kondisiMap, Kondisi::class, 'nama_kondisi', $row['kondisi'] ?? 'Baik');

                // 4. Cleaning Data
                $tahun = !empty($row['tahun_pengadaan']) ? (int)$row['tahun_pengadaan'] : (int) now()->year;
                $harga = !empty($row['harga_beli']) ? (int)preg_replace('/\D+/', '', (string)$row['harga_beli']) : 0;
                $tglPengadaan = $this->parseTanggal($row['tanggal_pengadaan'] ?? null);
                
                // 5. Resolve Kategori & Jenis (Via Trait)
                $excelKodeKat = $row['kode_kategori_excel'] ?? null;
                $kategoriObj  = $this->resolveKategoriByKodeAndName($excelKodeKat, $nama);
                $kategori_id  = $kategoriObj ? $kategoriObj->id : null;

                $jenisObj = $this->resolveOrCreateJenisByName($row['jenis'] ?? 'Hardware');
                $jenis_id = $jenisObj ? $jenisObj->id : null;
                
                // Logic Khusus: Jika Nomor Inventaris ada, cek apakah harus update Jenis/Kategori berdasarkan parsing NI
                if ($nomor && ($parts = $this->parseNomorInventaris($nomor))) {
                    $tahun = $parts['tahun'];
                    if (!$jenis_id) {
                         $jenis_id = $this->resolveOrUpsertJenisFromNI($parts['prefix'], $parts['kode_jenis']);
                    }
                    if (!$kategori_id) {
                         $kategori_id = $this->resolveOrCreateKategoriByKode($parts['kode_kat'], $nama);
                    }
                }

                // 6. PROSES SIMPAN / UPDATE
                if ($nomor !== null) {
                    $existing = Perangkat::where('nomor_inventaris', $nomor)->first();
                    
                    if ($existing) {
                        $shouldUpdate = ($policy === 'overwrite') || 
                                        ($policy === 'selective' && in_array($nomor, $allowOverwrite, true));

                        if ($shouldUpdate) {
                            $existing->fill([
                                'nama_perangkat'    => $nama,
                                'merek_alat'        => $row['merek_alat'] ?? null,
                                'sumber_pendanaan'  => $row['sumber_pendanaan'] ?? null,
                                'tahun_pengadaan'   => $tahun,
                                'harga_beli'        => $harga,
                                'keterangan'        => $row['keterangan'] ?? null,
                                'tanggal_pengadaan' => $tglPengadaan,
                                'lokasi_id'         => $lokasi_id,
                                'jenis_id'          => $jenis_id,
                                'status_id'         => $status_id,
                                'kondisi_id'        => $kondisi_id,
                                'kategori_id'       => $kategori_id ?? $existing->kategori_id,
                            ])->save();
                            $updated++;
                        } else {
                            $this->skippedDupes++;
                        }
                        continue;
                    }
                }

                // 7. Insert Baru
                Perangkat::create([
                    'nama_perangkat'    => $nama,
                    'merek_alat'        => $row['merek_alat'] ?? null,
                    'sumber_pendanaan'  => $row['sumber_pendanaan'] ?? null,
                    'tahun_pengadaan'   => $tahun,
                    'nomor_inventaris'  => $nomor,
                    'harga_beli'        => $harga,
                    'keterangan'        => $row['keterangan'] ?? null,
                    'tanggal_pengadaan' => $tglPengadaan,
                    'lokasi_id'         => $lokasi_id,
                    'jenis_id'          => $jenis_id,
                    'status_id'         => $status_id,
                    'kondisi_id'        => $kondisi_id,
                    'kategori_id'       => $kategori_id,
                    // 'created_by'     => auth()->id(),
                ]);
                $inserted++;
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Notification::make()->title('Error Import')->body($e->getMessage())->danger()->send();
            return;
        }

        $msg = "Insert: {$inserted}, Update: {$updated}";
        if ($this->skippedNoName > 0 || $this->skippedDupes > 0) {
            $msg .= " | Skip(Tanpa Nama): {$this->skippedNoName}, Skip(Duplikat): {$this->skippedDupes}";
        }

        Notification::make()->title('Import selesai')->body($msg)->success()->send();

        // Reset Form
        $this->data = ['file' => null, 'policy' => 'skip', 'selective' => []];
        $this->dupes = [];
        $this->totalRows = 0;
        $this->scanToken = null;
        $this->form->fill($this->data);
    }
}