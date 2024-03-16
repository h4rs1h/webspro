<!DOCTYPE html>
<html lang="en">
{{-- Head --}}
@include('layout.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('Images/logowebspro.png') }}" alt="LogoWEBSPROPPV" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        {{-- Navbar --}}
        @include('layout.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        {{-- Sidebar --}}
        @include('layout.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        {{-- Footer --}}
        @include('layout.footer')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    {{-- FooterScript --}}
    @include('layout.footerscritp')
</body>

</html>
