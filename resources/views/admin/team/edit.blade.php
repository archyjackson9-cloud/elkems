@extends('layouts.admin')
@section('title', 'Edit Team Member')
@section('page-title', 'Edit Team Member')
@section('content')
<div class="admin-card">
    <div class="admin-card-header">Member Details</div>
    <div class="p-4">
        <form action="{{ route('admin.team.update', $team) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.team._form', ['team' => $team])
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-eld-sm px-4">Update Member</button>
                <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
