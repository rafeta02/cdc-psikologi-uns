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

        // Get draft if draft_id is provided
        $draft = null;
        if (request('draft_id')) {
            $draft = PrestasiMahasiswa::where('id', request('draft_id'))
                ->where('user_id', auth()->id())
                ->where('is_draft', true)
                ->with(['pesertas'])
                ->first();
        }

        return view('frontend.prestasiMahasiswas.create', compact('kategoris', 'users', 'draft'));
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

        // Handle file uploads
        $fileCollections = [
            'surat_tugas' => 'surat_tugas',
            'sertifikat' => 'sertifikat',
            'foto_dokumentasi' => 'foto_dokumentasi',
            'bukti_sipsmart' => 'bukti_sipsmart'
        ];

        foreach ($fileCollections as $inputName => $collectionName) {
            // Remove files that are no longer in the request
            if (count($prestasiMahasiswa->$collectionName) > 0) {
                foreach ($prestasiMahasiswa->$collectionName as $media) {
                    if (!in_array($media->file_name, $request->input($inputName, []))) {
                        $media->delete();
                    }
                }
            }

            // Get existing media files
            $media = $prestasiMahasiswa->$collectionName->pluck('file_name')->toArray();

            // Add new files
            foreach ($request->input($inputName, []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $filePath = storage_path('tmp/uploads/' . basename($file));
                    if (file_exists($filePath)) {
                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                        $newFileName = $prestasiMahasiswa->nama_kegiatan . '_' . $inputName . '_' . uniqid() . '.' . $extension;
                        $newFilePath = storage_path('tmp/uploads/' . $newFileName);
                        
                        if (copy($filePath, $newFilePath)) {
                            $prestasiMahasiswa->addMedia($newFilePath)->toMediaCollection($collectionName);
                        }
                    }
                }
            }
        }

        // Handle single file upload (surat_tugas_pembimbing)
        if ($request->input('surat_tugas_pembimbing', false)) {
            if (!$prestasiMahasiswa->surat_tugas_pembimbing || 
                $request->input('surat_tugas_pembimbing') !== $prestasiMahasiswa->surat_tugas_pembimbing->file_name) {
                
                if ($prestasiMahasiswa->surat_tugas_pembimbing) {
                    $prestasiMahasiswa->surat_tugas_pembimbing->delete();
                }

                $filePath = storage_path('tmp/uploads/' . basename($request->input('surat_tugas_pembimbing')));
                if (file_exists($filePath)) {
                    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                    $newFileName = $prestasiMahasiswa->nama_kegiatan . '_surat_tugas_pembimbing_' . uniqid() . '.' . $extension;
                    $newFilePath = storage_path('tmp/uploads/' . $newFileName);
                    
                    if (copy($filePath, $newFilePath)) {
                        $prestasiMahasiswa->addMedia($newFilePath)->toMediaCollection('surat_tugas_pembimbing');
                    }
                }
            }
        } elseif ($prestasiMahasiswa->surat_tugas_pembimbing) {
            $prestasiMahasiswa->surat_tugas_pembimbing->delete();
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

        $draftId = $request->input('draft_id');
        $currentStep = $request->input('current_step');
        $saveAsDraft = $request->input('save_as_draft', false);

        try {
            // Prepare data with default values for required fields
            $data = array_merge(
                // Convert null values to empty strings for string fields
                collect($request->except(['_token', '_method', 'draft_id', 'current_step', 'save_as_draft']))
                    ->map(function ($value, $key) {
                        // If the value is null and the field is a string field, return empty string
                        if (is_null($value) && in_array($key, [
                            'nama_penyelenggara',
                            'tempat_penyelenggara',
                            'dosen_pembimbing',
                            'url_publikasi',
                            'no_wa',
                            'informasi_lomba',
                            'tips_trik'
                        ])) {
                            return '';
                        }
                        return $value;
                    })
                    ->toArray(),
                [
                    'current_step' => $currentStep,
                    'is_draft' => true,
                    // Set default values for required fields if they're not provided
                    'jumlah_peserta' => $request->input('jumlah_peserta', 'individu'),
                    'perolehan_juara' => $request->input('perolehan_juara', 'juara_1'),
                    'keikutsertaan' => $request->input('keikutsertaan', 'offline'),
                    'bersedia_mentoring' => $request->input('bersedia_mentoring', '0'),
                    // Set empty string defaults for required string fields
                    'nama_penyelenggara' => $request->input('nama_penyelenggara', ''),
                    'tempat_penyelenggara' => $request->input('tempat_penyelenggara', ''),
                    'dosen_pembimbing' => $request->input('dosen_pembimbing', ''),
                    'url_publikasi' => $request->input('url_publikasi', ''),
                    'no_wa' => $request->input('no_wa', ''),
                    'informasi_lomba' => $request->input('informasi_lomba', ''),
                    'tips_trik' => $request->input('tips_trik', '')
                ]
            );

            if ($draftId) {
                // Update existing draft
                $prestasi = PrestasiMahasiswa::where('id', $draftId)
                    ->where('user_id', auth()->id())
                    ->first();

                if (!$prestasi) {
                    throw new \Exception('Draft not found');
                }

                // Update the draft with new data
                $prestasi->update($data);

                // Handle peserta if in step 2
                if ($currentStep == 2 && $request->has('nama_peserta')) {
                    // Delete existing peserta
                    PrestasiMahasiswaDetail::where('prestasi_mahasiswa_id', $prestasi->id)->delete();
                    
                    // Add new peserta
                    foreach ($request->input('nama_peserta') as $key => $nama) {
                        if (!empty($nama)) {
                            PrestasiMahasiswaDetail::create([
                                'prestasi_mahasiswa_id' => $prestasi->id,
                                'nama' => $nama,
                                'nim' => $request->input('nim_peserta')[$key] ?? ''
                            ]);
                        }
                    }
                }

            } else {
                // Add user_id to data array for new drafts
                $data['user_id'] = auth()->id();

                // Create new draft
                $prestasi = PrestasiMahasiswa::create($data);

                // Handle peserta if in step 2
                if ($currentStep == 2 && $request->has('nama_peserta')) {
                    foreach ($request->input('nama_peserta') as $key => $nama) {
                        if (!empty($nama)) {
                            PrestasiMahasiswaDetail::create([
                                'prestasi_mahasiswa_id' => $prestasi->id,
                                'nama' => $nama,
                                'nim' => $request->input('nim_peserta')[$key] ?? ''
                            ]);
                        }
                    }
                }
            }

            // Handle file uploads if in step 3
            if ($currentStep == 3) {
                $fileCollections = [
                    'surat_tugas' => 'surat_tugas',
                    'sertifikat' => 'sertifikat',
                    'foto_dokumentasi' => 'foto_dokumentasi',
                    'surat_tugas_pembimbing' => 'surat_tugas_pembimbing',
                    'bukti_sipsmart' => 'bukti_sipsmart'
                ];

                foreach ($fileCollections as $inputName => $collectionName) {
                    if ($request->has($inputName)) {
                        $files = is_array($request->input($inputName)) ? 
                            $request->input($inputName) : 
                            [$request->input($inputName)];

                        foreach ($files as $file) {
                            if ($file) {
                                $filePath = storage_path('tmp/uploads/' . basename($file));
                                if (file_exists($filePath)) {
                                    $prestasi->addMedia($filePath)->toMediaCollection($collectionName);
                                }
                            }
                        }
                    }
                }
            }

            return response()->json([
                'success' => true,
                'draft_id' => $prestasi->id,
                'message' => $saveAsDraft ? 'Draft saved successfully' : 'Step saved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getDraft(Request $request)
    {
        try {
            $draft = PrestasiMahasiswa::where('id', $request->draft_id)
                ->where('user_id', auth()->id())
                ->where('is_draft', true)
                ->with(['pesertas'])
                ->first();

            if (!$draft) {
                throw new \Exception('Draft not found');
            }

            // Get file information
            $fileCollections = [
                'surat_tugas_files' => $draft->getMedia('surat_tugas'),
                'sertifikat_files' => $draft->getMedia('sertifikat'),
                'foto_dokumentasi_files' => $draft->getMedia('foto_dokumentasi'),
                'surat_tugas_pembimbing_file' => $draft->getMedia('surat_tugas_pembimbing')->first(),
                'bukti_sipsmart_files' => $draft->getMedia('bukti_sipsmart')
            ];

            // Format file information
            $formattedFiles = [];
            foreach ($fileCollections as $key => $collection) {
                if ($key === 'surat_tugas_pembimbing_file' && $collection) {
                    $formattedFiles[$key] = [
                        'name' => $collection->file_name,
                        'size' => $collection->size,
                        'url' => $collection->getUrl()
                    ];
                } elseif (is_array($collection) || is_object($collection)) {
                    $formattedFiles[$key] = $collection->map(function($file) {
                        return [
                            'name' => $file->file_name,
                            'size' => $file->size,
                            'url' => $file->getUrl()
                        ];
                    })->toArray();
                }
            }

            // Prepare response data
            $responseData = array_merge($draft->toArray(), $formattedFiles);

            return response()->json([
                'success' => true,
                'draft' => $responseData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
