@extends('layouts.admin')

@section('title', 'Hero Section')
@section('page-title', 'Edit Hero Section')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">Hero Section Content</div>
    <div class="p-4">
        <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Main Heading <span class="text-danger">*</span></label>
                    <input type="text" name="heading" class="form-control" value="{{ old('heading', $hero->heading) }}" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Subheading <span class="text-danger">*</span></label>
                    <input type="text" name="subheading" class="form-control" value="{{ old('subheading', $hero->subheading) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Primary Button Text</label>
                    <input type="text" name="button_primary_text" class="form-control" value="{{ old('button_primary_text', $hero->button_primary_text) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Primary Button URL</label>
                    <input type="text" name="button_primary_url" class="form-control" value="{{ old('button_primary_url', $hero->button_primary_url ?? '#services') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Secondary Button Text</label>
                    <input type="text" name="button_secondary_text" class="form-control" value="{{ old('button_secondary_text', $hero->button_secondary_text) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Secondary Button URL</label>
                    <input type="text" name="button_secondary_url" class="form-control" value="{{ old('button_secondary_url', $hero->button_secondary_url ?? '#contact') }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Background Image</label>
                    @if($hero->background_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$hero->background_image) }}" alt="Current hero"
                             style="max-height:160px;border-radius:8px;object-fit:cover">
                    </div>
                    @endif
                    <input type="file" name="background_image" class="form-control" accept="image/*"
                           data-preview="hero-preview">
                    <img id="hero-preview" src="#" alt="Preview"
                         style="display:none;max-height:120px;margin-top:10px;border-radius:8px">
                    <div class="form-text">Recommended: 1920×1080 px. Max 5 MB (jpg, png, webp).</div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive"
                               value="1" {{ old('is_active', $hero->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Active (show on website)</label>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-eld-sm px-4">Save Changes</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
