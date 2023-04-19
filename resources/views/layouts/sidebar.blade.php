<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="{{url('/home')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    @if(Auth::user()->action != 3)
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>User Management</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

        <li>
          <a href="{{url('/clinic_details')}}">
            <i class="bi bi-circle"></i><span>All Clinic Details</span>
          </a>
        </li>
        <li>
          <a href="{{url('/clinic')}}">
            <i class="bi bi-circle"></i><span>Add Clinic Location</span>
          </a>
        </li>
      </ul>
    </li>

    @endif

    @if(Auth::user()->action == 2)
    <li class="nav-item">
      <a class="nav-link " href="{{url('/dispatch')}}">
        <i class="bi bi-basket"></i>
        <span>Dispatch</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link " href="{{url('/received_orders')}}">
        <i class="bi bi-basket"></i>
        <span>Received Orders</span>
      </a>
    </li>
    <li>
        <a class="nav-link " href="{{url('/store-eq')}}">
          <i class="bi bi-basket"></i>
          <span>Add Stock</span>
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="{{url('/stock_details')}}">
        <i class="bi bi-basket"></i>
        <span>Stock Details</span>
      </a>
    </li>

  
    @endif
    @if(Auth::user()->action == 3)
    <li class="nav-item">
      <a class="nav-link " href="{{url('/product_receive')}}">
        <i class="bi bi-basket"></i>
        <span>Receive Product</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="{{url('/product_used')}}">
        <i class="bi bi-basket"></i>
        <span>Use Product</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Provide Stock Report For The Clinic</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li class="nav-item">
          <a class="nav-link " href="{{url('/purchase_order')}}">
            <i class="bi bi-basket"></i>
            <span>New Order</span>
          </a>
        </li>
        <li>
          <a class="nav-link " href="{{url('/view_my_orders')}}">
            <i class="bi bi-basket"></i>
            <span>View My Orders</span>
          </a>
        </li>
      </ul>
    </li><!-- End Forms Nav -->
    @endif
    @if(Auth::user()->action == 2)
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Masters</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
       
        <li>
          <a class="nav-link " href="{{url('/category')}}">
            <i class="bi bi-basket"></i>
            <span>Category</span>
          </a>
        </li>
        <li>
          <a class="nav-link " href="{{url('/manufacturer')}}">
            <i class="bi bi-basket"></i>
            <span>Manufacturer</span>
          </a>
        </li>
        <li>
          <a class="nav-link " href="{{url('/unit')}}">
            <i class="bi bi-basket"></i>
            <span>Unit</span>
          </a>
        </li>
        <li>
          <a class="nav-link " href="{{url('/product')}}">
            <i class="bi bi-basket"></i>
            <span>Product</span>
          </a>
        </li>
      </ul>
    </li><!-- End Forms Nav -->
    @endif

        @if(Auth::user()->action == 2)
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#reports-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Report`s</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="reports-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a class="nav-link " href="{{url('/stock-inword')}}">
            <i class="bi bi-basket"></i>
            <span>Stock Inword</span>
          </a>
        </li>
        <li>
          <a class="nav-link " href="{{url('/stock-outword')}}">
            <i class="bi bi-basket"></i>
            <span>Stock Outword</span>
          </a>
        </li>
      </ul>
    </li><!-- End Forms Nav -->
    @endif
  </ul>

</aside><!-- End Sidebar-->