@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Create New Quiz</h6>
        </div>
        <div class="card-body pt-4 p-3">
             <form action="{{ route('quizzes.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf

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
                    {{-- Name --}}
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-control-label">quiz Name</label>
                        <input class="form-control" type="text" id="title" name="name" placeholder="Enter quiz title" value="{{ old('name') }}">
                    </div>



                    {{-- course --}}
                  <div class="col-md-6 mb-3">
                            <label for="course_id" class="form-control-label">course</label>
                            <select name="course_id" id="track_id" class="form-control" required>
                                <option value="" disabled selected>Choose a course</option>

                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->title }}
                                    </option>

                            </select>
                            @if ($errors->has('course_id'))
                                <small class="text-danger">{{ $errors->first('course_id') }}</small>
                            @endif
                        </div>

                    {{-- Link --}}
                    {{-- <div class="col-md-6 mb-3">
                        <label for="link" class="form-control-label">q</label>
                        <input class="form-control" type="text" id="link" name="link" placeholder="Enter course link" value="{{ old('link') }}">
                        @if ($errors->has('link'))
                            <small class="text-danger">{{ $errors->first('link') }}</small>
                        @endif
                    </div> --}}

                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-dark">Create Course</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
