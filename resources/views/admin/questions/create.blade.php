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
                    <label class="form-label">Select Quiz</label>
                    <select name="quiz_id" class="form-select" required>
                        <option value="">Choose a quiz</option>
                        @foreach ($quizzes as $quiz)
                            <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Question Title --}}
                <div class="mb-3">
                    <label class="form-label">Question Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                {{-- Question Type --}}
                <div class="mb-3">
                    <label class="form-label">Question Type</label>
                    <select name="type" id="type" class="form-select" required onchange="toggleAnswerFields()">
                        <option value="">Choose Type</option>
                        <option value="text">Text Answer</option>
                        <option value="checkbox">Multiple Choices</option>
                    </select>
                </div>

                {{-- Text Answer --}}
                <div class="mb-3" id="text-answer" style="display:none;">
                    <label class="form-label">Full Answer (Text)</label>
                    <textarea name="answers" class="form-control" rows="3"></textarea>
                </div>

                {{-- Checkbox Answer Fields --}}
                <div id="checkbox-answers" style="display:none;">
                    <label class="form-label">Choices (4 Options)</label>

                    @for ($i = 1; $i <= 4; $i++)
                        <input type="text" name="choice[]" class="form-control mb-2" placeholder="Choice {{ $i }}">
                    @endfor
                </div>

                {{-- Right Answer --}}
                <div class="mb-3">
                    <label class="form-label">Correct Answer</label>
                    <input type="text" name="right_answer" class="form-control" required>
                </div>

                {{-- Score --}}
                <div class="mb-3">
                    <label class="form-label">Score</label>
                    <input type="number" name="score" class="form-control" min="1" max="100" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Question</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleAnswerFields() {
    let type = document.getElementById("type").value;

    if (type === "text") {
        document.getElementById("text-answer").style.display = "block";
        document.getElementById("checkbox-answers").style.display = "none";
    } else if (type === "checkbox") {
        document.getElementById("text-answer").style.display = "none";
        document.getElementById("checkbox-answers").style.display = "block";
    } else {
        document.getElementById("text-answer").style.display = "none";
        document.getElementById("checkbox-answers").style.display = "none";
    }
}
</script>

@endsection
