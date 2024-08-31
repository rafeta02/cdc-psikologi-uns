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
use App\Models\Post;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use App\Models\TracerStakeholder;
use App\Models\TracerAlumnu;
use SEOMeta;
use Alert;



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

        $articleCategory = ArticleCategory::where('slug', 'alumni-caring')->first();
        $posts = $posts = Post::whereHas('categories', function ($query) use ($articleCategory) {
            $query->where('id', $articleCategory->id);
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
                $query->where('close_date', '>=', now());
            }

            if (!empty($request->company)) {
                $query->where('company_id', $request->company);
            }

            // Paginate results
            $jobs = $query->paginate(7);
            // Return partial view with filtered and paginated results
            return view('partials.job-list', compact('jobs'))->render();
        }

        // $jobs = Vacancy::where('close_date', '>=', now())->latest()->paginate(10);
        $jobs = Vacancy::latest()->paginate(7);
        $positions = Position::pluck('name', 'id');
        $industries = Industry::pluck('name', 'id');
        $educations = Education::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        return view('frontend.jobs', compact('jobs', 'positions', 'industries', 'educations', 'departments'));
    }

    public function jobDetail($slug)
    {
        $job = Vacancy::where('slug', $slug)->first();
        $company = Company::find($job->company_id);
        $relatedJobs = Vacancy::where('company_id', $job->company_id)->where('position_id', $job->position_id)->where('close_date', '>=', now())->latest()->take(3)->get();
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
                    $query->where('close_date', '>=', now());
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
            'integritas' => 'required|in:sangat_baik,baik,cukup,kurang',
            'keahlian' => 'required|in:sangat_baik,baik,cukup,kurang',
            'bahasa_inggris' => 'required|in:sangat_baik,baik,cukup,kurang',
            'teknologi_informasi' => 'required|in:sangat_baik,baik,cukup,kurang',
            'komunikasi' => 'required|in:sangat_baik,baik,cukup,kurang',
            'kerjasama' => 'required|in:sangat_baik,baik,cukup,kurang',
            'pengembangan_diri' => 'required|in:sangat_baik,baik,cukup,kurang',
            'kepuasan_alumni' => 'required|string',
            'saran' => 'required|string',
            'ketersediaan_campus_hiring' => 'required',
            'tanda_tangan' => 'required|file',
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

            $tracerStakeholder->addMedia($request->file('tanda_tangan')->path())->toMediaCollection('tanda_tangan');
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
}
