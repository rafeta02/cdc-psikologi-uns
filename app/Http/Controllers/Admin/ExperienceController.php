<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyExperienceRequest;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ExperienceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('experience_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Experience::query()->select(sprintf('%s.*', (new Experience)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'experience_show';
                $editGate      = 'experience_edit';
                $deleteGate    = 'experience_delete';
                $crudRoutePart = 'experiences';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.experiences.index');
    }

    public function create()
    {
        abort_if(Gate::denies('experience_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experiences.create');
    }

    public function store(StoreExperienceRequest $request)
    {
        $experience = Experience::create($request->all());

        return redirect()->route('admin.experiences.index');
    }

    public function edit(Experience $experience)
    {
        abort_if(Gate::denies('experience_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->all());

        return redirect()->route('admin.experiences.index');
    }

    public function show(Experience $experience)
    {
        abort_if(Gate::denies('experience_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experiences.show', compact('experience'));
    }

    public function destroy(Experience $experience)
    {
        abort_if(Gate::denies('experience_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experience->delete();

        return back();
    }

    public function massDestroy(MassDestroyExperienceRequest $request)
    {
        $experiences = Experience::find(request('ids'));

        foreach ($experiences as $experience) {
            $experience->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
