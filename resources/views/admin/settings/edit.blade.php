@extends('layouts.admin')
@section('title', 'Site Settings')
@section('page-title', 'Site Settings')
@section('content')

<div class="admin-card">
    <div class="admin-card-header">General Settings</div>
    <div class="p-4">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf @method('PUT')

            <h6 class="fw-700 mb-3" style="color:#3DBDA0;border-bottom:1px solid #eee;padding-bottom:8px">
                <i class="bi bi-globe2 me-2"></i>Site Information
            </h6>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $settings['site_name']) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tagline</label>
                    <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $settings['tagline']) }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Footer Text</label>
                    <input type="text" name="footer_text" class="form-control" value="{{ old('footer_text', $settings['footer_text']) }}" placeholder="All rights reserved.">
                </div>
            </div>

            <h6 class="fw-700 mb-3" style="color:#3DBDA0;border-bottom:1px solid #eee;padding-bottom:8px">
                <i class="bi bi-telephone me-2"></i>Contact Information
            </h6>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Phone Number</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $settings['phone']) }}" placeholder="+233 XX XXX XXXX">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Public Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $settings['email']) }}" placeholder="info@eldsolutions.com">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $settings['address']) }}" placeholder="Accra, Ghana">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Admin Notification Email</label>
                    <input type="email" name="admin_email" class="form-control" value="{{ old('admin_email', $settings['admin_email']) }}" placeholder="admin@eldsolutions.com">
                    <div class="form-text">Contact form submissions are sent here.</div>
                </div>
            </div>

            <h6 class="fw-700 mb-3" style="color:#3DBDA0;border-bottom:1px solid #eee;padding-bottom:8px">
                <i class="bi bi-share me-2"></i>Social Media Links
            </h6>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold"><i class="bi bi-linkedin me-1"></i>LinkedIn</label>
                    <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $settings['linkedin']) }}" placeholder="https://linkedin.com/company/...">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold"><i class="bi bi-twitter-x me-1"></i>Twitter / X</label>
                    <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $settings['twitter']) }}" placeholder="https://twitter.com/...">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold"><i class="bi bi-facebook me-1"></i>Facebook</label>
                    <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $settings['facebook']) }}" placeholder="https://facebook.com/...">
                </div>
            </div>

            <h6 class="fw-700 mb-3" style="color:#3DBDA0;border-bottom:1px solid #eee;padding-bottom:8px">
                <i class="bi bi-map me-2"></i>Maps (Optional)
            </h6>
            <div class="mb-4">
                <label class="form-label fw-semibold">Google Maps Embed URL</label>
                <input type="text" name="google_maps_embed" class="form-control" value="{{ old('google_maps_embed', $settings['google_maps_embed']) }}" placeholder="https://maps.google.com/maps?...">
                <div class="form-text">Paste the embed URL from Google Maps share → Embed a map.</div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-eld-sm px-4">Save Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
