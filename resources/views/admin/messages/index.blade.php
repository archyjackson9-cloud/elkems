@extends('layouts.admin')
@section('title', 'Messages')
@section('page-title', 'Contact Messages')
@section('content')

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width:30px"></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Received</th>
                    <th style="width:120px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr class="{{ !$msg->is_read ? 'fw-semibold' : '' }}" style="{{ !$msg->is_read ? 'background:#f0fbf8' : '' }}">
                    <td class="text-center">
                        @if(!$msg->is_read)
                            <span style="width:8px;height:8px;border-radius:50%;background:#3DBDA0;display:inline-block"></span>
                        @endif
                    </td>
                    <td>{{ $msg->name }}</td>
                    <td><a href="mailto:{{ $msg->email }}" class="text-eld">{{ $msg->email }}</a></td>
                    <td>{{ Str::limit($msg->subject ?? '(no subject)', 40) }}</td>
                    <td><small class="text-muted">{{ $msg->created_at->format('M j, Y g:i A') }}</small></td>
                    <td>
                        <a href="{{ route('admin.messages.show', $msg) }}"
                           class="btn btn-sm btn-eld-sm me-1">Read</a>
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    data-confirm="Delete this message?">Del</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">No messages yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div class="p-4">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
