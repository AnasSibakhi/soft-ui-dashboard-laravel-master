<!-- Navbar عائم أبيض غامق مع حواف مستطيلة بسيطة -->
<nav id="smartNavbar" class="navbar navbar-expand-lg fixed-top px-4 py-2 shadow-sm"
  style="
    position: fixed;
    top: -40px; /* البداية فوق الشاشة */
    left: 100px; /* مسافة من اليسار */
    right: 100px; /* مسافة من اليمين */
    width: auto;
    z-index: 9999;
    background-color: #f3f4f6; /* أبيض غامق */
    border-radius: 12px; /* ميل خفيف للحواف */
    transition: all 0.6s ease;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
  ">
  <div class="container-fluid d-flex justify-content-between align-items-center px-3">

    <!-- شعار الموقع -->
    <a id="navBrand" class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ url('/') }}"
      style="font-size: 1.6rem; color: #000; transition: color 0.4s;">
      <i class="fas fa-graduation-cap"
        id="navIcon"
        style="color:#2563EB; font-size:1.9rem; animation: glowPulse 2s infinite alternate;"></i>
      Edvanta
    </a>

    <!-- مربع البحث -->
 <!-- مربع البحث شفاف -->
<form action="{{ route('user.courses.search') }}" method="GET"
      class="d-none d-lg-flex position-relative" style="width: 480px;">
  <input name="q" type="text" class="form-control rounded-pill px-5"
         placeholder="Search for a course...">
  <i class="fas fa-search position-absolute"
     style="left:18px; top:50%; transform:translateY(-50%); color:#2563EB;"></i>
</form>



    <!-- المستخدم -->
    <div class="d-flex align-items-center gap-3">
      @auth
      <div class="dropdown">
        <a id="navUser" class="d-flex align-items-center dropdown-toggle text-dark fw-semibold"
          href="#" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false"
          style="cursor:pointer; transition: color 0.4s;">
          <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563EB&color=fff&rounded=true&size=40"
            class="rounded-circle me-2" width="38" height="38"
            style="box-shadow:0 4px 10px rgba(37,99,235,0.3);">
          <span>{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow-lg rounded-4 border-0 mt-2"
          style="
            background: #fff;
            animation: fadeIn 0.3s ease;
          ">
          <li><a class="dropdown-item fw-semibold" href="#"><i class="fas fa-user me-2 text-primary"></i> Profile</a></li>
          <li><a class="dropdown-item fw-semibold" href="#"><i class="fas fa-book me-2 text-primary"></i> My Courses</a></li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item text-danger fw-semibold">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
      @else
      <a href="{{ route('login') }}" class="btn fw-semibold text-white px-4 py-2 rounded-pill"
        style="
          background: linear-gradient(90deg,#2563EB,#1D4ED8);
          box-shadow: 0 4px 16px rgba(37,99,235,0.4);
          transition: all 0.3s ease;
        "
        onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 24px rgba(37,99,235,0.6)'"
        onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 16px rgba(37,99,235,0.4)'">
        <i class="fas fa-sign-in-alt me-2"></i> Login
      </a>
      @endauth
    </div>
  </div>
</nav>

<!-- مسافة أعلى الصفحة -->
<div style="height: 140px;"></div>

<!-- Script الانزلاق والظل -->
<script>
  const navbar = document.getElementById("smartNavbar");

  // تأثير الانزلاق عند تحميل الصفحة
  window.addEventListener('load', () => {
    setTimeout(() => {
      navbar.style.top = "20px";
    }, 100);
  });

  // إضافة ظل خفيف عند التمرير
  window.addEventListener("scroll", () => {
    navbar.style.boxShadow = window.scrollY > 40
      ? "0 4px 20px rgba(0,0,0,0.3)"
      : "0 2px 12px rgba(0,0,0,0.1)";
  });
</script>

<!-- الحركات -->
<style>
@keyframes glowPulse {
  0% { text-shadow: 0 0 8px rgba(37,99,235,0.5); }
  100% { text-shadow: 0 0 20px rgba(37,99,235,1); }
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>

<script src="https://kit.fontawesome.com/a2e0e6adf2.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
