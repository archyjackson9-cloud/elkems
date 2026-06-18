@extends('layouts.admin')
@section('title', 'Add Trusted By')
@section('page-title', 'Add Trusted By')
@section('content')
<div class="admin-card">
    <div class="admin-card-header">Organisation Details</div>
    <div class="p-4">
        <form action="{{ route('admin.trusted-by.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.trusted-by._form', ['trustedBy' => null])
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-eld-sm px-4">Add Organisation</button>
                <a href="{{ route('admin.trusted-by.index') }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
