<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/orders*') ? 'active' : '' }}" href="/dashboard/orders">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Data Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/clients*') ? 'active' : '' }}" href="/dashboard/clients">
                    <span data-feather="grid" class="align-text-bottom"></span>
                    Data Clients
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/reports*') ? 'active' : '' }}" href="/dashboard/reports">
                    <span data-feather="clipboard" class="align-text-bottom"></span>
                    Report
                </a>
            </li>
        </ul>



        {{-- @can('admin')
            
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Administrator</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
                    <span data-feather="grid" class="align-text-bottom"></span>
                    Post Categories
                </a>
            </li>
        </ul>
        @endcan --}}

    </div>
</nav>
