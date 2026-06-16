@extends('layouts.admin')
@section('title', 'Edit Client')
@section('page-title', 'Edit Client')
@section('content')
<div class="admin-card">
    <div class="admin-card-header">Client Details</div>
    <div class="p-4">
        <form action="{{ route('admin.clients.update', $client) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.clients._form', ['client' => $client])
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-eld-sm px-4">Update Client</button>
                <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
