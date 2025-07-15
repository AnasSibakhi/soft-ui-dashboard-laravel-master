@extends('layouts.user_type.auth')

@section('content')
<style>
    .container-fluid {
    padding: 20px;
}

/* اجعل الاتجاه RTL فقط على الفيديو */
.video-area {
    direction: rtl;
    text-align: right;
}

    .video-area {
        max-width: 900px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 15px;
        text-align: right;
    }

    .video-frame {
        width: 100%;
        aspect-ratio: 16 / 9;
        background: #000;
        border-radius: 8px;
    }

    .video-course-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #444;
    }

    .video-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .back-btn {
        margin-bottom: 15px;
        text-align: right;
    }
</style>

<div class="container-fluid">
    <div class="video-area">
        {{-- زر الرجوع --}}
        <div class="back-btn">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">BACK ←</a>
        </div>

        {{-- مشغل الفيديو --}}
        @php
            $link = $video->link;
            $embedLink = null;
            $isFile = false;

            if ($video->file) {
                $isFile = true;
            } elseif (Str::contains($link, 'youtube.com/watch')) {
                parse_str(parse_url($link, PHP_URL_QUERY), $ytParams);
                $videoId = $ytParams['v'] ?? null;
                $embedLink = $videoId ? 'https://www.youtube.com/embed/' . $videoId : null;
            } elseif (Str::contains($link, 'youtu.be')) {
                $videoId = last(explode('/', $link));
                $embedLink = 'https://www.youtube.com/embed/' . $videoId;
            } elseif (Str::contains($link, 'vimeo.com')) {
                $videoId = last(explode('/', $link));
                $embedLink = 'https://player.vimeo.com/video/' . $videoId;
            } elseif(Str::endsWith($link, ['.mp4', '.webm', '.ogg'])) {
                $isFile = false;
            } else {
                $embedLink = $link;
            }
        @endphp

        @if ($isFile)
            <video class="video-frame" controls preload="metadata">
                <source src="{{ asset('storage/' . $video->file) }}" type="video/mp4">
                متصفحك لا يدعم تشغيل الفيديو.
            </video>
        @elseif ($embedLink)
            <iframe class="video-frame" src="{{ $embedLink }}" frameborder="0" allowfullscreen></iframe>
        @elseif (!$isFile && Str::endsWith($link, ['.mp4', '.webm', '.ogg']))
            <video class="video-frame" controls preload="metadata">
                <source src="{{ $link }}" type="video/mp4">
                متصفحك لا يدعم تشغيل الفيديو.
            </video>
        @else
            <p class="text-danger">لا يوجد فيديو لعرضه.</p>
        @endif

        {{-- اسم الكورس فقط (بدون العنوان) --}}
        <div class="video-course-title">{{ $video->course->title ?? 'غير محدد' }}</div>

        {{-- تاريخ النشر --}}
        <div class="video-meta">
            <strong>تاريخ النشر:</strong> {{ $video->created_at->diffForHumans() }}
        </div>
    </div>
</div>
@endsection
