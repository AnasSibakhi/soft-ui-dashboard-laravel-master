<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Courses</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      background: #f9fafb;
      font-family: 'Segoe UI', sans-serif;
    }

    .container {
      max-width: 1100px;
      margin: 40px auto;
      position: relative;
    }

    .header-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 28px;
      padding: 0 12px;
    }

    .left-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #1e293b;
    }

    .right-title {
      font-size: 1rem;
      font-weight: 500;
      color: #2563eb;
      opacity: 0.9;
    }

    .course-scroll {
      display: flex;
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      scroll-behavior: smooth;
      gap: 28px;
      padding-bottom: 20px;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
    }

    .course-scroll::-webkit-scrollbar {
      display: none;
    }

    .scroll-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 44px;
      height: 44px;
      background: white;
      border-radius: 50%;
      border: none;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
      color: #2563eb;
      font-size: 1.2rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      z-index: 10;
    }

    .scroll-btn:hover {
      background-color: #2563eb;
      color: white;
      transform: translateY(-50%) scale(1.05);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }

    .scroll-btn.left {
      left: -22px;
    }

    .scroll-btn.right {
      right: -22px;
    }

    .course-card-link {
      flex: 0 0 100%;
      scroll-snap-align: start;
      text-decoration: none;
    }

    .course-card {
      display: flex;
      align-items: center;
      background: white;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
      padding: 24px;
      border: 1px solid #e2e8f0;
      transition: transform 0.3s ease;
      min-height: 170px;
    }

    .course-card:hover {
      transform: translateY(-4px);
    }

    .course-image {
      width: 300px;
      height: 180px;
      border-radius: 14px;
      object-fit: cover;
      margin-right: 28px;
      flex-shrink: 0;
    }

    .course-title {
      font-size: 1.3rem;
      font-weight: 600;
      color: #1e293b;
      margin-bottom: 8px;
    }

    .course-track,
    .course-date {
      font-size: 1rem;
      color: #475569;
      margin-bottom: 6px;
    }

    .course-info {
      flex: 1;
    }

    .course-title a,
    .course-track a {
      color: inherit;
      text-decoration: none;
    }

    .course-track a:hover {
      color: #2563eb;
    }
    .course-title a:hover {
  color: #2563eb;
  text-decoration: underline;
}

.course-track a:hover {
  color: #2563eb;
  text-decoration: underline;
}

.course-image-link:hover img {
  filter: brightness(0.85);
  transition: filter 0.3s ease;
}


  </style>
</head>
<body>
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000">

<div class="container">
  <!-- العنوان -->
  <div class="header-row">
    <div class="right-title">Resume Learning</div>
    <div class="left-title">My Courses</div>
  </div>

  <!-- أزرار التنقل -->
  <button id="scrollLeft" class="scroll-btn left"><i class="fas fa-chevron-left"></i></button>
  <button id="scrollRight" class="scroll-btn right"><i class="fas fa-chevron-right"></i></button>

  <!-- كورسات -->
  <div id="courseScroll" class="course-scroll">
@forelse($latestCourses as $course)
  <div class="course-card-link" style="flex: 0 0 100%; scroll-snap-align: start;">
    <div class="course-card">
      {{-- رابط الصورة --}}
      <a href="/courses/{{$course->slug}}" class="" style="display: block; flex-shrink: 0;">
        @if($course->photos->first())
          <img src="{{ asset('images/' . $course->photos->first()->filename) }}" class="course-image" alt="{{ $course->title }}">
        @else
          <img src="{{ asset('images/default.jpg') }}" class="course-image" alt="Default">
        @endif
      </a>

      <div class="course-info">
        {{-- رابط العنوان --}}
        <div class="course-title">
          <a href="/courses/{{$course->slug}}" style="color: inherit; text-decoration: none;">
            {{ $course->title }}
          </a>
        </div>

        {{-- رابط التراك --}}
        <div class="course-track">
          <a href="/track/{{$course->track->name}}" style="color: #475569; text-decoration: none;">
            {{ $course->track->name ?? 'No Track' }}
          </a>
        </div>

        <div class="course-date">
          <i class="fas fa-calendar-alt me-1"></i> {{ $course->created_at->format('M d, Y') }}
        </div>
      </div>
    </div>
  </div>
@empty
  <p>You are not enrolled in any courses yet.</p>
@endforelse

  </div>
</div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const scrollContainer = document.getElementById('courseScroll');
    const scrollAmount = scrollContainer.offsetWidth;

    document.getElementById('scrollLeft').addEventListener('click', () => {
      scrollContainer.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });

    document.getElementById('scrollRight').addEventListener('click', () => {
      scrollContainer.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });

    // ✅ Auto scroll every 10 seconds
    setInterval(() => {
      scrollContainer.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }, 10000);
  });
</script>

</body>
</html>
