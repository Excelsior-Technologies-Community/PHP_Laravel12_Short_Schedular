<!DOCTYPE html>
<html>

<head>
    <title>Scheduler Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #eef2f3, #dfe9f3);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-size: 13px;
            padding: 6px 10px;
        }

        .pagination {
            justify-content: center;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body class="p-4">

    <div class="container">

        <div class="card p-4">

            <h2 class="mb-4 text-center">📊 Scheduler Logs Dashboard</h2>

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- SEARCH + FILTER --}}
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-5">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="🔍 Search message...">
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success</option>
                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Search</button>
                </div>

                <div class="col-md-2">
                    <a href="/" class="btn btn-secondary w-100">Reset</a>
                </div>
            </form>

            {{-- CLEAR BUTTON --}}
            <div class="text-end mb-3">
                <a href="/clear-logs" class="btn btn-danger btn-sm">🗑 Clear Logs</a>
            </div>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Time</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td class="text-start">{{ $log->message }}</td>
                                <td>
                                    @if($log->status == 'success')
                                        <span class="badge bg-success">✔ Success</span>
                                    @else
                                        <span class="badge bg-danger">✖ Failed</span>
                                    @endif
                                </td>
                                <td>{{ $log->created_at->format('d M Y, h:i:s A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No logs found 😕</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION (ONLY NUMBERS STYLE) --}}
            <div class="mt-3">
                {{ $logs->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>