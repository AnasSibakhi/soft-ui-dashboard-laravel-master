@extends('layouts.user_type.auth')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
.course-link {
  font-size: 13px;
  color: #0d6efd;
  text-decoration: none;
  transition: all 0.3s ease;
  cursor: pointer;
}

.course-link:hover {
  color: #0a58ca;
  transform: scale(1.05);
  text-decoration: underline;
}

.table td, .table th {
  font-size: 13px;
  vertical-align: middle;
}
</style>

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-xs text-uppercase">Manage Questions</h6>
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
                <div class="d-flex justify-content-end">
                    <a href="{{ route('question.create') }}" class="btn bg-gradient-primary btn-sm">
                        <i class="fas fa-plus me-1"></i> Add Question
                    </a>
                </div>
            </div>

            {{-- Questions Table --}}
            @if(count($questions))
            <div class="card-body pt-0">
                <table class="table table-hover align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Questions</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">The Answers</th>
                            {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Correct</th> --}}
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Score</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Quiz</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                        <tr>
                            <td class="text-center">
                                {{-- <a href="{{ route('question.show', $question->id) }}" class="course-link"> --}}
                                    {{ $question->title }}
                                </a>
                            </td>
                            <td class="text-center">
                                @php
                                    $answers = json_decode($question->answers, true);
                                @endphp
                                @if(is_array($answers))
                                    <ul class="list-unstyled mb-0">
                                        @foreach($answers as $answer)
                                            <li><i class="fas fa-angle-right text-primary me-1"></i>{{ $answer }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $question->answers }}
                                @endif
                            </td>
                            {{-- <td class="text-center">{{ $question->right_answer }}</td> --}}
                            <td class="text-center">{{ $question->score }}</td>
                            <td class="text-center">
                                @if($question->quiz)
                                <a href="{{ route('quizzes.show', $question->quiz->id) }}" class="text-sm text-primary text-decoration-underline">
                                    {{ $question->quiz->name }}
                                </a>
                                @else
                                <span class="text-sm text-muted">—</span>
                                @endif
                            </td>
                         <td class="text-center">
    {{-- Show button --}}
    {{-- <a href="{{ route('question.show', $question->id) }}" class="btn btn-link text-info text-xs px-2" title="Show">
        <i class="fas fa-eye"></i>
    </a> --}}

    {{-- Edit button --}}
    <a href="{{ route('question.edit', $question->id) }}" class="btn btn-link text-secondary text-xs px-2" title="Edit">
        <i class="fas fa-edit"></i>
    </a>

    {{-- Delete button --}}
    <form method="POST" action="{{ route('question.destroy', $question->id) }}" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button class="btn btn-link text-danger text-xs px-2" title="Delete" onclick="return confirm('Are you sure?')">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-4">
                <p class="text-muted text-xs mb-0">No Questions Found</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
