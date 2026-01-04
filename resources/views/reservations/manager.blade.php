@extends('layouts.app')

@section('content')
<div class="main-content">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px;">
        <div>
            <h1 style="font-size: 3rem; margin: 0;">Cluster <span style="color: var(--accent-cyan);">Management</span></h1>
            <p style="color: var(--text-dim); font-size: 1.1rem;">Supervision technique du parc informatique.</p>
        </div>
        <a href="{{ route('resources.create') }}" class="btn btn-primary">+ New Resource</a>
    </div>

    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
        @foreach($resources as $resource)
        <div class="card">
            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                <span style="color: var(--accent-cyan); font-family: monospace; letter-spacing: 2px;">{{ strtoupper($resource->type) }}</span>
                <div style="width: 12px; height: 12px; border-radius: 50%; background: {{ $resource->status === 'disponible' ? 'var(--accent-green)' : 'var(--accent-orange)' }}; box-shadow: 0 0 10px {{ $resource->status === 'disponible' ? 'var(--accent-green)' : 'var(--accent-orange)' }};"></div>
            </div>

            <h2 style="font-size: 1.8rem; margin-bottom: 20px; letter-spacing: -0.5px;">{{ $resource->name }}</h2>

            <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 15px; margin-bottom: 25px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span style="color: var(--text-dim);">Processing Units</span>
                    <span style="font-weight: bold;">{{ $resource->cpu }} Cores</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: var(--text-dim);">Memory Capacity</span>
                    <span style="font-weight: bold;">{{ $resource->ram }} GB</span>
                </div>
            </div>

            <div style="display: flex; gap: 15px; border-top: 1px solid var(--glass-border); padding-top: 20px;">
                <form action="{{ route('resources.toggleMaintenance', $resource->id) }}" method="POST" style="flex: 1;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn {{ $resource->status === 'maintenance' ? 'btn-success' : 'btn-warning' }}" style="width: 100%;">
                        {{ $resource->status === 'maintenance' ? 'Online' : 'Maintenance' }}
                    </button>
                </form>
                <a href="{{ route('resources.edit', $resource->id) }}" class="btn" style="border: 1px solid var(--glass-border); color: var(--text-dim);">Edit</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection