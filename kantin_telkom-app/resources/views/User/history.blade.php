<!DOCTYPE html>
<html lang="en">
<head>
    <style>
      /* Animasi dari dashboard dan lain-lain */
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
      .hero-fade {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s cubic-bezier(.4,0,.2,1) forwards;
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
        padding: 42px 24px 27px 24px;
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
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order History - Telkom Canteen</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKB4Imkb9h9Q4CPrl/cHBX9nuS4wxLBzME2YkdE+5eYXPL3ZXl2bqsxYuFeo+AJ6Dig0lzVEA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @vite('resources/css/app.css')

  <style>
    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 30px;
      margin-bottom: 20px;
    }

    .pagination nav ul {
      display: flex;
      list-style: none;
      padding: 0;
      gap: 8px;
      margin: 0;
    }

    .pagination nav ul li a,
    .pagination nav ul li span {
      display: inline-block;
      padding: 12px 16px;
      background: none;
      color: #333;
      font-size: 14px;
      text-decoration: none;
      transition: background 0.2s ease;
      border: none;
      border-radius: 6px;
      min-width: 40px;
      text-align: center;
    }

    .pagination nav ul li a:hover {
      background: #d4d4d4;
    }

    .pagination nav ul li.active span {
      background: #fff;
      border: 1px solid #000000;
      color: #000000;
      border-radius: 6px;
      font-weight: 600;
    }

    /* Hide Previous/Next text arrows */
    .pagination nav ul li:first-child,
    .pagination nav ul li:last-child {
      display: none;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800">
  <!-- Delete Modal -->
  <div id="deleteModal" class="delete-modal">
    <div class="delete-modal-content">
      <div class="delete-modal-title">Yakin Untuk Hapus ?</div>
      <hr>
      <div class="delete-modal-actions">
        <button id="confirmDeleteBtn" class="delete-btn">
          <i class="fas fa-trash"></i> Hapus
        </button>
        <button id="cancelDeleteBtn" class="cancel-btn">Batal</button>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <div class="slide-down">
    @include('User.components.navbar')
  </div>

  <!-- Main Content -->
  <main class="px-8 py-8 max-w-7xl mx-auto min-h-screen pb-32">

    @if($transaksis->count() > 0)
      <!-- Header Row -->
      <div class="bg-white rounded-lg shadow-xs px-6 py-4 mb-4 grid grid-cols-5 gap-4 font-semibold text-gray-800 border-1 border-gray-300">
        <div>Date</div>
        <div>Name Order</div>
        <div>Queue number</div>
        <div>Price</div>
        <div>Status</div>
      </div>

      <!-- Data Rows with min-height for 5 items -->
      <div class="space-y-4" id="historyList" style="min-height: 550px;">
        @foreach($transaksis as $transaksi)
          <div class="history-item-wrapper bg-white rounded-lg shadow-sm hover:shadow-md border-1 border-gray-300 transition-all duration-300">
            <!-- Main Card -->
            <div class="history-item px-10 py-8 grid grid-cols-5 gap-4 items-center cursor-pointer" data-id="{{ $transaksi->id_transaksi }}">
              <!-- Date -->
              <div class="text-sm text-gray-800">
                {{ \Carbon\Carbon::parse($transaksi->tgl_transaksi)->format('d/m/Y') }}
              </div>

              <!-- Name Order -->
              <div class="text-sm text-gray-900 font-medium">
                @if($transaksi->transaksiDetails->count() > 0)
                  {{ $transaksi->transaksiDetails->first()->menu->nama_menu ?? 'Menu tidak ditemukan' }}
                  @if($transaksi->transaksiDetails->count() > 1)
                    <span class="text-gray-500">+{{ $transaksi->transaksiDetails->count() - 1 }} more</span>
                  @endif
                @else
                  -
                @endif
              </div>

              <!-- Queue Number -->
              <div class="text-sm text-gray-800 ml-10">
                {{ $transaksi->karcis->karcis_id ?? '-' }}
              </div>

              <!-- Price -->
              <div class="text-sm text-gray-900 font-medium">
                <span class="text-xs align-super">RP</span>{{ number_format($transaksi->transaksiDetails->sum('subtotal'), 0, ',', '.') }}
              </div>

              <!-- Status -->
              <div>
                @php
                  $status = $transaksi->transaksiDetails->first()->status ?? 'belum';
                  $statusColor = [
                    'belum' => 'text-red-600',
                    'proses' => 'text-blue-600',
                    'selesai' => 'text-green-600',
                    'batal' => 'text-gray-600',
                  ];
                  $statusText = [
                    'belum' => 'Delay',
                    'proses' => 'Process',
                    'selesai' => 'Completed',
                    'batal' => 'Cancelled',
                  ];
                @endphp
                <span class="text-sm font-medium {{ $statusColor[$status] ?? 'text-gray-600' }}">
                  {{ $statusText[$status] ?? ucfirst($status) }}
                </span>
              </div>
            </div>

            <!-- Delete Button Area (Below card with border top, slides down) -->
            <div class="delete-btn-container overflow-hidden transition-all duration-300" style="max-height: 0;">
              <div class="border-t border-gray-200 px-10 py-3 flex justify-end">
                <span class="text-red-500 hover:text-red-700 font-medium text-sm cursor-pointer flex items-center gap-2" onclick="confirmDelete({{ $transaksi->id_transaksi }})">
                  <i class="fas fa-trash"></i> Delete
                </span>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Pagination (Always below data, fixed position) -->
      <div class="pagination mt-8">
        <nav>
          <ul style="display: flex; list-style: none; padding: 0; gap: 8px; margin: 0; justify-content: center;">
            @foreach(range(1, $transaksis->lastPage()) as $page)
              <li class="{{ $page == $transaksis->currentPage() ? 'active' : '' }}" style="display: inline-block;">
                @if($page == $transaksis->currentPage())
                  <span style="display: inline-block; padding: 12px 16px; background: #fff; border: 2px solid #000; color: #000; border-radius: 6px; font-weight: 600; min-width: 40px; text-align: center;">{{ $page }}</span>
                @else
                  <a href="{{ $transaksis->url($page) }}" style="display: inline-block; padding: 12px 16px; background: #fff; border: 1px solid #ddd; color: #333; border-radius: 6px; text-decoration: none; min-width: 40px; text-align: center;">{{ $page }}</a>
                @endif
              </li>
            @endforeach
          </ul>
        </nav>
      </div>

    @else
      <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Orders Yet</h3>
        <p class="text-gray-500 mb-6">You haven't placed any orders yet.</p>
        <a href="{{ route('user.dashboard') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg">
          Start Shopping
        </a>
      </div>
    @endif

  </main>

  @include('User.components.footer')

  <script>
  let selectedItem = null;

  // Add click event to each history item
  document.querySelectorAll('.history-item').forEach(item => {
    item.addEventListener('click', function(e) {
      // Don't trigger if clicking delete button
      if (e.target.classList.contains('delete-btn') || e.target.closest('.delete-btn')) {
        return;
      }

      const itemId = this.dataset.id;
      const wrapper = this.closest('.history-item-wrapper');

      // If clicking the same item, deselect it
      if (selectedItem === itemId) {
        deselectAll();
        selectedItem = null;
        return;
      }

      // Select this item and blur others
      selectedItem = itemId;

      document.querySelectorAll('.history-item-wrapper').forEach(itemWrapper => {
        const historyItem = itemWrapper.querySelector('.history-item');
        const deleteContainer = itemWrapper.querySelector('.delete-btn-container');

        if (historyItem.dataset.id === itemId) {
          // Selected item: remove blur, show delete button with slide down animation
          itemWrapper.style.filter = 'none';
          itemWrapper.style.opacity = '1';
          itemWrapper.classList.add('ring-2', 'ring-white');

          // Slide delete button down from top
          deleteContainer.style.maxHeight = '60px';
        } else {
          // Other items: blur and reduce opacity, hide delete button
          itemWrapper.style.filter = 'blur(1px)';
          itemWrapper.style.opacity = '1';
          itemWrapper.classList.remove('ring-10', 'ring-gray-400');

          // Hide delete button
          deleteContainer.style.maxHeight = '0';
        }
      });
    });
  });

  // Deselect all items
  function deselectAll() {
    document.querySelectorAll('.history-item-wrapper').forEach(wrapper => {
      const deleteContainer = wrapper.querySelector('.delete-btn-container');

      wrapper.style.filter = 'none';
      wrapper.style.opacity = '1';
      wrapper.classList.remove('ring-2', 'ring-yellow-400');

      // Slide back (hide) delete button
      deleteContainer.style.maxHeight = '0';
    });
  }

  // Confirm delete
  let deleteId = null;
  function confirmDelete(id) {
    deleteId = id;
    document.getElementById('deleteModal').style.display = 'flex';
  }

  document.getElementById('cancelDeleteBtn').onclick = function() {
    document.getElementById('deleteModal').style.display = 'none';
    deleteId = null;
  };

  document.getElementById('confirmDeleteBtn').onclick = function() {
    if (!deleteId) return;
    // Send delete request
    fetch(`/user/history/${deleteId}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Remove the item from DOM with animation
        const wrapper = document.querySelector(`.history-item[data-id="${deleteId}"]`).closest('.history-item-wrapper');
        wrapper.style.transition = 'all 0.3s ease';
        wrapper.style.opacity = '0';
        wrapper.style.transform = 'translateX(-20px)';

        setTimeout(() => {
          wrapper.remove();
          selectedItem = null;
          deselectAll();

          // Check if history is empty
          if (document.querySelectorAll('.history-item').length === 0) {
            location.reload();
          }
        }, 300);
      } else {
        alert('Failed to delete: ' + (data.message || 'Unknown error'));
      }
      document.getElementById('deleteModal').style.display = 'none';
      deleteId = null;
    })
    .catch(err => {
      console.error('Error:', err);
      alert('Error deleting order');
      document.getElementById('deleteModal').style.display = 'none';
      deleteId = null;
    });
  };

  // Click outside to deselect
  document.addEventListener('click', function(e) {
    if (!e.target.closest('.history-item-wrapper')) {
      deselectAll();
      selectedItem = null;
    }
  });
  </script>

</body>
</html>
