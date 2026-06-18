@extends('layouts.admin')
@section('title', 'Add Partner')
@section('page-title', 'Add Partner')
@section('content')
<div class="admin-card">
    <div class="admin-card-header">Partner Details</div>
    <div class="p-4">
        <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.clients._form', ['client' => null])
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-eld-sm px-4">Add Partner</button>
                <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
