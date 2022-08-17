<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('/assets/dist/img/unri.png')}}" alt="SIA ELEKTRO" class="brand-image">
      <span class="brand-text">SIA ELEKTRO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if (Str::length(Auth::guard('dosen')->user()) > 0)   
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                PENILAIAN
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>KERJA PRAKTEK</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/penilaian-sempro" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEMPRO</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SKRIPSI</p>
                </a>
              </li>
            </ul>
          </li>    

          @if (Str::length(Auth::guard('dosen')->user()) > 0) 
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fab fa-wpforms"></i>
              <p>
                SEMINAR
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/form-kp" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>KERJA PRAKTEK</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/form-sempro" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEMPRO</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SKRIPSI</p>
                </a>
              </li>
            </ul>
          </li>    
          @endif      
          @endif      
          @endif      

          @if (Str::length(Auth::guard('web')->user()) > 0) 
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-database"></i>
              <p>
                DATA JURUSAN
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/role" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>HAK AKSES</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/prodi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PROGRAM STUDI</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/konsentrasi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>KONSENTRASI</p>
                </a>
              </li>
            </ul>
          </li>
                       
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                DATA PENGGUNA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/dosen" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DOSEN</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>STAFF JURUSAN</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/mahasiswa" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>MAHASISWA</p>
                </a>
              </li>
            </ul>
          </li>    
          @endif  

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>