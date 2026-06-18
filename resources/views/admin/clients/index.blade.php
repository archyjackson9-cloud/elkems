@extends('layouts.admin')
@section('title', 'Partnerships')
@section('page-title', 'Partnerships')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0 fw-semibold text-muted">{{ $clients->count() }} partner(s)</h6>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-eld-sm">
        <i class="bi bi-plus-circle me-1"></i> Add Partner
    </a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Website</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th style="width:130px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>
                        @if($client->logo)
                            <img src="{{ asset('storage/'.$client->logo) }}" alt="{{ $client->name }}"
                                 style="max-height:40px;max-width:80px;object-fit:contain">
                        @elseif($client->logo_text)
                            <span style="font-size:.75rem">{!! $client->logo_text !!}</span>
                        @else
                            <span class="text-muted small">Text only</span>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $client->name }}</td>
                    <td class="small text-muted">{{ Str::limit($client->description, 60) }}</td>
                    <td>
                        @if($client->website_url)
                        <a href="{{ $client->website_url }}" target="_blank" class="text-eld small">
                            {{ parse_url($client->website_url, PHP_URL_HOST) }}
                        </a>
                        @else —
                        @endif
                    </td>
                    <td>{{ $client->sort_order }}</td>
                    <td>
                        @if($client->is_active)
                            <span class="badge" style="background:#3DBDA0">Active</span>
                        @else
                            <span class="badge bg-secondary">Hidden</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.clients.edit', $client) }}"
                           class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                        <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    data-confirm="Delete {{ $client->name }}?">Del</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-5">
                    No partners yet. <a href="{{ route('admin.clients.create') }}">Add one</a>.
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
