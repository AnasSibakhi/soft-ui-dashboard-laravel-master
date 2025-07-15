@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Create New Video for: {{ $course->title }}</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="{{ route('course.videos.store', $course->id) }}" method="POST">
                @csrf

                {{-- Validation errors --}}
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text">{{ $errors->first() }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Success Message --}}
                {{-- @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-text">{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif --}}

                <div class="row">
                    {{-- Video Title --}}
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-control-label">Video Title</label>
                        <input class="form-control" type="text" id="title" name="title" placeholder="Enter video title" value="{{ old('title') }}" required>
                    </div>

                    {{-- Video Link --}}
                    <div class="col-md-6 mb-3">
                        <label for="link" class="form-control-label">Video Link (e.g. YouTube)</label>
                        <input class="form-control" type="url" id="link" name="link" placeholder="https://youtube.com/..." value="{{ old('link') }}" required>
                        @if ($errors->has('link'))
                            <small class="text-danger">{{ $errors->first('link') }}</small>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-dark">Create Video</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
