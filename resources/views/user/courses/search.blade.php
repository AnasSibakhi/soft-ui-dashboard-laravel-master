@extends('layouts.user')

@section('title', 'Search Courses')

@section('content')
<style>
.search-course-card {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 16px;
    margin-bottom: 15px;
    border: 1px solid #eee;
    border-radius: 14px;
    background: #fff;
    transition: box-shadow 0.3s, transform 0.3s;
}

.search-course-card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

.search-course-image img {
    width: 200px;
    height: 120px;
    object-fit: cover;
    border-radius: 10px;
}

.search-course-info {
    flex: 1;
}

.course-title {
    font-weight: 700;
    margin-bottom: 4px;
}

.course-desc {
    color: #6b7280;
    font-size: 0.9rem;
    margin-bottom: 8px;
}

.course-meta {
    display: flex;
    gap: 12px;
    font-size: 0.85rem;
    color: #6b7280;
    align-items: center;
}

.course-meta .badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-weight: 600;
}

.course-meta .free {
    background: #DCFCE7;
    color: #166534;
}

.course-meta .paid {
    background: #DBEAFE;
    color: #1D4ED8;
}

.track-badge {
    background: #F1F5F9;      /* خلفية فاتحة */
    color: #334155;            /* نص غامق */
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    white-space: nowrap;
}

.search-course-action {
    margin-left: 10px;
}
</style>

<div class="container py-5">

    {{-- عنوان --}}
    <div class="mb-4">
        <h2 class="fw-bold text-primary">Search Results</h2>

        @if(request('q'))
            <p class="text-muted mb-0">
                Results for: <strong>"{{ request('q') }}"</strong>
            </p>
        @endif
    </div>

    {{-- النتائج --}}
    @if($courses->count())

        @foreach($courses as $course)
            <div class="search-course-card">

                {{-- صورة --}}
                <div class="search-course-image">
                    <img src="{{ asset('images/' . ($course->photos->first()->filename ?? 'default.jpg')) }}"
                         alt="{{ $course->title }}">
                </div>

                {{-- بيانات --}}
                <div class="search-course-info">

                    <h5 class="course-title">
                        {{ \Illuminate\Support\Str::limit($course->title, 80) }}
                    </h5>

                    <p class="course-desc">
                        {{ \Illuminate\Support\Str::limit($course->description, 120) }}
                    </p>

                    <div class="course-meta">
                        <span class="badge {{ $course->status == '0' ? 'free' : 'paid' }}">
                            {{ $course->status == '0' ? 'Free' : 'Paid' }}
                        </span>

                        @if($course->track)
                            <span class="track-badge">
                                {{ $course->track->name }}
                            </span>
                        @endif

                        <span>{{ $course->users_count ?? $course->users->count() }} students</span>
                    </div>
                </div>

                {{-- زر --}}
                <div class="search-course-action">
                    <a href="{{ url('/courses/' . $course->slug) }}"
                       class="btn btn-outline-primary rounded-pill px-4">
                        View
                    </a>
                </div>

            </div>
        @endforeach

    @else
        <div class="alert alert-light text-center py-5 border rounded">
            <i class="bi bi-search fs-3 d-block mb-2"></i>
            No results found.
        </div>
    @endif
</div>
@endsection
