<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ActivityLogService;

class HomeController extends Controller
{
    protected $activityLogService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('auth');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $activityData = $this->activityLogService->getActivityData();

        return view('admin', compact('user', 'activityData'));
    }
}
