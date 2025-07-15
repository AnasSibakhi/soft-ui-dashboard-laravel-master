@extends('layouts.user_type.auth')

@section('content')
<div class="container mt-4">
    <h4>Edit User</h4>
    {{-- @include('inclode.errors') --}}
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('user-management') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
