<style>
  /* الحاوية الخاصة للتراكات فقط */
  .my-tracks-section {
    padding: 40px 25px;
    background: #fafafa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .my-tracks-section .track-title {
    font-size: 1.9rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 20px;
    border-left: 4px solid #2563eb;
    padding-left: 12px;
    user-select: none;
  }

  .my-tracks-section .courses-row {
    display: flex;
    gap: 18px;
    overflow-x: auto;
    padding-bottom: 12px;
    scroll-behavior: smooth;
  }

  .my-tracks-section .courses-row::-webkit-scrollbar {
    height: 8px;
  }
  .my-tracks-section .courses-row::-webkit-scrollbar-track {
    background: #e5e7eb;
    border-radius: 6px;
  }
  .my-tracks-section .courses-row::-webkit-scrollbar-thumb {
    background: #2563eb;
    border-radius: 6px;
  }

  .my-tracks-section .course-card {
    flex: 0 0 280px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 10px rgb(0 0 0 / 0.05);
    cursor: default;
    transition: box-shadow 0.25s ease;
    display: flex;
    flex-direction: column;
    overflow: hidden;
  }

  .my-tracks-section .course-card:hover {
    box-shadow: 0 8px 18px rgb(37 99 235 / 0.15);
  }

  .my-tracks-section .course-image {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-top-left-radius: 30px;
    border-top-right-radius: 16px;
    background: #f3f4f6;
  }

  .my-tracks-section .course-info {
    padding: 14px 18px 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .my-tracks-section .course-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #111827;
    margin-bottom: 10px;
    line-height: 1.3;
    min-height: 48px;
  }

  .my-tracks-section .course-meta {
    display: flex;
    justify-content: space-between;
    font-size: 0.9rem;
    color: #4b5563;
    font-weight: 600;
  }

  .my-tracks-section .course-status.free {
    color: #16a34a;
  }

  .my-tracks-section .course-status.paid {
    color: #dc2626;
  }

  @media (max-width: 768px) {
    .my-tracks-section .course-card {
      flex: 0 0 240px;
    }
    .my-tracks-section .course-image {
      height: 140px;
    }
    .my-tracks-section .track-title {
      font-size: 1.5rem;
      margin-bottom: 16px;
    }
  }

  @media (max-width: 480px) {
    .my-tracks-section {
      padding: 25px 15px;
    }
    .my-tracks-section .course-card {
      flex: 0 0 200px;
    }
    .my-tracks-section .course-image {
      height: 120px;
    }
    .my-tracks-section .track-title {
      font-size: 1.3rem;
    }
  }
.my-tracks-section .course-card {
  flex: 0 0 280px;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.05);
  cursor: default;
  display: flex;
  flex-direction: column;
  overflow: hidden;

  opacity: 0;
  transform: translateY(30px);
  pointer-events: none;

  transition:
    opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1),
    transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
  will-change: opacity, transform;
}

.my-tracks-section .course-card.visible {
  opacity: 1;
  transform: translateY(0);
  pointer-events: auto;
}

.my-tracks-section .course-card:hover {
  box-shadow: 0 8px 18px rgba(37, 99, 235, 0.15);
}


</style>

<div class="my-tracks-section">

  @foreach ($famousTracks as $track)
    <section class="track">
      <h2 class="track-title">{{ $track->name }}</h2>
      <div class="courses-row" tabindex="0" aria-label="Courses for {{ $track->name }}">
        @foreach ($track->courses->take(10) as $course)
          @php
            $image = $course->photos->first()
              ? asset('images/' . $course->photos->first()->filename)
              : asset('images/default.jpg');
          @endphp
          <article class="course-card" role="listitem" title="{{ $course->title }}">
            <img src="{{ $image }}" alt="{{ $course->title }}" class="course-image" loading="lazy" />
            <div class="course-info">
              <h3 class="course-title">{{ \Illuminate\Support\Str::limit($course->title, 50) }}</h3>
              <div class="course-meta">
                <span class="course-status {{ $course->status == '0' ? 'free' : 'paid' }}">
                  {{ $course->status == '0' ? 'FREE' : 'PAID' }}
                </span>
                <span>{{ count($course->users) }} users</span>
              </div>
            </div>
          </article>
        @endforeach
      </div>
    </section>
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
    }, {
      threshold: 0.15
    });

    document.querySelectorAll('.my-tracks-section .course-card').forEach(card => {
      observer.observe(card);
    });
  });
</script>
