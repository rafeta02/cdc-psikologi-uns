<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyArticleCategoryRequest;
use App\Http\Requests\StoreArticleCategoryRequest;
use App\Http\Requests\UpdateArticleCategoryRequest;
use App\Models\ArticleCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleCategoryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('article_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $articleCategories = ArticleCategory::all();

        return view('frontend.articleCategories.index', compact('articleCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('article_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.articleCategories.create');
    }

    public function store(StoreArticleCategoryRequest $request)
    {
        $articleCategory = ArticleCategory::create($request->all());

        return redirect()->route('frontend.article-categories.index');
    }

    public function edit(ArticleCategory $articleCategory)
    {
        abort_if(Gate::denies('article_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.articleCategories.edit', compact('articleCategory'));
    }

    public function update(UpdateArticleCategoryRequest $request, ArticleCategory $articleCategory)
    {
        $articleCategory->update($request->all());

        return redirect()->route('frontend.article-categories.index');
    }

    public function show(ArticleCategory $articleCategory)
    {
        abort_if(Gate::denies('article_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.articleCategories.show', compact('articleCategory'));
    }

    public function destroy(ArticleCategory $articleCategory)
    {
        abort_if(Gate::denies('article_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $articleCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyArticleCategoryRequest $request)
    {
        $articleCategories = ArticleCategory::find(request('ids'));

        foreach ($articleCategories as $articleCategory) {
            $articleCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
