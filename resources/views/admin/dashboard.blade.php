@extends('layouts.app')

@section('content')
<div class="main-content" style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 class="stat-value" style="font-size: 2.5rem; margin: 0;">Infrastructure <span style="color: white;">Global Stats</span></h1>
        <div style="background: rgba(255,255,255,0.05); padding: 10px 20px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.1);">
            <span style="color: #818cf8; font-weight: bold;">ADMIN MODE</span>
        </div>
    </div>

    {{-- Ligne des compteurs --}}
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="card" style="border-left: 4px solid #818cf8; background: rgba(30, 41, 59, 0.8);">
            <p style="color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">Global Occupancy</p>
            <h2 style="font-size: 2.5rem; color: white; margin-top: 10px;">{{ $stats['occupancy_rate'] }}%</h2>
            <div style="width: 100%; background: rgba(255,255,255,0.1); height: 4px; border-radius: 2px; margin-top: 10px;">
                <div style="width: {{ $stats['occupancy_rate'] }}%; background: #818cf8; height: 100%; border-radius: 2px;"></div>
            </div>
        </div>
        <div class="card" style="border-left: 4px solid #10b981;">
            <p style="color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase;">Total Units</p>
            <h2 style="font-size: 2.5rem; color: white; margin-top: 10px;">{{ $stats['total_resources'] }}</h2>
        </div>
        <div class="card" style="border-left: 4px solid #f59e0b;">
            <p style="color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase;">Maintenance Mode</p>
            <h2 style="font-size: 2.5rem; color: white; margin-top: 10px;">{{ $maintenanceCount }}</h2>
        </div>
        <div class="card" style="border-left: 4px solid #f43f5e;">
            <p style="color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase;">Pending Users</p>
            <h2 style="font-size: 2.5rem; color: white; margin-top: 10px;">{{ $stats['pending_accounts'] }}</h2>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 30px; margin-bottom: 30px;">
        <div class="card">
            <h3 style="color: white; margin-bottom: 20px;">Cluster Availability</h3>
            <div style="height: 250px;"><canvas id="occupancyChart"></canvas></div>
        </div>
        <div class="card">
            <h3 style="color: white; margin-bottom: 20px;">Hardware Distribution</h3>
            <div style="height: 250px;"><canvas id="inventoryChart"></canvas></div>
        </div>
    </div>

    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="color: white; margin: 0;">Audit Trail (Logs)</h3>
            <a href="{{ route('admin.logs') }}" style="color: #818cf8; font-size: 0.8rem;">View All Logs →</a>
        </div>
        <table style="width: 100%; border-collapse: collapse; color: var(--text-muted); font-size: 0.85rem;">
            <thead>
                <tr style="text-align: left; border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <th style="padding: 12px;">Admin/User</th>
                    <th style="padding: 12px;">Action performed</th>
                    <th style="padding: 12px;">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentLogs as $log)
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <td style="padding: 12px; color: white;">{{ $log->user->name ?? 'System' }}</td>
                    <td style="padding: 12px;">{{ $log->action }} : {{ $log->description }}</td>
                    <td style="padding: 12px;">{{ $log->created_at->format('d/m H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('occupancyChart'), {
        type: 'doughnut',
        data: {
            labels: ['Allocated', 'Available'],
            datasets: [{
                data: [{{ $stats['active_reservations'] }}, {{ $stats['total_resources'] - $stats['active_reservations'] }}],
                backgroundColor: ['#818cf8', 'rgba(255,255,255,0.05)'],
                borderWidth: 0
            }]
        },
        options: { cutout: '80%', plugins: { legend: { position: 'bottom', labels: { color: '#94a3b8' } } } }
    });

    new Chart(document.getElementById('inventoryChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($resourcesByType->pluck('type')) !!},
            datasets: [{
                data: {!! json_encode($resourcesByType->pluck('total')) !!},
                backgroundColor: '#10b981',
                borderRadius: 5
            }]
        },
        options: {
            scales: {
                y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } },
                x: { ticks: { color: '#94a3b8' } }
            },
            plugins: { legend: { display: false } }
        }
    });
</script>
@endsection