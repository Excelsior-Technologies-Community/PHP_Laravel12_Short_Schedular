@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Task Analytics Dashboard</h1>
        <p class="text-gray-600">Overview of scheduled tasks and system performance</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col">
            <span class="text-sm font-semibold text-gray-500 uppercase">Total Executions</span>
            <span class="text-4xl font-extrabold text-blue-600">{{ $total }}</span>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col">
            <span class="text-sm font-semibold text-gray-500 uppercase">Successful</span>
            <span class="text-4xl font-extrabold text-green-600">{{ $success }}</span>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col">
            <span class="text-sm font-semibold text-gray-500 uppercase">Failed</span>
            <span class="text-4xl font-extrabold text-red-600">{{ $failed }}</span>
        </div>
    </div>

    <div class="flex flex-wrap gap-3 mb-8">
        <a href="{{ route('logs.export') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-lg font-medium transition shadow-sm">
            Export CSV
        </a>
        <form action="{{ route('logs.cleanup') }}" method="POST">
            @csrf
            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-2.5 rounded-lg font-medium transition shadow-sm" onclick="return confirm('Are you sure?')">
                Delete Logs (>30 Days)
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">Recent Activity</h3>
        </div>
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Message</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($recentLogs as $log)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->message }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 text-xs font-bold rounded-full {{ $log->status === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($log->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $log->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection