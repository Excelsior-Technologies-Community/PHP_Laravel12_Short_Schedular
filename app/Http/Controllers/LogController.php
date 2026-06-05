<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Response;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $query = Log::query();

        if ($request->search) {
            $query->where('message', 'like', '%' . $request->search . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $logs = $query->latest()->paginate(7);

        return view('logs.index', compact('logs'));
    }

    public function dashboard()
    {
        $total = Log::count();
        $success = Log::where('status', 'success')->count();
        $failed = Log::where('status', 'failed')->count();
        $recentLogs = Log::latest()->take(5)->get();

        return view('logs.dashboard', compact('total', 'success', 'failed', 'recentLogs'));
    }

    public function export()
    {
        $logs = Log::all();
        $csvData = "ID,Message,Status,Created At\n";
        
        foreach ($logs as $log) {
            $csvData .= "{$log->id},{$log->message},{$log->status},{$log->created_at}\n";
        }

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=logs.csv',
        ]);
    }

    public function cleanup()
    {
        Log::where('created_at', '<', now()->subDays(30))->delete();
        return back()->with('success', 'Old logs cleaned!');
    }

    public function clear()
    {
        Log::truncate();
        return back()->with('success', 'Logs cleared!');
    }
}