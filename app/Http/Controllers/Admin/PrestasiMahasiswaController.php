<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPrestasiMahasiswaRequest;
use App\Http\Requests\StorePrestasiMahasiswaRequest;
use App\Http\Requests\UpdatePrestasiMahasiswaRequest;
use App\Models\KategoriPrestasi;
use App\Models\PrestasiMahasiswa;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\PrestasiMahasiswaExport;
use Excel;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;

class PrestasiMahasiswaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PrestasiMahasiswa::with(['user', 'kategori'])->select(sprintf('%s.*', (new PrestasiMahasiswa)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'prestasi_mahasiswa_show';
                $editGate = 'prestasi_mahasiswa_edit';
                $deleteGate = 'prestasi_mahasiswa_delete';
                $crudRoutePart = 'prestasi-mahasiswas';

                $actions = '';
                
                if(auth()->user()->can($viewGate)) {
                    $actions .= '<a class="btn btn-xs btn-primary" href="' . route("admin.{$crudRoutePart}.show", $row->id) . '">
                                    ' . trans('global.view') . '
                                </a> ';
                }
                
                if(auth()->user()->can($editGate)) {
                    $actions .= '<a class="btn btn-xs btn-info" href="' . route("admin.{$crudRoutePart}.edit", $row->id) . '">
                                    ' . trans('global.edit') . '
                                </a> ';
                }

                // Don't show validation actions for drafts
                if (!($row->is_draft ?? false)) {
                    $validationStatus = $row->validation_status ?? 'pending';
                    
                    // Validation Actions
                    if ($validationStatus === 'pending') {
                        $actions .= '<button type="button" class="btn btn-xs btn-success btn-validate" 
                                        data-id="' . $row->id . '" 
                                        data-name="' . htmlspecialchars($row->nama_kegiatan ?? 'Draft') . '">
                                        <i class="fas fa-check"></i> Validate
                                    </button> ';
                        
                        $actions .= '<button type="button" class="btn btn-xs btn-danger btn-reject-validation" 
                                        data-id="' . $row->id . '" 
                                        data-name="' . htmlspecialchars($row->nama_kegiatan ?? 'Draft') . '">
                                        <i class="fas fa-times"></i> Reject
                                    </button> ';
                    }
                }

                if(auth()->user()->can($deleteGate)) {
                    $actions .= '<form action="' . route("admin.{$crudRoutePart}.destroy", $row->id) . '" method="POST" onsubmit="return confirm(\'' . trans('global.areYouSure') . '\');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="submit" class="btn btn-xs btn-danger" value="' . trans('global.delete') . '">
                                </form>';
                }

                return $actions;
            });

            $table->editColumn('skim', function ($row) {
                return $row->skim ? PrestasiMahasiswa::SKIM_RADIO[$row->skim] : '';
            });
            $table->editColumn('tingkat', function ($row) {
                return $row->tingkat ? PrestasiMahasiswa::TINGKAT_RADIO[$row->tingkat] : '';
            });
            $table->editColumn('nama_kegiatan', function ($row) {
                return $row->nama_kegiatan ? $row->nama_kegiatan : '';
            });
            $table->addColumn('kategori_name', function ($row) {
                return $row->kategori ? $row->kategori->name : '';
            });

            $table->editColumn('jumlah_peserta', function ($row) {
                return $row->jumlah_peserta ? PrestasiMahasiswa::JUMLAH_PESERTA_RADIO[$row->jumlah_peserta] : '';
            });
            $table->editColumn('perolehan_juara', function ($row) {
                return $row->perolehan_juara ? PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT[$row->perolehan_juara] : '';
            });
            $table->editColumn('nama_penyelenggara', function ($row) {
                return $row->nama_penyelenggara ? $row->nama_penyelenggara : '';
            });
            $table->editColumn('tempat_penyelenggara', function ($row) {
                return $row->tempat_penyelenggara ? $row->tempat_penyelenggara : '';
            });
            $table->editColumn('keikutsertaan', function ($row) {
                return $row->keikutsertaan ? PrestasiMahasiswa::KEIKUTSERTAAN_RADIO[$row->keikutsertaan] : '';
            });
            $table->editColumn('dosen_pembimbing', function ($row) {
                return $row->dosen_pembimbing ? $row->dosen_pembimbing : '';
            });
            $table->editColumn('url_publikasi', function ($row) {
                return $row->url_publikasi ? $row->url_publikasi : '';
            });
            $table->editColumn('no_wa', function ($row) {
                return $row->no_wa ? $row->no_wa : '';
            });

            // Add validation status column
            $table->addColumn('approval_status', function ($row) {
                if ($row->is_draft ?? false) {
                    return '<span class="badge badge-warning"><i class="fas fa-edit"></i> Draft</span>';
                }
                
                $validationStatus = $row->validation_status ?? 'pending';
                
                // Validation Status
                switch ($validationStatus) {
                    case 'validated':
                        $statusDisplay = '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Validated</span>';
                        if ($row->validation_notes) {
                            $statusDisplay .= '<br><small class="text-muted" title="' . htmlspecialchars($row->validation_notes) . '">
                                        <i class="fas fa-comment"></i> Has notes
                                      </small>';
                        }
                        break;
                    case 'rejected':
                        $statusDisplay = '<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Rejected</span>';
                        if ($row->validation_notes) {
                            $statusDisplay .= '<br><small class="text-muted" title="' . htmlspecialchars($row->validation_notes) . '">
                                        <i class="fas fa-comment"></i> Has notes
                                      </small>';
                        }
                        break;
                    default:
                        $statusDisplay = '<span class="badge badge-warning"><i class="fas fa-clock"></i> Pending Validation</span>';
                }
                
                return $statusDisplay;
            });

            $table->editColumn('validation_status', function ($row) {
                return $row->validation_status ? PrestasiMahasiswa::STATUS_SELECT[$row->validation_status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'kategori', 'validation_status', 'approval_status']);

            return $table->make(true);
        }

        return view('admin.prestasiMahasiswas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('prestasi_mahasiswa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kategoris = KategoriPrestasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.prestasiMahasiswas.create', compact('kategoris', 'users'));
    }

    public function store(StorePrestasiMahasiswaRequest $request)
    {
        $prestasiMahasiswa = PrestasiMahasiswa::create($request->all());

        foreach ($request->input('surat_tugas', []) as $file) {
            $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('surat_tugas');
        }

        foreach ($request->input('sertifikat', []) as $file) {
            $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('sertifikat');
        }

        foreach ($request->input('foto_dokumentasi', []) as $file) {
            $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('foto_dokumentasi');
        }

        if ($request->input('surat_tugas_pembimbing', false)) {
            $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_tugas_pembimbing'))))->toMediaCollection('surat_tugas_pembimbing');
        }

        foreach ($request->input('bukti_sipsmart', []) as $file) {
            $prestasiMahasiswa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('bukti_sipsmart');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $prestasiMahasiswa->id]);
        }

        return redirect()->route('admin.prestasi-mahasiswas.index');
    }

    public function edit(PrestasiMahasiswa $prestasiMahasiswa)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kategoris = KategoriPrestasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prestasiMahasiswa->load('user', 'kategori');

        return view('admin.prestasiMahasiswas.edit', compact('kategoris', 'prestasiMahasiswa', 'users'));
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

        return redirect()->route('admin.prestasi-mahasiswas.index');
    }

    public function show(PrestasiMahasiswa $prestasiMahasiswa)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prestasiMahasiswa->load('user', 'kategori', 'pesertas');

        return view('admin.prestasiMahasiswas.show', compact('prestasiMahasiswa'));
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

    public function export(Request $request)
    {
        if ($request->has('date') && $request->date && $dates = explode(' - ', $request->date)) {
            $start = Date::parse($dates[0])->startOfDay();
            $end = !isset($dates[1]) ? $start->clone()->endOfMonth() : Date::parse($dates[1])->endOfDay();
        } else {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now();
        }

        return Excel::download(new PrestasiMahasiswaExport($start , $end), 'Prestasi Mahasiswa dari ' . $start->format('d-F-Y') .' sd '. $end->format('d-F-Y') . '.xlsx');
    }

    public function processValidation(Request $request, PrestasiMahasiswa $prestasiMahasiswa)
    {
        abort_if(Gate::denies('prestasi_mahasiswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $request->validate([
            'validation_status' => 'required|in:pending,validated,rejected',
            'validation_notes' => 'nullable|string',
        ]);

        $prestasiMahasiswa->update([
            'validation_status' => $request->validation_status,
            'validation_notes' => $request->validation_notes,
            'validated_at' => $request->validation_status != 'pending' ? now() : null,
            'validated_by' => $request->validation_status != 'pending' ? auth()->id() : null,
        ]);

        return redirect()->route('admin.prestasi-mahasiswas.index')
            ->with('message', 'Validasi prestasi mahasiswa berhasil!');
    }

    public function pendingValidations()
    {
        abort_if(Gate::denies('prestasi_mahasiswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pendingSubmissions = PrestasiMahasiswa::where('validation_status', 'pending')
            ->where('is_draft', 0)
            ->with(['user', 'kategori'])
            ->get();

        return view('admin.prestasiMahasiswas.pending', compact('pendingSubmissions'));
    }

    public function reject(Request $request, $id)
    {
        try {
            $request->validate([
                'validation_notes' => 'required|string|min:10'
            ]);

            $prestasiMahasiswa = PrestasiMahasiswa::findOrFail($id);
            
            $prestasiMahasiswa->update([
                'validation_status' => 'rejected',
                'validation_notes' => $request->validation_notes,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Prestasi mahasiswa berhasil ditolak.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function approved(Request $request, $id)
    {
        try {
            $prestasiMahasiswa = PrestasiMahasiswa::findOrFail($id);
            
            $prestasiMahasiswa->update([
                'validation_status' => 'validated',
                'validation_notes' => $request->validation_notes,
                'validated_at' => now(),
                'validated_by' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Prestasi mahasiswa berhasil divalidasi.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
