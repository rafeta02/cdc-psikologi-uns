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
use QrCode;
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

    public function create(Request $request)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $kategoris = KategoriPrestasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // Check if we're editing an existing record (draft or regular edit)
        $prestasiMahasiswa = null;
        
        // Check for draft_id parameter (from "Lanjutkan Pengisian" button)
        if ($request->has('draft_id')) {
            $prestasiMahasiswa = PrestasiMahasiswa::with(['pesertas', 'kategori', 'user', 'media'])
                ->where('id', $request->draft_id)
                ->where('user_id', auth()->id()) // Ensure user can only edit their own records
                ->first();
        }
        
        // Check for id parameter (from direct edit link)
        if ($request->has('id')) {
            $prestasiMahasiswa = PrestasiMahasiswa::with(['pesertas', 'kategori', 'user', 'media'])
                ->where('id', $request->id)
                ->where('user_id', auth()->id()) // Ensure user can only edit their own records
                ->first();
        }

        return view('frontend.prestasiMahasiswas.create', compact('kategoris', 'users', 'prestasiMahasiswa'));
    }

    public function store(StorePrestasiMahasiswaRequest $request)
    {
        // Check if we're updating an existing record
        $prestasiMahasiswa = null;
        $isUpdate = false;
        
        // If there's a hidden field indicating this is an update
        if ($request->has('prestasi_mahasiswa_id') && $request->prestasi_mahasiswa_id) {
            $prestasiMahasiswa = PrestasiMahasiswa::where('id', $request->prestasi_mahasiswa_id)
                ->where('user_id', auth()->id())
                ->first();
            $isUpdate = true;
        }

        if ($isUpdate && $prestasiMahasiswa) {
            // Update existing record
            $prestasiMahasiswa->update(array_merge(
                $request->all(),
                [
                    'user_id' => auth()->id(), 
                    'is_draft' => $request->input('is_draft', false),
                    // Reset validation status to pending when user edits submission
                    'validation_status' => 'pending',
                    'validation_notes' => null,
                    'validated_at' => null,
                    'validated_by' => null,
                ]
            ));
            
            // Delete existing participants and re-create them
            $prestasiMahasiswa->pesertas()->delete();
        } else {
            // Create new record
            $prestasiMahasiswa = PrestasiMahasiswa::create(array_merge(
                $request->all(),
                [
                    'user_id' => auth()->id(), 
                    'is_draft' => $request->input('is_draft', false)
                ]
            ));
        }
        
        // Save participants (for both create and update)
        if ($request->has('peserta') && is_array($request->input('peserta'))) {
            foreach ($request->input('peserta') as $pesertaData) {
                if (!empty($pesertaData['nama']) && !empty($pesertaData['nim'])) {
                    PrestasiMahasiswaDetail::create([
                        'nama' => $pesertaData['nama'],
                        'nim' => $pesertaData['nim'],
                        'prestasi_mahasiswa_id' => $prestasiMahasiswa->id,
                    ]);
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

        \Log::info('=== STORE METHOD FILE HANDLING ===');
        \Log::info('Is update: ' . ($isUpdate ? 'true' : 'false'));
        
        foreach ($fileCollections as $inputName => $collectionName) {
            $inputFiles = $request->input($inputName, []);
            \Log::info("Processing {$inputName}: " . json_encode($inputFiles));
            
            // For updates, only remove existing files if we have NEW files to upload
            if ($isUpdate) {
                $hasValidNewFiles = false;
                
                // Check if we actually have new files to upload (files that exist in tmp/uploads)
                foreach ($inputFiles as $file) {
                    $filePath = storage_path('tmp/uploads/' . basename($file));
                    if (file_exists($filePath)) {
                        $hasValidNewFiles = true;
                        \Log::info("- Found new file to upload: {$file}");
                        break;
                    }
                }
                
                \Log::info("- Has valid new files: " . ($hasValidNewFiles ? 'true' : 'false'));
                
                // Only delete existing files if we have valid new files to replace them
                if ($hasValidNewFiles) {
                    $existingCount = $prestasiMahasiswa->getMedia($collectionName)->count();
                    \Log::info("- Deleting {$existingCount} existing files for {$inputName}");
                    $prestasiMahasiswa->getMedia($collectionName)->each->delete();
                } else {
                    $existingCount = $prestasiMahasiswa->getMedia($collectionName)->count();
                    \Log::info("- Preserving {$existingCount} existing files for {$inputName}");
                }
            }
            
            // Only process files that actually exist in tmp/uploads (newly uploaded files)
            $processedCount = 0;
            foreach ($request->input($inputName, []) as $file) {
                $filePath = storage_path('tmp/uploads/' . basename($file));
                if (file_exists($filePath)) {
                    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                    $newFileName = $prestasiMahasiswa->nama_kegiatan . '_' . $inputName . '_' . uniqid() . '.' . $extension;
                    $newFilePath = storage_path('tmp/uploads/' . $newFileName);
                    
                    if (copy($filePath, $newFilePath)) {
                        $prestasiMahasiswa->addMedia($newFilePath)->toMediaCollection($collectionName);
                        $processedCount++;
                    }
                }
            }
            \Log::info("- Processed {$processedCount} new files for {$inputName}");
        }

        // Handle single file upload (surat_tugas_pembimbing)
        \Log::info('Processing surat_tugas_pembimbing...');
        if ($request->input('surat_tugas_pembimbing', false)) {
            $filePath = storage_path('tmp/uploads/' . basename($request->input('surat_tugas_pembimbing')));
            \Log::info("- File path: {$filePath}");
            \Log::info("- File exists: " . (file_exists($filePath) ? 'true' : 'false'));
            
            // For updates, only remove existing file if we have a new file to upload
            if ($isUpdate && file_exists($filePath)) {
                $existingCount = $prestasiMahasiswa->getMedia('surat_tugas_pembimbing')->count();
                \Log::info("- Deleting {$existingCount} existing pembimbing files");
                $prestasiMahasiswa->getMedia('surat_tugas_pembimbing')->each->delete();
            } elseif ($isUpdate) {
                $existingCount = $prestasiMahasiswa->getMedia('surat_tugas_pembimbing')->count();
                \Log::info("- Preserving {$existingCount} existing pembimbing files");
            }
            
            // Only process if the file actually exists in tmp/uploads (newly uploaded)
            if (file_exists($filePath)) {
                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                $newFileName = $prestasiMahasiswa->nama_kegiatan . '_surat_tugas_pembimbing_' . uniqid() . '.' . $extension;
                $newFilePath = storage_path('tmp/uploads/' . $newFileName);
                
                if (copy($filePath, $newFilePath)) {
                    $prestasiMahasiswa->addMedia($newFilePath)->toMediaCollection('surat_tugas_pembimbing');
                    \Log::info("- Successfully processed pembimbing file");
                }
            }
        } else {
            if ($isUpdate) {
                $existingCount = $prestasiMahasiswa->getMedia('surat_tugas_pembimbing')->count();
                \Log::info("- No pembimbing input, preserving {$existingCount} existing files");
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
        $actionText = $isUpdate ? 'updated' : 'submitted';
        $congratsMessage = "Congratulations! Thank you {$studentName} for the outstanding {$achievement} on {$prestasiMahasiswa->nama_kegiatan} by {$prestasiMahasiswa->nama_penyelenggara}. Your achievement has been {$actionText} successfully.";

        return redirect()->route('frontend.prestasi-mahasiswas.index')
            ->with('success', $congratsMessage);
    }

    public function show(PrestasiMahasiswa $prestasiMahasiswa)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMahasiswa->load('user', 'kategori', 'pesertas');

        return view('frontend.prestasiMahasiswas.show', compact('prestasiMahasiswa'));
    }

    public function publicShow($id)
    {
        // Only show validated achievements for public viewing
        $prestasiMahasiswa = PrestasiMahasiswa::with(['user', 'kategori', 'pesertas'])
            ->where('id', $id)
            ->where('validation_status', 'validated')
            ->firstOrFail();

        return view('frontend.prestasiMahasiswas.public_show', compact('prestasiMahasiswa'));
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
        try {
            // More flexible validation for draft saving
            $request->validate([
                'current_step' => 'required|integer|min:1|max:5'
            ]);

            // Check if we're updating an existing record
            $prestasiMahasiswa = null;
            $isUpdate = false;
            
            // If there's a hidden field indicating this is an update
            if ($request->has('prestasi_mahasiswa_id') && $request->prestasi_mahasiswa_id) {
                $prestasiMahasiswa = PrestasiMahasiswa::with(['media'])
                    ->where('id', $request->prestasi_mahasiswa_id)
                    ->where('user_id', auth()->id())
                    ->first();
                $isUpdate = true;
                \Log::info('Found existing prestasi_mahasiswa: ' . ($prestasiMahasiswa ? $prestasiMahasiswa->id : 'NOT FOUND'));
            }

            // Prepare data for saving, including only non-empty values
            $data = [];
            $data['user_id'] = auth()->id();
            $data['is_draft'] = true;
            $data['current_step'] = $request->input('current_step', 1);
            
            // Only include fields that have values to avoid database constraints
            $allowedFields = [
                'skim', 'tingkat', 'nama_kegiatan', 'kategori_id', 
                'tanggal_awal', 'tanggal_akhir', 'jumlah_peserta', 
                'perolehan_juara', 'nama_penyelenggara', 'tempat_penyelenggara',
                'keikutsertaan', 'dosen_pembimbing', 'url_publikasi', 'no_wa',
                'informasi_lomba', 'tips_trik', 'bersedia_mentoring'
            ];
            
            foreach ($allowedFields as $field) {
                $value = $request->input($field);
                if (!empty($value) || $value === '0' || $value === 0) {
                    $data[$field] = $value;
                }
            }
            
            // Handle special cases for empty but valid values
            if ($request->has('bersedia_mentoring')) {
                $data['bersedia_mentoring'] = $request->input('bersedia_mentoring', false);
            }

            if ($isUpdate && $prestasiMahasiswa) {
                // Update existing record
                $prestasiMahasiswa->update($data);
                \Log::info('Updated existing prestasi_mahasiswa: ' . $prestasiMahasiswa->id);
                
                // Delete existing participants and re-create them
                $prestasiMahasiswa->pesertas()->delete();
            } else {
                // Make sure we have at least the minimum required fields for draft
                if (empty($data['skim'])) {
                    $data['skim'] = 'lomba'; // default value
                }
                if (empty($data['tingkat'])) {
                    $data['tingkat'] = 'nasional'; // default value  
                }
                if (empty($data['nama_kegiatan'])) {
                    $data['nama_kegiatan'] = 'Draft - ' . date('Y-m-d H:i:s');
                }

                // Create new draft
                $prestasiMahasiswa = PrestasiMahasiswa::create($data);
                \Log::info('Created new prestasi_mahasiswa: ' . $prestasiMahasiswa->id);
            }

            // Handle participants if they exist (for both create and update)
            if ($request->has('peserta') && is_array($request->input('peserta'))) {
                foreach ($request->input('peserta') as $pesertaData) {
                    if (!empty($pesertaData['nama']) && !empty($pesertaData['nim'])) {
                        PrestasiMahasiswaDetail::create([
                            'nama' => $pesertaData['nama'],
                            'nim' => $pesertaData['nim'],
                            'prestasi_mahasiswa_id' => $prestasiMahasiswa->id,
                        ]);
                    }
                }
            }

            // Handle file uploads if any
            $fileCollections = [
                'surat_tugas' => 'surat_tugas',
                'sertifikat' => 'sertifikat',
                'foto_dokumentasi' => 'foto_dokumentasi',
                'bukti_sipsmart' => 'bukti_sipsmart'
            ];

            \Log::info('=== FILE UPLOAD DEBUG ===');
            \Log::info('Is update: ' . ($isUpdate ? 'true' : 'false'));
            
            foreach ($fileCollections as $inputName => $collectionName) {
                $inputFiles = $request->input($inputName, []);
                $hasInput = $request->has($inputName);
                $inputEmpty = empty($inputFiles);
                
                \Log::info("Processing {$inputName}:");
                \Log::info("- Has input: " . ($hasInput ? 'true' : 'false'));
                \Log::info("- Input empty: " . ($inputEmpty ? 'true' : 'false'));
                \Log::info("- Input files: " . json_encode($inputFiles));
                
                if ($isUpdate) {
                    $existingMedia = $prestasiMahasiswa->getMedia($collectionName);
                    \Log::info("- Existing media count: " . $existingMedia->count());
                    
                    // FIXED: Only delete existing files if we actually have NEW files to upload
                    // Don't delete if input is empty or just preserving existing files
                    if ($hasInput && !$inputEmpty && count($inputFiles) > 0) {
                        $hasValidNewFiles = false;
                        foreach ($inputFiles as $file) {
                            $filePath = storage_path('tmp/uploads/' . basename($file));
                            if (file_exists($filePath)) {
                                $hasValidNewFiles = true;
                                break;
                            }
                        }
                        
                        if ($hasValidNewFiles) {
                            \Log::info("- Deleting existing files because new valid files found");
                            $prestasiMahasiswa->getMedia($collectionName)->each->delete();
                        } else {
                            \Log::info("- Keeping existing files - no valid new files to replace them");
                        }
                    } else {
                        \Log::info("- Keeping existing files - no new upload data");
                    }
                }
                
                // Only process files that actually exist in tmp/uploads
                $processedFiles = 0;
                foreach ($inputFiles as $file) {
                    $filePath = storage_path('tmp/uploads/' . basename($file));
                    \Log::info("- Checking file: {$file} -> {$filePath}");
                    \Log::info("- File exists: " . (file_exists($filePath) ? 'true' : 'false'));
                    
                    if (file_exists($filePath)) {
                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                        $newFileName = ($prestasiMahasiswa->nama_kegiatan ?? 'draft') . '_' . $inputName . '_' . uniqid() . '.' . $extension;
                        $newFilePath = storage_path('tmp/uploads/' . $newFileName);
                        
                        if (copy($filePath, $newFilePath)) {
                            $prestasiMahasiswa->addMedia($newFilePath)->toMediaCollection($collectionName);
                            $processedFiles++;
                            \Log::info("- Successfully processed file: {$newFileName}");
                        } else {
                            \Log::error("- Failed to copy file: {$filePath}");
                        }
                    }
                }
                \Log::info("- Total files processed for {$inputName}: {$processedFiles}");
            }

            // Handle single file upload (surat_tugas_pembimbing)
            \Log::info('=== SINGLE FILE UPLOAD DEBUG ===');
            $pembimbingFile = $request->input('surat_tugas_pembimbing', false);
            \Log::info('Surat tugas pembimbing input: ' . ($pembimbingFile ? $pembimbingFile : 'empty'));
            
            if ($pembimbingFile) {
                $filePath = storage_path('tmp/uploads/' . basename($pembimbingFile));
                \Log::info('File path: ' . $filePath);
                \Log::info('File exists: ' . (file_exists($filePath) ? 'true' : 'false'));
                
                if ($isUpdate) {
                    $existingMedia = $prestasiMahasiswa->getMedia('surat_tugas_pembimbing');
                    \Log::info('Existing pembimbing media count: ' . $existingMedia->count());
                    
                    // Only delete if we have a valid new file
                    if (file_exists($filePath)) {
                        \Log::info('Deleting existing pembimbing file for replacement');
                        $prestasiMahasiswa->getMedia('surat_tugas_pembimbing')->each->delete();
                    } else {
                        \Log::info('Keeping existing pembimbing file - new file not found');
                    }
                }
                
                if (file_exists($filePath)) {
                    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                    $newFileName = ($prestasiMahasiswa->nama_kegiatan ?? 'draft') . '_surat_tugas_pembimbing_' . uniqid() . '.' . $extension;
                    $newFilePath = storage_path('tmp/uploads/' . $newFileName);
                    
                    if (copy($filePath, $newFilePath)) {
                        $prestasiMahasiswa->addMedia($newFilePath)->toMediaCollection('surat_tugas_pembimbing');
                        \Log::info('Successfully processed pembimbing file: ' . $newFileName);
                    } else {
                        \Log::error('Failed to copy pembimbing file: ' . $filePath);
                    }
                } else {
                    \Log::warning('Pembimbing file not found in tmp/uploads, skipping');
                }
            } else {
                \Log::info('No pembimbing file to process');
            }

            // Return JSON response for AJAX requests
            \Log::info('About to return response...');
            \Log::info('Request wants JSON: ' . ($request->wantsJson() ? 'true' : 'false'));
            \Log::info('Request is AJAX: ' . ($request->ajax() ? 'true' : 'false'));
            \Log::info('Final prestasi_mahasiswa ID: ' . $prestasiMahasiswa->id);
            \Log::info('Is update: ' . ($isUpdate ? 'true' : 'false'));
            
            if ($request->wantsJson() || $request->ajax()) {
                $responseData = [
                    'success' => true,
                    'message' => $isUpdate ? 'Draft berhasil diperbarui!' : 'Draft berhasil disimpan!',
                    'draft_id' => $prestasiMahasiswa->id,
                    'current_step' => $prestasiMahasiswa->current_step
                ];
                \Log::info('Returning JSON response: ' . json_encode($responseData));
                return response()->json($responseData);
            }

            // Fallback for non-AJAX requests
            \Log::info('Returning redirect response (not AJAX)');
            return redirect()->route('frontend.prestasi-mahasiswas.index')
                ->with('success', $isUpdate ? 'Draft berhasil diperbarui!' : 'Draft berhasil disimpan!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error saving draft: ' . json_encode($e->errors()));
            
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal: ' . implode(', ', array_flatten($e->errors()))
                ], 422);
            }

            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
                
        } catch (\Exception $e) {
            \Log::error('Error saving draft: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            \Log::error('Request data: ' . json_encode($request->all()));
            
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan draft: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan draft: ' . $e->getMessage());
        }
    }
}
