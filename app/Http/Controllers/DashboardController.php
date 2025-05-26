<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SparePartService;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SparePartService $sparePartService)
    {
        $this->middleware('auth');

        // Share low stock spare parts with all views
        View::composer('*', function ($view) use ($sparePartService) {
            $view->with('lowStockSpareParts', $sparePartService->getLowStockSpareParts());
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }
} 