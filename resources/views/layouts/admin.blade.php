<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - CLEANhub</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom Style -->
  <style>
    .sidebar {
      width: 240px;
      min-height: 100vh;
      background-color: #f8f9fa;
      position: fixed;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: all 0.3s ease;
    }
    .sidebar.collapsed { margin-left: -240px; }

    .main-content {
      margin-left: 240px;
      padding: 1rem;
      transition: all 0.3s ease;
    }
    .main-content.expanded { margin-left: 0; }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem;
      background-color: white;
      border-bottom: 1px solid #ddd;
    }

    .submenu {
      display: none;
      padding-left: 1.5rem;
    }
    .submenu.show { display: block; }

    .burger {
      cursor: pointer;
      font-size: 1.5rem;
      margin-right: 1rem;
    }

    .nav-link.active {
      font-weight: bold;
      color: #0d6efd;
    }

    .profile-dropdown {
      position: relative;
    }

    .profile-dropdown-toggle {
      cursor: pointer;
    }

    .profile-menu {
      display: none;
      position: absolute;
      right: 0;
      top: 100%;
      background-color: white;
      border: 1px solid #ccc;
      width: 200px;
      padding: 1rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      z-index: 1000;
    }
    .profile-menu.active { display: block; }

    .modal-content {
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    .modal-header { border-bottom: none; justify-content: center; }
    .modal-body { padding: 2rem; }
    .modal-footer { border-top: none; }
  </style>

  @yield('head')
</head>
<body>

<div class="d-flex">
  <!-- Sidebar -->
  <div class="sidebar p-3" id="sidebar">
    <div>
      <img src="{{ asset('img/logo.png') }}" alt="CLEANhub" class="img-fluid mb-4" style="max-width: 160px;">
      <hr>
      <nav class="nav flex-column">
        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
          <i class="bi bi-house-door me-2"></i> Dashboard
        </a>

        <!-- Management -->
        <div>
          <a href="javascript:void(0);" class="nav-link d-flex justify-content-between align-items-center"
             onclick="toggleSubmenu()">
            <span><i class="bi bi-gear me-2"></i> Management</span>
            <i id="submenuIcon" class="bi bi-chevron-right"></i>
          </a>
          <div class="submenu ps-4" id="submenu">
            <a class="nav-link {{ request()->is('admin/products') ? 'active' : '' }}" href="{{ route('products.index') }}">
              <i class="bi bi-box me-2"></i> Products
            </a>
            <a class="nav-link {{ request()->is('admin/services') ? 'active' : '' }}" href="{{ route('services.index') }}">
              <i class="bi bi-briefcase me-2"></i> Services
            </a>
            <a class="nav-link {{ request()->is('admin/images-description') ? 'active' : '' }}" href="{{ route('dashboard.images.index') }}">
              <i class="bi bi-image me-2"></i> Images & Description
            </a>
          </div>
        </div>

        <!-- Orders -->
        <a class="nav-link {{ request()->routeIs('orders.index') ? 'active' : '' }}" href="{{ route('orders.index') }}">
          <i class="bi bi-receipt me-2"></i> Orders
        </a>

        <!-- Notifications -->
        <a class="nav-link {{ request()->routeIs('notifications.index') ? 'active' : '' }}" href="{{ route('notifications.index') }}">
          <i class="bi bi-bell me-2"></i> Notifications
        </a>
      </nav>
    </div>

    <!-- Logout -->
    <form action="{{ route('logout') }}" method="POST" class="mt-3">
      @csrf
      <button type="submit" class="btn btn-danger w-100">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
      </button>
    </form>
  </div>

  <!-- Main Content -->
  <div class="main-content w-100" id="mainContent">
    <div class="topbar">
      <div class="d-flex align-items-center">
        <i class="bi bi-list burger" onclick="toggleSidebar()"></i>
      </div>
      <div class="profile-dropdown">
        <div class="d-flex align-items-center gap-2 profile-dropdown-toggle" onclick="toggleProfileMenu()">
          <strong class="text-primary">Apple Laundry</strong>
          <i class="bi bi-person-circle fs-4 text-secondary"></i>
        </div>
        <div class="profile-menu shadow" id="profileMenu">
          <div class="text-center">
            <i class="bi bi-person-circle fs-1 text-secondary"></i>
            <p class="fw-bold mt-2 mb-1">Apple Laundry</p>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Dynamic Content -->
    @yield('content')
  </div>
</div>

<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content p-4">
      <h4 class="text-center fw-bold mb-4 text-primary" id="editProfileModalLabel">Edit Profile</h4>
      <form method="POST" action="#" enctype="multipart/form-data">
        {{-- @csrf --}}
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control" name="email" value="">
          </div>
          <div class="col-md-6">
            <label class="form-label fw-semibold">Phone Number</label>
            <input type="text" class="form-control" name="phone" value="">
          </div>
          <div class="col-md-6">
            <label class="form-label fw-semibold">Laundry Name</label>
            <input type="text" class="form-control" name="name" value="">
          </div>
          <div class="col-md-6">
            <label class="form-label fw-semibold">Account Number</label>
            <input type="text" class="form-control" name="account" value="">
          </div>
          <div class="col-md-6">
            <label class="form-label fw-semibold">Laundry Address</label>
            <input type="text" class="form-control" name="address" value="">
          </div>
          <div class="col-md-6">
            <label class="form-label fw-semibold">Photo Profile</label>
            <input type="file" class="form-control" name="photo">
          </div>
        </div>
        <div class="d-flex justify-content-end mt-4 gap-2">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Back</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('mainContent').classList.toggle('expanded');
  }

  function toggleSubmenu() {
    const submenu = document.getElementById('submenu');
    const icon = document.getElementById('submenuIcon');
    submenu.classList.toggle('show');
    icon.classList.toggle('bi-chevron-down');
    icon.classList.toggle('bi-chevron-right');
  }

  function toggleProfileMenu() {
    document.getElementById('profileMenu').classList.toggle('active');
  }

  window.onclick = function(e) {
    if (!e.target.closest('.profile-dropdown')) {
      document.getElementById('profileMenu')?.classList.remove('active');
    }
  };
</script>

@yield('scripts')
</body>
</html>
