@extends('layouts.admin')

@section('title', 'About Section')
@section('page-title', 'Edit About Section')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">About Section Content</div>
    <div class="p-4">
        <form action="{{ route('admin.about.update') }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-4">
                <label class="form-label fw-semibold">Company Description <span class="text-danger">*</span></label>
                <textarea name="description" rows="5" class="form-control" required>{{ old('description', $about->description) }}</textarea>
                <div class="form-text">This paragraph appears in the About section below the heading.</div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Mission Statement <span class="text-danger">*</span></label>
                <textarea name="mission_statement" rows="4" class="form-control" required>{{ old('mission_statement', $about->mission_statement) }}</textarea>
                <div class="form-text">Appears in the teal banner below the description.</div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-eld-sm px-4">Save Changes</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
