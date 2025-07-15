@extends('layouts.user_type.auth')

@section('content')
<div class="container mt-4">
    <h4>Edit quiz</h4>
    @if(session('info'))
    <div class="alert alert-info alert-dismissible fade show text-xs mx-4 mt-3" role="alert">
        <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <form method="POST" action="{{ route('quizzes.update', $quiz->id) }}">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $quiz->name }}">
        </div>
    <div class="col-md-6 mb-3">
                        <label for="course_id" class="form-control-label">Course</label>
                        <select name="course_id" id="course_id" class="form-control" required>
                            <option value="{{ $quiz->course_id }}" selected disabled>{{ $quiz->course->title ?? 'Current Course' }}</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $quiz->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('course_id'))
                            <small class="text-danger">{{ $errors->first('course_id') }}</small>
                        @endif
                    </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
