@extends('layouts.admin')

@section('title', 'Team Members')
@section('page-title', 'Management Team')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0 fw-semibold text-muted">{{ $members->count() }} member(s)</h6>
    <a href="{{ route('admin.team.create') }}" class="btn btn-eld-sm">
        <i class="bi bi-person-plus me-1"></i> Add Member
    </a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th style="width:130px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                <tr>
                    <td>
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}"
                                 style="width:40px;height:40px;border-radius:50%;object-fit:cover">
                        @else
                            <div style="width:40px;height:40px;border-radius:50%;background:#3DBDA0;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:13px">
                                {{ $member->initials }}
                            </div>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $member->name }}</td>
                    <td class="text-eld">{{ $member->position }}</td>
                    <td>{{ $member->sort_order }}</td>
                    <td>
                        @if($member->is_active)
                            <span class="badge" style="background:#3DBDA0">Active</span>
                        @else
                            <span class="badge bg-secondary">Hidden</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.team.edit', $member) }}"
                           class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                        <form action="{{ route('admin.team.destroy', $member) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    data-confirm="Delete {{ $member->name }}?">Del</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">
                    No team members yet. <a href="{{ route('admin.team.create') }}">Add one</a>.
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
