
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
 <div class="sidenav-header d-flex align-items-center p-3">
  <i class="fas fa-times cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
  <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none">
    <!-- أيقونة SVG شعار بسيط -->
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#2563EB" viewBox="0 0 24 24" class="me-2">
      <path d="M12 2L2 7v7c0 5 4 8 10 8s10-3 10-8V7l-10-5zM12 20c-4.5 0-8-2.5-8-6v-4.2l8-3.8 8 3.8V14c0 3.5-3.5 6-8 6z"/>
    </svg>
    <span class="fs-4 fw-bold text-primary">Edvanta</span>
  </a>
</div>

  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
<li class="nav-item">
  <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <title>shop</title>
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g transform="translate(-1716.000000, -439.000000)" fill="#2563EB" fill-rule="nonzero">
            <g transform="translate(1716.000000, 291.000000)">
              <g transform="translate(0.000000, 148.000000)">
                <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
              </g>
            </g>
          </g>
        </g>
      </svg>
    </div>
    <span class="nav-link-text ms-1">Dashboard</span>
  </a>
</li>


      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Laravel Examples</h6>
      </li>
 <li class="nav-item">
  <a class="nav-link {{ (Request::is('user-profile') ? 'active' : '') }}" href="{{ url('user-profile') }}">
    <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
         style="background-color: {{ Request::is('user-profile') ? '#DBEAFE' : '#fff' }};">
      <svg width="12px" height="12px" viewBox="0 0 46 42" xmlns="http://www.w3.org/2000/svg" fill="{{ Request::is('user-profile') ? '#2563EB' : '#000' }}">
        <g fill="none" fill-rule="evenodd">
          <g transform="translate(-1717.000000, -291.000000)" fill="{{ Request::is('user-profile') ? '#2563EB' : '#000' }}" fill-rule="nonzero">
            <g transform="translate(1716.000000, 291.000000)">
              <g transform="translate(1.000000, 0.000000)">
                <path d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z" opacity="0.6"></path>
                <path d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                <path d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
              </g>
            </g>
          </g>
        </g>
      </svg>
    </div>
    <span class="nav-link-text ms-1">User Profile</span>
  </a>
</li>

<li class="nav-item pb-2">
    <a class="nav-link {{ (Request::is('user-management') ? 'active' : '') }}" href="{{ url('user-management') }}">
        <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
             style="background-color: {{ Request::is('user-management') ? '#DBEAFE' : '#fff' }};">
            <i class="fas fa-lg fa-list-ul ps-2 pe-2 text-center"
               style="font-size: 1rem; color: {{ Request::is('user-management') ? '#2563EB' : '#000' }};" aria-hidden="true"></i>
        </div>
        <span class="nav-link-text ms-1">User Management</span>
    </a>
</li>

      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Example pages</h6>
      </li>
<li class="nav-item">
  <a class="nav-link {{ (Request::is('admin/tracks') ? 'active' : '') }}" href="{{ url('admin/tracks') }}">
    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      <!-- أيقونة المسار -->
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="16" width="4" height="4" rx="1" fill="#000" stroke="#000"/>
        <rect x="9" y="12" width="4" height="8" rx="1" fill="#222" stroke="#000"/>
        <rect x="15" y="8" width="4" height="12" rx="1" fill="#555" stroke="#000"/>
      </svg>
    </div>
    <span class="nav-link-text ms-1">Tracks</span>
  </a>
</li>


<li class="nav-item">
  <a class="nav-link {{ (Request::is('admin/course') ? 'active' : '') }}" href="{{ url('admin/course') }}">
    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      <!-- أيقونة كتاب مفتوح باللون الأسود -->
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 64 64" fill="none" stroke="#000" stroke-width="2">
        <!-- السبورة -->
        <rect x="4" y="8" width="56" height="30" rx="4" fill="#fff" stroke="#000" stroke-width="2"/>
        <!-- رأس الطالب -->
        <circle cx="32" cy="48" r="4" fill="#000" stroke="#000" />
        <!-- جسم الطالب -->
        <path d="M28 58c0-2.2 1.8-4 4-4s4 1.8 4 4v2H28v-2z" fill="#000" stroke="#000"/>
        <!-- قاعدة الطالب -->
        <rect x="24" y="60" width="16" height="2" fill="#000" stroke="#000"/>
      </svg>
    </div>
    <span class="nav-link-text ms-1">Courses</span>
  </a>
</li>



<li class="nav-item">
  <a class="nav-link {{ (Request::is('admin/videos') ? 'active' : '') }}" href="{{ url('admin/videos') }}">
    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      <!-- أيقونة مشغل فيديو بحجم أكبر ولون أسود -->
      <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="2" y="6" width="20" height="12" rx="4" ry="4" fill="#000" stroke="none"/>
        <polygon points="10 8 16 12 10 16" fill="#fff"/>
      </svg>
    </div>
    <span class="nav-link-text ms-1">Videos</span>
  </a>
</li>


<li class="nav-item">
  <a class="nav-link {{ (Request::is('admin/quizzes') ? 'active' : '') }}" href="{{ url('admin/quizzes') }}">
    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
        <!-- الورقة -->
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" fill="#DBEAFE" stroke="#000"/>
        <!-- خطوط الورقة -->
        <line x1="7" y1="8" x2="13" y2="8" />
        <line x1="7" y1="12" x2="13" y2="12" />
        <line x1="7" y1="16" x2="13" y2="16" />
        <!-- القلم -->
        <path d="M18 2l3 3-9.5 9.5-3 1 1-3L18 2z" fill="#000" stroke="#1E40AF"/>
      </svg>
    </div>
    <span class="nav-link-text ms-1">Quizzes</span>
  </a>
</li>


<li class="nav-item">
  <a class="nav-link {{ (Request::is('admin/question') ? 'active' : '') }}" href="{{ url('admin/question') }}">
    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10" fill="#fff" stroke="#000" />
        <path d="M9 9a3 3 0 1 1 6 0c0 1.5-3 2-3 4" stroke="#000" />
        <line x1="12" y1="17" x2="12" y2="17.01" stroke="#000" />
      </svg>
    </div>
    <span class="nav-link-text ms-1">Question</span>
  </a>
</li>





    </ul>
  </div>


</aside>
