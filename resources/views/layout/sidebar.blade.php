<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('Images/logowebspro.png') }}" alt="Logo WEBSPRO PPV" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">WEBSPRO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $username }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (Auth::user()->role_id == '1')
                    @include('layout.sidebar.admin')
                @elseif (Auth::user()->role_id == '2')
                    <li class="nav-header">BILLING</li>
                @elseif (Auth::user()->role_id == '3')
                    <li class="nav-header">COLLECTION</li>
                @elseif (Auth::user()->role_id == '4')
                    <li class="nav-header">TENAN RELATION</li>
                @elseif (Auth::user()->role_id == '5')
                    <li class="nav-header">TENAN RELATION 2</li>
                @endif
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="fas fa-share"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
