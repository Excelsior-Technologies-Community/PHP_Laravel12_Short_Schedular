<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $query = Log::query();

        // Search
        if ($request->search) {
            $query->where('message', 'like', '%' . $request->search . '%');
        }

        // Filter
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $logs = $query->latest()->paginate(7);

        return view('logs.index', compact('logs'));
    }

    public function clear()
    {
        Log::truncate();
        return back()->with('success', 'Logs cleared!');
    }
}
