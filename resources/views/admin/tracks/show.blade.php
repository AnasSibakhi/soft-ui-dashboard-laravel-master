@extends('layouts.user_type.auth')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-3 mx-3">

            {{-- زر الرجوع وزر إضافة كورس --}}
            <div class="d-flex justify-content-between align-items-center mt-3 mx-3">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">← BACK</a>
            <a href="{{ route('tracks.course.create', $track->id) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> New Course
                </a>
            </div>

            {{-- عنوان التراك --}}
            <h2 class="my-3 mx-3">{{ $track->name }}</h2>

            {{-- رسالة الحالة --}}
            @if(session('status'))
                <div class="alert alert-dismissible fade show mx-3" role="alert"
                     style="font-size: 12px; padding: 10px 14px; background-color: #dbd5d9; color: #0c020a; border: 1px solid #5a0649;">
                    <span>{{ session('status') }}</span>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close" style="font-size: 10px;"></button>
                </div>
            @endif

            <div class="card-body pt-2">
                @if($track->courses && $track->courses->count())
                    <div class="horizontal-scroll d-flex flex-row overflow-auto px-2" style="gap: 16px; padding: 10px 0;">
                        @foreach ($track->courses as $course)
                            <div class="course-card" style="flex: 0 0 300px;">
                                <div class="card h-100 border-0 shadow-sm hover-shadow" style="border-radius: 10px; overflow: hidden; transition: 0.3s;">

                                    {{-- صورة من photos --}}
                                    @if ($course->photos->first())
                                        <img src="{{ asset('images/' . $course->photos->first()->filename) }}"
                                             class="card-img-top"
                                             alt="Course Image"
                                             style="height: 200px; object-fit: cover;">
                                    @else
                                        <div style="height: 200px; background: #eee; display: flex; align-items: center; justify-content: center;">
                                            <span class="text-muted">No Image</span>
                                        </div>
                                    @endif

                                    <div class="card-body d-flex flex-column px-3 py-2">
                                        <h6 class="card-title mb-1 text-dark" style="font-size: 13px;">{{ $course->track->name }}</h6>
                                        <h6 class="card-title mb-1 text-dark" style="font-size: 13px;">{{ $course->title }}</h6>
                                        <p class="card-text text-muted mb-3" style="font-size: 12px;">
                                            {{ Str::limit($course->description ?? '', 80) }}
                                        </p>

                                        <div class="mt-auto d-flex justify-content-between gap-2">
                                            <a href="{{ route('course.edit', $course->id) }}"
                                               class="btn btn-sm fw-bold flex-fill"
                                               style="color: #d000a8; border: 1px solid #d000a8; font-size: 12px;">
                                                EDIT
                                            </a>
                                            <a href="{{ route('course.show', $course->id) }}"
                                               class="btn btn-sm fw-bold flex-fill"
                                               style="color: #d000a8; border: 1px solid #d000a8; font-size: 12px;">
                                                SHOW
                                            </a>
                                            <form action="{{ route('course.destroy', $course->id) }}" method="POST"
                                                  onsubmit="return confirm('Are you sure?')" class="flex-fill">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm fw-bold w-100"
                                                        style="color: #d000a8; border: 1px solid #d000a8; font-size: 12px;">
                                                    DELETE
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-3">
                        <p class="text-muted text-xs mb-0" style="font-size: 11px;">No courses found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
