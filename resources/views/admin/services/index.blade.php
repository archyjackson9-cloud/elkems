@extends('layouts.admin')

@section('title', 'Services')
@section('page-title', 'Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0 fw-semibold text-muted">{{ $services->count() }} service(s) total</h6>
    <a href="{{ route('admin.services.create') }}" class="btn btn-eld-sm">
        <i class="bi bi-plus-circle me-1"></i> Add Service
    </a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width:60px">#</th>
                    <th>Title</th>
                    <th>Badge Labels</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th style="width:120px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td class="text-muted">{{ $service->id }}</td>
                    <td class="fw-semibold">{{ $service->title }}</td>
                    <td><small class="text-muted">{{ $service->badge_labels ?: '—' }}</small></td>
                    <td>{{ $service->sort_order }}</td>
                    <td>
                        @if($service->is_active)
                            <span class="badge" style="background:#3DBDA0">Active</span>
                        @else
                            <span class="badge bg-secondary">Hidden</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service) }}"
                           class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                        <form action="{{ route('admin.services.destroy', $service) }}"
                              method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    data-confirm="Delete this service?">Del</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">
                    No services yet. <a href="{{ route('admin.services.create') }}">Add one</a>.
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
