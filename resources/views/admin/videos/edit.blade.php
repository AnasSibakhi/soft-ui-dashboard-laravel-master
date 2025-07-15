@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Edit Video</h6>
        </div>

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show text-xs mx-4 mt-3" role="alert">
                <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body pt-4 p-3">
            <form action="{{ route('videos.update', $video->id) }}" method="POST" autocomplete="off">
                @csrf
                @method('PATCH')

                {{-- Validation errors --}}
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text">{{ $errors->first() }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-text">{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    {{-- Title --}}
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-control-label">Video Title</label>
                        <input class="form-control" type="text" id="title" name="title" placeholder="Enter video title" value="{{ $video->title }}" required>
                    </div>

                    {{-- Course --}}
                    <div class="col-md-6 mb-3">
                        <label for="course_id" class="form-control-label">Course</label>
                        <select name="course_id" id="course_id" class="form-control" required>
                            <option value="" disabled>Choose a course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $video->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('course_id'))
                            <small class="text-danger">{{ $errors->first('course_id') }}</small>
                        @endif
                    </div>

                    {{-- Link --}}
                    <div class="col-md-12 mb-3">
                        <label for="link" class="form-control-label">Video Link</label>
                        <input class="form-control" type="url" id="link" name="link" placeholder="Enter video link" value="{{ $video->link }}" required>
                        @if ($errors->has('link'))
                            <small class="text-danger">{{ $errors->first('link') }}</small>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-dark">Update Video</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
