<nav class="navbar navbar-expand-lg mx-auto"
  style="
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    z-index: 1100;

    background: rgba(255, 255, 255, 0.07);
    backdrop-filter: saturate(250%) blur(40px);
    -webkit-backdrop-filter: saturate(250%) blur(40px);

    border-radius: 60px;
    box-shadow:
      0 0 10px 2px rgba(255, 255, 255, 0.3),
      0 8px 32px 0 rgba(31, 38, 135, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.2);

    margin: 8px 0 0 0;  /* فقط مسافة بسيطة من الأعلى */
    max-width: 1600px;   /* زدت العرض */
    left: 0;
    right: 0;

    height: 70px;        /* زدت الطول */
  "
>
  <div class="container-fluid d-flex justify-content-between align-items-center px-3" style="height: 100%; max-width: 100%;">
    <!-- الشعار -->
    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/') }}" style="font-size: 1.3rem; user-select: none; line-height: 1;">
  <i class="fas fa-graduation-cap" style="color:#2563EB; font-size: 1.7rem; text-shadow: 0 0 8px rgba(37, 99, 235, 0.7); line-height: 1;"></i>
  <span style="color: #000;">Edvanta</span>
</a>


    <!-- البحث -->
    <form class="d-none d-lg-flex mx-auto align-items-center" method="GET" action="" role="search" style="width: 600px; position: relative; height: 43px;">
      <input
        type="search"
        name="query"
        placeholder="Find Your Course..."
        aria-label="Search"
        class="form-control rounded-pill shadow-sm border-0"
        style="
          box-shadow: 0 3px 9px rgba(37, 99, 235, 0.2);
          font-size: 0.95rem;
          transition: box-shadow 0.3s ease;
          height: 44px;
          padding: 0 20px;
        "
        onfocus="this.style.boxShadow='0 5px 15px rgba(37, 99, 235, 0.35)'"
        onblur="this.style.boxShadow='0 3px 9px rgba(37, 99, 235, 0.2)'"
      />
      <button type="submit" style="display:none;"></button>
    </form>

    <!-- المستخدم -->
    <div class="d-flex align-items-center gap-3" style="position: relative; z-index: 1100; height: 44px;">
      @auth
      <ul class="navbar-nav" style="height: 100%;">
        <li class="nav-item dropdown" style="position: static; height: 100%;">
          <a class="nav-link dropdown-toggle d-flex align-items-center text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
            style="cursor: pointer; user-select: none; font-size: 1rem; padding: 0 14px; border-radius: 40px; height: 44px; line-height: 44px; transition: background-color 0.25s ease;"
            onmouseover="this.style.backgroundColor='rgba(37, 99, 235, 0.12)'"
            onmouseout="this.style.backgroundColor='transparent'"
          >
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563EB&color=fff&rounded=true&size=40"
              alt="avatar" class="rounded-circle me-2"
              style="width: 38px; height: 38px; object-fit: cover; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); transition: box-shadow 0.3s ease;"
              onmouseover="this.style.boxShadow='0 0 14px 3px rgba(37, 99, 235, 0.65)'"
              onmouseout="this.style.boxShadow='0 4px 12px rgba(37, 99, 235, 0.3)'"
            />
            <span class="fw-semibold" style="letter-spacing: 0.035em; line-height: 1;">{{ Auth::user()->name }}</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end mt-2 shadow-lg rounded-4" aria-labelledby="userDropdown"
            style="background: #ffffffdd; backdrop-filter: saturate(180%) blur(14px); border: 1px solid rgba(37, 99, 235, 0.2); min-width: 190px; box-shadow: 0 8px 24px rgba(37, 99, 235, 0.22); font-size: 0.95rem;">
            <li>
              <a class="dropdown-item d-flex align-items-center text-dark fw-semibold" href="#" style="padding: 12px 20px;">
                <i class="fas fa-user me-3 text-primary"></i> Profile
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center text-dark fw-semibold" href="#" style="padding: 12px 20px;">
                <i class="fas fa-book me-3 text-primary"></i> My Courses
              </a>
            </li>
            <li><hr class="dropdown-divider my-2"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center text-danger fw-semibold" style="padding: 12px 20px;">
                  <i class="fas fa-sign-out-alt me-3"></i> Logout
                </button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
      @else
      <a href="{{ route('login') }}"
        class="btn btn-primary btn-sm rounded-pill fw-semibold d-inline-flex align-items-center"
        style="padding: 8px 22px; font-size: 1rem; letter-spacing: 0.04em;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        transition: box-shadow 0.3s ease;"
        onmouseover="this.style.boxShadow='0 6px 18px rgba(37, 99, 235, 0.55)'"
        onmouseout="this.style.boxShadow='0 4px 12px rgba(37, 99, 235, 0.3)'"
      >
        <i class="fas fa-sign-in-alt me-2"></i> Login
      </a>
      @endauth
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('home_picture')
