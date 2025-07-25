@extends('layouts.user_type.auth')

@section('content')

<style>
  .dashboard-card {
    background: linear-gradient(135deg, #1e293b, #3b0764); /* خلفية سحرية */
    color: #fff;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    min-height: 100px;
  }

  .dashboard-card .card-body p {
    font-size: 0.65rem;
    text-transform: uppercase;
    color: #cbd5e1;
    margin-bottom: 0.3rem;
  }

  .dashboard-card .card-body h3 {
    font-size: 1.5rem;
    font-weight: bold;
    color: #fff;
  }

  .dashboard-card a.count-number {
    color: inherit;
    text-decoration: none;
  }

  .dashboard-card a.count-number:hover {
    text-decoration: underline;
    opacity: 0.9;
  }

  .icon-bg {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #4f46e5, #9333ea);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
  }
</style>


<div class="row gx-3 gy-3 mt-3">

  <!-- Tracks -->
  <div class="col-xl-3 col-md-6 col-sm-12">
    <div class="card shadow border-0 h-100 dashboard-card">
      <div class="card-body d-flex align-items-center justify-content-between px-3 py-2">
        <div>
          <p>Tracks</p>
          <h3><a href="{{ route('tracks.index') }}" class="count-number">{{ $tracks_count }}</a></h3>
        </div>
        <div class="icon-bg bg-primary text-center rounded-circle shadow d-flex align-items-center justify-content-center">
          <i class="fas fa-layer-group text-white fs-3"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Courses -->
  <div class="col-xl-3 col-md-6 col-sm-12">
    <div class="card shadow border-0 h-100 dashboard-card">
      <div class="card-body d-flex align-items-center justify-content-between px-3 py-2">
        <div>
          <p>Courses</p>
          <h3><a href="{{ route('course.index') }}" class="count-number">{{ $courses_count }}</a></h3>
        </div>
        <div class="icon-bg bg-primary text-center rounded-circle shadow d-flex align-items-center justify-content-center">
          <i class="fas fa-book-open text-white fs-3"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Users -->
  <div class="col-xl-3 col-md-6 col-sm-12">
    <div class="card shadow border-0 h-100 dashboard-card">
      <div class="card-body d-flex align-items-center justify-content-between px-3 py-2">
        <div>
          <p>Users</p>
          <h3><a href="{{ route('user-management') }}" class="count-number">{{ $users_count }}</a></h3>
        </div>
        <div class="icon-bg bg-primary text-center rounded-circle shadow d-flex align-items-center justify-content-center">
          <i class="fas fa-users text-white fs-3"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Quizzes -->
  <div class="col-xl-3 col-md-6 col-sm-12">
    <div class="card shadow border-0 h-100 dashboard-card">
      <div class="card-body d-flex align-items-center justify-content-between px-3 py-2">
        <div>
          <p>Quizzes</p>
          <h3><a href="{{ route('quizzes.index') }}" class="count-number">{{ $quizzes_count }}</a></h3>
        </div>
        <div class="icon-bg bg-primary text-center rounded-circle shadow d-flex align-items-center justify-content-center">
          <i class="fas fa-question-circle text-white fs-3"></i>
        </div>
      </div>
    </div>
  </div>

</div>
 <!-- End Cards Section -->

  @php
    $coursesWithTrack = $courses->filter(fn($course) => $course->track);
  @endphp

  @if ($coursesWithTrack->count())
  <div class="row mt-4">

    <!-- Tracks Table -->
    <div class="col-md-6 mb-4">
      <div class="card h-100 shadow-sm border rounded p-3" style="background-color: #fff;">
        <h6 class="mb-3 text-center text-uppercase text-secondary" style="font-weight: 700; letter-spacing: 1.1px; font-size: 0.85rem;">Tracks</h6>
        <div class="table-responsive">
          <table class="table align-items-center mb-0" style="font-size: 0.75rem;">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"># of Courses</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tracks as $track)
              <tr>
                <td class="text-center">
                  <a href="{{ route('tracks.show', $track->id) }}" class="text-xs font-weight-bold mb-0 text-decoration-none" style="color: #111;">
                    {{ $track->name }}
                  </a>
                </td>
                <td class="text-center font-weight-bold">{{ $track->courses->count() }}</td>
                <td class="text-center text-secondary" style="font-size: 0.65rem;">
                  {{ $track->created_at ? $track->created_at->diffForHumans() : '--' }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Courses Table -->
    <div class="col-md-6 mb-4">
      <div class="card h-100 shadow-sm border rounded p-3" style="background-color: #fff;">
        <h6 class="mb-3 text-center text-uppercase text-secondary" style="font-weight: 700; letter-spacing: 1.1px; font-size: 0.85rem;">Courses</h6>
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0" style="font-size: 0.75rem;">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course Title</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Users</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation Date</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Track Name</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($courses as $course)
              <tr>
                <td class="text-center">
                  <a href="{{ route('course.show', $course->id) }}" class="text-xs font-weight-bold mb-0 text-decoration-none" style="color: #111;">
                    {{ $course->title }}
                  </a>
                </td>
                <td class="text-center font-weight-bold">
                  @if ($course->users->isNotEmpty())
                    {{ $course->users->count() }} Users
                  @else
                    <span style="color: #999;">No Users</span>
                  @endif
                </td>
                <td class="text-center text-secondary" style="font-size: 0.65rem;">
                  {{ $course->created_at?->diffForHumans() ?? '--' }}
                </td>
                <td class="text-center">
                  @if ($course->track)
                    <a href="{{ route('tracks.show', $course->track->id) }}" class="text-xs font-weight-bold mb-0 text-decoration-none" style="color: #111;">
                      {{ $course->track->name }}
                    </a>
                  @else
                    <span style="color: #999;">No Track</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- Latest Users Section -->
<div class="row mt-3">
  <div class="col-12 mb-2">
    <h6 class="text-uppercase fw-bold" style="font-size: 0.75rem; color: #000;">Latest Users</h6>
  </div>

  @foreach ($users as $user)
    <div class="col-md-4 mb-2">
      <div class="card shadow-sm border-0" style="border-radius: 10px; font-size: 0.75rem; background-color: #1e3a8a;">
        <div class="card-body d-flex align-items-center p-2">
          <div class="user-icon me-3"
               style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; font-size: 1rem; color: #1e3a8a; background-color: #ffffff; border-radius: 50%;">
            <i class="fas fa-user"></i>
          </div>
          <div>
            <h6 class="mb-0 fw-semibold" style="font-size: 0.8rem; color: #ffffff;">
              {{ $user->name }}
              @if ($user->email_verified_at)
                <span class="badge bg-success text-white ms-1" style="font-size: 0.6rem;">Verified</span>
              @else
                <span class="badge bg-secondary text-white ms-1" style="font-size: 0.6rem;">Unverified</span>
              @endif
            </h6>
            <small class="d-block" style="font-size: 0.65rem; color: #e0e7ff;">{{ $user->email }}</small>
            <small style="font-size: 0.6rem; color: #c7d2fe;">{{ $user->created_at->diffForHumans() }}</small>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>


  <!-- Latest Quizzes Section -->
  <div class="row mt-4">
    <div class="col-12 mb-3">
      <h6 class="text-uppercase fw-bold" style="font-size: 0.85rem; color: #000;">Latest Quizzes</h6>
    </div>

    @forelse ($quizzes as $quiz)
      <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
        <div class="card border rounded shadow-sm h-100"
             style="background-color: #fff; font-size: 0.85rem; color: #000;">

          <!-- Card Header -->
          <div class="card-header bg-white d-flex justify-content-between align-items-center py-2 px-3"
               style="border-top-left-radius: 8px; border-top-right-radius: 8px;">
            <h6 class="mb-0 text-truncate fw-semibold" title="{{ $quiz->name }}" style="color: #000;">
              {{ $quiz->name }}
            </h6>
            <span class="badge border border-dark text-dark" style="font-size: 0.7rem;">
              {{ $quiz->questions_count ?? 0 }} Qs
            </span>
          </div>

          <!-- Card Body -->
          <div class="card-body d-flex flex-column p-3">
            <p class="mb-3 flex-grow-1" style="min-height: 60px; font-size: 0.75rem; color: #444;">
              {{ Str::limit($quiz->description ?? 'No description available.', 90) }}
            </p>

            <!-- Footer Info -->
          <div class="d-flex justify-content-between align-items-center mt-auto">
  <small style="font-size: 0.7rem; color: #555;">
    <i class="fas fa-calendar-alt me-1"></i> {{ $quiz->created_at->format('M d, Y') }}
  </small>
  <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-sm magical-btn" style="font-size: 0.75rem;">
    View
  </a>
</div>

<style>
.magical-btn {
  background: linear-gradient(135deg, #1e293b, #3b0764);
  color: #fff;
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
  border-radius: 6px;
  padding: 4px 12px;
  transition: background 0.3s ease, box-shadow 0.3s ease;
  text-decoration: none;
  display: inline-block;
}

.magical-btn:hover,
.magical-btn:focus {
  background: linear-gradient(135deg, #3b0764, #1e293b);
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.8);
  color: #f0f0f0;
  text-decoration: none;
}

</style>

          </div>

        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-dark text-center">
          No quizzes available right now.
        </div>
      </div>
    @endforelse
  </div>

  @else
    <div class="text-center py-4">
      <p class="text-muted text-xs mb-0">No Tracks Found</p>
    </div>
  @endif

</div>

@endsection
