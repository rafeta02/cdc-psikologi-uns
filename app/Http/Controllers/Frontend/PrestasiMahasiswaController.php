<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPrestasiMahasiswaRequest;
use App\Http\Requests\StorePrestasiMahasiswaRequest;
use App\Http\Requests\UpdatePrestasiMahasiswaRequest;
use App\Models\KategoriPrestasi;
use App\Models\PrestasiMahasiswa;
use App\Models\PrestasiMahasiswaDetail;
use App\Models\User;
use Gate;
use PDF;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\PrestasiMahasiswa as PrestasiMahasiswaModel;
use App\Models\PrestasiMahasiswaDetail as PrestasiMahasiswaDetailModel;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\App;

class PrestasiMahasiswaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('prestasi_mahasiswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMahasiswas = PrestasiMahasiswa::with(['user', 'kategori', 'media'])->get();

        return view('frontend.prestasiMahasiswas.index', compact('prestasiMahasiswas'));
    }

    public function create()
    {
        abort_if(Gate::denies('prestasi_mahasiswa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kategoris = KategoriPrestasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.prestasiMahasiswas.create', compact('kategoris', 'users'));
    }

    public function store(StorePrestasiMahasiswaRequest $request)
    {
        $draftId = $request->input('draft_id');
        
        if ($draftId) {
            // Update the existing draft
            $prestasiMahasiswa = PrestasiMahasiswa::find($draftId);
            
            // Make sure the user owns this draft
            if (!$prestasiMahasiswa || $prestasiMahasiswa->user_id != auth()->id()) {
                return redirect()->route('frontend.prestasi-mahasiswas.create')
                    ->with('error', 'Invalid draft ID');
            }
            
            // Check if all required files are uploaded
            $requiredFilesUploaded = 
                $request->has('surat_tugas') && count($request->input('surat_tugas', [])) > 0 &&
                $request->has('sertifikat') && count($request->input('sertifikat', [])) > 0 &&
                $request->has('foto_dokumentasi') && count($request->input('foto_dokumentasi', [])) > 0 &&
                $request->has('surat_tugas_pembimbing') && $request->input('surat_tugas_pembimbing') &&
                $request->has('bukti_sipsmart') && count($request->input('bukti_sipsmart', [])) > 0;
            
            // Update the record with all form data
            $prestasiMahasiswa->update(array_merge(
                $request->all(),
                ['is_draft' => !$requiredFilesUploaded] // Mark as no longer a draft only if all files are uploaded
            ));
            
            if (!$requiredFilesUploaded) {
                return redirect()->route('frontend.prestasi-mahasiswas.create', ['draft_id' => $prestasiMahasiswa->id])
                    ->with('error', 'All document uploads are required. Please upload all required files in Step 3.');
            }
            
            // Update peserta details
            if ($request->has('nama_peserta') && is_array($request->input('nama_peserta'))) {
                // Delete existing peserta records
                PrestasiMahasiswaDetail::where('prestasi_mahasiswa_id', $prestasiMahasiswa->id)->delete();
                
                // Create new peserta records
                foreach ($request->input('nama_peserta') as $key => $nama) {
                    if (!empty($nama)) {
                        PrestasiMahasiswaDetail::create([
                            'nim' => $request->nim_peserta[$key] ?? '',
                            'nama' => $nama,
                            'prestasi_mahasiswa_id' => $prestasiMahasiswa->id,
                        ]);
                    }
                }
            }
        } else {
            // Check if all required files are uploaded
            $requiredFilesUploaded = 
                $request->has('surat_tugas') && count($request->input('surat_tugas', [])) > 0 &&
                $request->has('sertifikat') && count($request->input('sertifikat', [])) > 0 &&
                $request->has('foto_dokumentasi') && count($request->input('foto_dokumentasi', [])) > 0 &&
                $request->has('surat_tugas_pembimbing') && $request->input('surat_tugas_pembimbing') &&
                $request->has('bukti_sipsmart') && count($request->input('bukti_sipsmart', [])) > 0;
            
            // Create a new record
            $prestasiMahasiswa = PrestasiMahasiswa::create(array_merge(
                $request->all(),
                [
                    'user_id' => auth()->id(), 
                    'is_draft' => !$requiredFilesUploaded
                ]
            ));
            
            if (!$requiredFilesUploaded) {
                return redirect()->route('frontend.prestasi-mahasiswas.create', ['draft_id' => $prestasiMahasiswa->id])
                    ->with('error', 'All document uploads are required. Please upload all required files in Step 3.');
            }
            
            // Save the Nama Peserta and NIM Peserta to PrestasiMahasiswaDetail
            if ($request->has('nama_peserta') && is_array($request->input('nama_peserta'))) {
                foreach ($request->input('nama_peserta') as $key => $nama) {
                    if (!empty($nama)) {
                        PrestasiMahasiswaDetail::create([
                            'nim' => $request->nim_peserta[$key] ?? '',
                            'nama' => $nama,
                            'prestasi_mahasiswa_id' => $prestasiMahasiswa->id,
                        ]);
                    }
                }
            }
        }

        // Handle file uploads using the existing media handling logic
        foreach ($request->input('surat_tugas', []) as $file) {
            $filePath = storage_path('tmp/uploads/' . basename($file));
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            $newFileName = $prestasiMahasiswa->nama_kegiatan .'_surat_tugas_' . uniqid(). '.' . $extension;
            $newFilePath = storage_path('tmp/uploads/' . $newFileName);
            rename($filePath, $newFilePath);

            if (file_exists($newFilePath)) {
                $prestasiMahasiswa->addMedia($newFilePath)->toMediaCollection('surat_tugas');
            }
        }

        foreach ($request->input('sertifikat', []) as $file) {
            $filePath = storage_path('tmp/uploads/' . basename($file));
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            $newFileName = $prestasiMahasiswa->nama_kegiatan .'_sertifikat_' . uniqid(). '.' . $extension;
            $newFilePath = storage_path('tmp/uploads/' . $newFileName);
            rename($filePath, $newFilePath);

            if (file_exists($newFilePath)) {
                $prestasiMahasiswa->addMedia($newFilePath)->toMediaCollection('sertifikat');
            }
        }

        foreach ($request->input('foto_dokumentasi', []) as $file) {
            $filePath = storage_path('tmp/uploads/' . basename($file));
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            $newFileName = $prestasiMahasiswa->nama_kegiatan .'_foto_dokumentasi_' . uniqid(). '.' . $extension;
            $newFilePath = storage_path('tmp/uploads/' . $newFileName);
            rename($filePath, $newFilePath);

            if (file_exists($newFilePath)) {
                $prestasiMahasiswa->addMedia($newFilePath)->toMediaCollection('foto_dokumentasi');
            }
        }

        if ($request->input('surat_tugas_pembimbing', false)) {
            $filePath = storage_path('tmp/uploads/' . basename($request->input('surat_tugas_pembimbing')));
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            $newFileName = $prestasiMahasiswa->nama_kegiatan .'_surat_tugas_pembimbing_' . uniqid(). '.' . $extension;
            $newFilePath = storage_path('tmp/uploads/' . $newFileName);
            rename($filePath, $newFilePath);

            if (file_exists($newFilePath)) {
                $prestasiMahasiswa->addMedia($newFilePath)->toMediaCollection('surat_tugas_pembimbing');
            }
        }

        foreach ($request->input('bukti_sipsmart', []) as $file) {
            $filePath = storage_path('tmp/uploads/' . basename($file));
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            $newFileName = $prestasiMahasiswa->nama_kegiatan .'_bukti_sipsmart_' . uniqid(). '.' . $extension;
            $newFilePath = storage_path('tmp/uploads/' . $newFileName);
            rename($filePath, $newFilePath);

            if (file_exists($newFilePath)) {
                $prestasiMahasiswa->addMedia($newFilePath)->toMediaCollection('bukti_sipsmart');
            }
        }

        // Get student name for congratulations message
        $studentName = '';
        if ($prestasiMahasiswa->pesertas && count($prestasiMahasiswa->pesertas) > 0) {
            $studentName = $prestasiMahasiswa->pesertas[0]->nama;
        } else {
            $studentName = auth()->user()->name;
        }

        // Get achievement type
        $achievement = PrestasiMahasiswaModel::PEROLEHAN_JUARA_SELECT[$prestasiMahasiswa->perolehan_juara] ?? 'achievement';

        // Create congratulations message
        $congratsMessage = "Congratulations! Thank you {$studentName} for the outstanding {$achievement} on {$prestasiMahasiswa->nama_kegiatan} by {$prestasiMahasiswa->nama_penyelenggara}. Your name has been listed on the Faculty of Psychology web of achievers.";

        return redirect()->route('frontend.prestasi-mahasiswas.index')
            ->with('success', $congratsMessage);
    }

    public function edit(PrestasiMahasiswa $prestasiMahasiswa)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kategoris = KategoriPrestasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prestasiMahasiswa->load('user', 'kategori');

        return view('frontend.prestasiMahasiswas.edit', compact('kategoris', 'prestasiMahasiswa', 'users'));
    }

    public function update(UpdatePrestasiMahasiswaRequest $request, PrestasiMahasiswa $prestasiMahasiswa)
    {
        $prestasiMahasiswa->update($request->all());

        if (count($prestasiMahasiswa->surat_tugas) > 0) {
            foreach ($prestasiMahasiswa->surat_tugas as $media) {
                if (! in_array($media->file_name, $request->input('surat_tugas', []))) {
                    $media->delete();
                }
            }
        }
        $media = $prestasiMahasiswa->surat_tugas->pluck('file_name')->toArray();
        foreach ($request->input('surat_tugas', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('surat_tugas');
            }
        }

        if (count($prestasiMahasiswa->sertifikat) > 0) {
            foreach ($prestasiMahasiswa->sertifikat as $media) {
                if (! in_array($media->file_name, $request->input('sertifikat', []))) {
                    $media->delete();
                }
            }
        }
        $media = $prestasiMahasiswa->sertifikat->pluck('file_name')->toArray();
        foreach ($request->input('sertifikat', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('sertifikat');
            }
        }

        if (count($prestasiMahasiswa->foto_dokumentasi) > 0) {
            foreach ($prestasiMahasiswa->foto_dokumentasi as $media) {
                if (! in_array($media->file_name, $request->input('foto_dokumentasi', []))) {
                    $media->delete();
                }
            }
        }
        $media = $prestasiMahasiswa->foto_dokumentasi->pluck('file_name')->toArray();
        foreach ($request->input('foto_dokumentasi', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('foto_dokumentasi');
            }
        }

        if ($request->input('surat_tugas_pembimbing', false)) {
            if (! $prestasiMahasiswa->surat_tugas_pembimbing || $request->input('surat_tugas_pembimbing') !== $prestasiMahasiswa->surat_tugas_pembimbing->file_name) {
                if ($prestasiMahasiswa->surat_tugas_pembimbing) {
                    $prestasiMahasiswa->surat_tugas_pembimbing->delete();
                }
                $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_tugas_pembimbing'))))->toMediaCollection('surat_tugas_pembimbing');
            }
        } elseif ($prestasiMahasiswa->surat_tugas_pembimbing) {
            $prestasiMahasiswa->surat_tugas_pembimbing->delete();
        }

        if (count($prestasiMahasiswa->bukti_sipsmart) > 0) {
            foreach ($prestasiMahasiswa->bukti_sipsmart as $media) {
                if (! in_array($media->file_name, $request->input('bukti_sipsmart', []))) {
                    $media->delete();
                }
            }
        }
        $media = $prestasiMahasiswa->bukti_sipsmart->pluck('file_name')->toArray();
        foreach ($request->input('bukti_sipsmart', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('bukti_sipsmart');
            }
        }

        return redirect()->route('frontend.prestasi-mahasiswas.index');
    }

    public function show(PrestasiMahasiswa $prestasiMahasiswa)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMahasiswa->load('user', 'kategori', 'pesertas');

        return view('frontend.prestasiMahasiswas.show', compact('prestasiMahasiswa'));
    }

    public function destroy(PrestasiMahasiswa $prestasiMahasiswa)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMahasiswa->delete();

        return back();
    }

    public function massDestroy(MassDestroyPrestasiMahasiswaRequest $request)
    {
        $prestasiMahasiswas = PrestasiMahasiswa::find(request('ids'));

        foreach ($prestasiMahasiswas as $prestasiMahasiswa) {
            $prestasiMahasiswa->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_create') && Gate::denies('prestasi_mahasiswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PrestasiMahasiswa();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function printBukti(Request $request)
    {
        $prestasi = PrestasiMahasiswa::with('pesertas')->find($request->id);
        $pdf = PDF::loadView('pdf.bukti', compact('prestasi'));
        return $pdf->download('bukti-prestasi.pdf');
    }

    public function saveStep(Request $request)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $step = $request->input('save_step');
        $draftId = $request->input('draft_id');
        $is_draft = true; // Always save as draft when using this method
        $is_explicit_draft = $request->has('save_as_draft'); // Flag to indicate user clicked "Save as Draft" button

        try {
            // If we already have a draft, update it
            if ($draftId) {
                $prestasiMahasiswa = PrestasiMahasiswa::find($draftId);

                // Make sure the user owns this draft
                if (!$prestasiMahasiswa || $prestasiMahasiswa->user_id != auth()->id()) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['draft_id' => 'Invalid draft ID']
                    ], 400);
                }

                // Update the record based on the step
                switch ($step) {
                    case 1:
                        $prestasiMahasiswa->update([
                            'skim' => $request->input('skim'),
                            'tingkat' => $request->input('tingkat'),
                            'nama_kegiatan' => $request->input('nama_kegiatan'),
                            'kategori_id' => $request->input('kategori_id'),
                            'tanggal_awal' => $request->input('tanggal_awal'),
                            'tanggal_akhir' => $request->input('tanggal_akhir'),
                            'current_step' => $step,
                            'is_draft' => $is_draft,
                        ]);
                        break;
                    case 2:
                        $prestasiMahasiswa->update([
                            'jumlah_peserta' => $request->input('jumlah_peserta'),
                            'perolehan_juara' => $request->input('perolehan_juara'),
                            'nama_penyelenggara' => $request->input('nama_penyelenggara'),
                            'tempat_penyelenggara' => $request->input('tempat_penyelenggara'),
                            'keikutsertaan' => $request->input('keikutsertaan'),
                            'url_publikasi' => $request->input('url_publikasi'),
                            'dosen_pembimbing' => $request->input('dosen_pembimbing'),
                            'current_step' => $step,
                            'is_draft' => $is_draft,
                        ]);

                        // Update peserta details
                        if ($request->has('nama_peserta') && is_array($request->input('nama_peserta'))) {
                            // Delete existing peserta records
                            PrestasiMahasiswaDetail::where('prestasi_mahasiswa_id', $prestasiMahasiswa->id)->delete();
                            
                            // Create new peserta records
                            foreach ($request->input('nama_peserta') as $key => $nama) {
                                if (!empty($nama)) {
                                    PrestasiMahasiswaDetail::create([
                                        'nim' => $request->nim_peserta[$key] ?? '',
                                        'nama' => $nama,
                                        'prestasi_mahasiswa_id' => $prestasiMahasiswa->id,
                                    ]);
                                }
                            }
                        }
                        break;
                    case 3:
                        $prestasiMahasiswa->update([
                            'no_wa' => $request->input('no_wa'),
                            'current_step' => $step,
                            'is_draft' => $is_draft,
                        ]);

                        // Only validate files if this isn't explicitly saving as a draft
                        // and we're trying to advance to the next step
                        if (!$is_explicit_draft) {
                            // Check if all required files are present
                            $suratTugas = $prestasiMahasiswa->getMedia('surat_tugas')->count() > 0;
                            $sertifikat = $prestasiMahasiswa->getMedia('sertifikat')->count() > 0;
                            $fotoDokumentasi = $prestasiMahasiswa->getMedia('foto_dokumentasi')->count() > 0;
                            $suratTugasPembimbing = $prestasiMahasiswa->getMedia('surat_tugas_pembimbing')->count() > 0;
                            $buktiSipsmart = $prestasiMahasiswa->getMedia('bukti_sipsmart')->count() > 0;
                            
                            $hasAllFiles = $suratTugas && $sertifikat && $fotoDokumentasi && 
                                          $suratTugasPembimbing && $buktiSipsmart;
                            
                            if (!$hasAllFiles) {
                                $missingFiles = [];
                                if (!$suratTugas) $missingFiles[] = 'Surat Tugas';
                                if (!$sertifikat) $missingFiles[] = 'Sertifikat';
                                if (!$fotoDokumentasi) $missingFiles[] = 'Foto Dokumentasi';
                                if (!$suratTugasPembimbing) $missingFiles[] = 'Surat Tugas Pembimbing';
                                if (!$buktiSipsmart) $missingFiles[] = 'Bukti SIPSMART';
                                
                                return response()->json([
                                    'success' => false,
                                    'message' => 'Document uploads are incomplete',
                                    'missing_files' => $missingFiles,
                                    'errors' => [
                                        'files' => 'Please upload all required documents before proceeding.'
                                    ]
                                ], 422);
                            }
                        }
                        
                        // File uploads are handled separately through the storeMedia route
                        break;
                }
            } else {
                // Create a new draft
                $prestasiMahasiswa = PrestasiMahasiswa::create([
                    'user_id' => auth()->id(),
                    'skim' => $request->input('skim'),
                    'tingkat' => $request->input('tingkat'),
                    'nama_kegiatan' => $request->input('nama_kegiatan') ?? 'Draft',
                    'kategori_id' => $request->input('kategori_id'),
                    'tanggal_awal' => $request->input('tanggal_awal'),
                    'tanggal_akhir' => $request->input('tanggal_akhir'),
                    'jumlah_peserta' => $request->input('jumlah_peserta') ?? '>10',
                    'perolehan_juara' => $request->input('perolehan_juara') ?? 'peserta',
                    'nama_penyelenggara' => $request->input('nama_penyelenggara') ?? 'Draft',
                    'tempat_penyelenggara' => $request->input('tempat_penyelenggara') ?? 'Draft',
                    'keikutsertaan' => $request->input('keikutsertaan'),
                    'url_publikasi' => $request->input('url_publikasi'),
                    'dosen_pembimbing' => $request->input('dosen_pembimbing'),
                    'no_wa' => $request->input('no_wa') ?? '0',
                    'current_step' => $step,
                    'is_draft' => $is_draft,
                ]);

                // Create peserta records if step 2 is being saved immediately
                if ($step == 2 && $request->has('nama_peserta') && is_array($request->input('nama_peserta'))) {
                    foreach ($request->input('nama_peserta') as $key => $nama) {
                        if (!empty($nama)) {
                            PrestasiMahasiswaDetail::create([
                                'nim' => $request->nim_peserta[$key] ?? '',
                                'nama' => $nama,
                                'prestasi_mahasiswa_id' => $prestasiMahasiswa->id,
                            ]);
                        }
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Step ' . $step . ' saved successfully',
                'draft_id' => $prestasiMahasiswa->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving step data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getDraft(Request $request)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $draftId = $request->input('draft_id');

        if (!$draftId) {
            return response()->json([
                'success' => false,
                'message' => 'No draft ID provided'
            ], 400);
        }

        try {
            $draft = PrestasiMahasiswa::find($draftId);

            if (!$draft || $draft->user_id != auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Draft not found or you do not have permission to access it'
                ], 404);
            }

            // Load the peserta (participant) details
            $pesertaDetails = PrestasiMahasiswaDetail::where('prestasi_mahasiswa_id', $draft->id)->get();
            
            // Format data for the frontend
            $draftData = $draft->toArray();
            $draftData['nama_peserta'] = $pesertaDetails->pluck('nama')->toArray();
            $draftData['nim_peserta'] = $pesertaDetails->pluck('nim')->toArray();

            // Add media URLs
            if ($draft->getMedia('surat_tugas')->count() > 0) {
                $draftData['surat_tugas_files'] = $draft->getMedia('surat_tugas')->map(function ($media) {
                    return [
                        'name' => $media->file_name,
                        'url' => $media->getUrl(),
                    ];
                })->toArray();
            }

            if ($draft->getMedia('sertifikat')->count() > 0) {
                $draftData['sertifikat_files'] = $draft->getMedia('sertifikat')->map(function ($media) {
                    return [
                        'name' => $media->file_name,
                        'url' => $media->getUrl(),
                    ];
                })->toArray();
            }

            if ($draft->getMedia('foto_dokumentasi')->count() > 0) {
                $draftData['foto_dokumentasi_files'] = $draft->getMedia('foto_dokumentasi')->map(function ($media) {
                    return [
                        'name' => $media->file_name,
                        'url' => $media->getUrl(),
                    ];
                })->toArray();
            }

            if ($draft->getMedia('surat_tugas_pembimbing')->count() > 0) {
                $draftData['surat_tugas_pembimbing_file'] = [
                    'name' => $draft->getMedia('surat_tugas_pembimbing')->first()->file_name,
                    'url' => $draft->getMedia('surat_tugas_pembimbing')->first()->getUrl(),
                ];
            }

            if ($draft->getMedia('bukti_sipsmart')->count() > 0) {
                $draftData['bukti_sipsmart_files'] = $draft->getMedia('bukti_sipsmart')->map(function ($media) {
                    return [
                        'name' => $media->file_name,
                        'url' => $media->getUrl(),
                    ];
                })->toArray();
            }

            return response()->json([
                'success' => true,
                'draft' => $draftData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving draft data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
