<?php

namespace App\Http\Controllers;

use App\Services\ActionService;
use App\Http\Requests\Action\StoreActionRequest;
use App\Http\Requests\Action\UpdateActionRequest;
use App\Models\SparePart;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ActionController extends Controller
{
    protected $actionService;

    public function __construct(ActionService $actionService)
    {
        $this->actionService = $actionService;
        $this->middleware('permission:action-list')->only('index');
        $this->middleware('permission:action-create')->only(['create', 'store']);
        $this->middleware('permission:action-edit')->only(['edit', 'update']);
        $this->middleware('permission:action-delete')->only('destroy');
    }

    public function index()
    {
        if (request()->ajax()) {
            $actions = \App\Models\Action::with('sparePart')->select('actions.*');
            return DataTables::of($actions)
                ->addIndexColumn()
                ->addColumn('spare_part', function ($action) {
                    return $action->sparePart ? $action->sparePart->name : '-';
                })
                ->addColumn('action', function ($action) {
                    return view('actions.actions', compact('action'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('actions.index');
    }

    public function create()
    {
        $spareParts = SparePart::all();
        return view('actions.create', compact('spareParts'));
    }

    public function store(StoreActionRequest $request)
    {
        try {
            $this->actionService->createAction($request->validated());
            return redirect()->route('actions.index')
                ->with('success', 'Action created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $action = $this->actionService->getActionById($id);
            $spareParts = SparePart::all();
            return view('actions.edit', compact('action', 'spareParts'));
        } catch (\Exception $e) {
            return redirect()->route('actions.index')
                ->with('error', 'Error fetching action: ' . $e->getMessage());
        }
    }

    public function update(UpdateActionRequest $request, $id)
    {
        try {
            $this->actionService->updateAction($id, $request->validated());
            return redirect()->route('actions.index')
                ->with('success', 'Action updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->actionService->deleteAction($id);
            return response()->json(['success' => 'Action deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting action: ' . $e->getMessage()], 500);
        }
    }
} 