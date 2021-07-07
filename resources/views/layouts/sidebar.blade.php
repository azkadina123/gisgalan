  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('tamplate/dist/img/logotegal.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8') }}">
      <span class="brand-text font-weight-light">PEMETAAN PENYAKIT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('tamplate/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Adminn (RS,Puskesmas,Klinik)</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
        
              
                
            <ul class="nav nav-treeview">
              
            
          <li class="nav-item">
            <a href="/grafik" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if (Auth::user()->rule === '1')
          <li class="nav-item">
            <a href="/permintaanverifikasi" class="nav-link">
              <i class="nav-icon far fa-envelope-open"></i>
              <p>
                Permintaan Verifikasi
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/keloladataakun" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Kelola Data Akun
              </p>
            </a>
          </li>    
          <li class="nav-item">
            <a href="{{route('riwayat.index')}}" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Riwayat Data
              </p>
            </a>
          </li>    
          
          @elseif (Auth::user()->rule === '2')
                        <!-- puskesmas rs klinik -->

          <li class="nav-item">
            <a href="/keloladatapenyakit" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              Kelola Data Penyakit
            </a>
          </li>

          <li class="nav-item">
            <a href="/statuspermintaan" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              Status Permintaan
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('riwayat.index')}}" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Riwayat Data
              </p>
            </a>
          </li>    
          @else
          @endif          
     
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>