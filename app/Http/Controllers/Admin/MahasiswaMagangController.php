<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMahasiswaMagangRequest;
use App\Http\Requests\StoreMahasiswaMagangRequest;
use App\Http\Requests\UpdateMahasiswaMagangRequest;
use App\Models\Dospem;
use App\Models\Magang;
use App\Models\MahasiswaMagang;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Alert;
use App\Exports\MahasiswaMagangExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

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

                $actions = view('partials.magangActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ))->render();
                
                return $actions;
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

            // Add current phase indicator
            $table->addColumn('current_phase', function ($row) {
                return $this->determineCurrentPhase($row);
            });

            $table->rawColumns(['actions', 'placeholder', 'mahasiswa', 'magang', 'berkas_magang', 'current_phase']);

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

        $dospems = Dospem::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mahasiswaMagangs.create', compact('approved_bies', 'magangs', 'mahasiswas', 'verified_bies', 'dospems'));
    }

    public function store(StoreMahasiswaMagangRequest $request)
    {
        // Check if the student already has an active application (if mahasiswa_id is provided)
        if ($request->mahasiswa_id) {
            $activeApplication = MahasiswaMagang::where('mahasiswa_id', $request->mahasiswa_id)
                ->whereIn('approve', ['PENDING', 'APPROVED'])
                ->first();

            if ($activeApplication) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'This student already has an active internship application. Students can only have one active application at a time.');
            }
        }

        $mahasiswaMagang = MahasiswaMagang::create($request->all());

        // New document uploads
        if ($request->input('proposal_magang', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('proposal_magang'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('proposal_magang')), 'proposal_magang'))
                ->toMediaCollection('proposal_magang');
        }

        if ($request->input('surat_tugas', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_tugas'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('surat_tugas')), 'surat_tugas'))
                ->toMediaCollection('surat_tugas');
        }

        if ($request->input('berkas_instansi', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('berkas_instansi'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('berkas_instansi')), 'berkas_instansi'))
                ->toMediaCollection('berkas_instansi');
        }

        foreach ($request->input('laporan_akhir', []) as $file) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($file), 'laporan_akhir'))
                ->toMediaCollection('laporan_akhir');
        }

        foreach ($request->input('presensi', []) as $file) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($file), 'presensi'))
                ->toMediaCollection('presensi');
        }

        foreach ($request->input('sertifikat', []) as $file) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($file), 'sertifikat'))
                ->toMediaCollection('sertifikat');
        }

        if ($request->input('form_penilaian_pembimbing_lapangan', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('form_penilaian_pembimbing_lapangan'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('form_penilaian_pembimbing_lapangan')), 'form_penilaian_pembimbing_lapangan'))
                ->toMediaCollection('form_penilaian_pembimbing_lapangan');
        }

        if ($request->input('form_penilaian_dosen_pembimbing', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('form_penilaian_dosen_pembimbing'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('form_penilaian_dosen_pembimbing')), 'form_penilaian_dosen_pembimbing'))
                ->toMediaCollection('form_penilaian_dosen_pembimbing');
        }

        if ($request->input('berita_acara_seminar', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('berita_acara_seminar'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('berita_acara_seminar')), 'berita_acara_seminar'))
                ->toMediaCollection('berita_acara_seminar');
        }

        foreach ($request->input('presensi_kehadiran_seminar', []) as $file) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($file), 'presensi_kehadiran_seminar'))
                ->toMediaCollection('presensi_kehadiran_seminar');
        }

        if ($request->input('notulen_pertanyaan', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('notulen_pertanyaan'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('notulen_pertanyaan')), 'notulen_pertanyaan'))
                ->toMediaCollection('notulen_pertanyaan');
        }

        if ($request->input('tanda_bukti_penyerahan_laporan', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('tanda_bukti_penyerahan_laporan'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('tanda_bukti_penyerahan_laporan')), 'tanda_bukti_penyerahan_laporan'))
                ->toMediaCollection('tanda_bukti_penyerahan_laporan');
        }

        foreach ($request->input('berkas_magang', []) as $file) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($file), 'berkas_magang'))
                ->toMediaCollection('berkas_magang');
        }

        // Handle new document uploads
        if ($request->input('khs', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('khs'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('khs')), 'khs'))
                ->toMediaCollection('khs');
        }

        if ($request->input('krs', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('krs'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('krs')), 'krs'))
                ->toMediaCollection('krs');
        }

        if ($request->input('form_persetujuan_dosen_pa', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('form_persetujuan_dosen_pa'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('form_persetujuan_dosen_pa')), 'form_persetujuan_dosen_pa'))
                ->toMediaCollection('form_persetujuan_dosen_pa');
        }

        if ($request->input('surat_persetujuan_rekognisi', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_persetujuan_rekognisi'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('surat_persetujuan_rekognisi')), 'surat_persetujuan_rekognisi'))
                ->toMediaCollection('surat_persetujuan_rekognisi');
        }

        if ($request->input('logbook_mbkm', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('logbook_mbkm'))))
                ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('logbook_mbkm')), 'logbook_mbkm'))
                ->toMediaCollection('logbook_mbkm');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mahasiswaMagang->id]);
        }

        return redirect()->route('admin.mahasiswa-magangs.index');
    }

    public function edit(MahasiswaMagang $internship_application)
    {
        abort_if(Gate::denies('mahasiswa_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = Magang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approved_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $verified_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dospems = Dospem::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $internship_application->load('mahasiswa', 'magang', 'approved_by', 'verified_by');
        
        // Pass as mahasiswaMagang for blade compatibility
        $mahasiswaMagang = $internship_application;
        return view('admin.mahasiswaMagangs.edit', compact('approved_bies', 'magangs', 'mahasiswaMagang', 'mahasiswas', 'verified_bies', 'dospems'));
    }

    public function update(UpdateMahasiswaMagangRequest $request, MahasiswaMagang $internship_application)
    {
        $internship_application->update($request->all());
        $mahasiswaMagang = $internship_application; // For consistency

        // Handle proposal_magang file
        if ($request->input('proposal_magang', false)) {
            if (! $mahasiswaMagang->proposal_magang || $request->input('proposal_magang') !== $mahasiswaMagang->proposal_magang->file_name) {
                if ($mahasiswaMagang->proposal_magang) {
                    $mahasiswaMagang->proposal_magang->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('proposal_magang'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('proposal_magang')), 'proposal_magang'))
                    ->toMediaCollection('proposal_magang');
            }
        } elseif ($mahasiswaMagang->proposal_magang) {
            $mahasiswaMagang->proposal_magang->delete();
        }

        // Handle surat_tugas file
        if ($request->input('surat_tugas', false)) {
            if (! $mahasiswaMagang->surat_tugas || $request->input('surat_tugas') !== $mahasiswaMagang->surat_tugas->file_name) {
                if ($mahasiswaMagang->surat_tugas) {
                    $mahasiswaMagang->surat_tugas->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_tugas'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('surat_tugas')), 'surat_tugas'))
                    ->toMediaCollection('surat_tugas');
            }
        } elseif ($mahasiswaMagang->surat_tugas) {
            $mahasiswaMagang->surat_tugas->delete();
        }

        // Handle berkas_instansi file
        if ($request->input('berkas_instansi', false)) {
            if (! $mahasiswaMagang->berkas_instansi || $request->input('berkas_instansi') !== $mahasiswaMagang->berkas_instansi->file_name) {
                if ($mahasiswaMagang->berkas_instansi) {
                    $mahasiswaMagang->berkas_instansi->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('berkas_instansi'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('berkas_instansi')), 'berkas_instansi'))
                    ->toMediaCollection('berkas_instansi');
            }
        } elseif ($mahasiswaMagang->berkas_instansi) {
            $mahasiswaMagang->berkas_instansi->delete();
        }

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
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($file), 'presensi'))
                    ->toMediaCollection('presensi');
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
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($file), 'sertifikat'))
                    ->toMediaCollection('sertifikat');
            }
        }

        if ($request->input('form_penilaian_pembimbing_lapangan', false)) {
            if (! $mahasiswaMagang->form_penilaian_pembimbing_lapangan || $request->input('form_penilaian_pembimbing_lapangan') !== $mahasiswaMagang->form_penilaian_pembimbing_lapangan->file_name) {
                if ($mahasiswaMagang->form_penilaian_pembimbing_lapangan) {
                    $mahasiswaMagang->form_penilaian_pembimbing_lapangan->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('form_penilaian_pembimbing_lapangan'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('form_penilaian_pembimbing_lapangan')), 'form_penilaian_pembimbing_lapangan'))
                    ->toMediaCollection('form_penilaian_pembimbing_lapangan');
            }
        } elseif ($mahasiswaMagang->form_penilaian_pembimbing_lapangan) {
            $mahasiswaMagang->form_penilaian_pembimbing_lapangan->delete();
        }

        if ($request->input('form_penilaian_dosen_pembimbing', false)) {
            if (! $mahasiswaMagang->form_penilaian_dosen_pembimbing || $request->input('form_penilaian_dosen_pembimbing') !== $mahasiswaMagang->form_penilaian_dosen_pembimbing->file_name) {
                if ($mahasiswaMagang->form_penilaian_dosen_pembimbing) {
                    $mahasiswaMagang->form_penilaian_dosen_pembimbing->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('form_penilaian_dosen_pembimbing'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('form_penilaian_dosen_pembimbing')), 'form_penilaian_dosen_pembimbing'))
                    ->toMediaCollection('form_penilaian_dosen_pembimbing');
            }
        } elseif ($mahasiswaMagang->form_penilaian_dosen_pembimbing) {
            $mahasiswaMagang->form_penilaian_dosen_pembimbing->delete();
        }

        if ($request->input('berita_acara_seminar', false)) {
            if (! $mahasiswaMagang->berita_acara_seminar || $request->input('berita_acara_seminar') !== $mahasiswaMagang->berita_acara_seminar->file_name) {
                if ($mahasiswaMagang->berita_acara_seminar) {
                    $mahasiswaMagang->berita_acara_seminar->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('berita_acara_seminar'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('berita_acara_seminar')), 'berita_acara_seminar'))
                    ->toMediaCollection('berita_acara_seminar');
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
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($file), 'presensi_kehadiran_seminar'))
                    ->toMediaCollection('presensi_kehadiran_seminar');
            }
        }

        if ($request->input('notulen_pertanyaan', false)) {
            if (! $mahasiswaMagang->notulen_pertanyaan || $request->input('notulen_pertanyaan') !== $mahasiswaMagang->notulen_pertanyaan->file_name) {
                if ($mahasiswaMagang->notulen_pertanyaan) {
                    $mahasiswaMagang->notulen_pertanyaan->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('notulen_pertanyaan'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('notulen_pertanyaan')), 'notulen_pertanyaan'))
                    ->toMediaCollection('notulen_pertanyaan');
            }
        } elseif ($mahasiswaMagang->notulen_pertanyaan) {
            $mahasiswaMagang->notulen_pertanyaan->delete();
        }

        if ($request->input('tanda_bukti_penyerahan_laporan', false)) {
            if (! $mahasiswaMagang->tanda_bukti_penyerahan_laporan || $request->input('tanda_bukti_penyerahan_laporan') !== $mahasiswaMagang->tanda_bukti_penyerahan_laporan->file_name) {
                if ($mahasiswaMagang->tanda_bukti_penyerahan_laporan) {
                    $mahasiswaMagang->tanda_bukti_penyerahan_laporan->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('tanda_bukti_penyerahan_laporan'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('tanda_bukti_penyerahan_laporan')), 'tanda_bukti_penyerahan_laporan'))
                    ->toMediaCollection('tanda_bukti_penyerahan_laporan');
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
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($file), 'berkas_magang'))
                    ->toMediaCollection('berkas_magang');
            }
        }

        // Handle new document updates
        if ($request->input('khs', false)) {
            if (! $mahasiswaMagang->khs || $request->input('khs') !== $mahasiswaMagang->khs->file_name) {
                if ($mahasiswaMagang->khs) {
                    $mahasiswaMagang->khs->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('khs'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('khs')), 'khs'))
                    ->toMediaCollection('khs');
            }
        } elseif ($mahasiswaMagang->khs) {
            $mahasiswaMagang->khs->delete();
        }

        if ($request->input('krs', false)) {
            if (! $mahasiswaMagang->krs || $request->input('krs') !== $mahasiswaMagang->krs->file_name) {
                if ($mahasiswaMagang->krs) {
                    $mahasiswaMagang->krs->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('krs'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('krs')), 'krs'))
                    ->toMediaCollection('krs');
            }
        } elseif ($mahasiswaMagang->krs) {
            $mahasiswaMagang->krs->delete();
        }

        if ($request->input('form_persetujuan_dosen_pa', false)) {
            if (! $mahasiswaMagang->form_persetujuan_dosen_pa || $request->input('form_persetujuan_dosen_pa') !== $mahasiswaMagang->form_persetujuan_dosen_pa->file_name) {
                if ($mahasiswaMagang->form_persetujuan_dosen_pa) {
                    $mahasiswaMagang->form_persetujuan_dosen_pa->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('form_persetujuan_dosen_pa'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('form_persetujuan_dosen_pa')), 'form_persetujuan_dosen_pa'))
                    ->toMediaCollection('form_persetujuan_dosen_pa');
            }
        } elseif ($mahasiswaMagang->form_persetujuan_dosen_pa) {
            $mahasiswaMagang->form_persetujuan_dosen_pa->delete();
        }

        if ($request->input('surat_persetujuan_rekognisi', false)) {
            if (! $mahasiswaMagang->surat_persetujuan_rekognisi || $request->input('surat_persetujuan_rekognisi') !== $mahasiswaMagang->surat_persetujuan_rekognisi->file_name) {
                if ($mahasiswaMagang->surat_persetujuan_rekognisi) {
                    $mahasiswaMagang->surat_persetujuan_rekognisi->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_persetujuan_rekognisi'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('surat_persetujuan_rekognisi')), 'surat_persetujuan_rekognisi'))
                    ->toMediaCollection('surat_persetujuan_rekognisi');
            }
        } elseif ($mahasiswaMagang->surat_persetujuan_rekognisi) {
            $mahasiswaMagang->surat_persetujuan_rekognisi->delete();
        }

        if ($request->input('logbook_mbkm', false)) {
            if (! $mahasiswaMagang->logbook_mbkm || $request->input('logbook_mbkm') !== $mahasiswaMagang->logbook_mbkm->file_name) {
                if ($mahasiswaMagang->logbook_mbkm) {
                    $mahasiswaMagang->logbook_mbkm->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('logbook_mbkm'))))
                    ->usingName($mahasiswaMagang->generateCustomFileName(basename($request->input('logbook_mbkm')), 'logbook_mbkm'))
                    ->toMediaCollection('logbook_mbkm');
            }
        } elseif ($mahasiswaMagang->logbook_mbkm) {
            $mahasiswaMagang->logbook_mbkm->delete();
        }

        return redirect()->route('admin.mahasiswa-magangs.index');
    }

    public function show(MahasiswaMagang $internship_application)
    {
        abort_if(Gate::denies('mahasiswa_magang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $internship_application->load([
            'mahasiswa', 
            'magang', 
            'company',
            'approved_by', 
            'verified_by',
            'dospem',
            'monitorings' => function($query) {
                $query->orderBy('tanggal', 'desc');
            }
        ]);

        // Pass as mahasiswaMagang for blade compatibility
        $mahasiswaMagang = $internship_application;
        return view('admin.mahasiswaMagangs.show', compact('mahasiswaMagang'));
    }

    public function destroy(MahasiswaMagang $internship_application)
    {
        abort_if(Gate::denies('mahasiswa_magang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $internship_application->delete();

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

    /**
     * Export MahasiswaMagang data to Excel
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        abort_if(Gate::denies('mahasiswa_magang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $dateField = $request->input('date_field', 'created_at');

        // Generate filename with date range if provided
        $filename = 'mahasiswa_magang';
        if ($startDate && $endDate) {
            $filename .= '_' . Carbon::parse($startDate)->format('Y-m-d') . '_to_' . Carbon::parse($endDate)->format('Y-m-d');
        } elseif ($startDate) {
            $filename .= '_from_' . Carbon::parse($startDate)->format('Y-m-d');
        } elseif ($endDate) {
            $filename .= '_until_' . Carbon::parse($endDate)->format('Y-m-d');
        }
        $filename .= '_' . now()->format('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new MahasiswaMagangExport($startDate, $endDate, $dateField), $filename);
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

    /**
     * Approve a magang application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MahasiswaMagang  $mahasiswaMagang
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $id)
    {
        abort_if(Gate::denies('mahasiswa_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $mahasiswaMagang = MahasiswaMagang::findOrFail($id);
        
        $mahasiswaMagang->update([
            'approve' => 'APPROVED',
            'approved_by_id' => auth()->id(),
            'dosen_pembimbing' => $request->input('dosen_pembimbing')
        ]);

        Alert::success('Success', 'Kegiatan Magang Mahasiswa berhasil di approved');

        return redirect()->route('admin.mahasiswa-magangs.index');
    }

    /**
     * Reject a magang application.
     *
     * @param  \App\Models\MahasiswaMagang  $mahasiswaMagang
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        abort_if(Gate::denies('mahasiswa_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $mahasiswaMagang = MahasiswaMagang::findOrFail($id);
        
        $mahasiswaMagang->update([
            'approve' => 'REJECTED',
            'approved_by_id' => auth()->id()
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Verify a magang application.
     *
     * @param  \App\Models\MahasiswaMagang  $mahasiswaMagang
     * @return \Illuminate\Http\Response
     */
    public function verify($id)
    {
        abort_if(Gate::denies('mahasiswa_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $mahasiswaMagang = MahasiswaMagang::findOrFail($id);
        
        $mahasiswaMagang->update([
            'verified' => 'APPROVED',
            'verified_by_id' => auth()->id()
        ]);

        return redirect()->route('admin.mahasiswa-magangs.index')->with('message', 'Application verified successfully');
    }

    /**
     * Process verification form data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function processVerification(Request $request, $id)
    {
        abort_if(Gate::denies('mahasiswa_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $mahasiswaMagang = MahasiswaMagang::findOrFail($id);
        
        $mahasiswaMagang->update([
            'verified' => $request->input('verified'),
            'verification_notes' => $request->input('verification_notes'),
            'verified_by_id' => auth()->id()
        ]);

        return redirect()->route('admin.mahasiswa-magangs.verify-documents', $mahasiswaMagang->id)
            ->with('success', 'Verification status updated successfully.');
    }

    /**
     * Display a page for document verification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifyDocuments($id)
    {
        abort_if(Gate::denies('mahasiswa_magang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $mahasiswaMagang = MahasiswaMagang::with(['mahasiswa', 'magang', 'approved_by', 'verified_by', 'monitorings'])->findOrFail($id);
        
        return view('admin.mahasiswaMagangs.verify_documents', compact('mahasiswaMagang'));
    }
    
    /**
     * Generate a completion certificate for verified internships.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generateCertificate($id)
    {
        abort_if(Gate::denies('mahasiswa_magang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $mahasiswaMagang = MahasiswaMagang::with(['mahasiswa', 'verified_by'])->findOrFail($id);
        
        if ($mahasiswaMagang->verified != 'APPROVED') {
            return redirect()->back()->with('error', 'Cannot generate certificate. Internship is not yet verified.');
        }
        
        return view('frontend.mahasiswaMagangs.completion_certificate', compact('mahasiswaMagang'));
    }

    /**
     * Admin dashboard showing student phases overview
     */
    public function dashboard()
    {
        abort_if(Gate::denies('mahasiswa_magang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $mahasiswaMagangs = MahasiswaMagang::with(['mahasiswa', 'magang', 'approved_by', 'verified_by'])->get();
        
        // Phase statistics
        $stats = [
            'pending_applications' => 0,
            'rejected_applications' => 0,
            'awaiting_pretest' => 0,
            'in_internship' => 0,
            'ready_for_posttest' => 0,
            'awaiting_verification' => 0,
            'completed' => 0,
            'total' => $mahasiswaMagangs->count()
        ];
        
        // Categorize students by phase
        $studentsByPhase = [
            'Phase 1: Application Review' => collect(),
            'Application Rejected' => collect(),
            'Phase 2: Pre-test Required' => collect(),
            'Phase 3: Internship Period' => collect(),
            'Phase 3: Ready for Post-test' => collect(),
            'Phase 4: Document Verification' => collect(),
            'Phase 4: Document Revision Required' => collect(),
            'Completed Successfully' => collect(),
        ];
        
        foreach ($mahasiswaMagangs as $magang) {
            $phaseInfo = $this->getPhaseInfo($magang);
            $stats[$phaseInfo['stat_key']]++;
            
            if (isset($studentsByPhase[$phaseInfo['phase']])) {
                $studentsByPhase[$phaseInfo['phase']]->push($magang);
            }
        }
        
        $dospems = Dospem::pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        return view('admin.mahasiswaMagangs.dashboard', compact('stats', 'studentsByPhase', 'dospems'));
    }

    private function getPhaseInfo($row)
    {
        // Phase 1: Application Review
        if ($row->approve === 'PENDING') {
            return ['phase' => 'Phase 1: Application Review', 'stat_key' => 'pending_applications'];
        }
        
        if ($row->approve === 'REJECTED') {
            return ['phase' => 'Application Rejected', 'stat_key' => 'rejected_applications'];
        }
        
        // Phase 2: Pre-test & Document Submission
        if ($row->approve === 'APPROVED' && !$row->pretest) {
            return ['phase' => 'Phase 2: Pre-test Required', 'stat_key' => 'awaiting_pretest'];
        }
        
        // Phase 3: Internship Period (Monitoring)
        if ($row->approve === 'APPROVED' && $row->pretest && !$row->posttest) {
            // Check monitoring requirements
            $monitoringCount = \App\Models\MonitoringMagang::where('magang_id', $row->id)->count();
            
            if ($monitoringCount < 1) {
                return ['phase' => 'Phase 3: Internship Period', 'stat_key' => 'in_internship'];
            } else {
                // Check if 1 month has passed since pretest
                $pretestDate = $row->pretest_completed_at;
                if (!$pretestDate) {
                    // Fallback to test record if timestamp not available
                    $pretestRecord = \App\Models\TestMagang::where('magang_id', $row->id)
                        ->where('type', 'PRETEST')
                        ->first();
                    if ($pretestRecord) {
                        $pretestDate = $pretestRecord->created_at;
                    }
                }
                
                // Ensure $pretestDate is a Carbon instance before calling copy()
                if ($pretestDate) {
                    if (is_string($pretestDate)) {
                        $pretestDate = \Carbon\Carbon::parse($pretestDate);
                    }
                    if ($pretestDate instanceof \Carbon\Carbon && now()->gte($pretestDate->copy()->addMonth())) {
                        return ['phase' => 'Phase 3: Ready for Post-test', 'stat_key' => 'ready_for_posttest'];
                    } else {
                        return ['phase' => 'Phase 3: Internship Period', 'stat_key' => 'in_internship'];
                    }
                } else {
                    return ['phase' => 'Phase 3: Internship Period', 'stat_key' => 'in_internship'];
                }
            }
        }
        
        // Phase 4: Completion Phase
        if ($row->approve === 'APPROVED' && $row->pretest && $row->posttest) {
            if ($row->verified === 'PENDING') {
                return ['phase' => 'Phase 4: Document Verification', 'stat_key' => 'awaiting_verification'];
            } elseif ($row->verified === 'REJECTED') {
                return ['phase' => 'Phase 4: Document Revision Required', 'stat_key' => 'awaiting_verification'];
            } elseif ($row->verified === 'APPROVED') {
                return ['phase' => 'Completed Successfully', 'stat_key' => 'completed'];
            }
        }
        
        // Default fallback
        return ['phase' => 'Status Unknown', 'stat_key' => 'pending_applications'];
    }

    private function determineCurrentPhase($row)
    {
        // Phase 1: Application Review
        if ($row->approve === 'PENDING') {
            return '<span class="badge badge-warning"><i class="fas fa-clock"></i> Phase 1: Application Review</span>';
        }
        
        if ($row->approve === 'REJECTED') {
            return '<span class="badge badge-danger"><i class="fas fa-times"></i> Application Rejected</span>';
        }
        
        // Phase 2: Pre-test & Document Submission
        if ($row->approve === 'APPROVED' && !$row->pretest) {
            return '<span class="badge badge-info"><i class="fas fa-file-alt"></i> Phase 2: Pre-test Required</span>';
        }
        
        // Phase 3: Internship Period (Monitoring)
        if ($row->approve === 'APPROVED' && $row->pretest && !$row->posttest) {
            // Check monitoring requirements
            $monitoringCount = \App\Models\MonitoringMagang::where('magang_id', $row->id)->count();
            
            if ($monitoringCount < 1) {
                return '<span class="badge badge-primary"><i class="fas fa-chart-line"></i> Phase 3: Internship Period (' . $monitoringCount . '/1 reports)</span>';
            } else {
                // Check if 1 month has passed since pretest
                $pretestDate = $row->pretest_completed_at;
                if (!$pretestDate) {
                    // Fallback to test record if timestamp not available
                    $pretestRecord = \App\Models\TestMagang::where('magang_id', $row->id)
                        ->where('type', 'PRETEST')
                        ->first();
                    if ($pretestRecord) {
                        $pretestDate = $pretestRecord->created_at;
                    }
                }
                
                if ($pretestDate) {
                    // Ensure $pretestDate is a Carbon instance before calling copy()
                    if (is_string($pretestDate)) {
                        $pretestDate = \Carbon\Carbon::parse($pretestDate);
                    }
                    
                    if ($pretestDate instanceof \Carbon\Carbon) {
                        $oneMonthLater = $pretestDate->copy()->addMonth();
                        $now = now();
                        
                        if ($now->gte($oneMonthLater)) {
                            return '<span class="badge badge-success"><i class="fas fa-clipboard-check"></i> Phase 3: Ready for Post-test</span>';
                        } else {
                            $daysRemaining = $now->diffInDays($oneMonthLater);
                            return '<span class="badge badge-primary"><i class="fas fa-hourglass-half"></i> Phase 3: Post-test in ' . $daysRemaining . ' days</span>';
                        }
                    } else {
                        return '<span class="badge badge-primary"><i class="fas fa-chart-line"></i> Phase 3: Internship Period</span>';
                    }
                } else {
                    return '<span class="badge badge-primary"><i class="fas fa-chart-line"></i> Phase 3: Internship Period</span>';
                }
            }
        }
        
        // Phase 4: Completion Phase
        if ($row->approve === 'APPROVED' && $row->pretest && $row->posttest) {
            if ($row->verified === 'PENDING') {
                return '<span class="badge badge-warning"><i class="fas fa-file-check"></i> Phase 4: Document Verification</span>';
            } elseif ($row->verified === 'REJECTED') {
                return '<span class="badge badge-warning"><i class="fas fa-redo"></i> Phase 4: Document Revision Required</span>';
            } elseif ($row->verified === 'APPROVED') {
                return '<span class="badge badge-success"><i class="fas fa-graduation-cap"></i> Completed Successfully</span>';
            }
        }
        
        // Default fallback
        return '<span class="badge badge-secondary"><i class="fas fa-question"></i> Status Unknown</span>';
    }
}
