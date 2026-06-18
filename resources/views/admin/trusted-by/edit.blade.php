@extends('layouts.admin')
@section('title', 'Edit Trusted By')
@section('page-title', 'Edit Trusted By')
@section('content')
<div class="admin-card">
    <div class="admin-card-header">Organisation Details</div>
    <div class="p-4">
        <form action="{{ route('admin.trusted-by.update', $trustedBy) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.trusted-by._form', ['trustedBy' => $trustedBy])
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-eld-sm px-4">Update Organisation</button>
                <a href="{{ route('admin.trusted-by.index') }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
