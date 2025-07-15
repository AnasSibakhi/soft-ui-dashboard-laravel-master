@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Edit Course</h6>
        </div>
        <div class="card-body pt-4 p-3">
            <form action="{{ route('course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Validation errors --}}
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text">{{ $errors->first() }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    {{-- Title --}}
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-control-label">Course Title</label>
                        <input class="form-control" type="text" id="title" name="title" value="{{ old('title', $course->title) }}">
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-control-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0" {{ $course->status == 0 ? 'selected' : '' }}>FREE</option>
                            <option value="1" {{ $course->status == 1 ? 'selected' : '' }}>PAID</option>
                        </select>
                    </div>

                    {{-- Track --}}
                    <div class="col-md-6 mb-3">
                        <label for="track_id" class="form-control-label">Track</label>
                        <select name="track_id" id="track_id" class="form-control">
                            @foreach($tracks as $track)
                                <option value="{{ $track->id }}" {{ $course->track_id == $track->id ? 'selected' : '' }}>
                                    {{ $track->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Link --}}
                    <div class="col-md-6 mb-3">
                        <label for="link" class="form-control-label">Course Link</label>
                        <input class="form-control" type="text" id="link" name="link" value="{{ old('link', $course->link) }}">
                    </div>

                    {{-- Multiple Images --}}
                    <div class="col-md-12 mb-3">
                        <label for="images" class="form-control-label">Course Images</label>
                        <input class="form-control" type="file" id="images" name="images[]" multiple>

                        @if ($course->photos && $course->photos->count())
                            <div class="d-flex gap-2 mt-2 flex-wrap">
                                @foreach($course->photos as $photo)
                                    <img src="{{ asset('images/' . $photo->filename) }}" alt="Photo" style="height: 80px; border-radius: 4px;">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('course.index') }}" class="btn" style="color: #a00080; border: 1px solid #a00080;">
                        ← Back
                    </a>
                    <button type="submit" class="btn btn-dark">Update Course</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
