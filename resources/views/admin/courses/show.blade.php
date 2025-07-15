@extends('layouts.user_type.auth')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    .course-title {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .track-link {
        color: #0d6efd;
        text-decoration: none;
        font-weight: 500;
    }

    .track-link:hover {
        text-decoration: underline;
        color: #084298;
    }

    .video-sidebar {
        background: #ffffff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .video-item {
        display: flex;
        gap: 12px;
        margin-bottom: 15px;
        align-items: center;
    }

    .video-thumb img {
        width: 120px;
        height: 70px;
        object-fit: cover;
        border-radius: 6px;
    }

    .video-info a {
        font-weight: 600;
        font-size: 1rem;
        color: #1a73e8;
        text-decoration: none;
    }

    .video-info a:hover {
        color: #0b58ca;
        text-decoration: underline;
    }

    .btn-add-video {
        margin-bottom: 15px;
    }
</style>

<div class="container-fluid">
    <div class="video-area">
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
        {{-- زر الرجوع --}}
        <div class="back-btn mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">← BACK</a>
        </div>

        {{-- معلومات الكورس --}}
        <div class="row">
            <div class="col-md-8">
                <div class="course-title">{{ $course->title }}</div>
                <h6>
                    <a href="/admin/tracks/{{ $course->track->id }}" class="track-link">
                        {{ $course->track->name }} <i class="fas fa-arrow-up-right-from-square ms-1" style="font-size: 0.8rem;"></i>
                    </a>
                </h6>
                <div class="course-status text-{{ $course->status == 0 ? 'muted' : 'success' }}">
                    {{ $course->status == 0 ? 'FREE' : 'PAID' }}
                </div>
            </div>
            <div class="col-md-4 text-end">
                @if ($course->photos->first())
                    <img src="{{ asset('images/' . $course->photos->first()->filename) }}"
                         class="img-fluid rounded shadow-sm"
                         style="max-height: 150px; object-fit: cover;" alt="Course Image">
                @endif
            </div>
        </div>

        {{-- إضافة فيديو --}}
        <div class="btn-add-video text-end mt-3">
            <a href="{{ route('course.videos.create', $course->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Add Video
            </a>
        </div>

          <div class="btn-add-video text-end mt-3">
     <a href="{{ route('quizzes.create', $course->id) }}" class="btn btn-sm btn-primary">Add Quiz</a>
      </a>


        </div>

        {{-- الشريط الجانبي للفيديوهات --}}
        <div class="video-sidebar mt-3">
            <h5 class="mb-3">Course Videos ({{ $course->videos->count() }})</h5>

            @if($course->videos && $course->videos->count())
                @foreach($course->videos as $video)
                    @php
                        $url = $video->link;
                        $thumb = '';

                        if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
                            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $url, $matches)) {
                                $videoId = $matches[1];
                                $thumb = "https://img.youtube.com/vi/" . $videoId . "/mqdefault.jpg";
                            }
                        } elseif (str_contains($url, 'vimeo.com')) {
                            $thumb = "https://via.placeholder.com/120x70?text=Vimeo";
                        } else {
                            $thumb = "https://via.placeholder.com/120x70?text=Video";
                        }
                    @endphp

                    <div class="video-item">
                        <div class="video-thumb">
                            <a href="{{ route('videos.show', $video->id) }}">
                                <img src="{{ $thumb }}" alt="Thumbnail">
                            </a>
                        </div>
                   <div class="video-info w-100">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <a href="{{ route('videos.show', $video->id) }}">
                {{ $video->title }}
            </a><br>
            <small class="text-muted">{{ $video->created_at->diffForHumans() }}</small>
        </div>

        <div class="btn-group btn-group-sm">
            <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-outline-primary" title="Edit">
                <i class="fas fa-edit"></i>
            </a>

            <form action="{{ route('videos.destroy', $video->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this video?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" title="Delete">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        </div>
    </div>
</div>

                    </div>
                @endforeach
            @else
                <p class="text-muted">No videos found for this course.</p>
            @endif
        </div>

    </div>
</div>
@endsection
