@extends('layouts.user_type.auth')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
.course-link {
  font-size: 12px;
  color: #0d6efd;
  text-decoration: none;
  transition: all 0.3s ease;
  cursor: pointer;
}

.course-link:hover {
  color: #0a58ca;
  transform: scale(1.1);
  text-decoration: underline;
}
</style>

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-xs text-uppercase">Manage Quiz</h6>
            </div>

            {{-- Errors --}}
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show text-xs mx-4 mt-3" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Success --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-xs mx-4 mt-3" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Add Button --}}
            <div class="card-body">
                <div class="row align-items-end">
                    <div class="col-md-12 d-flex justify-content-end">
                        <a href="{{ route('quizzes.create') }}" class="btn bg-gradient-primary btn-sm mb-1">
                            <i class="fas fa-plus me-1"></i> Add Quiz
                        </a>
                    </div>
                </div>
            </div>

            {{-- Quizzes Table --}}
            @if(count($quizzes))
            <div class="card-body pt-0">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. Questions</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course Title</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizzes as $quiz)
                            <tr>
                                <td class="text-center">
                                    <a href="{{ route('quizzes.show', $quiz) }}" class="course-link">
                                        {{ $quiz->name }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ count($quiz->questions) }}</p>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('course.show', $quiz->course_id) }}" class="course-link">
                                        {{ $quiz->course->title }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <span class="text-secondary text-xs font-weight-bold">
                                        {{ $quiz->created_at ? $quiz->created_at->diffForHumans() : '--' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-link text-secondary text-xs px-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('quizzes.destroy', $quiz->id) }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-danger text-xs px-2" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="text-center py-4">
                <p class="text-muted text-xs mb-0">No Quizzes Found</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
