@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; max-width: 800px; margin-left: auto; margin-right: auto; padding: 25px; background: #0f172a; border-radius: 12px; color: white; border: 1px solid #1e293b;">
    <div class="header" style="margin-bottom: 30px; border-bottom: 1px solid #1e293b; padding-bottom: 15px;">
        <h2 style="font-size: 1.8rem; font-weight: 700;">System Config: <span style="color: #6366f1;">{{ $resource->name }}</span></h2>
        <p style="color: #94a3b8;">Administrator global overrides for hardware specifications.</p>
    </div>

    <form action="{{ route('resources.update', $resource) }}" method="POST">
        @csrf
        @method('PATCH')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #cbd5e1;">Hardware Label</label>
                <input type="text" name="name" value="{{ $resource->name }}" style="width: 100%; background: #1e293b; border: 1px solid #334155; border-radius: 6px; padding: 10px; color: white;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #cbd5e1;">Responsible Manager</label>
                <select name="manager_id" style="width: 100%; background: #1e293b; border: 1px solid #334155; border-radius: 6px; padding: 10px; color: white;">
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}" {{ $resource->manager_id == $manager->id ? 'selected' : '' }}>
                            {{ $manager->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #cbd5e1;">CPU Cores</label>
                <input type="number" name="cpu" value="{{ $resource->cpu }}" style="width: 100%; background: #1e293b; border: 1px solid #334155; border-radius: 6px; padding: 10px; color: white;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #cbd5e1;">RAM (GB)</label>
                <input type="number" name="ram" value="{{ $resource->ram }}" style="width: 100%; background: #1e293b; border: 1px solid #334155; border-radius: 6px; padding: 10px; color: white;">
            </div>
        </div>

        <div style="margin-top: 30px; display: flex; gap: 15px; justify-content: flex-end;">
            <a href="{{ route('admin.dashboard') }}" style="padding: 12px 20px; color: #94a3b8; text-decoration: none;">Cancel</a>
            <button type="submit" class="btn-primary" style="padding: 12px 30px; border-radius: 8px; font-weight: bold; border: none; cursor: pointer;">
                Apply System Changes
            </button>
        </div>
    </form>
</div>
@endsection