<style>
.pretty-track-wrapper {
    padding: 3rem 1.5rem;
    background: #ffffff;
    font-family: 'Inter', sans-serif;
}

/* عنوان المسار */
.pretty-track-title {
    font-size: 2rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 1.5rem;
    border-left: 4px solid #3b82f6;
    padding-left: 12px;
}

/* سكروول أفقي */
.pretty-courses-scroll {
    display: flex;
    gap: 24px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 16px 0;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    /* لا تضغط الكورسات، أضف سكرول إذا زاد العدد */
    flex-wrap: nowrap; /* مهم جداً */
}

.pretty-courses-scroll.visible {
    opacity: 1;
    transform: translateY(0);
}

.pretty-courses-scroll::-webkit-scrollbar {
    height: 6px;
}

.pretty-courses-scroll::-webkit-scrollbar-thumb {
    background: #94a3b8;
    border-radius: 4px;
}

/* كارد بدون خلفية */
.pretty-course-card {
    width: 280px;
    background: transparent;
    border: 1px solid rgba(203, 213, 225, 0.4);
    border-radius: 8px;
    padding: 12px;
    box-shadow: none;
    display: flex;
    flex-direction: column;
    box-sizing: border-box;
    cursor: default;
    transition: transform 0.3s ease, opacity 0.6s ease;
    opacity: 0;
    transform: translateY(20px);
  flex: 0 0 280px; /* عرض ثابت وعدم الانكماش */

}

/* عند الظهور */
.pretty-course-card.visible {
    opacity: 1;
    transform: translateY(0);
}

/* الصورة */
.pretty-course-image {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease;
}

.pretty-course-image:hover {
    transform: scale(1.02);
}

/* العنوان والمعلومات */
.pretty-course-title {
    font-size: 1rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.4;
    margin-top: 6px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.pretty-course-meta {
    display: flex;
    justify-content: space-between;
    font-size: 0.85rem;
    color: #475569;
}

/* البادجات */
.pretty-badge {
    padding: 3px 8px;
    border-radius: 999px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    white-space: nowrap;
    line-height: 1;
}

.pretty-badge.free {
    color: #22c55e !important;
}

.pretty-badge.paid {
    color: #ef4444 !important;
}

.pretty-users::before {
    content: "👥 ";
    margin-right: 2px;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .pretty-course-card {
        width: 210px;
    }
}

/* قسم المواضيع الشهيرة */
.famous-tracks {
    background-color: #f9fafb; /* لون خلفية فاتح وبسيط */
    padding: 20px 24px;
    border-radius: 12px;
    margin-top: 30px;
    border: 1px solid #d1d5db; /* حدود خفيفة */
    box-shadow: none; /
}

.famous-tracks h4 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 16px;
    border-left: 4px solid #3b82f6;
    padding-left: 12px;
}

.famous-tracks .tracks {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.famous-tracks .tracks a {
    background-color: #f0eff5;
    color: #080909;
    padding: 8px 16px;
    border-radius: 999px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: background 0.3s ease, color 0.3s ease;
    border: 1px solid #f0f3f8;
}

.famous-tracks .tracks a:hover {
    background-color: #0e3487;
    color: #eaeff5;
}

/* قسم الكورسات الموصى بها */
.recommended-section {
    margin-top: 40px;
    padding: 0 12px;
}

.recommended-title {
    font-size: 1.6rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 24px;
    border-left: 4px solid #3b82f6;
    padding-left: 12px;
}

/* كارد Udemy */
.udemy-style-card {
    display: flex;
    gap: 20px;
    padding: 16px 20px;
    background: #ffffff;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.04);
    margin-bottom: 20px;
    transition: box-shadow 0.25s ease;
    max-width: 800px;
    margin-left: 40px;
    margin-right: auto;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    cursor: pointer;
    align-items: center;
}

.udemy-style-card:hover {
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
}

.udemy-image {
    width: 200px;
    aspect-ratio: 16/9;
    overflow: hidden;
    background: #f1f5f9;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    flex-shrink: 0;
}

.udemy-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.udemy-info {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.udemy-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
    line-height: 1.3;
}

.course-meta-inline {
    display: flex;
    align-items: center;
    gap: 120px;
    margin-top: 6px;
}

.pretty-users {
    font-size: 0.85rem;
    color: #555;
}
</style>

<div class="pretty-track-wrapper">
    @php $i = 0; @endphp
    @foreach ($Tracks as $track)
        @if (!$loop->first)
            <hr class="track-separator">
        @endif

        <section class="mb-5">
            <h2 class="pretty-track-title">Latest {{ $track->name }} Courses</h2>

            <div class="pretty-courses-scroll">
                @foreach ($track->courses->take(10) as $course)
                    @php
                        $image = $course->photos->first()
                            ? asset('images/' . $course->photos->first()->filename)
                            : asset('images/ rbs.webp');
                    @endphp
                    <div class="pretty-course-card">
                        <a href="/courses/{{$course->slug}}">
                            <img src="{{ $image }}" alt="{{ $course->title }}" class="pretty-course-image" />
                         </a>

                        <h3 class="pretty-course-title">
                              <a href="/courses/{{$course->slug}}">
                            {{ \Illuminate\Support\Str::limit($course->title, 50) }}
                            </a>
                        </h3>

                        <div class="pretty-course-meta">
                            <span class="pretty-badge {{ $course->status == '0' ? 'free' : 'paid' }}">
                                {{ $course->status == '0' ? 'Free' : 'Paid' }}
                            </span>
                            <span class="pretty-users">{{ $course->users_count ?? count($course->users) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($i == 1)
                <div class="famous-tracks">
                    <h4>Famous topic for you</h4>
                    <div class="tracks">
                        @foreach ($famous_Tracks as $famous_Track)
                            <a href="#">{{ $famous_Track->name }}</a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($i == 2)
            @auth


                <div class="recommended-section">
                    <h4 class="recommended-title">Recommended Courses For You</h4>
                    @foreach ($recommended_courses as $course)
                        <div class="udemy-style-card">
                            <div class="udemy-image">
                                <img src="{{ asset('images/' . ($course->photos->first()->filename ?? 'default.jpg')) }}" alt="Course Image">
                            </div>

                            <div class="udemy-info">
                                <h5 class="udemy-title">
                                    {{ \Illuminate\Support\Str::limit($course->title, 60) }}
                                </h5>

                                <div class="course-meta-inline">
                                    <span class="pretty-badge {{ $course->status == '0' ? 'free' : 'paid' }}">
                                        {{ $course->status == '0' ? 'Free' : 'Paid' }}
                                    </span>
                                    <span class="pretty-users">{{ $course->users_count ?? count($course->users) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                   @endauth
            @endif
        </section>

        @php $i++; @endphp
    @endforeach
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            } else {
                entry.target.classList.remove('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.pretty-courses-scroll').forEach(container => {
        observer.observe(container);
    });

    document.querySelectorAll('.pretty-course-card').forEach(card => {
        observer.observe(card);
    });
});
</script>
