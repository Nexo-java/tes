<nav class="slide-down flex items-center justify-between px-8 py-3 bg-white border-b border-gray-200" style="z-index: 1000; position: relative;">
  <!-- Logo -->
  <div class="flex items-center">
    <div class="flex items-center gap-2">
      <img src="{{ asset('images/e6ca3c98-d691-4d68-a69c-fd205249ffca_removalai_preview.png') }}" class="w-32    h-22">
      <div class="flex flex-col leading-tight">

      </div>
    </div>
  </div>

  <!-- Navigation Menu -->
  <ul class="flex space-x-29 font-medium text-gray-700 text-lg">
    <li>
      <a href="{{ route('user.dashboard') }}" class="hover:text-gray-900 pb-1 px-5 border-b-3 {{ Request::routeIs('user.dashboard') ? 'text-gray-900 font-semibold border-yellow-300' : 'border-transparent' }}">
        Home
      </a>
    </li>
    <li>
      <a href="{{ route('user.dashboard') }}#canteen" class="hover:text-gray-900 pb-1 px-5 border-b-3 {{ Request::routeIs('user.canteen') ? 'text-gray-900 font-semibold border-yellow-300' : 'border-transparent' }}">
        Canteen
      </a>
    </li>
    <li>
      <a href="{{ route('user.history') }}" class="hover:text-gray-900 pb-1 px-5 border-b-3 {{ Request::routeIs('user.history') ? 'text-gray-900 font-semibold border-yellow-300' : 'border-transparent' }}">
        History
      </a>
    </li>
  </ul>

  <!-- Right Side: Search, Notification, Profile -->
  <div class="flex items-center space-x-4">
    <!-- Search Bar -->
    <form action="{{ route('user.search') }}" method="GET" class="relative">
      <input
        type="text"
        name="q"
        placeholder="What do you want to eat today?"
        class="px-4 py-4 pr-12 rounded-full border border-yellow-300 focus:outline-none focus:ring-1 focus:ring-yellow-400 w-160 text-sm mr-10"
        required
      >
      <button type="submit" class="absolute right-1 top-1/2 transform -translate-y-1/2  mr-10 p-3 rounded-full bg-gray-200 hover:bg-gray-300 transition">
        <svg class="w-5 h-5 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </button>
    </form>

    <!-- Notification Icon -->
    <button id="notifBtn" class="relative p-1 hover:bg-gray-100 border-1 border-gray-300 rounded-full transition">
      <svg class="w-8 h-8 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="1">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13.479 5.749A4.5 4.5 0 0 1 16.5 10v3.7l2.073 1.935a.5.5 0 0 1-.341.865H5.769a.5.5 0 0 1-.342-.866L7.5 13.7V10a4.5 4.5 0 0 1 3.021-4.251a1.5 1.5 0 0 1 2.958 0"/>
          <path d="M10.585 18.5a1.5 1.5 0 0 0 2.83 0z"/>
        </g>
      </svg>
      <span id="notifCount" class="hidden absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full min-w-[20px] text-center"></span>
    </button>

    <!-- Notification Dropdown -->
    <div id="notifDropdown" class="hidden absolute right-0 top-12 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
      <div class="p-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="font-semibold text-gray-800">Notifications</h3>
        <div class="flex gap-2">
          <button id="markAllReadBtn" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
            Mark as Read
          </button>
          <button id="deleteAllBtn" class="text-xs text-red-600 hover:text-red-800 font-medium">
            Delete All
          </button>
        </div>
      </div>
      <div id="notifList" class="max-h-96 overflow-y-auto">
        <div class="p-4 text-center text-gray-500 text-sm">Loading...</div>
      </div>
      <!-- Modal Delete All Notification -->
      <div id="notifDeleteModal" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:16px;max-width:350px;width:90%;margin:auto;padding:32px 20px 20px 20px;box-shadow:0 4px 24px rgba(0,0,0,0.2);position:relative;">
          <div style="font-size:1.1rem;font-weight:600;margin-bottom:18px;text-align:left;">Yakin ingin hapus semua notifikasi?</div>
          <hr>
          <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:32px;">
            <button id="confirmNotifDeleteBtn" style="background:#ef4444;color:#fff;border:none;border-radius:10px;padding:7px 20px;font-size:12px;font-weight:500;box-shadow:0 2px 6px rgba(239,68,68,0.15);cursor:pointer;">Hapus Semua</button>
            <button id="cancelNotifDeleteBtn" style="background:#f9fafb;color:#222;border:1px solid #ddd;border-radius:10px;padding:7px 20px;font-size:12px;font-weight:500;box-shadow:0 2px 6px rgba(0,0,0,0.08);cursor:pointer;">Batal</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Profile Icon -->
    <a href="{{ route('user.profile') }}" class="p-1 hover:bg-gray-100 rounded-full transition">
      <div class="w-11 h-11  rounded-full flex items-center justify-center border-1 border-gray-300">
        <svg class="w-7 h-7 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 32" fill="currentColor">
          <path d="M.5 31.983a.503.503 0 0 0 .612-.354c1.03-3.843 5.216-4.839 7.718-5.435c.627-.149 1.122-.267 1.444-.406c2.85-1.237 3.779-3.227 4.057-4.679a.5.5 0 0 0-.165-.473c-1.484-1.281-2.736-3.204-3.526-5.416a.5.5 0 0 0-.103-.171c-1.045-1.136-1.645-2.337-1.645-3.294c0-.559.211-.934.686-1.217a.5.5 0 0 0 .243-.408C10.042 5.036 13.67 1.026 18.12 1l.107.007c4.472.062 8.077 4.158 8.206 9.324a.5.5 0 0 0 .178.369c.313.265.459.601.459 1.057c0 .801-.427 1.786-1.201 2.772a.5.5 0 0 0-.084.158c-.8 2.536-2.236 4.775-3.938 6.145a.5.5 0 0 0-.178.483c.278 1.451 1.207 3.44 4.057 4.679c.337.146.86.26 1.523.403c2.477.536 6.622 1.435 7.639 5.232a.5.5 0 0 0 .966-.26c-1.175-4.387-5.871-5.404-8.393-5.95c-.585-.127-1.09-.236-1.336-.344c-1.86-.808-3.006-2.039-3.411-3.665c1.727-1.483 3.172-3.771 3.998-6.337c.877-1.14 1.359-2.314 1.359-3.317c0-.669-.216-1.227-.644-1.663C27.189 4.489 23.19.076 18.227.005l-.149-.002c-4.873.026-8.889 4.323-9.24 9.83c-.626.46-.944 1.105-.944 1.924c0 1.183.669 2.598 1.84 3.896c.809 2.223 2.063 4.176 3.556 5.543c-.403 1.632-1.55 2.867-3.414 3.676c-.241.105-.721.22-1.277.352c-2.541.604-7.269 1.729-8.453 6.147a.5.5 0 0 0 .354.612"/>
        </svg>
      </div>
    </a>
  </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const notifBtn = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');
    const notifCount = document.getElementById('notifCount');
    const notifList = document.getElementById('notifList');

    // Get read notifications from localStorage
    function getReadNotifications() {
        const read = localStorage.getItem('readNotifications');
        return read ? JSON.parse(read) : [];
    }

    // Save read notifications to localStorage
    function saveReadNotifications(ids) {
        localStorage.setItem('readNotifications', JSON.stringify(ids));
    }

    // Toggle dropdown
    notifBtn?.addEventListener('click', function(e) {
        e.stopPropagation();
        notifDropdown.classList.toggle('hidden');
        if (!notifDropdown.classList.contains('hidden')) {
            loadNotifications();
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!notifDropdown.contains(e.target) && !notifBtn.contains(e.target)) {
            notifDropdown.classList.add('hidden');
        }
    });

    // Load notifications
    function loadNotifications() {
        fetch('{{ route("user.notifications") }}')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateNotifications(data.notifications);
                }
            })
            .catch(error => console.error('Error loading notifications:', error));
    }

    function updateNotifications(notifications) {
        const readIds = getReadNotifications();

        // Filter unread notifications
        const unreadNotifications = notifications.filter(n => !readIds.includes(n.id));
        const unreadCount = unreadNotifications.length;

        // Update count badge (hanya notifikasi yang belum dibaca)
        if (unreadCount > 0) {
            notifCount.textContent = unreadCount;
            notifCount.classList.remove('hidden');
        } else {
            notifCount.classList.add('hidden');
        }

        // Update notification list (tampilkan semua notifikasi)
        if (notifications.length === 0) {
            notifList.innerHTML = '<div class="p-4 text-center text-gray-500 text-sm">No new notifications</div>';
            return;
        }

        const statusColors = {
            'proses': 'bg-blue-100 text-blue-800',
            'selesai': 'bg-green-100 text-green-800',
            'batal': 'bg-red-100 text-red-800',
            'belum': 'bg-yellow-100 text-yellow-800'
        };

        const statusIcons = {
            'proses': '🔄',
            'selesai': '✅',
            'batal': '❌',
            'belum': '⏳'
        };

        notifList.innerHTML = notifications.map(notif => `
          <div class="p-4 border-b border-gray-100 hover:bg-gray-50 transition">
            <div class="flex items-start gap-3">
              <span class="text-2xl">${statusIcons[notif.status]}</span>
              <div class="flex-1">
                <p class="font-medium text-gray-800">${notif.message}</p>
                <p class="text-xs text-gray-500 mt-1">Order #${notif.order_number} • ${notif.time}</p>
                <span class="inline-block mt-2 px-2 py-1 rounded-full text-xs font-semibold ${statusColors[notif.status]}">
                  ${notif.status.charAt(0).toUpperCase() + notif.status.slice(1)}
                </span>
                ${notif.isNonTunaiProses ? '<span class="ml-2 inline-block px-2 py-1 rounded-full text-xs font-semibold bg-blue-500 text-white">Non Tunai</span>' : ''}
              </div>
            </div>
          </div>
        `).join('');
    }

    // Auto-refresh notifications every 30 seconds
    setInterval(function() {
        fetch('{{ route("user.notifications") }}')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const readIds = getReadNotifications();
                    const unreadNotifications = data.notifications.filter(n => !readIds.includes(n.id));

                    // Jika ada notifikasi baru yang belum dibaca, tampilkan badge
                    if (unreadNotifications.length > 0) {
                        notifCount.textContent = unreadNotifications.length;
                        notifCount.classList.remove('hidden');
                    } else {
                        notifCount.classList.add('hidden');
                    }
                }
            })
            .catch(error => console.error('Error:', error));
    }, 30000);

    // Mark all as read
    const markAllReadBtn = document.getElementById('markAllReadBtn');
    markAllReadBtn?.addEventListener('click', function() {
      fetch('{{ route("user.notifications") }}')
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Save all notification IDs as read
            const allIds = data.notifications.map(n => n.id);
            saveReadNotifications(allIds);

            // Update UI
            notifCount.classList.add('hidden');
            loadNotifications();
          }
        })
        .catch(error => console.error('Error:', error));
    });

    // Delete all notifications
    const deleteAllBtn = document.getElementById('deleteAllBtn');
    deleteAllBtn?.addEventListener('click', function() {
      document.getElementById('notifDeleteModal').style.display = 'flex';
    });

    document.getElementById('cancelNotifDeleteBtn').onclick = function() {
      document.getElementById('notifDeleteModal').style.display = 'none';
    };

    document.getElementById('confirmNotifDeleteBtn').onclick = function() {
      fetch('{{ route("user.notifications.deleteAll") }}', {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Clear localStorage
          localStorage.removeItem('readNotifications');

          // Update UI
          notifCount.classList.add('hidden');
          loadNotifications();
          alert('All notifications deleted');
        }
        document.getElementById('notifDeleteModal').style.display = 'none';
      })
      .catch(error => {
        console.error('Error:', error);
        document.getElementById('notifDeleteModal').style.display = 'none';
      });
    };

    // Initial load
    loadNotifications();
});
</script>
