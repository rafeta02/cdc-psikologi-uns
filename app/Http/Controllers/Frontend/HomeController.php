<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\PrestasiMahasiswa;
use App\Models\ResultAssessment;
use App\Models\ResultCompetence;
use App\Models\ArticleCategory;

class HomeController
{
    public function index()
    {

        $prestasi = PrestasiMahasiswa::where('user_id', auth()->user()->id)->count();
        $assessment = ResultAssessment::where('user_id', auth()->user()->id)->count();
        $competence = ResultCompetence::where('user_id', auth()->user()->id)->count();

        $articleCategory = ArticleCategory::where('slug', 'alumni-caring')->first();

        if ($articleCategory) {
            $posts = Post::whereHas('categories', function ($query) use ($articleCategory) {
                $query->where('id', $articleCategory->id);
            })->where('status', 'published')->latest()->take(8)->get();
        } else {
            $posts = collect([]);
        }

        return view('frontend.dashboard', compact('prestasi', 'assessment', 'competence', 'posts'));
    }
}
