@extends('layouts.user_type.auth')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h6>Edit Question: {{ $question->title }}</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('question.update', $question->id) }}">
                @csrf
                @method('PUT') {{-- مهم لتحديد أنه تعديل --}}

                {{-- Select Quiz --}}
                <div class="mb-3">
                    <label for="quiz_id" class="form-label">Select Quiz</label>
                    <select name="quiz_id" class="form-select" required>
                        @foreach ($quizzes as $quiz)
                            <option value="{{ $quiz->id }}" {{ $quiz->id == $question->quiz_id ? 'selected' : '' }}>
                                {{ $quiz->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('quiz_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Question Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $question->title) }}" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Answers --}}
                @php
                    $answers = json_decode($question->answers, true);
                @endphp
                <div class="mb-3">
                    <label class="form-label">Answers</label>
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="Answer A" value="{{ old('answers.0', $answers[0] ?? '') }}" required>
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="Answer B" value="{{ old('answers.1', $answers[1] ?? '') }}" required>
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="Answer C" value="{{ old('answers.2', $answers[2] ?? '') }}" required>
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="Answer D" value="{{ old('answers.3', $answers[3] ?? '') }}" required>
                    @error('answers') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Right Answer --}}
                <div class="mb-3">
                    <label for="right_answer" class="form-label">Correct Answer</label>
                    <select name="right_answer" class="form-select" required>
                        <option value="">Select the correct one</option>
                        <option value="A" {{ old('right_answer', $question->right_answer) == 'A' ? 'selected' : '' }}>Answer A</option>
                        <option value="B" {{ old('right_answer', $question->right_answer) == 'B' ? 'selected' : '' }}>Answer B</option>
                        <option value="C" {{ old('right_answer', $question->right_answer) == 'C' ? 'selected' : '' }}>Answer C</option>
                        <option value="D" {{ old('right_answer', $question->right_answer) == 'D' ? 'selected' : '' }}>Answer D</option>
                    </select>
                    @error('right_answer') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Score --}}
                <div class="mb-3">
                    <label for="score" class="form-label">Score</label>
                    <input type="number" name="score" class="form-control" value="{{ old('score', $question->score) }}" min="1" max="100" required>
                    @error('score') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="text-end">
                    <button class="btn btn-primary">Update Question</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
