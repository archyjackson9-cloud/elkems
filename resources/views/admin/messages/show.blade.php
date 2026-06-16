@extends('layouts.admin')
@section('title', 'View Message')
@section('page-title', 'Message Detail')
@section('content')

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <span>Message from {{ $message->name }}</span>
                <span class="badge" style="background:#3DBDA0">{{ $message->is_read ? 'Read' : 'Unread' }}</span>
            </div>
            <div class="p-4">
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <label class="small text-muted text-uppercase fw-semibold" style="letter-spacing:.5px">Name</label>
                        <p class="mb-0 fw-semibold">{{ $message->name }}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="small text-muted text-uppercase fw-semibold" style="letter-spacing:.5px">Email</label>
                        <p class="mb-0"><a href="mailto:{{ $message->email }}" class="text-eld">{{ $message->email }}</a></p>
                    </div>
                    @if($message->subject)
                    <div class="col-12">
                        <label class="small text-muted text-uppercase fw-semibold" style="letter-spacing:.5px">Subject</label>
                        <p class="mb-0">{{ $message->subject }}</p>
                    </div>
                    @endif
                    <div class="col-12">
                        <label class="small text-muted text-uppercase fw-semibold" style="letter-spacing:.5px">Received</label>
                        <p class="mb-0 text-muted small">{{ $message->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                </div>

                <hr>
                <label class="small text-muted text-uppercase fw-semibold mb-2 d-block" style="letter-spacing:.5px">Message</label>
                <div style="background:#f8f9fa;border-left:4px solid #3DBDA0;padding:20px;border-radius:0 8px 8px 0;white-space:pre-wrap;line-height:1.75">{{ $message->message }}</div>

                <div class="mt-4 d-flex gap-2">
                    <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject ?? 'Your enquiry') }}"
                       class="btn btn-eld-sm">
                        <i class="bi bi-reply me-1"></i> Reply via Email
                    </a>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="ms-auto">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                data-confirm="Delete this message?">
                            <i class="bi bi-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="admin-card-header">Quick Reply</div>
            <div class="p-4">
                <p class="small text-muted mb-3">Compose a reply directly from here (opens your mail client).</p>
                <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject ?? 'Your enquiry to ELD Solutions') }}&body={{ urlencode('Dear '.$message->name.','."\n\n".'Thank you for contacting ELD Solutions Ltd.'."\n\n".'Regards,'."\n".'ELD Solutions Team') }}"
                   class="btn btn-eld-sm w-100">
                    <i class="bi bi-envelope-arrow-up me-2"></i> Open in Mail Client
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
