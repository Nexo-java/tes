<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $kantin->nama_kantin }} - Telkom Canteen</title>
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
    .cart-hidden {
      display: none;
      transform: translateY(100%);
    }

    .cart-visible {
      display: block;
      animation: slideUp 0.4s ease-out forwards;
    }

    .cart-hiding {
      display: block;
      animation: slideDown 0.4s ease-out forwards;
    }

    @keyframes slideUp {
      from {
        transform: translateY(100%);
      }
      to {
        transform: translateY(0);
      }
    }

    @keyframes slideDown {
      from {
        transform: translateY(0);
      }
      to {
        transform: translateY(100%);
      }
    }

    .qr-image {
      width: 200px;
      height: 200px;
      object-fit: contain;
      margin: 0 auto;
    }

    /* Menu card transitions */
    .menu-image {
      transition: height 0.3s ease;
    }

    .menu-price {
      transition: color 0.3s ease;
    }

    .default-state,
    .ordered-state {
      transition: opacity 0.3s ease;
    }

    /* Horizontal scroll for cart items */
    #cartItems::-webkit-scrollbar {
      height: 6px;
    }
    #cartItems::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    #cartItems::-webkit-scrollbar-thumb {
      background: #fbbf24;
      border-radius: 10px;
    }
    #cartItems::-webkit-scrollbar-thumb:hover {
      background: #f59e0b;
    }

    /* Horizontal scroll for canteen tabs */
    .overflow-x-auto::-webkit-scrollbar {
      height: 4px;
    }
    .overflow-x-auto::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    .overflow-x-auto::-webkit-scrollbar-thumb {
      background: #fbbf24;
      border-radius: 10px;
    }
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
      background: #f59e0b;
    }

    /* Banner canteen custom width */
    .canteen-banner {
      max-width: 1550px;
      margin: 0 auto;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- Navbar dengan animasi slide-down -->

    <div class="slide-down">
      @include('User.components.navbar')
    </div>


  <!-- Canteen Tabs Section -->
  <section class="bg-white border-white px-9 py-6 ">
    <div class="max-w-8xl mx-auto">
      <div class="flex gap-12 overflow-x-auto  justify-center">
        @foreach($allKantins as $k)
          <a href="{{ route('user.canteen', $k->id_kantin) }}"
             class="flex-shrink-0 relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition">
            <div class="w-120 h-28 relative">
              @if($k->gambar_kantin)
                <img src="{{ asset('storage/' . $k->gambar_kantin) }}" class="w-full h-full object-cover">
              @else
                <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=200" class="w-full h-full object-cover">
              @endif
              <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                <p class="text-white font-bold text-base text-center px-2">{{ $k->nama_kantin }}</p>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Hero Section with Canteen Banner -->
  <section class="px-8 py-4">
    <div class="canteen-banner relative w-full h-64 rounded-2xl overflow-hidden">
      @php
        // Gunakan banner sesuai ID kantin (id-1.png, id-2.png, id-3.png)
        $bannerId = $kantin->id_kantin;
        $bannerPath = "images/id-{$bannerId}.png";
        $bannerExists = file_exists(public_path($bannerPath));
      @endphp

      @if($bannerExists)
        <img src="{{ asset($bannerPath) }}" class="w-full h-full object-cover">
      @elseif($kantin->gambar_kantin)
        <img src="{{ asset('storage/' . $kantin->gambar_kantin) }}" class="w-full h-full object-cover">
      @else
        <img src="https://images.unsplash.com/photo-1567521464027-f127ff144326?w=1200" class="w-full h-full object-cover">
      @endif
      <div class="absolute inset-0  to-black/50"></div>
      <div class="absolute bottom-8 left-8 ml-20 mb-10 ">
        <h1 class="text-4xl font-bold text-white mb-2">{{ $kantin->nama_kantin }}</h1>
        <p class="text-white text-lg">{{ $kantin->lokasi_kantin ?? 'SMK Telkom Banjarbaru' }}</p>
      </div>
    </div>
  </section>

  <!-- Main Content dengan animasi fade-in -->
  <main  id="mainAnim" style="opacity:0;transform:translateY(30px);" class="px-8 py-8 pb-32 max-w-7xl mx-auto">

    <!-- Search Result Info -->


    <!-- Menu Section -->
    <div class="mb-12">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Menu</h2>

      @if($menus->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($menus as $menu)
            <div class="menu-card bg-white rounded-2xl shadow-md hover:shadow-xl transition border-2 {{ session('search') && stripos($menu->nama_menu, session('search')) !== false ?'border-gray-200' : 'border-gray-200' }}" data-menu-id="{{ $menu->menu_id }}">
              <div class="flex h-55">
                <!-- Left: Info -->
                <div class="flex-1 p-4 flex flex-col justify-between">
                  <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $menu->nama_menu }}</h3>
                    <p class="text-gray-500 text-xs line-clamp-2 mt-2">{{ $menu->deks_menu ?? 'Delicious food ready to enjoy!' }}</p>
                  </div>
                  <div>
                    <!-- Harga per item (akan jadi kuning saat ordered) -->
                    <p class="menu-price-small text-sm font-bold mb-1 transition-colors" style="color: #666;">
                      <span class="text-xs align-super">RP</span><span class="menu-price-value">{{ number_format($menu->harga, 0, ',', '.') }}</span>
                    </p>

                    <hr class="mb-2 border-gray-300">

                    <!-- Default State: Add Order Button -->
                    <div class="default-state">
                      <button
                        class="addToCart bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-2 px-4 rounded-lg text-sm w-full transition"
                        data-id="{{ $menu->menu_id }}"
                        data-name="{{ $menu->nama_menu }}"
                        data-price="{{ $menu->harga }}"
                        data-kantin="{{ $kantin->nama_kantin }}">
                        Add Order
                      </button>
                    </div>

                    <!-- Ordered State: Subtotal & Quantity Controls (Hidden by default) -->
                    <div class="ordered-state hidden">
                      <div class="flex items-center gap-3">
                        <p class="text-2xl font-bold text-gray-900 mr-2">
                          <span class="text-sm align-super">RP</span><span class="menu-subtotal">0</span>
                        </p>
                        <button class="decrease-qty bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold w-7 h-7 rounded-lg transition text-lg">-</button>
                        <span class="menu-qty font-bold text-gray-800 text-xs">1</span>
                        <button class="increase-qty bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold w-7 h-7 rounded-lg transition text-lg">+</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Right: Image & Order Now -->
                <div class="flex flex-col ml-2 mr-2 my-2">
                  <div class="menu-image flex-shrink-0 transition-all duration-300 overflow-hidden rounded-lg" style="width: 144px; height: 100%;">
                    @if($menu->gambar_menu)
                      <img src="{{ asset('storage/' . $menu->gambar_menu) }}" class="w-full h-full object-cover">
                    @else
                      <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                      </div>
                    @endif
                  </div>
                  <button class="order-now hidden bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-2 rounded-lg text-sm transition mt-2" style="width: 144px;">
                    Order Now
                  </button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div class="text-center py-16">
          <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
          </svg>
          <h3 class="text-xl font-semibold text-gray-700 mb-2">No Menu Available</h3>
          <p class="text-gray-500 mb-6">This canteen doesn't have any menu yet.</p>
        </div>
      @endif
    </div>

  </main>

  <!-- Success Notification Overlay -->
  <div id="successOverlay" style="display: none; background-color: rgba(0, 0, 0, 0); transition: background-color 0.3s ease;" class="fixed inset-0 z-[9999] flex items-end justify-center pb-64">
    <div id="successBox" style="transform: translateY(100px); opacity: 0; transition: all 0.4s ease;" class="bg-yellow-400 rounded-lg px-10 py-4 text-center shadow-2xl">
      <p class="text-black font-bold text-xl">Your order has been placed, please wait.</p>
    </div>
  </div>

  <!-- Cart Bar (Fixed Bottom) -->
  <div id="cartBar" class="cart-hidden fixed bottom-0 left-0 right-0 bg-white shadow-lg border-t-2 border-gray-300 z-50">
    <div class="max-w-7x2 mx-auto px-6 py-4 min-h-[200px]">

      <!-- STEP 1: Cart View -->
      <div id="cartView" class="h-[180px] flex flex-col justify-between">
        <div class="flex-1 flex flex-col overflow-hidden">
          <h3 class="text-xl font-bold text-gray-800 mb-4">Confirm Order</h3>

          <!-- Cart Items vertical stack with scroll -->
          <div id="cartItems" class="flex flex-col gap-2 mb-4 flex-1 overflow-y-auto pr-2">
            <!-- Cart items will be dynamically inserted here -->
          </div>
        </div>

        <!-- Total and Checkout -->
        <div class="flex justify-end items-center gap-4">
          <div class="flex items-start gap-1">
            <p class="text-xs text-black mt-1">RP</p>
            <p id="cartTotal" class="text-2xl font-bold text-gray-800 text-center">0</p>
          </div>
          <button id="checkoutBtn" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-12 rounded-lg transition text-lg">
            Checkout
          </button>
        </div>
      </div>

      <!-- STEP 2: Payment Selection View -->
      <div id="paymentView" style="display: none;" class="min-h-[180px] flex flex-col justify-between">
        <div>
          <!-- Header with Confirm Order and Select payment -->
          <div class="flex justify-between items-start mb-2">
          <div>
            <h3 class="text-xl font-bold text-gray-800 border-b-2 border-gray-300 pb-2 inline-block mb-2">Confirm Order</h3>
            <p id="orderSummary" class="text-gray-700"></p>
          </div>
          <div class="mr-350">
            <p class="text-base font-semibold text-gray-800 border-b-2 border-gray-300 pb-2 inline-block mb-3">Select payment</p>

            <!-- Payment Buttons Container with fixed width -->
            <div style="width: 280px;">
              <!-- Initial Payment Type Selection -->
              <div id="paymentTypeButtons" class="flex gap-2">
                <button id="btnTunai" class="border-2 border-gray-400 bg-white hover:bg-yellow-50 py-1 px-10 rounded-lg font-semibold transition text-yellow-600 text-sm">
                  Tunai
                </button>
                <button id="btnNonTunai" class="border-2 border-gray-400 bg-white hover:bg-yellow-50 py-1 px-10 rounded-lg font-semibold transition text-yellow-600 text-sm">
                  Non Tunai
                </button>
              </div>
              <!-- Warning pembayaran, sama persis dashboard -->
              <div style="position: relative;">
                <div id="paymentWarning" style="display: none;" class="flex items-start gap-2 text-red-500 text-sm font-semibold mt-2 bg-transparent">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/><text x="12" y="16" text-anchor="middle" font-size="12" fill="currentColor" dy="-2">i</text></svg>
                  <span class="text-red-500 text-sm font-semibold whitespace-nowrap">Silahkan pilih metode pembayaran terlebih dahulu</span>
                </div>
              </div>

              <!-- Payment App Options (replaces Tunai/Non Tunai after Non Tunai is clicked) -->
              <div id="paymentAppButtons" style="display: none;" class="grid grid-cols-2 gap-2">
                <button class="paymentApp border-2 border-gray-400 bg-white hover:bg-gray-50 py-1 px-10 rounded-lg font-semibold transition text-gray-800 text-sm" data-app="dana">
                  DANA
                </button>
                <button class="paymentApp border-2 border-gray-400 bg-white hover:bg-gray-50 py-1 px-10 rounded-lg font-semibold transition text-gray-800 text-sm" data-app="ovo">
                  OVO
                </button>
                <button class="paymentApp border-2 border-gray-400 bg-white hover:bg-gray-50 py-1 px-10 rounded-lg font-semibold transition text-gray-800 text-sm" data-app="gopay">
                  Gopay
                </button>
                <button class="paymentApp border-2 border-gray-400 bg-white hover:bg-gray-50 py-1 px-10 rounded-lg font-semibold transition text-gray-800 text-sm" data-app="qris">
                  Qris
                </button>
              </div>
            </div>
          </div>
        </div>
        </div>

        <!-- Total and Action Buttons -->
        <div class="flex justify-end items-center gap-4">
          <div class="flex items-start gap-1">
            <p class="text-xs text-gray-600 mt-1">RP</p>
            <p id="paymentTotal" class="text-2xl font-bold text-black">0</p>
          </div>
          <button id="backBtn" class="bg-cyan-400 hover:bg-cyan-500 text-black font-bold py-4 px-14 rounded-lg transition">
            Back
          </button>
          <button id="buyBtn" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-4 px-14 rounded-lg transition">
            Buy
          </button>
        </div>
      </div>

      <!-- STEP 3: QR Code View (Inside Cart Horizontal) -->
      <div id="qrView" style="display: none;" class="h-[180px] flex items-center justify-between gap-6 px-4">
        <!-- QR Code Section -->
        <div class="text-center">
          <div class="bg-white border-4 border-yellow-400 p-3 inline-block rounded-lg shadow-md">
            <img id="qrImagePage" src="" alt="QR Code" style="width: 120px; height: 120px; object-fit: contain;">
          </div>
          <p class="text-black text-sm font-bold mt-2">Scan to pay</p>
          <p class="text-gray-600 text-xs" id="selectedPaymentApp">-</p>
        </div>

        <!-- Upload & Buttons Section -->
        <div class="flex-1 flex flex-col gap-3 max-w-md">
          <!-- Upload Bukti Transfer -->
          <div class="bg-gray-50 rounded-lg p-4 border-2 border-gray-300">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Upload Payment Proof <span class="text-red-500">*</span></label>
            <input type="file" id="buktiTransferInput" accept="image/*" class="block w-full text-xs text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-yellow-400 file:text-black hover:file:bg-yellow-500 file:cursor-pointer cursor-pointer border border-gray-300 rounded-lg">
            <p class="text-xs text-gray-500 mt-1">Required (JPG, PNG, max 2MB)</p>
            <p id="uploadStatus" class="text-xs mt-1 hidden"></p>
          </div>

          <div class="flex gap-3">
            <button id="cancelPaymentBtn" class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg transition">
              Cancel
            </button>
            <button id="confirmPaymentBtn" class="flex-1 bg-gray-400 text-white font-bold py-3 px-6 rounded-lg transition cursor-not-allowed" disabled>
              I have paid
            </button>
          </div>
        </div>
      </div>

      </div>
      </div>

    </div>
  </div>  <!-- Success Notification Overlay -->
  <div id="successOverlay" style="display: none; background-color: rgba(0, 0, 0, 0); transition: background-color 0.3s ease;" class="fixed inset-0 z-[9999] flex items-end justify-center pb-64">
    <div id="successBox" style="transform: translateY(100px); opacity: 0; transition: all 0.4s ease;" class="bg-yellow-400 rounded-lg px-10 py-4 text-center shadow-2xl">
      <p class="text-black font-bold text-xl">Your order has been placed, please wait.</p>
    </div>
  </div>

  @include('User.components.footer')

  <script>
  let cart = [];
  let selectedPayment = null;
  let selectedApp = null;
  let buktiTransferFile = null;

  const cartBar = document.getElementById('cartBar');
  const cartTotal = document.getElementById('cartTotal');
  const paymentTotal = document.getElementById('paymentTotal');
  const cartItems = document.getElementById('cartItems');
  const orderSummary = document.getElementById('orderSummary');

  // Views
  const cartView = document.getElementById('cartView');
  const paymentView = document.getElementById('paymentView');
  const qrView = document.getElementById('qrView');

  // Buttons
  const checkoutBtn = document.getElementById('checkoutBtn');
  const backBtn = document.getElementById('backBtn');
  const buyBtn = document.getElementById('buyBtn');
  const btnTunai = document.getElementById('btnTunai');
  const btnNonTunai = document.getElementById('btnNonTunai');
  const paymentTypeButtons = document.getElementById('paymentTypeButtons');
  const paymentAppButtons = document.getElementById('paymentAppButtons');
  const qrImagePage = document.getElementById('qrImagePage');
  const cancelPaymentBtn = document.getElementById('cancelPaymentBtn');
  const confirmPaymentBtn = document.getElementById('confirmPaymentBtn');
  const buktiTransferInput = document.getElementById('buktiTransferInput');

  // Handle bukti transfer upload
  buktiTransferInput.addEventListener('change', function(e) {
    const uploadStatus = document.getElementById('uploadStatus');

    if (this.files && this.files[0]) {
      const file = this.files[0];

      // Validate file size (max 2MB)
      if (file.size > 2 * 1024 * 1024) {
        uploadStatus.textContent = '❌ File too large! Maximum 2MB';
        uploadStatus.className = 'text-xs mt-2 text-red-600';
        uploadStatus.classList.remove('hidden');
        this.value = '';
        buktiTransferFile = null;

        // Keep button disabled
        confirmPaymentBtn.disabled = true;
        confirmPaymentBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
        confirmPaymentBtn.classList.remove('bg-green-500', 'hover:bg-green-600');
        return;
      }

      buktiTransferFile = file;

      // Show success message
      uploadStatus.textContent = `✓ File uploaded: ${file.name}`;
      uploadStatus.className = 'text-xs mt-2 text-green-600 font-semibold';
      uploadStatus.classList.remove('hidden');

      // Enable "I have paid" button
      confirmPaymentBtn.disabled = false;
      confirmPaymentBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
      confirmPaymentBtn.classList.add('bg-green-500', 'hover:bg-green-600');
    } else {
      buktiTransferFile = null;
      uploadStatus.classList.add('hidden');

      // Disable "I have paid" button
      confirmPaymentBtn.disabled = true;
      confirmPaymentBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
      confirmPaymentBtn.classList.remove('bg-green-500', 'hover:bg-green-600');
    }
  });  // Format currency
  function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(number);
  }

  // Calculate totals
  function getTotal() {
    return cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
  }

  function getTotalQty() {
    return cart.reduce((sum, item) => sum + item.qty, 0);
  }

  // Update cart display
  function updateCart() {
    const total = getTotal();
    const qty = getTotalQty();

    cartTotal.textContent = formatRupiah(total);
    paymentTotal.textContent = formatRupiah(total);

    // Show or hide cart bar with animation
    if (cart.length > 0) {
      cartBar.classList.remove('cart-hidden', 'cart-hiding');
      cartBar.classList.add('cart-visible');
      showCartView();
    } else {
      // Trigger slide down animation before hiding
      cartBar.classList.remove('cart-visible');
      cartBar.classList.add('cart-hiding');

      // Hide after animation completes
      setTimeout(() => {
        cartBar.classList.remove('cart-hiding');
        cartBar.classList.add('cart-hidden');
      }, 400);
    }

    renderCartItems();
  }

  // Render cart items (Horizontal layout)
  function renderCartItems() {
    cartItems.innerHTML = '';

    if (cart.length === 0) {
      cartItems.innerHTML = '<p class="text-gray-500 text-center py-4">Cart kosong</p>';
      return;
    }

    cart.forEach((item, index) => {
      const itemDiv = document.createElement('div');
      itemDiv.className = 'flex items-center gap-3 max-w-md';
      itemDiv.innerHTML = `
        <button onclick="decreaseQty(${index})" class="text-gray-800 w-6 h-6 font-bold text-xl flex items-center justify-center hover:text-red-500">−</button>
        <div class="border-2 border-yellow-400 rounded-lg p-3 bg-white flex-1">
          <p class="font-semibold text-gray-800 text-sm text-center">${item.name} <span class="text-yellow-600">(${item.kantin})</span></p>
        </div>
        <div class="border border-gray-300 rounded px-4 py-2">
          <span class="text-gray-800 font-bold">${item.qty}</span>
        </div>
      `;
      cartItems.appendChild(itemDiv);
    });
  }

  // Show Cart View (Step 1)
  function showCartView() {
    cartView.style.display = 'flex';
    paymentView.style.display = 'none';
    qrView.style.display = 'none';
    selectedPayment = null;
    selectedApp = null;

    // Reset payment buttons to initial state (Tunai/Non Tunai)
    paymentTypeButtons.style.display = 'flex';
    paymentAppButtons.style.display = 'none';

    // Hapus warning pembayaran jika ada
    const paymentWarning = document.getElementById('paymentWarning');
    if (paymentWarning) paymentWarning.style.display = 'none';
  }

  // Show Payment View (Step 2)
  function showPaymentView() {
    cartView.style.display = 'none';
    paymentView.style.display = 'flex';
    qrView.style.display = 'none';

    // Reset to show Tunai/Non Tunai buttons initially
    paymentTypeButtons.style.display = 'flex';
    paymentAppButtons.style.display = 'none';

    // Generate order summary (vertical list)
    const summary = cart.map(item => `${item.qty}x ${item.name}`).join('<br>');
    orderSummary.innerHTML = summary;
  }

  // Show QR View (Step 3)
  function showQRView() {
    cartView.style.display = 'none';
    paymentView.style.display = 'none';
    qrView.style.display = 'flex';
  }

  // Increase quantity
  function increaseQty(index) {
    cart[index].qty++;
    updateCart();
  }

  // Decrease quantity
  function decreaseQty(index) {
    cart[index].qty--;
    if (cart[index].qty <= 0) {
      cart.splice(index, 1);
    }
    updateCart();
  }

  // Add to cart
  document.querySelectorAll('.addToCart').forEach(btn => {
    btn.addEventListener('click', function() {
      const id = this.dataset.id;
      const name = this.dataset.name;
      const price = parseInt(this.dataset.price);
      const kantin = this.dataset.kantin;

      const menuCard = this.closest('.menu-card');
      const defaultState = menuCard.querySelector('.default-state');
      const orderedState = menuCard.querySelector('.ordered-state');
      const menuImage = menuCard.querySelector('.menu-image');
      const menuPriceSmall = menuCard.querySelector('.menu-price-small');
      const menuQty = menuCard.querySelector('.menu-qty');
      const menuSubtotal = menuCard.querySelector('.menu-subtotal');
      const orderNowBtn = menuCard.querySelector('.order-now');

      const existing = cart.find(item => item.id === id);
      if (existing) {
        existing.qty++;
      } else {
        cart.push({ id, name, price, qty: 1, kantin });
      }

      // Show transition: shrink image height, change price color to yellow, show Order Now
      defaultState.classList.add('hidden');
      orderedState.classList.remove('hidden');
      orderNowBtn.classList.remove('hidden');
      menuImage.style.height = '160px';
      menuPriceSmall.style.color = '#EAB308'; // Yellow color

      // Update quantity display and subtotal
      const cartItem = cart.find(item => item.id === id);
      menuQty.textContent = cartItem.qty;
      menuSubtotal.textContent = formatRupiah(cartItem.qty * price);

      // Don't show cart bar yet, wait for Order Now
    });
  });

  // Handle quantity controls in menu cards
  document.querySelectorAll('.menu-card').forEach(card => {
    const menuId = card.dataset.menuId;
    const increaseBtn = card.querySelector('.increase-qty');
    const decreaseBtn = card.querySelector('.decrease-qty');
    const orderNowBtn = card.querySelector('.order-now');
    const menuQty = card.querySelector('.menu-qty');
    const menuSubtotal = card.querySelector('.menu-subtotal');
    const menuImage = card.querySelector('.menu-image');
    const menuPriceSmall = card.querySelector('.menu-price-small');
    const defaultState = card.querySelector('.default-state');
    const orderedState = card.querySelector('.ordered-state');

    increaseBtn.addEventListener('click', () => {
      const cartItem = cart.find(item => item.id === menuId);
      if (cartItem) {
        cartItem.qty++;
        menuQty.textContent = cartItem.qty;
        menuSubtotal.textContent = formatRupiah(cartItem.qty * cartItem.price);
      }
    });

    decreaseBtn.addEventListener('click', () => {
      const cartItem = cart.find(item => item.id === menuId);
      if (cartItem) {
        cartItem.qty--;
        if (cartItem.qty <= 0) {
          const index = cart.findIndex(item => item.id === menuId);
          cart.splice(index, 1);
          orderedState.classList.add('hidden');
          defaultState.classList.remove('hidden');
          orderNowBtn.classList.add('hidden');
          menuImage.style.height = '100%';
          menuPriceSmall.style.color = '#666'; // Reset to gray
        } else {
          menuQty.textContent = cartItem.qty;
          menuSubtotal.textContent = formatRupiah(cartItem.qty * cartItem.price);
        }
      }
    });

    orderNowBtn.addEventListener('click', () => {
      // Reset menu card to default state
      orderedState.classList.add('hidden');
      defaultState.classList.remove('hidden');
      orderNowBtn.classList.add('hidden');
      menuImage.style.height = '100%';
      menuPriceSmall.style.color = '#666'; // Reset to gray

      // Update cart display and show cart bar only (don't go to payment yet)
      updateCart();
      // User can continue adding more items
    });
  });

  // Checkout button - Go to payment view
  checkoutBtn.addEventListener('click', () => {
    if (cart.length === 0) {
      alert('Cart masih kosong!');
      return;
    }
    showPaymentView();
  });

  // Back button - Return to cart view
  backBtn.addEventListener('click', () => {
    showCartView();
    // Hapus warning pembayaran jika ada
    const paymentWarning = document.getElementById('paymentWarning');
    if (paymentWarning) paymentWarning.style.display = 'none';
  });

  // Payment method selection - Tunai
  btnTunai.addEventListener('click', () => {
    selectedPayment = 'tunai';

    // Style Tunai as active (yellow bg, white text)
    btnTunai.classList.remove('border-gray-400', 'bg-white', 'text-yellow-600');
    btnTunai.classList.add('bg-yellow-400', 'text-white', 'border-yellow-400');

    // Style Non Tunai as inactive (white bg, gray border, yellow text)
    btnNonTunai.classList.remove('bg-yellow-400', 'text-white', 'border-yellow-400');
    btnNonTunai.classList.add('border-gray-400', 'bg-white', 'text-yellow-600');
  });

  // Payment method selection - Non Tunai
  btnNonTunai.addEventListener('click', () => {
    selectedPayment = null; // Reset, tunggu pilih app
    selectedApp = null;

    // Style Non Tunai as active (yellow bg, white text)
    btnNonTunai.classList.remove('border-gray-400', 'bg-white', 'text-yellow-600');
    btnNonTunai.classList.add('bg-yellow-400', 'text-white', 'border-yellow-400');

    // Style Tunai as inactive (white bg, gray border, yellow text)
    btnTunai.classList.remove('bg-yellow-400', 'text-white', 'border-yellow-400');
    btnTunai.classList.add('border-gray-400', 'bg-white', 'text-yellow-600');

    // Hide Tunai/Non Tunai buttons
    paymentTypeButtons.style.display = 'none';

    // Show Payment App buttons (grid 2x2)
    paymentAppButtons.style.display = 'grid';
  });

  // Payment App Selection
  document.querySelectorAll('.paymentApp').forEach(btn => {
    btn.addEventListener('click', function() {
      selectedApp = this.dataset.app;
      selectedPayment = 'non-tunai'; // Set payment method to non-tunai for all digital wallets

      // Remove active from all payment apps (reset to gray border)
      document.querySelectorAll('.paymentApp').forEach(b => {
        b.classList.remove('border-blue-500');
        b.classList.add('border-gray-400');
      });

      // Add active to clicked (blue border)
      this.classList.remove('border-gray-400');
      this.classList.add('border-blue-500');
    });
  });

  // Buy button - For Tunai: direct submit, For Non-Tunai: show QR view
  buyBtn.addEventListener('click', () => {
    if (!selectedPayment) {
      // Tampilkan warning di bawah tombol pembayaran
      let paymentWarning = document.getElementById('paymentWarning');
      if (paymentWarning) {
        paymentWarning.style.display = 'flex';
      }
      return;
    }

    // If Tunai, submit directly
    if (selectedPayment === 'tunai') {
      submitTransaction();
    }
    // If Non-Tunai, show QR view (Step 3)
    else if (selectedPayment === 'non-tunai') {
      // Generate QR Code
      const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${selectedApp.toUpperCase()}-Payment-${Date.now()}`;
      qrImagePage.src = qrUrl;

      // Display selected payment app name
      document.getElementById('selectedPaymentApp').textContent = selectedApp.toUpperCase();

      // Reset upload status
      document.getElementById('uploadStatus').classList.add('hidden');
      buktiTransferFile = null;
      buktiTransferInput.value = '';

      // Reset confirm button to disabled
      confirmPaymentBtn.disabled = true;
      confirmPaymentBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
      confirmPaymentBtn.classList.remove('bg-green-500', 'hover:bg-green-600');

      // Show QR View (Full screen overlay)
      showQRView();
    }
  });

  // Cancel Payment from QR View - Go back to payment view
  cancelPaymentBtn.addEventListener('click', () => {
    showPaymentView();
  });

  // I have paid from QR View - Submit transaction
  confirmPaymentBtn.addEventListener('click', () => {
    submitTransaction();
  });

  // Function to submit transaction
  function submitTransaction() {
    // Validasi untuk non-tunai: harus ada bukti transfer
    if (selectedPayment === 'non-tunai' && !buktiTransferFile) {
      alert('Please upload payment proof first!');
      return;
    }

    console.log('Sending payment data:', {
      metode_bayar: selectedPayment,
      items: cart,
      has_bukti: buktiTransferFile ? 'yes' : 'no'
    });

    // Prepare FormData for file upload
    const formData = new FormData();
    formData.append('metode_bayar', selectedPayment);
    formData.append('items', JSON.stringify(cart));

    // Add bukti transfer if non-tunai
    if (selectedPayment === 'non-tunai' && buktiTransferFile) {
      formData.append('bukti_transfer', buktiTransferFile);
    }

    // Send to server
    fetch("{{ route('user.transaksi.store') }}", {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: formData
    })
    .then(res => {
      console.log('Response status:', res.status);
      if (!res.ok) {
        return res.text().then(text => {
          console.error('Error response text:', text);
          throw new Error(`HTTP error! status: ${res.status}, body: ${text}`);
        });
      }
      return res.json();
    })
    .then(data => {
      console.log('Response data:', data);
      if (data.success) {
        // Show success overlay with animation
        const overlay = document.getElementById('successOverlay');
        const box = document.getElementById('successBox');

        overlay.style.display = 'flex';

        // Trigger animation
        setTimeout(() => {
          overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.3)';
          box.style.transform = 'translateY(0)';
          box.style.opacity = '1';
        }, 10);

        // Hide with animation after 3 seconds
        setTimeout(() => {
          overlay.style.backgroundColor = 'rgba(0, 0, 0, 0)';
          box.style.transform = 'translateY(100px)';
          box.style.opacity = '0';

          setTimeout(() => {
            overlay.style.display = 'none';
            cart = [];
            updateCart();
          }, 400);
        }, 3000);
      } else {
        alert('❌ Gagal: ' + (data.message || 'Terjadi kesalahan'));
      }
    })
    .catch(err => {
      console.error('Fetch error:', err);
      alert('❌ Error: ' + err.message);
    });
  }

  // Jalankan animasi saat masuk halaman canteen
  document.addEventListener('DOMContentLoaded', function() {
    // Navbar animasi
    const navbar = document.getElementById('navbarAnim');
    if (navbar) {
      navbar.style.opacity = '0';
      navbar.style.transform = 'translateY(-60px)';
      navbar.style.animation = 'slideDownIn 0.7s cubic-bezier(.4,0,.2,1) forwards';
      setTimeout(() => {
        navbar.style.opacity = '1';
        navbar.style.transform = 'translateY(0)';
      }, 700);
    }
    // Main content animasi
    const main = document.getElementById('mainAnim');
    if (main) {
      main.style.opacity = '0';
      main.style.transform = 'translateY(30px)';
      main.style.animation = 'fadeInUp 0.8s cubic-bezier(.4,0,.2,1) forwards';
      setTimeout(() => {
        main.style.opacity = '1';
        main.style.transform = 'translateY(0)';
      }, 800);
    }
  });
  // Initialize
  updateCart();
  </script>
</body>
</html>
