@extends('layouts.admin')
@section('title', 'Trusted By')
@section('page-title', 'Trusted By')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0 fw-semibold text-muted">{{ $trustedBys->count() }} organisation(s)</h6>
    <a href="{{ route('admin.trusted-by.create') }}" class="btn btn-eld-sm">
        <i class="bi bi-plus-circle me-1"></i> Add Organisation
    </a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Website</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th style="width:130px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trustedBys as $item)
                <tr>
                    <td>
                        @if($item->logo)
                            <img src="{{ asset('storage/'.$item->logo) }}" alt="{{ $item->name }}"
                                 style="max-height:40px;max-width:80px;object-fit:contain">
                        @elseif($item->logo_text)
                            <span style="font-size:.75rem">{!! $item->logo_text !!}</span>
                        @else
                            <span class="text-muted small">Text only</span>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $item->name }}</td>
                    <td>
                        @if($item->website_url)
                        <a href="{{ $item->website_url }}" target="_blank" class="text-eld small">
                            {{ parse_url($item->website_url, PHP_URL_HOST) }}
                        </a>
                        @else —
                        @endif
                    </td>
                    <td>{{ $item->sort_order }}</td>
                    <td>
                        @if($item->is_active)
                            <span class="badge" style="background:#3DBDA0">Active</span>
                        @else
                            <span class="badge bg-secondary">Hidden</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.trusted-by.edit', $item) }}"
                           class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                        <form action="{{ route('admin.trusted-by.destroy', $item) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    data-confirm="Delete {{ $item->name }}?">Del</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">
                    No trusted-by entries yet. <a href="{{ route('admin.trusted-by.create') }}">Add one</a>.
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
