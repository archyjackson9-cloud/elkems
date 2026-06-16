@extends('layouts.admin')

@section('title', 'Edit Service')
@section('page-title', 'Edit Service')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">Service Details</div>
    <div class="p-4">
        <form action="{{ route('admin.services.update', $service) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.services._form', ['service' => $service])
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-eld-sm px-4">Update Service</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
