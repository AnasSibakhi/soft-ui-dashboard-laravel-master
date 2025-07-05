
@extends('layouts.user_type.auth')

@section('content')
<div class="container mt-4">
    <h4>Edit Track</h4>
    @if(session('info'))
    <div class="alert alert-info alert-dismissible fade show text-xs mx-4 mt-3" role="alert">
        <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    {{-- @if(session('info'))
    <div class="alert alert-info alert-dismissible fade show text-xs mx-4 mt-3" role="alert">
        <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif --}}
    <form method="POST" action="{{ route('tracks.update', $track->id) }}">
        @csrf
        @method('PATCH')
 @include('includes.errors')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $track->name }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('tracks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
