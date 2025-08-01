<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="{{url('admin/dashboard')}}">
        <i class="mdi mdi-speedometer menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    
    <li class="nav-item {{ Request::is('admin/orders') ? 'active':'' }}">
      <a class="nav-link" href="{{url('admin/orders')}}" aria-expanded="false" aria-controls="tables">
        <i class="bi bi-chat-square-text menu-icon"></i>
        <span class="menu-title">Orders</span>
        <!-- <i class="menu-arrow"></i> -->
      </a>
      </li>

    <!-- <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">UI Elements</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">          
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>          
        </ul>
      </div>
    </li>     -->
    <!-- <li class="nav-item">
      <a class="nav-link" href="#category" aria-expanded="false"
        aria-controls="category">
        <i class="mdi mdi-view-headline menu-icon"></i>
        <span class="menu-title">Category</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="category">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/admin/category/create">Add Category</a></li>          
        </ul>
      </div>
      <div class="collapse" id="category">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/admin/category">View Category</a></li>          
        </ul>
      </div> -->
    </li>    
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category">
        <i class="bi bi-tags menu-icon"></i>
        <span class="menu-title">Category</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="category">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/category')}}">View Category</a></li>
        </ul>
      </div>
      <div class="collapse" id="category">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/category/create')}}">Add Category</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
        <i class="bi bi-cart2 menu-icon"></i>
        <span class="menu-title">Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="products">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/products')}}">View Products</a></li>
        </ul>
      </div>
      <div class="collapse" id="products">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/products/create')}}">Add Products</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#discounts" aria-expanded="false" aria-controls="discounts">
        <i class="mdi mdi-sale menu-icon"></i>
        <span class="menu-title">Discounts</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="discounts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/discounts')}}">View Discounts</a></li>
        </ul>
      </div>
      <div class="collapse" id="discounts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/discounts/create')}}">Add Discounts</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#offers" aria-expanded="false" aria-controls="offers">
        <i class="bi bi-bookmark-star menu-icon"></i>
        <span class="menu-title">Offer Texts</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="offers">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/offers')}}">View Offers</a></li>
        </ul>
      </div>
      <div class="collapse" id="offers">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/offers/create')}}">Add Offers</a></li>
        </ul>
      </div>
      </li>

      <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#sliders" aria-expanded="false" aria-controls="sliders">
        <i class="mdi mdi-view-carousel-outline menu-icon"></i>
        <span class="menu-title">Sliders</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="sliders">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/sliders')}}">View Slider</a></li>
        </ul>
      </div>
      <div class="collapse" id="sliders">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/sliders/create')}}">Add Slider</a></li>
        </ul>
      </div>
      </li>

      <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Users</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="users">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/users')}}">View Users</a></li>
        </ul>
      </div>
      <div class="collapse" id="users">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/users/create')}}">Add User</a></li>
        </ul>
      </div>
      </li>

      <li class="nav-item">
      <a class="nav-link" href="#settings"  data-bs-toggle="collapse"  aria-expanded="false" aria-controls="settings">
        <i class="bi bi-gear menu-icon"></i>
        <span class="menu-title">Company Profile</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="settings">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/settings')}}">View Profile</a></li>
        </ul>
      </div>
      <div class="collapse" id="settings">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/settings/edit')}}">Edit Profile</a></li>
        </ul>
      </div>
      </li>

    <!-- <li class="nav-item">
      <a class="nav-link" href="{{url('admin/brands')}}" aria-expanded="false" aria-controls="tables">
        <i class="bi bi-award menu-icon"></i>
        <span class="menu-title">Brands</span>
      </a>
    </li>     -->
    
      <!-- <div class="collapse" id="tables">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
          </li>
        </ul>
      </div>
    </li> -->
    <!-- <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
        <i class="mdi mdi-emoticon menu-icon"></i>
        <span class="menu-title">Icons</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="icons">
        <ul class="nav flex-column sub-menu">          
          <li class="nav-item"> <a class="nav-link" href="pages/icons/font-awesome.html">Font Awesome</a></li>                              
        </ul>
      </div>
    </li>    
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>          
          <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>                    
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../../../docs/documentation.html">
        <i class="mdi mdi-file-document-box menu-icon"></i>
        <span class="menu-title">Documentation</span>
      </a>
    </li> -->
  </ul>
</nav>