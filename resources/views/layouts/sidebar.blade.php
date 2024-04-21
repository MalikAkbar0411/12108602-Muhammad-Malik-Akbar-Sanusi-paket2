<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- SidebarSearch Form -->
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <a href="#" class="nav-link active">
            <p>
              Dashboard
            </p>
          </a>
          @if(Auth::check() && Auth::user()->role == 'admin')
          <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
              <a class="nav-link" href="/dashboard" style="{{ Request::is('dashboard') ? 'color: #ffff00;' : '' }}">
                  <i class="fas fa-fw fa-home" style="{{ Request::is('dashboard') ? 'color: #ffff00;' : 'color: #ffffff;' }}"></i>
                  <span style="font-size: 1em;">Dashboard</span>
              </a>
          </li>      
        <li class="nav-item">
          <a href="" class="nav-link">
            <a class="nav-link" href="/user" style="{{ Request::is('user') ? 'color: #ffff00;' : '' }}">
              <i class="fas fa-user fa-sm fa-fw" style="{{ Request::is('user') ? 'color: #ffff00;' : 'color: #ffffff;' }}"></i>
              <p>
                <span style="font-size: 1em;">User</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/penjualan" class="nav-link">
              <i class="fas fa-cart-plus fa-sm fa-fw" style="{{ Request::is('penjualan') ? 'color: #ffff00;' : 'color: #ffffff;' }}"></i>
              <i  style="{{ Request::is('penjualan') ? 'color: #ffff00;' : 'color: #ffffff;' }}"></i>
              <p>
              Penjualan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="produk" class="nav-link">
              <i class="fab fa-product-hunt" style="{{ Request::is('produk') ? 'color: #ffff00;' : 'color: #ffffff;' }}"></i>
              <i  style="{{ Request::is('produk') ? 'color: #ffff00;' : 'color: #ffffff;' }}"></i>
              <p>
              Produk
          </p>
          </a>
        </li>
        @else
          <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
              <a class="nav-link" href="/dashboard" style="{{ Request::is('dashboard') ? 'color: #ffff00;' : '' }}">
                  <i class="fas fa-fw fa-home" style="{{ Request::is('dashboard') ? 'color: #ffff00;' : 'color: #ffffff;' }}"></i>
                  <span style="font-size: 1em;">Dashboard</span>
              </a>
          </li>
          <li class="nav-item">
            <a href="/penjualan" class="nav-link">
                <i class="fas fa-cart-plus fa-sm fa-fw" style="{{ Request::is('penjualan') ? 'color: #ffff00;' : 'color: #ffffff;' }}"></i>
                <i  style="{{ Request::is('penjualan') ? 'color: #ffff00;' : 'color: #ffffff;' }}"></i>
                <p>
                Penjualan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="produk" class="nav-link">
                <i class="fab fa-product-hunt" style="{{ Request::is('produk') ? 'color: #ffff00;' : 'color: #ffffff;' }}"></i>
                <i  style="{{ Request::is('produk') ? 'color: #ffff00;' : 'color: #ffffff;' }}"></i>
                <p>
                Produk
            </p>
            </a>
          </li>
      @endif
  </div>
</aside>