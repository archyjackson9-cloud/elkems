@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div>
                <div class="number">{{ $stats['total_messages'] }}</div>
                <div class="label">Total Messages</div>
            </div>
            <i class="bi bi-envelope stat-icon"></i>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card" style="border-left-color:#ff4757">
            <div>
                <div class="number" style="color:#ff4757">{{ $stats['unread_messages'] }}</div>
                <div class="label">Unread Messages</div>
            </div>
            <i class="bi bi-envelope-exclamation stat-icon" style="color:#ff4757"></i>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div>
                <div class="number">{{ $stats['total_services'] }}</div>
                <div class="label">Services</div>
            </div>
            <i class="bi bi-grid-3x3-gap stat-icon"></i>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div>
                <div class="number">{{ $stats['total_team'] }}</div>
                <div class="label">Team Members</div>
            </div>
            <i class="bi bi-people stat-icon"></i>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Recent Messages --}}
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <span>Recent Messages</span>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-eld-sm">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentMessages as $msg)
                        <tr class="{{ !$msg->is_read ? 'fw-semibold' : '' }}">
                            <td>{{ $msg->name }}</td>
                            <td><small>{{ $msg->email }}</small></td>
                            <td><small>{{ Str::limit($msg->subject ?? 'No subject', 30) }}</small></td>
                            <td><small class="text-muted">{{ $msg->created_at->format('M j, Y') }}</small></td>
                            <td>
                                <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-outline-secondary btn-sm">View</a>
                                @if(!$msg->is_read)
                                <span class="badge-unread ms-1">New</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No messages yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="admin-card-header">Quick Actions</div>
            <div class="p-3 d-flex flex-column gap-2">
                <a href="{{ route('admin.services.create') }}" class="btn btn-eld-sm text-start">
                    <i class="bi bi-plus-circle me-2"></i> Add Service
                </a>
                <a href="{{ route('admin.team.create') }}" class="btn btn-eld-sm text-start">
                    <i class="bi bi-person-plus me-2"></i> Add Team Member
                </a>
                <a href="{{ route('admin.clients.create') }}" class="btn btn-eld-sm text-start">
                    <i class="bi bi-building-add me-2"></i> Add Client
                </a>
                <a href="{{ route('admin.hero.edit') }}" class="btn btn-outline-secondary btn-sm text-start">
                    <i class="bi bi-pencil me-2"></i> Edit Hero Section
                </a>
                <a href="{{ route('admin.settings.edit') }}" class="btn btn-outline-secondary btn-sm text-start">
                    <i class="bi bi-gear me-2"></i> Site Settings
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
