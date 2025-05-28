<?php

namespace App\Http\Controllers;

use App\Services\MachineReportService;
use App\Http\Requests\MachineReport\StoreMachineReportRequest;
use App\Http\Requests\MachineReport\UpdateMachineReportRequest;
use App\Models\User;
use App\Models\Action;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MachineReportController extends Controller
{
    protected $machineReportService;

    public function __construct(MachineReportService $machineReportService)
    {
        $this->machineReportService = $machineReportService;
        $this->middleware('permission:machine-report-list')->only('index');
        $this->middleware('permission:machine-report-create')->only(['create', 'store']);
        $this->middleware('permission:machine-report-edit')->only(['edit', 'update']);
        $this->middleware('permission:machine-report-delete')->only('destroy');
    }

    public function index()
    {
        if (request()->ajax()) {
            $reports = \App\Models\MachineReport::with(['user', 'action'])->select('machine_reports.*');
            return DataTables::of($reports)
                ->addIndexColumn()
                ->addColumn('user', function ($report) {
                    return $report->user ? $report->user->name : '-';
                })
                ->addColumn('action', function ($report) {
                    return $report->action ? $report->action->action_status : '-';
                })
                ->addColumn('actions', function ($report) {
                    return view('machine_reports.actions', compact('report'))->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('machine_reports.index');
    }

    public function create()
    {
        $users = User::all();
        $actions = Action::all();
        return view('machine_reports.create', compact('users', 'actions'));
    }

    public function store(StoreMachineReportRequest $request)
    {
        try {
            $this->machineReportService->createMachineReport($request->validated());
            return redirect()->route('machine-reports.index')
                ->with('success', 'Machine report created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $report = $this->machineReportService->getMachineReportById($id);
            if (auth()->id() !== $report->user_id) {
                abort(403, 'You are not authorized to edit this report.');
            }
            $users = User::all();
            $actions = Action::all();
            return view('machine_reports.edit', compact('report', 'users', 'actions'));
        } catch (\Exception $e) {
            return redirect()->route('machine-reports.index')
                ->with('error', 'Error fetching machine report: ' . $e->getMessage());
        }
    }

    public function update(UpdateMachineReportRequest $request, $id)
    {
        try {
            $report = $this->machineReportService->getMachineReportById($id);
            if (auth()->id() !== $report->user_id) {
                abort(403, 'You are not authorized to update this report.');
            }
            $this->machineReportService->updateMachineReport($id, $request->validated());
            return redirect()->route('machine-reports.index')
                ->with('success', 'Machine report updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $report = $this->machineReportService->getMachineReportById($id);
            if (auth()->id() !== $report->user_id) {
                return response()->json(['error' => 'You are not authorized to delete this report.'], 403);
            }
            $this->machineReportService->deleteMachineReport($id);
            return response()->json(['success' => 'Machine report deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting machine report: ' . $e->getMessage()], 500);
        }
    }
} 