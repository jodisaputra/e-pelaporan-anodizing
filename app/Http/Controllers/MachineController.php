<?php

namespace App\Http\Controllers;

use App\Services\MachineService;
use App\Http\Requests\Machine\StoreMachineRequest;
use App\Http\Requests\Machine\UpdateMachineRequest;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    protected $machineService;

    public function __construct(MachineService $machineService)
    {
        $this->machineService = $machineService;
        $this->middleware('permission:machine-list')->only(['index', 'show']);
        $this->middleware('permission:machine-create')->only(['create', 'store']);
        $this->middleware('permission:machine-edit')->only(['edit', 'update']);
        $this->middleware('permission:machine-delete')->only('destroy');
    }

    public function index()
    {
        if (request()->ajax()) {
            $machines = $this->machineService->getMachinesForDataTable();
            return \Yajra\DataTables\Facades\DataTables::of($machines)
                ->addIndexColumn()
                ->addColumn('image', function ($machine) {
                    if ($machine->image) {
                        return '<img src="' . asset('storage/' . $machine->image) . '" alt="Machine Image" style="max-width:60px;max-height:60px;">';
                    }
                    return '-';
                })
                ->addColumn('actions', function ($machine) {
                    return view('machines.actions', compact('machine'))->render();
                })
                ->rawColumns(['image', 'actions'])
                ->make(true);
        }
        return view('machines.index');
    }

    public function create()
    {
        return view('machines.create');
    }

    public function store(StoreMachineRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('machines', 'public');
        }
        $this->machineService->createMachine($data);
        return redirect()->route('machines.index')->with('success', 'Machine created successfully.');
    }

    public function show($id)
    {
        $machine = $this->machineService->getMachineById($id);
        return view('machines.show', compact('machine'));
    }

    public function edit($id)
    {
        $machine = $this->machineService->getMachineById($id);
        return view('machines.edit', compact('machine'));
    }

    public function update(UpdateMachineRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('machines', 'public');
        }
        $this->machineService->updateMachine($id, $data);
        return redirect()->route('machines.index')->with('success', 'Machine updated successfully.');
    }

    public function destroy($id)
    {
        $this->machineService->deleteMachine($id);
        return response()->json(['success' => 'Machine deleted successfully.']);
    }
} 