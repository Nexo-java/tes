<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <style>
  /* Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

/* Background */
body {
  background-image: url('{{ asset("images/bg_login.png") }}');
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;        /* tetap mengisi area proporsional */
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-attachment: fixed;  /* (opsional) tetap saat scroll */
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 80vh;             /* gunakan min-height untuk fleksibilitas */
}

/* Container */
.login-container {
  display: flex;
  flex-direction: column; /* susun vertikal */
  justify-content: center;
  align-items: center;
}

.login-title {
  margin: 0;   /* hilangkan jarak bawaan */
  padding: 0;
}



#bg-login{
    position: absolute;
    width: 80%;
    height: 80%;
    background: url('images/bg.png');
    z-index: -1;
}

/* Box */
.login-box {
  background: linear-gradient(180deg,#fbf7ef 0%, #f6ecd8 100%);
  padding: 18px 20px 40px;
  border-radius: 18px;
  box-shadow: 8px 14px 24px rgba(0,0,0,0.20), 2px 6px 12px rgba(0,0,0,0.06);
  text-align: center;
  width: 500px; /* diperlebar sedikit ke kanan/kiri */
  max-width: calc(100% - 40px);
  margin-top: 100px;
}

.logo {
  display: block;
  margin: 0 auto 6px; /* rapatkan ke title */
  width: 250px; /* diperbesar tanpa merubah ukuran box */
  max-width: 95%; /* jaga agar tidak melebihi box pada layar kecil */
  height: auto;
  object-fit: contain;
}

/* Title */
.login-box h2 {
  color: #111;
  font-size: 20px;
  margin: 4px 0 14px; /* lebih dekat ke gambar */
  line-height: 1.1;
  font-weight: 700;
  letter-spacing: 0.6px;
}

/* Input */
.input-group {
  text-align: left;
  margin-bottom: 20px;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  border-radius: 15px;
}

.input-group label {
  font-weight: 600;
  color: #222;
  margin-bottom: 8px;
  width: 100%;
  text-align: left;
  padding-left: 35px;
}

.input-group input {
  width: 100%;
  max-width: 360px;
  padding: 22px 46px 22px 18px; /* lebih tebal atas & bawah */
  border: 0.5px solid rgba(0,0,0,0.12);
  border-radius: 12px;
  font-size: 14px;
  display: block;
  margin: 0 auto;
  /* shadow kanan dan bawah diperkuat */
  box-shadow: 6px 8px 18px rgba(0,0,0,0.18), 2px 4px 8px rgba(0,0,0,0.06);
  background: #fff;
}


/* Password wrapper */
.password-wrapper {
  display: block;
  position: relative;
  width: 100%;
  max-width: 360px;
  margin: 0 auto;
}

.password-wrapper input {
  width: 100%;
  max-width: 360px;
  padding: 22px 46px 22px 15px; /* lebih tebal atas & bawah agar konsisten */
  border: 0.5px solid rgba(0,0,0,0.12);
  border-radius: 8px;
  font-size: 14px;
  box-sizing: border-box;
  /* shadow kanan dan bawah agar konsisten dengan input utama */
  box-shadow: 6px 8px 18px rgba(0,0,0,0.18), 2px 4px 8px rgba(0,0,0,0.06);
}

.password-wrapper .toggle-pass {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  background: transparent;
  border: none;
  cursor: pointer;
  font-size: 18px;
  color: #222;
  padding: 6px;
}

/* Forgot */
.forgot {
  text-align: right;
  margin: 10px 12px 18px 0;
  font-size: 13px;
  color: #000000;
  padding-right: 22px;
}
.forgot a {
  color: #000;             /* warna hitam */
  text-decoration: none;   /* hilangkan garis/underline */
}
.forgot a:hover {
  text-decoration: none;
}

/* Button */
.btn {
  width: 260px;
  padding: 20px 18px; /* tambah tinggi (atas & bawah) saja */
  border: 0.5px black;
  background: linear-gradient(#ffffff, rgb(179, 176, 176));
  border-radius: 40px;
  font-size: 16px;
  cursor: pointer;
  font-weight: 700;
  color: #191919;
  box-shadow: 0 6px 14px rgba(0,0,0,0.12), inset 0 -3px 0 rgba(0,0,0,0.04);
  margin-top: 20px;
  margin-bottom: 28px; /* tambah spasi bawah tombol */
}

/* responsive minor */
@media (max-width:420px){
  .login-box { width: 92%; }
  .btn { width: 78%; }
}
  </style>

</head>
<body>
  <div class="login-container">
    <div class="login-box">

      <img src="{{ asset('images/e6ca3c98-d691-4d68-a69c-fd205249ffca_removalai_preview.png') }}" class="logo" alt="Canteen Logo">
      <h2>LOGIN</h2>
      <form action="{{ route('login.process') }}" method="POST">
        @csrf
        <div class="input-group">
          <label for="nis">NIS</label>
          <input type="text" id="login" name="login" placeholder="Enter your NIS" required>
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <div class="password-wrapper">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="button" class="toggle-pass" onclick="togglePassword(event)">
              <i id="toggleIcon" class="fas fa-eye"></i>
            </button>
          </div>
        </div>

        <div class="forgot">
          <a href="#">Forgot password?</a>
        </div>

        <button type="submit" class="btn">Sign In</button>
      </form>
    </div>
  </div>
  <!-- Popup sukses -->
  @if (session('success'))
  <div id="popup-success"
    style="
      position: fixed;
      top: -100px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #16a34a;
      color: white;
      padding: 1rem 2rem;
      border-radius: 0.75rem;
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
      font-weight: 600;
      font-size: 1.1rem;
      transition: top 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.6s ease;
      z-index: 9999;
      opacity: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 250px;
    ">
    <span>Login Successful</span>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("popup-success");
    if (popup) {
      setTimeout(() => {
        popup.style.top = "40px";
        popup.style.opacity = "1";
      }, 200);
      setTimeout(() => {
        popup.style.top = "-150px";
        popup.style.opacity = "0";
      }, 2800);
      setTimeout(() => {
        const redirectUrl = "{{ session('redirectTo') }}";
        if (redirectUrl) {
          window.location.href = redirectUrl;
        }
      }, 3400);
    }
  });
  </script>
  @endif

  <!-- Popup gagal -->
  @if ($errors->first('login') || $errors->first('password'))
  <div id="popup-error"
    style="
      position: fixed;
      top: -100px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #ef4444;
      color: white;
      padding: 1rem 2rem;
      border-radius: 0.75rem;
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
      font-weight: 600;
      font-size: 1.1rem;
      transition: top 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.6s ease;
      z-index: 9999;
      opacity: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 250px;
    ">
    <span>
      @if ($errors->first('login'))
        {{ $errors->first('login') }}
      @elseif ($errors->first('password'))
        {{ $errors->first('password') }}
      @endif
    </span>
  </div>
  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("popup-error");
    if (popup) {
      setTimeout(() => {
        popup.style.top = "40px";
        popup.style.opacity = "1";
      }, 200);
      setTimeout(() => {
        popup.style.top = "-150px";
        popup.style.opacity = "0";
      }, 2800);
    }
  });
  </script>
  @endif
<script>
  function togglePassword(event) {
    event.preventDefault(); // mencegah tombol submit

    const password = document.getElementById("password");
    const icon = document.getElementById("toggleIcon");

    if (!password || !icon) return;

    if (password.type === "password") {
      password.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    } else {
      password.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  }
</script>




</body>
</html>
