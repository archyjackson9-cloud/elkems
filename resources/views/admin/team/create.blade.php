@extends('layouts.admin')
@section('title', 'Add Team Member')
@section('page-title', 'Add Team Member')
@section('content')
<div class="admin-card">
    <div class="admin-card-header">Member Details</div>
    <div class="p-4">
        <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.team._form', ['team' => null])
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-eld-sm px-4">Add Member</button>
                <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
