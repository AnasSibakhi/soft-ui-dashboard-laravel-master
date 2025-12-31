@extends('layouts.user')

@section('title', 'Search Courses')

@section('content')

<style>
.pretty-courses-scroll {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 24px;
}

.pretty-course-card {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid #eee;
    transition: all 0.3s ease;
}

.pretty-course-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.pretty-course-image {
    width: 100%;
    height: 160px;
    object-fit: cover;
}

.pretty-course-body {
    padding: 14px;
}

.pretty-course-title {
    font-size: 0.95rem;
    font-weight: 700;
    line-height: 1.4;
    margin-bottom: 6px;
    color: #111;
}

.pretty-course-title a {
    text-decoration: none;
    color: inherit;
}

.pretty-course-title a:hover {
    color: #2563EB;
}

.pretty-course-track {
    font-size: 0.8rem;
    color: #6B7280;
    margin-bottom: 10px;
}

.pretty-course-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.pretty-badge {
    padding: 4px 10px;
    font-size: 0.75rem;
    border-radius: 20px;
    font-weight: 600;
}

.pretty-badge.free {
    background: #DCFCE7;
    color: #166534;
}

.pretty-badge.paid {
    background: #DBEAFE;
    color: #1D4ED8;
}

.pretty-users {
    font-size: 0.75rem;
    color: #6B7280;
}
</style>

<div class="container py-5">

    {{-- عنوان --}}
    <div class="mb-4">
        <h3 class="fw-bold text-primary">Search Results</h3>

        @if(request('q'))
            <p class="text-muted mb-0">
                Results for: <strong>"{{ request('q') }}"</strong>
            </p>
        @endif
    </div>

    @if($courses->count())

        <div class="pretty-courses-scroll">
            @foreach ($courses as $course)

                @php
                    $image = $course->photos->first()
                        ? asset('images/' . $course->photos->first()->filename)
                        : asset('images/rbs.webp');
                @endphp

                <div class="pretty-course-card">

                    <a href="/courses/{{ $course->slug }}">
                        <img src="{{ $image }}"
                             alt="{{ $course->title }}"
                             class="pretty-course-image">
                    </a>

                    <div class="pretty-course-body">

                        <h3 class="pretty-course-title">
                            <a href="/courses/{{ $course->slug }}">
                                {{ \Illuminate\Support\Str::limit($course->title, 55) }}
                            </a>
                        </h3>

                        {{-- التراك --}}
                        <div class="pretty-course-track">
                            {{ optional($course->track)->title ?? 'General Track' }}
                        </div>

                        <div class="pretty-course-meta">
                            <span class="pretty-badge {{ $course->status == '0' ? 'free' : 'paid' }}">
                                {{ $course->status == '0' ? 'Free' : 'Paid' }}
                            </span>

                            <span class="pretty-users">
                                {{ $course->users_count ?? count($course->users) }} students
                            </span>
                        </div>

                    </div>
                </div>

            @endforeach
        </div>

    @else
        <div class="alert alert-light text-center py-5 border rounded">
            <i class="bi bi-search fs-3 d-block mb-2"></i>
            No courses found.
        </div>
    @endif

</div>
@endsection
