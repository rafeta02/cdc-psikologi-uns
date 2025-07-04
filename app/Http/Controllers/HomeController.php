<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use App\Models\Vacancy;
use App\Models\Industry;
use App\Models\Position;
use App\Models\Department;
use App\Models\Education;
use App\Models\Experience;
use App\Models\VacancyTag;
use App\Models\Post;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use App\Models\TracerStakeholder;
use App\Models\TracerAlumnu;
use App\Models\KategoriPrestasi;
use App\Models\PrestasiMahasiswa;
use App\Models\PrestasiMahasiswaDetail;
use App\Models\Contest;
use SEOMeta;
use Alert;
use App\Charts\MonthlyUsersChart;
use App\Charts\PieChart;
use App\Charts\BarChart;
use DB;
use App\Models\Magang;



class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $positions = Position::pluck('name', 'id');
        $recentJobs = Vacancy::latest()->take(5)->get();
        $interns = Vacancy::where('type', 'internship')->latest()->take(5)->get();
        $fulltimes = Vacancy::where('type', 'fulltime')->latest()->take(5)->get();

        $posts = $posts = Post::whereHas('categories', function ($query) {
            $query->where('slug', 'alumni-caring');
        })->where('status', 'published')->latest()->take(3)->get();

        return view('frontend.home', compact('positions', 'recentJobs', 'interns', 'fulltimes','posts'));
    }

    public function job(Request $request)
    {
        if ($request->ajax()) {
            $query = Vacancy::query();

            if (!empty($request->name)) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if (!empty($request->city)) {
                $query->where('regency_id', $request->city);
            }

            if (!empty($request->industry)) {
                $query->where('industry_id', $request->industry);
            }

            if (!empty($request->position)) {
                $query->where('position_id', $request->position);
            }

            if (!empty($request->job_type)) {
                $query->where('type', $request->job_type);
            }

            if (!empty($request->experience)) {
                $query->where('experience_id', $request->experience);
            }

            if (!empty($request->tag)) {
                $query->whereHas('tags', function ($query) use ($request) {
                    $query->whereIn('vacancy_tag_id', $request->tag);
                });
            }

            if (!empty($request->education)) {
                $query->whereHas('education', function ($query) use ($request) {
                    $query->whereIn('education_id', $request->education);
                });
            }

            if (!empty($request->department)) {
                $query->whereHas('departments', function ($query) use ($request) {
                    $query->whereIn('department_id', $request->department);
                });
            }

            if (!empty($request->onlyopen)) {
                $query->where(function($q) {
                    $q->where('close_date', '>=', now())->orWhere('close_date_exist', 0);
                });
            }

            if (!empty($request->company)) {
                $query->where('company_id', $request->company);
            }

            // Paginate results
            $jobs = $query->latest()->paginate(7);
            // Return partial view with filtered and paginated results
            return view('partials.job-list', compact('jobs'))->render();
        }

        // $jobs = Vacancy::where('close_date', '>=', now())->latest()->paginate(10);
        $jobs = Vacancy::latest()->paginate(7);
        $positions = Position::pluck('name', 'id');
        $industries = Industry::pluck('name', 'id');
        $educations = Education::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        $experiences = Experience::pluck('name', 'id');
        $tags = VacancyTag::pluck('name', 'id');
        return view('frontend.jobs', compact('jobs', 'positions', 'industries', 'educations', 'departments', 'experiences', 'tags'));
    }

    public function jobDetail($slug)
    {
        $job = Vacancy::where('slug', $slug)->first();
        $company = Company::find($job->company_id);
        $relatedJobs = Vacancy::whereNot('slug', $slug)->where('company_id', $job->company_id)->where('position_id', $job->position_id)->where('close_date', '>=', now())->latest()->take(3)->get();
        return view('frontend.job_detail', compact('job', 'company', 'relatedJobs'));
    }

    public function company(Request $request)
    {
        if ($request->ajax()) {
            $query = Company::query();

            if (!empty($request->name)) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if (!empty($request->city)) {
                $query->where('regency_id', $request->city);
            }

            if (!empty($request->industry)) {
                $query->where('industry_id', $request->industry);
            }
            // Paginate results
            $companies = $query->paginate(12);
            // Return partial view with filtered and paginated results
            return view('partials.company-list', compact('companies'))->render();
        }

        $companies = Company::withCount(['vacancies as open_vacancies' => function($query) {
            $query->where(function($q) {
                $q->where('close_date', '>=', now())
                  ->orWhereNull('close_date');
            });
        }])
        ->orderBy('open_vacancies', 'desc')
        ->orderBy('name', 'asc')
        ->paginate(12);

        $industries = Industry::pluck('name', 'id');

        return view('frontend.companies', compact('companies', 'industries'));
    }

    public function jobAjax(Request $request)
    {
        if ($request->ajax()) {
            $query = Vacancy::query();

            if (!empty($request->name)) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if (!empty($request->city)) {
                $query->where('regency_id', $request->city);
            }

            if (!empty($request->industry)) {
                $query->where('industry_id', $request->industry);
            }

            if (!empty($request->position)) {
                $query->where('position_id', $request->position);
            }

            if (!empty($request->job_type)) {
                $query->where('type', $request->job_type);
            }

            if (!empty($request->experience)) {
                $query->where('experience_id', $request->experience);
            }

            if (!empty($request->tag)) {
                $query->whereHas('tags', function ($query) use ($request) {
                    $query->whereIn('vacancy_tag_id', $request->tag);
                });
            }

            if (!empty($request->education)) {
                $query->whereHas('education', function ($query) use ($request) {
                    $query->whereIn('education_id', $request->education);
                });
            }

            if (!empty($request->department)) {
                $query->whereHas('departments', function ($query) use ($request) {
                    $query->whereIn('department_id', $request->department);
                });
            }

            if (!empty($request->opening)) {
                if ($request->opening == 1) {
                    $query->where(function($q) {
                        $q->where('close_date', '>=', now())
                          ->orWhere('close_date_exist', 0);
                    });
                } else {
                    $query->where('close_date', '<', now());
                }
            }

            if (!empty($request->company)) {
                $query->where('company_id', $request->company);
            }

            // Paginate results
            $jobs = $query->orderBy('open_date', 'desc')->paginate(5);
            // Return partial view with filtered and paginated results
            return view('partials.job-list', compact('jobs'))->render();
        }

        return redirect()->back();
    }


    public function companyDetail($slug)
    {
        $company = Company::where('slug', $slug)->first();
        $jobs = Vacancy::where('company_id', $company->id)->where('close_date', '>=', now())->orderBy('open_date', 'desc')->paginate(5);;
        $closedjobs = Vacancy::where('company_id', $company->id)->where('close_date', '<', now())->orderBy('open_date', 'desc')->paginate(5);;
        return view('frontend.company_detail', compact('company', 'jobs', 'closedjobs'));
    }

    public function magang(Request $request)
    {
        if ($request->ajax()) {
            $query = Magang::query();

            if (!empty($request->name)) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if (!empty($request->type)) {
                $query->where('type', $request->type);
            }

            if (!empty($request->company)) {
                $query->where('company_id', $request->company);
            }

            if (!empty($request->onlyopen)) {
                $query->where(function($q) {
                    $q->where('close_date', '>=', now())->orWhere('close_date_exist', 0);
                });
            }

            // Paginate results
            $magangs = $query->latest()->paginate(7);
            // Return partial view with filtered and paginated results
            return view('partials.magang-list', compact('magangs'))->render();
        }

        $magangs = Magang::latest()->paginate(7);
        $companies = Company::pluck('name', 'id');
        return view('frontend.magang', compact('magangs', 'companies'));
    }

    public function magangDetail($slug)
    {
        $magang = Magang::where('slug', $slug)->first();
        
        if (!$magang) {
            return redirect()->route('magang')->with('error', 'Magang not found');
        }
        
        $company = Company::find($magang->company_id);
        $relatedMagangs = Magang::whereNot('slug', $slug)
            ->where('company_id', $magang->company_id)
            ->where(function($q) {
                $q->where('close_date', '>=', now())->orWhere('close_date_exist', 0);
            })
            ->latest()
            ->take(3)
            ->get();
        return view('frontend.magang_detail', compact('magang', 'company', 'relatedMagangs'));
    }

    public function magangAjax(Request $request)
    {
        if ($request->ajax()) {
            $query = Magang::query();

            if (!empty($request->name)) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if (!empty($request->type)) {
                $query->where('type', $request->type);
            }

            if (!empty($request->company)) {
                $query->where('company_id', $request->company);
            }

            if (!empty($request->opening)) {
                if ($request->opening == 1) {
                    $query->where(function($q) {
                        $q->where('close_date', '>=', now())
                          ->orWhere('close_date_exist', 0);
                    });
                } else {
                    $query->where('close_date', '<', now());
                }
            }

            // Paginate results
            $magangs = $query->orderBy('open_date', 'desc')->paginate(5);
            // Return partial view with filtered and paginated results
            return view('partials.magang-list', compact('magangs'))->render();
        }

        return redirect()->back();
    }

    public function news(Request $request, $category = null)
    {
        $articleCategory = ArticleCategory::where('slug', $category)->first();

        $featured = Post::where('status', 'published')->latest()->take(5)->get();

        $query = Post::query();
        if ($articleCategory) {
            $query->whereHas('categories', function ($query) use ($articleCategory) {
                $query->where('id', $articleCategory->id);
            });
        }
        $posts = $query->where('status', 'published')->latest()->paginate(10);

        return view('frontend.blog', compact('posts', 'featured'))->with('category', $articleCategory->name ?? null);
    }

    public function acara(Request $request)
    {
        $featured = Post::where('status', 'published')->latest()->take(5)->get();

        $query = Post::query();
        $query->whereHas('categories', function ($query) {
            $query->whereNotIn('slug', ['alumni-caring', 'beasiswa']);
        });
        $posts = $query->where('status', 'published')->latest()->paginate(10);

        return view('frontend.blog', compact('posts', 'featured'))->with('category', $articleCategory->name ?? null);
    }

    public function beasiswa(Request $request)
    {
        $articleCategory = ArticleCategory::where('slug', 'beasiswa')->first();

        $featured = Post::where('status', 'published')->latest()->take(5)->get();

        $query = Post::query();
        if ($articleCategory) {
            $query->whereHas('categories', function ($query) use ($articleCategory) {
                $query->where('id', $articleCategory->id);
            });
        }
        $posts = $query->where('status', 'published')->latest()->paginate(10);

        return view('frontend.blog', compact('posts', 'featured'))->with('category', $articleCategory->name ?? null);
    }

    public function alumniCaring()
    {
        $articleCategory = ArticleCategory::where('slug', 'alumni-caring')->first();

        $featured = Post::whereHas('categories', function ($query) use ($articleCategory) {
            $query->where('id', $articleCategory->id);
        })->where('status', 'published')->latest()->take(5)->get();

        $posts = Post::whereHas('categories', function ($query) use ($articleCategory) {
            $query->where('id', $articleCategory->id);
        })->where('status', 'published')->latest()->paginate(10);

        return view('frontend.blog', compact('posts', 'featured'))->with('category', 'Alumni Caring' ?? null);
    }

    public function alumniCaringDetail($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $tags = $post->tags->pluck('name')->toArray(); // Get tags as an array of names
        $tagsString = implode(', ', $tags);

        // Set SEO meta tags
        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription($post->excerpt);
        SEOMeta::setKeywords($tags); // Set tags as keywords
        SEOMeta::setCanonical(url()->current());

        $popularPosts = Post::where('status', 'published')->latest()->take(7)->get();
        $relatedPosts = Post::whereHas('categories', function ($query) use ($post) {
                            $query->whereIn('id', $post->categories->pluck('id')); // Same categories
                        })
                        ->where('posts.id', '!=', $post->id) // Exclude the current post
                        ->orderByRaw('ABS(TIMESTAMPDIFF(SECOND, posts.created_at, ?))', [$post->created_at]) // Order by nearest creation time
                        ->take(6) // Limit the number of related posts
                        ->get();

        $tags = ArticleTag::take(10)->get();
        return view('frontend.blog_detail', compact('post', 'popularPosts', 'relatedPosts', 'tags'));
    }

    public function blogSearch(Request $request)
    {
        $search = $request->search;
        $tag = $request->tag;

        $query = Post::query();
        if (!empty($search)) {
            $query->where('title', 'like', '%' . $search . '%')->orWhere('content', 'like', '%' . $search . '%');
        }
        if (!empty($tag)) {
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('id', $tag);
            });
        }
        $posts = $query->where('status', 'published')->latest()->paginate(10);

        $popularPosts = Post::where('status', 'published')->latest()->take(7)->get();
        $tags = ArticleTag::take(10)->get();

        return view('frontend.blog_search', compact('posts', 'popularPosts', 'tags'));
    }

    public function blogDetail($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        if ($post->categories->contains('slug', 'alumni-caring')) {
            return redirect()->route('alumni-caring-detail', $slug);
        }

        $tags = $post->tags->pluck('name')->toArray(); // Get tags as an array of names
        $tagsString = implode(', ', $tags);

        // Set SEO meta tags
        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription($post->excerpt);
        SEOMeta::setKeywords($tags); // Set tags as keywords
        SEOMeta::setCanonical(url()->current());

        $popularPosts = Post::where('status', 'published')->latest()->take(7)->get();
        $relatedPosts = Post::whereHas('categories', function ($query) use ($post) {
                            $query->whereIn('id', $post->categories->pluck('id')); // Same categories
                        })
                        ->where('posts.id', '!=', $post->id) // Exclude the current post
                        ->orderByRaw('ABS(TIMESTAMPDIFF(SECOND, posts.created_at, ?))', [$post->created_at]) // Order by nearest creation time
                        ->take(6) // Limit the number of related posts
                        ->get();

        $tags = ArticleTag::take(10)->get();
        return view('frontend.blog_detail', compact('post', 'popularPosts', 'relatedPosts', 'tags'));
    }

    public function tracerStudy()
    {
        return view('frontend.tracer_stakeholder');
    }

    public function tracerStudyStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nama_instansi' => 'required|string|max:255',
            'nama_alumni' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer',
            'waktu_tunggu' => 'required|integer',
            'tingkat_instansi' => 'required',
            'kesesuaian_bidang' => 'required',
            'kompetensi_integritas' => 'required|in:sangat_baik,baik,cukup,kurang',
            'kompetensi_profesionalisme' => 'required|in:sangat_baik,baik,cukup,kurang',
            'kompetensi_inggris' => 'required|in:sangat_baik,baik,cukup,kurang',
            'kompetensi_it' => 'required|in:sangat_baik,baik,cukup,kurang',
            'kompetensi_komunikasi' => 'required|in:sangat_baik,baik,cukup,kurang',
            'kompetensi_kerjasama' => 'required|in:sangat_baik,baik,cukup,kurang',
            'kompetensi_pengembangan' => 'required|in:sangat_baik,baik,cukup,kurang',
            'kepuasan_alumni' => 'required|string',
            'saran' => 'required|string',
            'ketersediaan_campus_hiring' => 'required',
            'tanda_tangan' => 'required|file|mimes:pdf,png,jpg,jpeg|max:5120',
            'captcha' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('current_step', $request->input('current_step'));
        }

        $validatedData = $validator->validated();

        $tracerStakeholder = TracerStakeholder::create($validatedData);

        if ($request->hasFile('tanda_tangan')) {

            $file = $request->file('tanda_tangan');
            $extension = $file->getClientOriginalExtension();

            $fileName = 'tanda_tangan_' . $tracerStakeholder->nama . '_' . uniqid() . '.' . $extension;
            $filePath = $file->move(storage_path('tmp/uploads'), $fileName);

            $newFilePath = storage_path('tmp/uploads/' . $fileName);

            if (file_exists($newFilePath)) {
                $tracerStakeholder->addMedia($newFilePath)->toMediaCollection('tanda_tangan');
            } else {
                throw new \Exception('File does not exist at path: ' . $newFilePath);
            }
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $tracerStakeholder->id]);
        }

        Alert::success('Success', 'Data tersimpan, Terima kasih.')->autoclose(4000);

        return redirect()->route('tracer-study')->with('success', 'Data tersimpan, Terima kasih.');
    }

    public function tracerAlumni()
    {
        return view('frontend.tracer_alumni');
    }

    public function tracerAlumniStore(Request $request)
    {
         // Define validation rules
        $validator = Validator::make($request->all(), [
            'nim' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'kota_asal_id' => 'required|integer',
            'kota_domisili_id' => 'required|integer',
            'angkatan' => 'required|string|max:255',
            'kesibukan' => 'required|string|max:255',
            'partisipasi' => 'required|string|max:255',
            'nama_instansi' => 'required|string|max:255',
            'jabatan_instansi' => 'required|string|max:255',
            'pendapatan' => 'required|string|max:255',
            'captcha' => 'required|captcha', // Laravel Captcha validation
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        $tracerStakeholder = TracerAlumnu::create($validatedData);

        return redirect()->route('tracer-alumni')->with('success', 'Data tersimpan, Terima kasih.');
    }

    public function grafik(PieChart $pie)
    {
        //Grafik Pie Tingkat
        $internasional = PrestasiMahasiswa::where('tingkat', 'internasional')->count();
        $nasional = PrestasiMahasiswa::where('tingkat', 'nasional')->count();
        $regional = PrestasiMahasiswa::where('tingkat', 'regional')->count();
        $data = [$internasional, $nasional, $regional];
        $label = ['Internasional', 'Nasional', 'Regional'];
        $tingkat_chart = $pie->build(
            'Capaian Prestasi Mahasiswa Fakultas Psikologi',
            'Capaian Prestasi Mahasiswa Fakultas Psikologi Universitas Sebelas Maret Berdasarkan Tingkat Kegiatan',
            $data, $label);

        //Grafik Pie Kategori
        $data = [];
        $label = [];
        $kategori = KategoriPrestasi::whereHas('prestasi_mahasiswa')->get();
        foreach($kategori as $item) {
            $data[] = PrestasiMahasiswa::where('kategori_id', $item->id)->count();
            $label[] = $item->name;
        };

        $kategori_chart = $pie->build(
            'Capaian Prestasi Mahasiswa Fakultas Psikologi',
            'Capaian Prestasi Mahasiswa Fakultas Psikologi Universitas Sebelas Maret Berdasarkan Kategori Kegiatan',
            $data, $label);

        $achievementsByYear = DB::table('prestasi_mahasiswas')
            ->selectRaw('YEAR(tanggal_akhir) as year, COUNT(*) as total')
            ->whereNotNull('tanggal_akhir')
            ->groupBy(DB::raw('YEAR(tanggal_akhir)'))
            ->orderBy('year')
            ->get();
        
        // Format data for the chart
        $years = $achievementsByYear->pluck('year');
        $counts = $achievementsByYear->pluck('total');

        return view('frontend.grafik', compact('tingkat_chart', 'kategori_chart', 'years', 'counts'));
    }

    public function about()
    {
        return view('frontend.psikologi-cdc');
    }

    public function team()
    {
        return view('frontend.team');
    }

    public function help()
    {
        return view('frontend.help');
    }

    public function faq()
    {
        return view('frontend.faq');
    }

    public function privacy()
    {
        return view('frontend.privacy_policy');
    }

    public function prestasiMahasiswa(Request $request)
    {
        if ($request->ajax()) {
            $query = PrestasiMahasiswaDetail::with('prestasi_mahasiswa');

            if (!empty($request->kategori)) {
                $query->whereHas('prestasi_mahasiswa', function ($query) use ($request) {
                    $query->where('kategori_id', $request->kategori);
                });
            }
            if (!empty($request->keikutsertaan)) {
                $query->whereHas('prestasi_mahasiswa', function ($query) use ($request) {
                    $query->where('keikutsertaan', $request->keikutsertaan);
                });
            }
            if (!empty($request->tingkat)) {
                $query->whereHas('prestasi_mahasiswa', function ($query) use ($request) {
                    $query->where('tingkat', $request->tingkat);
                });
            }

            // Paginate results
            $prestasis = $query->latest()->paginate(7);
            // Return partial view with filtered and paginated results
            return view('partials.prestasi-list', compact('prestasis'))->render();
        }

        $prestasis = PrestasiMahasiswaDetail::with('prestasi_mahasiswa')->latest()->paginate(7);
        $categories = KategoriPrestasi::pluck('name', 'id');

        return view('frontend.prestasi_mahasiswa', compact('prestasis', 'categories'));
    }

    public function jadwalLomba(Request $request)
    {
        if ($request->ajax()) {
            $query = Contest::query();

            // Filter by type if provided
            if (!empty($request->type)) {
                $query->where('type', $request->type);
            }

            // Get contests with their dates
            $contests = $query->whereNotNull('tanggal')->get();

            // Format data for calendar
            $events = [];
            foreach ($contests as $contest) {
                // Get original date values from database before accessor modification
                $startDate = null;
                $endDate = null;
                
                // Try to get original values first, then fallback to accessors
                $originalTanggal = $contest->getOriginal('tanggal') ?? $contest->getRawOriginal('tanggal');
                $originalDeadline = $contest->getOriginal('deadline') ?? $contest->getRawOriginal('deadline');
                
                if ($originalTanggal) {
                    try {
                        $startDate = \Carbon\Carbon::parse($originalTanggal)->format('Y-m-d');
                    } catch (\Exception $e) {
                        // If parsing fails, try with the accessor
                        $startDate = $contest->tanggal ? \Carbon\Carbon::createFromFormat('d/m/Y', $contest->tanggal)->format('Y-m-d') : null;
                    }
                }
                
                if ($originalDeadline) {
                    try {
                        $endDate = \Carbon\Carbon::parse($originalDeadline)->format('Y-m-d');
                    } catch (\Exception $e) {
                        // If parsing fails, try with the accessor
                        $endDate = $contest->deadline ? \Carbon\Carbon::createFromFormat('d/m/Y', $contest->deadline)->format('Y-m-d') : null;
                    }
                }

                $events[] = [
                    'id' => $contest->id,
                    'title' => $contest->judul,
                    'start' => $startDate,
                    'end' => $endDate,
                    'description' => $contest->deskripsi,
                    'penyelenggara' => $contest->penyelenggara,
                    'link' => $contest->link,
                    'type' => $contest->type,
                    'className' => 'event-' . $contest->type,
                    'backgroundColor' => $this->getEventColor($contest->type),
                    'borderColor' => $this->getEventColor($contest->type)
                ];
            }

            return response()->json($events);
        }

        // Get contest types for filter
        $contestTypes = Contest::TYPE_SELECT;
        
        return view('frontend.jadwal_lomba', compact('contestTypes'));
    }

    public function jadwalLombaEvents(Request $request)
    {
        $query = Contest::query();

        // Filter by type if provided
        if (!empty($request->type)) {
            $query->where('type', $request->type);
        }

        // Get contests with their dates
        $contests = $query->whereNotNull('tanggal')->get();

        // Format data for calendar
        $events = [];
        foreach ($contests as $contest) {
            // Get original date values from database before accessor modification
            $startDate = null;
            $endDate = null;
            
            // Try to get original values first, then fallback to accessors
            $originalTanggal = $contest->getOriginal('tanggal') ?? $contest->getRawOriginal('tanggal');
            $originalDeadline = $contest->getOriginal('deadline') ?? $contest->getRawOriginal('deadline');
            
            if ($originalTanggal) {
                try {
                    $startDate = \Carbon\Carbon::parse($originalTanggal)->format('Y-m-d');
                } catch (\Exception $e) {
                    // If parsing fails, try with the accessor
                    $startDate = $contest->tanggal ? \Carbon\Carbon::createFromFormat('d/m/Y', $contest->tanggal)->format('Y-m-d') : null;
                }
            }
            
            if ($originalDeadline) {
                try {
                    $endDate = \Carbon\Carbon::parse($originalDeadline)->format('Y-m-d');
                } catch (\Exception $e) {
                    // If parsing fails, try with the accessor
                    $endDate = $contest->deadline ? \Carbon\Carbon::createFromFormat('d/m/Y', $contest->deadline)->format('Y-m-d') : null;
                }
            }

            $events[] = [
                'id' => $contest->id,
                'title' => $contest->judul,
                'start' => $startDate,
                'end' => $endDate,
                'description' => $contest->deskripsi,
                'penyelenggara' => $contest->penyelenggara,
                'link' => $contest->link,
                'type' => $contest->type,
                'className' => 'event-' . $contest->type,
                'backgroundColor' => $this->getEventColor($contest->type),
                'borderColor' => $this->getEventColor($contest->type)
            ];
        }

        return response()->json($events);
    }

    private function getEventColor($type)
    {
        $colors = [
            'lokal' => '#28a745',        // Green
            'wilayah' => '#17a2b8',      // Cyan
            'nasional' => '#ffc107',     // Yellow
            'internasional' => '#dc3545' // Red
        ];

        return $colors[$type] ?? '#6c757d'; // Default gray
    }

}
