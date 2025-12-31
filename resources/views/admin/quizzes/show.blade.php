@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-uppercase text-sm">Quiz: {{ $quiz->name }}</h6>
            <a href="{{ route('quiz.questions.create', ['quiz' => $quiz->id]) }}" class="btn btn-sm bg-gradient-primary">
                <i class="fas fa-plus me-1"></i> Add Question
            </a>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mx-4 my-3" role="alert">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($quiz->questions->count())
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 text-center">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Question</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Answers</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Correct</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Score</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quiz->questions as $index => $question)
                                @php
                                    // حاول تحويل الإجابات من JSON إلى مصفوفة
                                    $answers = json_decode($question->answers, true);

                                    // إذا json_decode رجع null، اعتبرها نص واحد
                                    if (!is_array($answers)) {
                                        $answers = [$question->answers];
                                    }

                                    $correctLetter = strtoupper($question->right_answer ?? '');
                                    $correctIndex = is_string($correctLetter) && strlen($correctLetter) === 1 ? ord($correctLetter) - 65 : null;
                                    $correctAnswer = ($correctIndex !== null && isset($answers[$correctIndex])) ? $answers[$correctIndex] : ($answers[0] ?? 'N/A');
                                @endphp
                                <tr>
                                    <td class="text-sm">{{ $question->title }}</td>
                                    <td class="text-start text-sm">
                                        <ul class="list-unstyled mb-0 ps-3">
                                            @foreach ($answers as $i => $ans)
                                                @php
                                                    $label = is_numeric($i) ? chr(65 + (int) $i) : '?';
                                                @endphp
                                                <li><strong>{{ $label }}.</strong> {{ $ans }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td><span class="badge bg-success text-white">{{ $correctAnswer }}</span></td>
                                    <td class="text-sm">{{ $question->score }}</td>
                                    <td>
                                        <a href="{{ route('question.edit', $question->id) }}" class="btn btn-link text-primary text-xs">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('question.destroy', $question->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-link text-danger text-xs" onclick="return confirm('Are you sure?')">
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
                    <p class="text-muted text-sm mb-0">No questions found for this quiz.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
