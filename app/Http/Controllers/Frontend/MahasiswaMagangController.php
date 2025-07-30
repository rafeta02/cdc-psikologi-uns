<?php

namespace App\Http\Controllers\Frontend;

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
use Alert;

class MahasiswaMagangController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('mahasiswa_magang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // SECURITY FIX: Only show current user's applications
        $mahasiswaMagangs = MahasiswaMagang::with(['mahasiswa', 'magang', 'approved_by', 'verified_by', 'media'])
            ->where('mahasiswa_id', auth()->id())
            ->get();

        return view('frontend.mahasiswaMagangs.index', compact('mahasiswaMagangs'));
    }

    public function create()
    {
        abort_if(Gate::denies('mahasiswa_magang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = Magang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approved_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $verified_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.mahasiswaMagangs.create', compact('approved_bies', 'magangs', 'mahasiswas', 'verified_bies'));
    }

    public function store(StoreMahasiswaMagangRequest $request)
    {
        // SECURITY FIX: Ensure mahasiswa_id is set to current user
        $data = $request->all();
        $data['mahasiswa_id'] = auth()->id();
        
        $mahasiswaMagang = MahasiswaMagang::create($data);

        // New document uploads
        if ($request->input('proposal_magang', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('proposal_magang'))))->toMediaCollection('proposal_magang');
        }

        if ($request->input('surat_tugas', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_tugas'))))->toMediaCollection('surat_tugas');
        }

        if ($request->input('berkas_instansi', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('berkas_instansi'))))->toMediaCollection('berkas_instansi');
        }

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

        // Handle new document uploads
        if ($request->input('khs', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('khs'))))->toMediaCollection('khs');
        }

        if ($request->input('krs', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('krs'))))->toMediaCollection('krs');
        }

        if ($request->input('form_persetujuan_dosen_pa', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('form_persetujuan_dosen_pa'))))->toMediaCollection('form_persetujuan_dosen_pa');
        }

        if ($request->input('surat_persetujuan_rekognisi', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_persetujuan_rekognisi'))))->toMediaCollection('surat_persetujuan_rekognisi');
        }

        if ($request->input('logbook_mbkm', false)) {
            $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('logbook_mbkm'))))->toMediaCollection('logbook_mbkm');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mahasiswaMagang->id]);
        }

        Alert::success('Pendaftaran Magang Berhasil di Submit. Silahkan menunggu validasi dari admin.');

        return redirect()->route('frontend.mahasiswa-magangs.index');
    }

    public function edit(MahasiswaMagang $mahasiswaMagang)
    {
        abort_if(Gate::denies('mahasiswa_magang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        // SECURITY FIX: Only allow editing own applications
        if ($mahasiswaMagang->mahasiswa_id !== auth()->id()) {
            abort(Response::HTTP_FORBIDDEN, 'You can only edit your own applications');
        }

        $mahasiswas = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $magangs = Magang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approved_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $verified_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mahasiswaMagang->load('mahasiswa', 'magang', 'approved_by', 'verified_by');

        return view('frontend.mahasiswaMagangs.edit', compact('approved_bies', 'magangs', 'mahasiswaMagang', 'mahasiswas', 'verified_bies'));
    }

    public function update(UpdateMahasiswaMagangRequest $request, MahasiswaMagang $mahasiswaMagang)
    {
        // SECURITY FIX: Only allow updating own applications
        if ($mahasiswaMagang->mahasiswa_id !== auth()->id()) {
            abort(Response::HTTP_FORBIDDEN, 'You can only update your own applications');
        }

        $mahasiswaMagang->update($request->all());

        // Handle proposal_magang file
        if ($request->input('proposal_magang', false)) {
            if (! $mahasiswaMagang->proposal_magang || $request->input('proposal_magang') !== $mahasiswaMagang->proposal_magang->file_name) {
                if ($mahasiswaMagang->proposal_magang) {
                    $mahasiswaMagang->proposal_magang->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('proposal_magang'))))->toMediaCollection('proposal_magang');
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
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_tugas'))))->toMediaCollection('surat_tugas');
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
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('berkas_instansi'))))->toMediaCollection('berkas_instansi');
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

        // Handle new document updates
        if ($request->input('khs', false)) {
            if (! $mahasiswaMagang->khs || $request->input('khs') !== $mahasiswaMagang->khs->file_name) {
                if ($mahasiswaMagang->khs) {
                    $mahasiswaMagang->khs->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('khs'))))->toMediaCollection('khs');
            }
        } elseif ($mahasiswaMagang->khs) {
            $mahasiswaMagang->khs->delete();
        }

        if ($request->input('krs', false)) {
            if (! $mahasiswaMagang->krs || $request->input('krs') !== $mahasiswaMagang->krs->file_name) {
                if ($mahasiswaMagang->krs) {
                    $mahasiswaMagang->krs->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('krs'))))->toMediaCollection('krs');
            }
        } elseif ($mahasiswaMagang->krs) {
            $mahasiswaMagang->krs->delete();
        }

        if ($request->input('form_persetujuan_dosen_pa', false)) {
            if (! $mahasiswaMagang->form_persetujuan_dosen_pa || $request->input('form_persetujuan_dosen_pa') !== $mahasiswaMagang->form_persetujuan_dosen_pa->file_name) {
                if ($mahasiswaMagang->form_persetujuan_dosen_pa) {
                    $mahasiswaMagang->form_persetujuan_dosen_pa->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('form_persetujuan_dosen_pa'))))->toMediaCollection('form_persetujuan_dosen_pa');
            }
        } elseif ($mahasiswaMagang->form_persetujuan_dosen_pa) {
            $mahasiswaMagang->form_persetujuan_dosen_pa->delete();
        }

        if ($request->input('surat_persetujuan_rekognisi', false)) {
            if (! $mahasiswaMagang->surat_persetujuan_rekognisi || $request->input('surat_persetujuan_rekognisi') !== $mahasiswaMagang->surat_persetujuan_rekognisi->file_name) {
                if ($mahasiswaMagang->surat_persetujuan_rekognisi) {
                    $mahasiswaMagang->surat_persetujuan_rekognisi->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('surat_persetujuan_rekognisi'))))->toMediaCollection('surat_persetujuan_rekognisi');
            }
        } elseif ($mahasiswaMagang->surat_persetujuan_rekognisi) {
            $mahasiswaMagang->surat_persetujuan_rekognisi->delete();
        }

        if ($request->input('logbook_mbkm', false)) {
            if (! $mahasiswaMagang->logbook_mbkm || $request->input('logbook_mbkm') !== $mahasiswaMagang->logbook_mbkm->file_name) {
                if ($mahasiswaMagang->logbook_mbkm) {
                    $mahasiswaMagang->logbook_mbkm->delete();
                }
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input('logbook_mbkm'))))->toMediaCollection('logbook_mbkm');
            }
        } elseif ($mahasiswaMagang->logbook_mbkm) {
            $mahasiswaMagang->logbook_mbkm->delete();
        }

        return redirect()->route('frontend.mahasiswa-magangs.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('mahasiswa_magang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // SECURITY FIX: Only allow viewing own applications
        $mahasiswaMagang = MahasiswaMagang::where('id', $id)
            ->where('mahasiswa_id', auth()->id())
            ->firstOrFail();
        $mahasiswaMagang->load('mahasiswa', 'magang', 'approved_by', 'verified_by');

        return view('frontend.mahasiswaMagangs.show', compact('mahasiswaMagang'));
    }

    public function destroy(MahasiswaMagang $mahasiswaMagang)
    {
        abort_if(Gate::denies('mahasiswa_magang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        // SECURITY FIX: Only allow deleting own applications
        if ($mahasiswaMagang->mahasiswa_id !== auth()->id()) {
            abort(Response::HTTP_FORBIDDEN, 'You can only delete your own applications');
        }

        $mahasiswaMagang->delete();

        return back();
    }

    public function massDestroy(MassDestroyMahasiswaMagangRequest $request)
    {
        // SECURITY FIX: Only allow deleting own applications
        $mahasiswaMagangs = MahasiswaMagang::whereIn('id', request('ids'))
            ->where('mahasiswa_id', auth()->id())
            ->get();

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

    public function apply($slug)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'You must be logged in to apply for internships');
        }

        $magang = Magang::where('slug', $slug)->firstOrFail();
        
        return view('frontend.mahasiswaMagangs.apply', compact('magang'));
    }

    /**
     * Check if student can create new application after rejection
     */
    public function checkNewApplicationEligibility($magang_id)
    {
        $existingApplication = MahasiswaMagang::where('mahasiswa_id', auth()->id())
            ->where('magang_id', $magang_id)
            ->first();
            
        if ($existingApplication && $existingApplication->approve !== 'REJECTED') {
            return redirect()->back()
                ->with('error', 'You already have an active application for this internship.');
        }
        
        return null; // Eligible to create new application
    }

    public function storeApplication(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'You must be logged in to apply for internships');
        }
        
        $validatedData = $request->validate([
            'nim' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:12',
            'type' => 'required|string|in:' . implode(',', array_keys(MahasiswaMagang::TYPE_SELECT)),
            'bidang' => 'required|string|in:' . implode(',', array_keys(MahasiswaMagang::BIDANG_SELECT)),
            'magang_id' => 'nullable|exists:magangs,id',
            'company_id' => 'nullable|exists:companies,id',
            'instansi' => 'required|string|max:255',
            'alamat_instansi' => 'required|string|max:1000',
        ]);
        
        // Check if user already has an application for this magang
        $existingApplication = MahasiswaMagang::where('mahasiswa_id', auth()->id())
            ->where('magang_id', $validatedData['magang_id'])
            ->first();
            
        // Allow new application only if previous was rejected
        if ($existingApplication && $existingApplication->approve !== 'REJECTED') {
            return redirect()->route('magang-detail', ['slug' => Magang::find($validatedData['magang_id'])->slug])
                ->with('error', 'You have already applied for this internship opportunity.');
        }
        
        // If previous application was rejected, delete it and create new one
        if ($existingApplication && $existingApplication->approve === 'REJECTED') {
            $existingApplication->delete();
        }
        
        $mahasiswaMagang = new MahasiswaMagang();
        $mahasiswaMagang->mahasiswa_id = auth()->id();
        $mahasiswaMagang->nim = $validatedData['nim'];
        $mahasiswaMagang->nama = $validatedData['nama'];
        $mahasiswaMagang->semester = $validatedData['semester'];
        $mahasiswaMagang->type = $validatedData['type'];
        $mahasiswaMagang->bidang = $validatedData['bidang'];
        $mahasiswaMagang->magang_id = $validatedData['magang_id'];
        
        // Handle company relationship
        if ($validatedData['company_id']) {
            $mahasiswaMagang->company_id = $validatedData['company_id'];
        }
        
        $mahasiswaMagang->instansi = $validatedData['instansi'];
        $mahasiswaMagang->alamat_instansi = $validatedData['alamat_instansi'];
        $mahasiswaMagang->approve = 'PENDING';
        $mahasiswaMagang->verified = 'PENDING';
        $mahasiswaMagang->save();

        // Update the filled count for the magang
        $magang = Magang::find($validatedData['magang_id']);
        if ($magang) {
            $magang->filled = ($magang->filled ?? 0) + 1;
            $magang->save();
        }
        
        Alert::success('Pendaftaran Magang Berhasil di Submit. Silahkan menunggu validasi dari admin.');
        
        return redirect()->route('magang-detail', ['slug' => $magang->slug])
            ->with('success', 'Your application has been submitted successfully. You can check the status in your dashboard.');
    }

    /**
     * Check monitoring report requirements
     */
    public function checkMonitoringRequirements($mahasiswaMagang)
    {
        $monitoringCount = \App\Models\MonitoringMagang::where('magang_id', $mahasiswaMagang->id)->count();
        
        $requirements = [
            'current_count' => $monitoringCount,
            'minimum_required' => 1,
            'is_sufficient' => $monitoringCount >= 1,
            'warning_message' => $monitoringCount < 1 ? 
                "Warning: You need at least 1 monitoring report. Current: {$monitoringCount}/1" : null
        ];
        
        return $requirements;
    }

    /**
     * Check if posttest is available based on 1-month rule
     */
    public function checkPosttestAvailability($mahasiswaMagang)
    {
        if (!$mahasiswaMagang->pretest) {
            return [
                'available' => false,
                'reason' => 'Complete pretest first'
            ];
        }
        
        // Use pretest_completed_at if available, otherwise fall back to test record
        $pretestDate = $mahasiswaMagang->pretest_completed_at;
        
        if (!$pretestDate) {
            // Fallback to test record if timestamp not available
            $pretestRecord = \App\Models\TestMagang::where('magang_id', $mahasiswaMagang->id)
                ->where('mahasiswa_id', $mahasiswaMagang->mahasiswa_id)
                ->where('type', 'PRETEST')
                ->first();
                
            if (!$pretestRecord) {
                return [
                    'available' => false,
                    'reason' => 'Pretest record not found'
                ];
            }
            
            $pretestDate = $pretestRecord->created_at;
        }
        
        // Ensure $pretestDate is a Carbon instance
        if (is_string($pretestDate)) {
            $pretestDate = \Carbon\Carbon::parse($pretestDate);
        } elseif (!($pretestDate instanceof \Carbon\Carbon)) {
            return [
                'available' => false,
                'reason' => 'Invalid pretest date'
            ];
        }
        
        $oneMonthLater = $pretestDate->copy()->addMonth();
        $now = now();
        
        if ($now->gte($oneMonthLater)) {
            return [
                'available' => true,
                'reason' => null
            ];
        } else {
            $daysRemaining = $now->diffInDays($oneMonthLater);
            return [
                'available' => false,
                'reason' => "Posttest will be available in {$daysRemaining} days (1 month after pretest)"
            ];
        }
    }

    /**
     * Show file resubmission form for rejected applications
     */
    public function resubmitFiles(MahasiswaMagang $mahasiswaMagang)
    {
        // Check if user owns this application
        if ($mahasiswaMagang->mahasiswa_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the application is rejected
        if ($mahasiswaMagang->approve !== 'REJECTED') {
            return redirect()->route('frontend.mahasiswa-magangs.index')
                ->with('error', 'Only rejected applications can be resubmitted.');
        }

        return view('frontend.mahasiswaMagangs.resubmit_files', compact('mahasiswaMagang'));
    }

    /**
     * Update files for a rejected application
     */
    public function updateFiles(Request $request, MahasiswaMagang $mahasiswaMagang)
    {
        // Check if user owns this application
        if ($mahasiswaMagang->mahasiswa_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the application is rejected
        if ($mahasiswaMagang->approve !== 'REJECTED') {
            return redirect()->route('frontend.mahasiswa-magangs.index')
                ->with('error', 'Only rejected applications can be resubmitted.');
        }

        // Handle berkas_magang files
        if (count($mahasiswaMagang->berkas_magang) > 0) {
            foreach ($mahasiswaMagang->berkas_magang as $media) {
                if (!in_array($media->file_name, $request->input('berkas_magang', []))) {
                    $media->delete();
                }
            }
        }
        $media = $mahasiswaMagang->berkas_magang->pluck('file_name')->toArray();
        foreach ($request->input('berkas_magang', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('berkas_magang');
            }
        }

        // Reset approval status to pending
        $mahasiswaMagang->approve = 'PENDING';
        $mahasiswaMagang->save();

        return redirect()->route('frontend.mahasiswa-magangs.index')
            ->with('success', 'Your internship application files have been updated and resubmitted.');
    }

    /**
     * Show document upload form
     */
    public function uploadDocuments(MahasiswaMagang $mahasiswaMagang)
    {
        // Check if user owns this application
        if ($mahasiswaMagang->mahasiswa_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('frontend.mahasiswaMagangs.upload_documents', compact('mahasiswaMagang'));
    }

    /**
     * Store uploaded documents
     */
    public function storeDocuments(Request $request, MahasiswaMagang $mahasiswaMagang)
    {
        // Check if user owns this application
        if ($mahasiswaMagang->mahasiswa_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Validate the request
        $request->validate([
            'proposal_magang' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'surat_tugas' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'berkas_instansi' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'khs' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'krs' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'form_persetujuan_dosen_pa' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'surat_persetujuan_rekognisi' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'logbook_mbkm' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        // Handle proposal_magang upload
        if ($request->hasFile('proposal_magang')) {
            if ($mahasiswaMagang->proposal_magang) {
                $mahasiswaMagang->proposal_magang->delete();
            }
            $mahasiswaMagang->addMedia($request->file('proposal_magang'))
                ->toMediaCollection('proposal_magang');
        }

        // Handle surat_tugas upload
        if ($request->hasFile('surat_tugas')) {
            if ($mahasiswaMagang->surat_tugas) {
                $mahasiswaMagang->surat_tugas->delete();
            }
            $mahasiswaMagang->addMedia($request->file('surat_tugas'))
                ->toMediaCollection('surat_tugas');
        }

        // Handle berkas_instansi upload
        if ($request->hasFile('berkas_instansi')) {
            if ($mahasiswaMagang->berkas_instansi) {
                $mahasiswaMagang->berkas_instansi->delete();
            }
            $mahasiswaMagang->addMedia($request->file('berkas_instansi'))
                ->toMediaCollection('berkas_instansi');
        }

        // Handle new document uploads
        if ($request->hasFile('khs')) {
            if ($mahasiswaMagang->khs) {
                $mahasiswaMagang->khs->delete();
            }
            $mahasiswaMagang->addMedia($request->file('khs'))
                ->toMediaCollection('khs');
        }

        if ($request->hasFile('krs')) {
            if ($mahasiswaMagang->krs) {
                $mahasiswaMagang->krs->delete();
            }
            $mahasiswaMagang->addMedia($request->file('krs'))
                ->toMediaCollection('krs');
        }

        if ($request->hasFile('form_persetujuan_dosen_pa')) {
            if ($mahasiswaMagang->form_persetujuan_dosen_pa) {
                $mahasiswaMagang->form_persetujuan_dosen_pa->delete();
            }
            $mahasiswaMagang->addMedia($request->file('form_persetujuan_dosen_pa'))
                ->toMediaCollection('form_persetujuan_dosen_pa');
        }

        if ($request->hasFile('surat_persetujuan_rekognisi')) {
            if ($mahasiswaMagang->surat_persetujuan_rekognisi) {
                $mahasiswaMagang->surat_persetujuan_rekognisi->delete();
            }
            $mahasiswaMagang->addMedia($request->file('surat_persetujuan_rekognisi'))
                ->toMediaCollection('surat_persetujuan_rekognisi');
        }

        if ($request->hasFile('logbook_mbkm')) {
            if ($mahasiswaMagang->logbook_mbkm) {
                $mahasiswaMagang->logbook_mbkm->delete();
            }
            $mahasiswaMagang->addMedia($request->file('logbook_mbkm'))
                ->toMediaCollection('logbook_mbkm');
        }

        Alert::success('Documents uploaded successfully');

        return redirect()->route('frontend.mahasiswa-magangs.upload-documents', $mahasiswaMagang->id)
            ->with('success', 'Documents uploaded successfully');
    }
    
    /**
     * Show final document upload form
     */
    public function uploadFinalDocuments(MahasiswaMagang $mahasiswaMagang)
    {
        // Check if user owns this application
        if ($mahasiswaMagang->mahasiswa_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the application is approved
        if ($mahasiswaMagang->approve !== 'APPROVED') {
            return redirect()->route('frontend.mahasiswa-magangs.index')
                ->with('error', 'Only approved internships can upload final documents.');
        }
        
        // Check monitoring requirements (minimum 1 report)
        $monitoringCount = \App\Models\MonitoringMagang::where('magang_id', $mahasiswaMagang->id)->count();
        if ($monitoringCount < 1) {
            return redirect()->route('frontend.mahasiswa-magangs.index')
                ->with('error', "You need at least 1 monitoring report before uploading final documents. Current: {$monitoringCount}/1");
        }

        return view('frontend.mahasiswaMagangs.upload_final_documents', compact('mahasiswaMagang'));
    }

    /**
     * Store final documents
     */
    public function storeFinalDocuments(Request $request, MahasiswaMagang $mahasiswaMagang)
    {
        // Check if user owns this application
        if ($mahasiswaMagang->mahasiswa_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the application is approved
        if ($mahasiswaMagang->approve !== 'APPROVED') {
            return redirect()->route('frontend.mahasiswa-magangs.index')
                ->with('error', 'Only approved internships can upload final documents.');
        }
        
        // Check monitoring requirements (minimum 1 report)
        $monitoringCount = \App\Models\MonitoringMagang::where('magang_id', $mahasiswaMagang->id)->count();
        if ($monitoringCount < 1) {
            return redirect()->route('frontend.mahasiswa-magangs.index')
                ->with('error', "You need at least 1 monitoring report before uploading final documents. Current: {$monitoringCount}/1");
        }

        // Validate uploaded files - allow Excel files for evaluation forms
        $request->validate([
            'laporan_akhir.*' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'presensi.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'sertifikat.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'form_penilaian_pembimbing_lapangan' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'form_penilaian_dosen_pembimbing' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'berita_acara_seminar' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'presensi_kehadiran_seminar.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'notulen_pertanyaan' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'tanda_bukti_penyerahan_laporan' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'berkas_magang.*' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'khs' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'krs' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'form_persetujuan_dosen_pa' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'surat_persetujuan_rekognisi' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'logbook_mbkm' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        // Handle multiple file uploads
        $multipleFileFields = ['laporan_akhir', 'presensi', 'sertifikat', 'presensi_kehadiran_seminar', 'berkas_magang'];
        foreach ($multipleFileFields as $field) {
            if (count($mahasiswaMagang->$field) > 0) {
                foreach ($mahasiswaMagang->$field as $media) {
                    if (!in_array($media->file_name, $request->input($field, []))) {
                        $media->delete();
                    }
                }
            }
            $media = $mahasiswaMagang->$field->pluck('file_name')->toArray();
            foreach ($request->input($field, []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($file)))
                        ->toMediaCollection($field);
                }
            }
        }

        // Handle single file uploads
        $singleFileFields = [
            'form_penilaian_pembimbing_lapangan',
            'form_penilaian_dosen_pembimbing',
            'berita_acara_seminar',
            'notulen_pertanyaan',
            'tanda_bukti_penyerahan_laporan',
            'khs',
            'krs',
            'form_persetujuan_dosen_pa',
            'surat_persetujuan_rekognisi',
            'logbook_mbkm'
        ];
        foreach ($singleFileFields as $field) {
            if ($request->input($field, false)) {
                if (!$mahasiswaMagang->$field || $request->input($field) !== $mahasiswaMagang->$field->file_name) {
                    if ($mahasiswaMagang->$field) {
                        $mahasiswaMagang->$field->delete();
                    }
                    $mahasiswaMagang->addMedia(storage_path('tmp/uploads/' . basename($request->input($field))))
                        ->toMediaCollection($field);
                }
            } elseif ($mahasiswaMagang->$field) {
                $mahasiswaMagang->$field->delete();
            }
        }

        return redirect()->route('frontend.mahasiswa-magangs.upload-final-documents', $mahasiswaMagang->id)
            ->with('success', 'Final documents uploaded successfully');
    }

    /**
     * Generate and display completion certificate
     */
    public function generateCertificate(MahasiswaMagang $mahasiswaMagang)
    {
        // Check if user owns this application
        if ($mahasiswaMagang->mahasiswa_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the internship is verified and approved
        if ($mahasiswaMagang->verified != 'APPROVED') {
            return redirect()->route('frontend.mahasiswa-magangs.index')
                ->with('error', 'Cannot generate certificate. Internship is not yet verified.');
        }
        
        // Load related data for the certificate
        $mahasiswaMagang->load(['mahasiswa', 'verified_by']);
        
        return view('frontend.mahasiswaMagangs.completion_certificate', compact('mahasiswaMagang'));
    }
}
