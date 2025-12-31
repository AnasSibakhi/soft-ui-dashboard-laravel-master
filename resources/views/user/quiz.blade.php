@extends('layouts.user')

@section('content')
<div class="container py-5" style="max-width: 850px; text-align: left;">

    {{-- عنوان الكويز --}}
    <h2 class="mb-4" style="color:#0f172a;">{{ $quiz->name }}</h2>
    <p style="color:#475569;">Ready to test your knowledge? Let’s begin!</p>
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
            @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form action="{{ route('quiz.submit', ['slug' => $quiz->course->slug, 'name' => $quiz->name]) }}" method="POST">
        @csrf

        @foreach ($quiz->questions as $index => $question)
            <div class="mb-4 p-3" style="border:1px solid #e2e8f0; border-radius:8px;">
                {{-- عنوان السؤال مع النقاط --}}
                <p style="font-weight:600; margin-bottom:10px;">
                    {{ $index + 1 }}. {{ $question->title }}
                    <span style="font-weight:500; color:#1d4ed8; margin-left:10px;"> ' Points: {{ $question->score }} ' </span>
                </p>

                {{-- Checkbox / Multiple Choice --}}
                @if(strtolower($question->type) === 'checkbox' || strtolower($question->type) === 'mcq')
                    @php
                        $answers = json_decode($question->answers, true) ?? [];
                    @endphp
                    @foreach($answers as $key => $answer)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio"
                                   name="answers[{{ $question->id }}]"
                                   id="answer{{ $question->id }}_{{ $key }}"
                                   value="{{ $answer }}">
                            <label class="form-check-label" for="answer{{ $question->id }}_{{ $key }}">
                                {{ $answer }}
                            </label>
                        </div>
                    @endforeach

                {{-- Text Question --}}
                @elseif(strtolower($question->type) === 'text')
                    <textarea name="answers[{{ $question->id }}]" rows="3"
                              class="form-control"
                              style="border-color:#e2e8f0; margin-top:5px;"
                              placeholder="Write your answer here..."></textarea>
                @endif

            </div>
        @endforeach

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Submit Quiz</button>
        </div>
    </form>
</div>
@endsection
