@extends('layouts.user_type.auth')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Quiz: {{ $quiz->name }}</h6>
            <a href="{{ route('quiz.question.create', ['quiz_id' => $quiz->id]) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Add Question
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($quiz->questions->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Answers</th>
                                <th>Correct</th>
                                <th>Score</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quiz->questions as $index => $question)
                                @php
                                    $answers = json_decode($question->answers, true);
                                    $correctLetter = strtoupper($question->right_answer);
                                    $correctIndex = ord($correctLetter) - 65;
                                    $correctAnswer = $answers[$correctIndex] ?? 'N/A';
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $question->title }}</td>
                                    <td class="text-start">
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($answers as $i => $ans)
                                                <li><strong>{{ chr(65 + $i) }}.</strong> {{ $ans }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td><span class="badge bg-success">{{ $correctAnswer }}</span></td>
                                    <td>{{ $question->score }}</td>
                                    <td>
                                        <a href="{{ route('question.edit', $question->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('question.destroy', $question->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">
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
                <p class="text-muted text-center my-4">No questions found for this quiz.</p>
            @endif
        </div>
    </div>
</div>
@endsection
