<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMahasiswaMagangRequest;
use App\Http\Requests\StoreMahasiswaMagangRequest;
use App\Http\Requests\UpdateMahasiswaMagangRequest;
use App\Models\Magang;
use App\Models\MahasiswaMagang;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaMagangController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('mahasiswa_magang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MahasiswaMagang::with(['mahasiswa', 'magang', 'approved_by', 'verified_by'])->select(sprintf('%s.*', (new MahasiswaMagang)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'mahasiswa_magang_show';
                $editGate      = 'mahasiswa_magang_edit';
                $deleteGate    = 'mahasiswa_magang_delete';
                $crudRoutePart = 'mahasiswa-magangs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('mahasiswa_name', function ($row) {
                return $row->mahasiswa ? $row->mahasiswa->name : '';
            });

            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : '';
            });
            $table->editColumn('semester', function ($row) {
                return $row->semester ? $row->semester : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? MahasiswaMagang::TYPE_SELECT[$row->type] : '';
            });
            $table->addColumn('magang_name', function ($row) {
                return $row->magang ? $row->magang->name : '';
            });

            $table->editColumn('instansi', function ($row) {
                return $row->instansi ? $row->instansi : '';
            });
            $table->editColumn('approve', function ($row) {
                return $row->approve ? MahasiswaMagang::APPROVE_SELECT[$row->approve] : '';
            });
            $table->editColumn('dosen_pembimbing', function ($row) {
                return $row->dosen_pembimbing ? $row->dosen_pembimbing : '';
            });
            $table->editColumn('berkas_magang', function ($row) {
                if (! $row->berkas_magang) {
                    return '';
                }
                $links = [];
                foreach ($row->berkas_magang as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('verified', function ($row) {
                return $row->verified ? MahasiswaMagang::VERIFIED_SELECT[$row->verified] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'mahasiswa', 'magang', 'berkas_magang']);

            return $table->make(true);
        }

        return view('admin.mahasiswaMagangs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('mahasiswa_magang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = Magang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approved_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $verified_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mahasiswaMagangs.create', compact('approved_bies', 'magangs', 'mahasiswas', 'verified_bies'));
    }

    public function store(StoreMahasiswaMagangRequest $request)
    {
        $mahasiswaMagang = MahasiswaMagang::create($request->all());

        foreach ($request->input('laporan_akhir', []) as $file) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('laporan_akhir');
        }

        foreach ($request->input('presensi', []) as $file) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('presensi');
        }

        foreach ($request->input('sertifikat', []) as $file) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('sertifikat');
        }

        if ($request->input('form_penilaian_pembimbing_lapangan', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('form_penilaian_pembimbing_lapangan'))))->toMediaCollection('form_penilaian_pembimbing_lapangan');
        }

        if ($request->input('form_penilaian_dosen_pembimbing', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('form_penilaian_dosen_pembimbing'))))->toMediaCollection('form_penilaian_dosen_pembimbing');
        }

        if ($request->input('berita_acara_seminar', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('berita_acara_seminar'))))->toMediaCollection('berita_acara_seminar');
        }

        foreach ($request->input('presensi_kehadiran_seminar', []) as $file) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('presensi_kehadiran_seminar');
        }

        if ($request->input('notulen_pertanyaan', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('notulen_pertanyaan'))))->toMediaCollection('notulen_pertanyaan');
        }

        if ($request->input('tanda_bukti_penyerahan_laporan', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('tanda_bukti_penyerahan_laporan'))))->toMediaCollection('tanda_bukti_penyerahan_laporan');
        }

        foreach ($request->input('berkas_magang', []) as $file) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('berkas_magang');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mahasiswaMagang->id]);
        }

        return redirect()->route('admin.mahasiswa-magangs.index');
    }

    public function edit(MahasiswaMagang $mahasiswaMagang)
    {
        abort_if(Gate::denies('mahasiswa_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = Magang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approved_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $verified_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mahasiswaMagang->load('mahasiswa', 'magang', 'approved_by', 'verified_by');

        return view('admin.mahasiswaMagangs.edit', compact('approved_bies', 'magangs', 'mahasiswaMagang', 'mahasiswas', 'verified_bies'));
    }

    public function update(UpdateMahasiswaMagangRequest $request, MahasiswaMagang $mahasiswaMagang)
    {
        $mahasiswaMagang->update($request->all());

        if (count($mahasiswaMagang->laporan_akhir) > 0) {
            foreach ($mahasiswaMagang->laporan_akhir as $media) {
                if (! in_array($media->file_name, $request->input('laporan_akhir', []))) {
                    $media->delete();
                }
            }
        }
        $media = $mahasiswaMagang->laporan_akhir->pluck('file_name')->toArray();
        foreach ($request->input('laporan_akhir', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('laporan_akhir');
            }
        }

        if (count($mahasiswaMagang->presensi) > 0) {
            foreach ($mahasiswaMagang->presensi as $media) {
                if (! in_array($media->file_name, $request->input('presensi', []))) {
                    $media->delete();
                }
            }
        }
        $media = $mahasiswaMagang->presensi->pluck('file_name')->toArray();
        foreach ($request->input('presensi', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('presensi');
            }
        }

        if (count($mahasiswaMagang->sertifikat) > 0) {
            foreach ($mahasiswaMagang->sertifikat as $media) {
                if (! in_array($media->file_name, $request->input('sertifikat', []))) {
                    $media->delete();
                }
            }
        }
        $media = $mahasiswaMagang->sertifikat->pluck('file_name')->toArray();
        foreach ($request->input('sertifikat', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('sertifikat');
            }
        }

        if ($request->input('form_penilaian_pembimbing_lapangan', false)) {
            if (! $mahasiswaMagang->form_penilaian_pembimbing_lapangan || $request->input('form_penilaian_pembimbing_lapangan') !== $mahasiswaMagang->form_penilaian_pembimbing_lapangan->file_name) {
                if ($mahasiswaMagang->form_penilaian_pembimbing_lapangan) {
                    $mahasiswaMagang->form_penilaian_pembimbing_lapangan->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('form_penilaian_pembimbing_lapangan'))))->toMediaCollection('form_penilaian_pembimbing_lapangan');
            }
        } elseif ($mahasiswaMagang->form_penilaian_pembimbing_lapangan) {
            $mahasiswaMagang->form_penilaian_pembimbing_lapangan->delete();
        }

        if ($request->input('form_penilaian_dosen_pembimbing', false)) {
            if (! $mahasiswaMagang->form_penilaian_dosen_pembimbing || $request->input('form_penilaian_dosen_pembimbing') !== $mahasiswaMagang->form_penilaian_dosen_pembimbing->file_name) {
                if ($mahasiswaMagang->form_penilaian_dosen_pembimbing) {
                    $mahasiswaMagang->form_penilaian_dosen_pembimbing->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('form_penilaian_dosen_pembimbing'))))->toMediaCollection('form_penilaian_dosen_pembimbing');
            }
        } elseif ($mahasiswaMagang->form_penilaian_dosen_pembimbing) {
            $mahasiswaMagang->form_penilaian_dosen_pembimbing->delete();
        }

        if ($request->input('berita_acara_seminar', false)) {
            if (! $mahasiswaMagang->berita_acara_seminar || $request->input('berita_acara_seminar') !== $mahasiswaMagang->berita_acara_seminar->file_name) {
                if ($mahasiswaMagang->berita_acara_seminar) {
                    $mahasiswaMagang->berita_acara_seminar->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('berita_acara_seminar'))))->toMediaCollection('berita_acara_seminar');
            }
        } elseif ($mahasiswaMagang->berita_acara_seminar) {
            $mahasiswaMagang->berita_acara_seminar->delete();
        }

        if (count($mahasiswaMagang->presensi_kehadiran_seminar) > 0) {
            foreach ($mahasiswaMagang->presensi_kehadiran_seminar as $media) {
                if (! in_array($media->file_name, $request->input('presensi_kehadiran_seminar', []))) {
                    $media->delete();
                }
            }
        }
        $media = $mahasiswaMagang->presensi_kehadiran_seminar->pluck('file_name')->toArray();
        foreach ($request->input('presensi_kehadiran_seminar', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('presensi_kehadiran_seminar');
            }
        }

        if ($request->input('notulen_pertanyaan', false)) {
            if (! $mahasiswaMagang->notulen_pertanyaan || $request->input('notulen_pertanyaan') !== $mahasiswaMagang->notulen_pertanyaan->file_name) {
                if ($mahasiswaMagang->notulen_pertanyaan) {
                    $mahasiswaMagang->notulen_pertanyaan->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('notulen_pertanyaan'))))->toMediaCollection('notulen_pertanyaan');
            }
        } elseif ($mahasiswaMagang->notulen_pertanyaan) {
            $mahasiswaMagang->notulen_pertanyaan->delete();
        }

        if ($request->input('tanda_bukti_penyerahan_laporan', false)) {
            if (! $mahasiswaMagang->tanda_bukti_penyerahan_laporan || $request->input('tanda_bukti_penyerahan_laporan') !== $mahasiswaMagang->tanda_bukti_penyerahan_laporan->file_name) {
                if ($mahasiswaMagang->tanda_bukti_penyerahan_laporan) {
                    $mahasiswaMagang->tanda_bukti_penyerahan_laporan->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('tanda_bukti_penyerahan_laporan'))))->toMediaCollection('tanda_bukti_penyerahan_laporan');
            }
        } elseif ($mahasiswaMagang->tanda_bukti_penyerahan_laporan) {
            $mahasiswaMagang->tanda_bukti_penyerahan_laporan->delete();
        }

        if (count($mahasiswaMagang->berkas_magang) > 0) {
            foreach ($mahasiswaMagang->berkas_magang as $media) {
                if (! in_array($media->file_name, $request->input('berkas_magang', []))) {
                    $media->delete();
                }
            }
        }
        $media = $mahasiswaMagang->berkas_magang->pluck('file_name')->toArray();
        foreach ($request->input('berkas_magang', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('berkas_magang');
            }
        }

        return redirect()->route('admin.mahasiswa-magangs.index');
    }

    public function show(MahasiswaMagang $mahasiswaMagang)
    {
        abort_if(Gate::denies('mahasiswa_magang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswaMagang->load('mahasiswa', 'magang', 'approved_by', 'verified_by');

        return view('admin.mahasiswaMagangs.show', compact('mahasiswaMagang'));
    }

    public function destroy(MahasiswaMagang $mahasiswaMagang)
    {
        abort_if(Gate::denies('mahasiswa_magang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswaMagang->delete();

        return back();
    }

    public function massDestroy(MassDestroyMahasiswaMagangRequest $request)
    {
        $mahasiswaMagangs = MahasiswaMagang::find(request('ids'));

        foreach ($mahasiswaMagangs as $mahasiswaMagang) {
            $mahasiswaMagang->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('mahasiswa_magang_create') && Gate::denies('mahasiswa_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MahasiswaMagang();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
