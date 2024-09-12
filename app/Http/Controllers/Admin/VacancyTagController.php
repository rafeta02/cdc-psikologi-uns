<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVacancyTagRequest;
use App\Http\Requests\StoreVacancyTagRequest;
use App\Http\Requests\UpdateVacancyTagRequest;
use App\Models\VacancyTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VacancyTagController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('vacancy_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VacancyTag::query()->select(sprintf('%s.*', (new VacancyTag)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'vacancy_tag_show';
                $editGate      = 'vacancy_tag_edit';
                $deleteGate    = 'vacancy_tag_delete';
                $crudRoutePart = 'vacancy-tags';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.vacancyTags.index');
    }

    public function create()
    {
        abort_if(Gate::denies('vacancy_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vacancyTags.create');
    }

    public function store(StoreVacancyTagRequest $request)
    {
        $vacancyTag = VacancyTag::create($request->all());

        return redirect()->route('admin.vacancy-tags.index');
    }

    public function edit(VacancyTag $vacancyTag)
    {
        abort_if(Gate::denies('vacancy_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vacancyTags.edit', compact('vacancyTag'));
    }

    public function update(UpdateVacancyTagRequest $request, VacancyTag $vacancyTag)
    {
        $vacancyTag->update($request->all());

        return redirect()->route('admin.vacancy-tags.index');
    }

    public function show(VacancyTag $vacancyTag)
    {
        abort_if(Gate::denies('vacancy_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vacancyTags.show', compact('vacancyTag'));
    }

    public function destroy(VacancyTag $vacancyTag)
    {
        abort_if(Gate::denies('vacancy_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacancyTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyVacancyTagRequest $request)
    {
        $vacancyTags = VacancyTag::find(request('ids'));

        foreach ($vacancyTags as $vacancyTag) {
            $vacancyTag->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
