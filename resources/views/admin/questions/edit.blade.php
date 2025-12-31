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
                @method('PUT')

                {{-- Select Quiz --}}
                <div class="mb-3">
                    <label class="form-label">Select Quiz</label>
                    <select name="quiz_id" class="form-select" required>
                        @foreach ($quizzes as $quiz)
                            <option value="{{ $quiz->id }}"
                                {{ $quiz->id == $question->quiz_id ? 'selected' : '' }}>
                                {{ $quiz->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Question Title</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ $question->title }}" required>
                </div>

                {{-- Question Type --}}
                <div class="mb-3">
                    <label class="form-label">Question Type</label>
                    <select name="type" id="type" class="form-select" required onchange="toggleEditFields()">
                        <option value="text" {{ $question->type == 'text' ? 'selected' : '' }}>Text</option>
                        <option value="checkbox" {{ $question->type == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                    </select>
                </div>

                @php
                    $answers = json_decode($question->answers, true);
                @endphp

                {{-- Text Answer --}}
                <div class="mb-3" id="text-answer" style="{{ $question->type == 'text' ? '' : 'display:none;' }}">
                    <label class="form-label">Full Answer (Text)</label>
                    <textarea name="answers_text" class="form-control" rows="3">{{ is_array($answers) ? '' : $answers }}</textarea>
                </div>

                {{-- Checkbox Answers --}}
                <div id="checkbox-answers" style="{{ $question->type == 'checkbox' ? '' : 'display:none;' }}">
                    <label class="form-label">Choices (4 options)</label>
                    @for ($i = 0; $i < 4; $i++)
                        <input type="text" name="answers[]"
                            class="form-control mb-2"
                            placeholder="Choice {{ $i+1 }}"
                            value="{{ is_array($answers) ? ($answers[$i] ?? '') : '' }}">
                    @endfor
                </div>

                {{-- Right Answer --}}
                <div class="mb-3">
                    <label class="form-label">Correct Answer (Text)</label>
                    <input type="text" name="right_answer" class="form-control"
                           value="{{ $question->right_answer }}" required>
                </div>

                {{-- Score --}}
                <div class="mb-3">
                    <label class="form-label">Score</label>
                    <input type="number" name="score" class="form-control"
                           min="1" max="100" value="{{ $question->score }}" required>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary">Update Question</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleEditFields() {
    let type = document.getElementById("type").value;
    document.getElementById("text-answer").style.display = type === "text" ? "block" : "none";
    document.getElementById("checkbox-answers").style.display = type === "checkbox" ? "block" : "none";
}
</script>
@endsection
