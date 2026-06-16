@extends('layouts.admin')

@section('title', 'Add Service')
@section('page-title', 'Add New Service')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">Service Details</div>
    <div class="p-4">
        <form action="{{ route('admin.services.store') }}" method="POST">
            @csrf
            @include('admin.services._form', ['service' => null])
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-eld-sm px-4">Create Service</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
