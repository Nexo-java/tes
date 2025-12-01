<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile - Telkom Canteen</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  <style>
    /* Fade-in animation for homepage */
    .fade-in {
      opacity: 0;
      transform: translateY(30px);
      animation: fadeInUp 0.8s cubic-bezier(.4,0,.2,1) forwards;
    }
    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    /* Slide-down animation for header/navbar */
    .slide-down {
      opacity: 0;
      transform: translateY(-60px);
      animation: slideDownIn 0.7s cubic-bezier(.4,0,.2,1) forwards;
    }
    @keyframes slideDownIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .delete-modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0; top: 0;
  width: 100vw; height: 100vh;
  background: rgba(0,0,0,0.8);
  align-items: center;
  justify-content: center;
}
.delete-modal-content {
  background: #fff;
  border-radius: 16px;
  max-width: 400px;
  width: 90%;
  margin: auto;
  padding: 42px 24px 27px 24px;;
  box-shadow: 0 4px 24px rgba(0,0,0,0.2);
  position: relative;
}
.delete-modal-title {
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 18px;
  text-align: left;
}
.delete-modal-actions {
  display: flex;
  gap: 10px;
  justify-content: flex-end;
  margin-top: 32px;
}
.delete-btn, .cancel-btn {
  padding: 7px 10px;
  font-size: 0.95rem;
  border-radius: 8px;
}
.delete-btn {
  background: #ef4444;
  color: #fff;
  border: none;
  border-radius: 10px;
  padding: 7px 20px;
  font-size: 12px;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 2px 6px rgba(239,68,68,0.15);
  cursor: pointer;
}
.cancel-btn {
  background: #f9fafb;
  color: #222;
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 7px 20px;
  font-size: 12pxrem;
  font-weight: 500;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  cursor: pointer;
}
    
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

  <div id="profileFade" class="fade-in">
    <!-- Navbar -->
    <div class="slide-down">
      @include('User.components.navbar')
    </div>

    <!-- Main Content -->
    <main class="px-8 py-8 max-w-7xl mx-auto">
      <h1 class="text-3xl font-bold mb-8">Profile</h1>

      <!-- Success Message -->
      @if(session('success'))
      <div id="successMessage" class="bg-green-500 text-white px-6 py-4 rounded-lg mb-6 flex items-center justify-between">
        <span class="font-medium">{{ session('success') }}</span>
        <button onclick="document.getElementById('successMessage').remove()" class="text-white hover:text-gray-200">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
      @endif

      <div class="bg-white rounded-lg      p-8">
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="flex flex-col md:flex-row gap-8">
            <!-- Profile Image -->
            <div class="flex flex-col items-start">
              <div class="w-65 h-102 bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden border-2 border-yellow-400">
                @if(auth()->guard('pengguna')->user()->foto_siswa)
                  <img src="{{ asset('storage/' . auth()->guard('pengguna')->user()->foto_siswa) }}" alt="Profile" class="w-full h-full object-cover">
                @else
                  <svg class="w-32 h-32 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                  </svg>
                @endif
              </div>
              <div class="flex flex-row gap-5 mt-4 w-full">
                <button type="button" onclick="toggleEdit()" class="px-3 py-1 border border-gray-800 rounded text-sm font-medium hover:bg-gray-50 transition">
                  Edit profile
                </button>
                <button type="submit" id="saveBtn" class="px-3 py-1 bg-white border border-gray-800 rounded text-sm font-medium hover:bg-gray-100 transition" disabled>
                  Save
                </button>
                <button type="button" onclick="document.getElementById('logoutForm').submit();" class="px-3 py-1 bg-red-500 text-white rounded text-sm font-medium hover:bg-red-600 transition">
                  Logout
                </button>
              </div>
            </div>

            <!-- Profile Info -->
            <div class="flex-1 space-y-4">
              <div class="border border-gray-300 rounded-lg p-5 bg-gray-50 flex items-center ">
                <label class="text-base font-semibold text-gray-700 min-w-[40px]" >NIS :</label>
                <input type="text" name="nis" value="{{ auth()->guard('pengguna')->user()->nis ?? '-' }}" class="flex-1 bg-transparent border-none outline-none text-gray-900 text-base py-2" readonly>
              </div>

              <div class="border border-gray-300 rounded-lg p-5 bg-gray-50 flex items-center ">
                <label class="text-base font-semibold text-gray-700 min-w-[50px]">Name :</label>
                <input type="text" name="nama_siswa" value="{{ auth()->guard('pengguna')->user()->nama_siswa ?? '-' }}" class="profile-input flex-1 bg-transparent border-none outline-none text-gray-900 text-base py-2" readonly>
              </div>

              <div class="border border-gray-300 rounded-lg p-5 bg-gray-50 flex items-center     ">
                <label class="text-base font-semibold text-gray-700 min-w-[50px]">Class :</label>
                <input type="text" name="kelas_siswa" value="{{ auth()->guard('pengguna')->user()->kelas_siswa ?? '-' }}" class="profile-input flex-1 bg-transparent border-none outline-none text-gray-900 text-base py-2" readonly>
              </div>

              <div class="border border-gray-300 rounded-lg p-5 bg-gray-50 flex items-center">
                <label class="text-base font-semibold text-gray-700 min-w-[50px]">Major :</label>
                <input type="text" name="jurusan_siswa" value="{{ auth()->guard('pengguna')->user()->jurusan_siswa ?? '-' }}" class="profile-input flex-1 bg-transparent border-none outline-none text-gray-900 text-base py-2" readonly>
              </div>

              <div class="border border-gray-300 rounded-lg p-5 bg-gray-50 flex items-center ">
                <label class="text-base font-semibold text-gray-700 min-w-[50px]">Email :</label>
                <input type="email" name="email_siswa" value="{{ auth()->guard('pengguna')->user()->email_siswa ?? '-' }}" class="profile-input flex-1 bg-transparent border-none outline-none text-gray-900 text-base py-2" readonly>
              </div>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>

  <!-- Logout Form (hidden) -->
  <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
  </form>

  <script>
    let isEditing = false;

    function toggleEdit() {
      isEditing = !isEditing;
      const inputs = document.querySelectorAll('.profile-input');
      const saveBtn = document.getElementById('saveBtn');

      inputs.forEach(input => {
        if (isEditing) {
          input.removeAttribute('readonly');
          input.classList.remove('bg-transparent');
          input.classList.add('bg-white', 'border', 'border-gray-300', 'px-3', 'py-2', 'rounded');
        } else {
          input.setAttribute('readonly', true);
          input.classList.add('bg-transparent');
          input.classList.remove('bg-white', 'border', 'border-gray-300', 'px-3', 'py-2', 'rounded');
        }
      });

      if (isEditing) {
        saveBtn.removeAttribute('disabled');
        saveBtn.classList.remove('bg-white', 'border-gray-800');
        saveBtn.classList.add('bg-yellow-400', 'hover:bg-yellow-500');
      } else {
        saveBtn.setAttribute('disabled', true);
        saveBtn.classList.add('bg-white', 'border-gray-800');
        saveBtn.classList.remove('bg-yellow-400', 'hover:bg-yellow-500');
      }
    }
  </script>

  @include('User.components.footer')

</body>
</html>
