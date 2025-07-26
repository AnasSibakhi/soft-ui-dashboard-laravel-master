@extends('layouts.user_type.guest')

@section('content')

<style>
html, body {
  margin: 0;
  padding: 0;
  height: 100%;
  overflow: hidden; /* يمنع الشريط */
  background: #fff;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.login-container {
  display: flex;
  height: 100vh;
  width: 100vw;
  overflow: hidden;
  padding: 0 20px; /* padding بسيط يوازن */
  box-sizing: border-box;
  gap: 20px;
}

.image-side {
  flex: 1;
  margin: 20px; /* تبعد الصورة عن الأطراف */
  border-radius: 20px; /* حواف ناعمة كاملة */
  background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1400&q=80');
  background-size: cover;
  background-position: center right;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}


.login-card {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px;
  background-color: white;
  height: 100vh;
  overflow: hidden;
}

.login-card form {
  width: 100%;
  max-width: 400px;
  background: white;
  padding: 30px 25px;
  border-radius: 15px;
  box-shadow: 0 0 20px rgb(0 0 0 / 0.1);
}


  .login-card {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px;
    background-color: white;
  }


  @media (max-width: 900px) {
    .login-container {
      flex-direction: column-reverse;
    }

    .image-side {
      height: 250px;
    }

    .login-card {
      padding: 20px;
    }
  }
</style>

<div class="login-container">
  <div class="login-card">
    <form role="form" method="POST" action="/session">
      @csrf

      <h3 class="text-center mb-4" style="color: #333; font-weight: 700;">Edvanta </h3>

      <label for="name">Name</label>
      <div class="mb-3">
        <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" value="{{ old('name') }}">
        @error('name')
          <p class="text-danger text-xs mt-2">{{ $message }}</p>
        @enderror
      </div>

      <label for="email">Email</label>
      <div class="mb-3">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
        @error('email')
          <p class="text-danger text-xs mt-2">{{ $message }}</p>
        @enderror
      </div>

      <label for="password">Password</label>
      <div class="mb-3">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="secret">
        @error('password')
          <p class="text-danger text-xs mt-2">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-check form-switch mb-3">
        <input class="form-check-input" type="checkbox" id="rememberMe" checked>
        <label class="form-check-label" for="rememberMe">Remember me</label>
      </div>

      <div class="text-center">
        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
      </div>

      <div class="text-center mt-4">
        <small class="text-muted">
          Forgot your password? Reset your password
          <a href="/login/forgot-password" class="text-info text-gradient font-weight-bold">here</a>
        </small>
      </div>
    </form>
  </div>

  <div class="image-side"></div>
</div>

@endsection
