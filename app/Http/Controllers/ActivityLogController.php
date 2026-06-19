<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {}

    /**
     * Display a listing of the activity logs.
     */
    public function index(): View
    {
        $store = auth()->user()->currentStore();
        abort_unless(auth()->user()->isOwner(), 403, 'Hanya Owner yang dapat mengakses log aktivitas.');

        $logs = $this->activityLogService->getLogsForStore($store->id, 20);

        return view('activity-logs.index', compact('logs'));
    }
}
