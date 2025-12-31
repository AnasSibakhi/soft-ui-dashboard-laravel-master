@extends('layouts.user')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
:root {
    --main-color: #2563EB;
    --main-hover: #1d4ed8;
    --success-color: #22c55e;
    --danger-color: #ef4444;
    --text-gray: #6b7280;
    --bg-light: #f9fafb;
}

/* كارد الكورس */
.course-card {
    background-color: #fff;
    border: none;
    max-width: 1100px;
    margin: auto;
    height: 280px;
}
.course-card img:hover { transform: scale(1.04); transition:0.3s; }

.badge { border-radius: 12px; font-size: 0.85rem; }
.course-info i { color: var(--main-color); }
.course-action .badge.bg-success { background: var(--success-color) !important; }
.course-action .badge.bg-danger { background: var(--danger-color) !important; }

/* فيديوهات */
.videos .video-card {
    border:1px solid #e5e7eb;
    border-radius:10px;
    padding:12px 14px;
    margin-bottom:10px;
    cursor:pointer;
    transition:0.3s;
    color:#111827;
    background:#fff;
}
.videos .video-card:hover {
    background: var(--bg-light);
    border-color: var(--main-color);
}
.videos .video-card i { color: var(--main-color); }

/* مودال الفيديو */
#video-container {
    width:100%;
    height:0;
    padding-bottom:56.25%;
    position:relative;
}
#video-container iframe, #video-container video {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
}

/* الكويزات */
.quizzes .quiz-card {
    border:1px solid #e5e7eb;
    border-radius:10px;
    padding:12px 14px;
    margin-bottom:10px;
    transition:0.3s;
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:#fff;
    color:#111827;
}
.quizzes .quiz-card:hover {
    background: var(--bg-light);
    border-color: var(--main-color);
}
.quizzes .quiz-card i { color: var(--main-color); }

.btn-outline-primary {
    color: var(--main-color);
    border-color: var(--main-color);
}
.btn-outline-primary:hover {
    background: var(--main-color);
    color: #fff;
    border-color: var(--main-hover);
}

h4.fw-bold { color: var(--main-color); }
.text-secondary { color: var(--text-gray) !important; }
</style>

<div class="container py-4">
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {!! session('status') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    {{-- كارد الكورس --}}
    <div class="card shadow-lg rounded-4 mb-4 course-card">
        <div class="row g-0 h-100 align-items-center">
            <div class="col-md-4 h-100">
                @php $imagePath = $course->photos->first() ? $course->photos->first()->filename : 'default.jpg'; @endphp
                <img src="{{ asset('images/' . $imagePath) }}" class="w-100 h-100 rounded-3 shadow-sm" style="object-fit:cover;">
            </div>
            <div class="col-md-8 p-4 d-flex flex-column justify-content-between">
                <h3 class="fw-bold text-dark mb-2" style="font-size:1.6rem;">{{ $course->title }}</h3>
                <p class="text-secondary mb-0" style="line-height:1.5; font-size:0.95rem; max-height:85px; overflow:hidden;">
                    {{ $course->description }}
                </p>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="course-info d-flex gap-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-people-fill fs-5"></i>
                            <span><strong>Participants:</strong> {{ $course->users->count() }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-diagram-3-fill fs-5"></i>
                            <span><strong>Category:</strong> {{ $course->track->name ?? 'General' }}</span>
                        </div>
                    </div>
                    <div class="course-action">
                        @php
                            $isFree = $course->status == 0;
                            $badgeColor = $isFree ? 'bg-success text-white' : 'bg-danger text-white';
                            $badgeText = $isFree ? 'Free' : 'Paid';
                        @endphp
                        <span class="badge {{ $badgeColor }}">{{ $badgeText }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- فيديوهات --}}
    <div class="videos mt-5">
        <h4 class="fw-bold mb-4">Course Videos</h4>
        @if(count($course->videos) > 0)
            @foreach($course->videos as $video)
                <div class="video-card"
                     data-bs-toggle="modal"
                     data-bs-target="#show-video"
                     data-title="{{ $video->title }}"
                     data-url="{{ $video->link ?? ($video->file ? asset('storage/' . $video->file) : '') }}">
                    <i class="bi bi-play-btn-fill me-2"></i>{{ $video->title }}
                </div>
            @endforeach
        @else
            <div class="alert alert-secondary">This course does not include any videos</div>
        @endif
    </div>

   {{-- الكويزات --}}
<div class="quizzes mt-5">
    <h4 class="fw-bold mb-4">Test Your Knowledge</h4>

    @if(count($course->quizzes) > 0)
        @foreach($course->quizzes as $quiz)

            @php
                // تحقق إذا المستخدم حل الكويز
                $solved = auth()->check()
                    ? $quiz->answers()->where('user_id', auth()->id())->exists()
                    : false;
            @endphp

            <div class="quiz-card d-flex justify-content-between align-items-center">

                <div>
                    <i class="bi bi-patch-question-fill me-2"></i>
                    <strong>{{ $quiz->name }}</strong>

                    @if($solved)
                        <span class="badge bg-success ms-2">✔ Solved</span>
                    @endif
                </div>

                <a href="/courses/{{ $course->slug }}/quizzes/{{ $quiz->name }}"
                   class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-arrow-right"></i>
                    {{ $solved ? 'View Result' : 'Start Quiz' }}
                </a>
            </div>

        @endforeach
    @else
        <div class="alert alert-secondary">
            This course does not include any quizzes
        </div>
    @endif
</div>

</div>

{{-- مودال الفيديو --}}
<div class="modal fade" id="show-video" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="video-title">Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-0">
        <div id="video-container"></div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const videoModal = document.getElementById('show-video');
    const videoContainer = document.getElementById('video-container');
    const videoTitle = document.getElementById('video-title');

    videoModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const title = button.getAttribute('data-title');
        let url = button.getAttribute('data-url');
        let embedUrl = url;

        if (url.includes("watch?v=")) {
            const videoId = url.split("watch?v=")[1].split('&')[0];
            embedUrl = `https://www.youtube.com/embed/${videoId}`;
        } else if (url.includes("youtu.be/")) {
            const videoId = url.split("youtu.be/")[1].split('?')[0];
            embedUrl = `https://www.youtube.com/embed/${videoId}`;
        } else if (url.includes("vimeo.com/")) {
            const videoId = url.split("vimeo.com/")[1].split('?')[0];
            embedUrl = `https://player.vimeo.com/video/${videoId}`;
        }

        videoTitle.textContent = title;

        if (embedUrl.endsWith(".mp4") || embedUrl.endsWith(".webm") || embedUrl.endsWith(".ogg")) {
            videoContainer.innerHTML = `<video width="100%" height="100%" controls autoplay>
                                            <source src="${embedUrl}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>`;
        } else {
            videoContainer.innerHTML = `<iframe width="100%" height="100%" src="${embedUrl}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>`;
        }
    });

    videoModal.addEventListener('hidden.bs.modal', function () {
        videoContainer.innerHTML = '';
    });
});
</script>

@endsection
