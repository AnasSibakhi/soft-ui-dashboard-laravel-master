@extends('layouts.user_type.auth')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h6>Add New Question</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('question.store') }}">
                @csrf

                {{-- Select Quiz --}}
                <div class="mb-3">
                    <label for="quiz_id" class="form-label">Select Quiz</label>
                    <select name="quiz_id" id="quiz_id" class="form-select" required>
                        <option value="">Choose a quiz</option>
                        @foreach ($quizzes as $quiz)
                            <option value="{{ $quiz->id }}" {{ old('quiz_id') == $quiz->id ? 'selected' : '' }}>
                                {{ $quiz->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('quiz_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Question Title</label>
                    <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Answers --}}
                <div class="mb-3">
                    <label class="form-label">Answers</label>
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="Answer A" required value="{{ old('answers.0') }}">
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="Answer B" required value="{{ old('answers.1') }}">
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="Answer C" required value="{{ old('answers.2') }}">
                    <input type="text" name="answers[]" class="form-control mb-2" placeholder="Answer D" required value="{{ old('answers.3') }}">
                    @error('answers') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Right Answer --}}
                <div class="mb-3">
                    <label for="right_answer" class="form-label">Correct Answer</label>
                    <select name="right_answer" class="form-select" required>
                        <option value="">Select the correct one</option>
                        <option value="A" {{ old('right_answer') == 'A' ? 'selected' : '' }}>Answer A</option>
                        <option value="B" {{ old('right_answer') == 'B' ? 'selected' : '' }}>Answer B</option>
                        <option value="C" {{ old('right_answer') == 'C' ? 'selected' : '' }}>Answer C</option>
                        <option value="D" {{ old('right_answer') == 'D' ? 'selected' : '' }}>Answer D</option>
                    </select>
                    @error('right_answer') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Score --}}
                <div class="mb-3">
                    <label for="score" class="form-label">Score</label>
                    <input type="number" name="score" class="form-control" min="1" max="100" value="{{ old('score', 1) }}" required>
                    @error('score') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="text-end">
                    <button class="btn btn-primary">Save Question</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
