<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">UITM ADMIN DASHBOARD</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown active">
          <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
               class="fas fa-fire"></i><span>Dashboard</span></a>

      </li>
        <li class="menu-header">Starter</li>

        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i> <span>Manage Product</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('admin.products.index') }}">UiTM Products</a></li>
            <li><a class="nav-link" href="{{ route('admin.seller-products.index') }}">Seller Products</a></li>
            <li><a class="nav-link" href="{{ route('admin.seller-pending-products.index') }}">Seller Pending Products</a></li>
          </ul>
        </li>

        {{-- <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i> <span>Manage Service</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('admin.service.index') }}">UiTM Service</a></li>
            <li><a class="nav-link" href="{{ route('admin.seller-services.index') }}">Seller Services</a></li>
            <li><a class="nav-link" href="{{ route('admin.seller-pending-services.index') }}">Seller Pending Services</a></li>
          </ul>
        </li> --}}

        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i> <span>Manage UiTM Vendor</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('admin.vendor-profile.index') }}">UiTM Vendor Profile</a></li>
            <li><a class="nav-link" href="{{ route('admin.payment-settings.index') }}">Payment Settings</a></li>
            {{-- <li><a class="nav-link" href="{{ route('admin.product-listing-app.index') }}">Product Listing Approval</a></li> --}}
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i> <span>Orders</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('admin.order.index') }}">All Orders</a></li>
          </ul>
        </li>
        
        <li><a class="nav-link" href="{{ route('admin.setting.index') }}"><i class="fas fa-wrench"></i><span>Settings</span></a></li>

        
      

      
  </div>