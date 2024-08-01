<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPositionRequest;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('position_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Position::query()->select(sprintf('%s.*', (new Position)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'position_show';
                $editGate      = 'position_edit';
                $deleteGate    = 'position_delete';
                $crudRoutePart = 'positions';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.positions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('position_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.positions.create');
    }

    public function store(StorePositionRequest $request)
    {
        $position = Position::create($request->all());

        return redirect()->route('admin.positions.index');
    }

    public function edit(Position $position)
    {
        abort_if(Gate::denies('position_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.positions.edit', compact('position'));
    }

    public function update(UpdatePositionRequest $request, Position $position)
    {
        $position->update($request->all());

        return redirect()->route('admin.positions.index');
    }

    public function show(Position $position)
    {
        abort_if(Gate::denies('position_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.positions.show', compact('position'));
    }

    public function destroy(Position $position)
    {
        abort_if(Gate::denies('position_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $position->delete();

        return back();
    }

    public function massDestroy(MassDestroyPositionRequest $request)
    {
        $positions = Position::find(request('ids'));

        foreach ($positions as $position) {
            $position->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
