<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
   <a class="navbar-brand me-lg-5" href="/">
      <img class="navbar-brand-dark" src="{{ asset('img/brand/light.svg') }}" alt="Volt logo" /> <img
         class="navbar-brand-light" src="{{ asset('img/brand/dark.svg') }}" alt="Volt logo" />
   </a>
   <div class="d-flex align-items-center">
      <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
         data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
         aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
   </div>
</nav>

<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
   <div class="sidebar-inner px-4 pt-3">
      <div
         class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
         <div class="d-flex align-items-center">
            <div class="avatar-lg me-4">
               <img src="{{ Auth::user()->avatar }}" class="card-img-top rounded-circle border-white"
                  alt="{{ Auth::user()->name }}">
            </div>
            <form method="POST" action="{{ route('logout') }}" class="d-block">
               <h2 class="h5 mb-3">Hi, {{ Auth::user()->name }}</h2>
               <a href="{{ route('logout') }}" onclick="event.preventDefault();
               this.closest('form').submit();" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                  @csrf
                  <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                     </path>
                  </svg>
                  Sign Out
               </a>
            </form>
         </div>
         <div class="collapse-close d-md-none">
            <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
               aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
               <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                     d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                     clip-rule="evenodd"></path>
               </svg>
            </a>
         </div>
      </div>
      <ul class="nav flex-column pt-3 pt-md-0">
         <li class="nav-item">
            <a href="/" class="nav-link d-flex align-items-center">
               <span class="sidebar-icon">
                  <img src="{{ asset('img/brand/light.svg') }}" height="20" width="20" alt="Volt Logo">
               </span>
               <span class="mt-1 ms-1 sidebar-text kalam">Abseen</span>
            </a>
         </li>
         <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="nav-link d-flex align-items-center">
               <ion-icon name="layers-outline" class="fs-5 me-3"></ion-icon>
               <span class="sidebar-text">Dashboard</span>
            </a>
         </li>
         @if (Auth::user()->role != 'Siswa')
            <li class="nav-item {{ Route::is('absensi.index') ? 'active' : '' }}">
               <a href="/dashboard/absensi" class="nav-link d-flex align-items-center">
                  <ion-icon name="hand-right-outline" class="fs-5 me-3"></ion-icon>
                  <span class="sidebar-text">Absensi</span>
               </a>
            </li>
            <li class="nav-item {{ Route::is('rayon.index') || Route::is('rayon.students') ? 'active' : '' }}">
               <a href="/dashboard/rayon" class="nav-link d-flex align-items-center">
                  <ion-icon name="compass-outline" class="fs-5 me-3"></ion-icon>
                  <span class="sidebar-text">Rayon</span>
               </a>
            </li>
            <li class="nav-item {{ Route::is('rombel.index') || Route::is('rombel.students') ? 'active' : '' }}">
               <a href="/dashboard/rombel" class="nav-link d-flex align-items-center">
                  <ion-icon name="ribbon-outline" class="fs-5 me-3"></ion-icon>
                  <span class="sidebar-text">Rombel</span>
               </a>
            </li>
            <li class="nav-item">
               <span
                  class="nav-link {{ Route::is('siswa.index') || Route::is('siswa.create') || Route::is('siswa.edit') || Route::is('guru.index') || Route::is('guru.create') || Route::is('guru.edit') || Route::is('user.index') || Route::is('admin.index') || Route::is('admin.create') || Route::is('admin.edit') ? '' : 'collapsed' }}  d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse"
                  data-bs-target="#submenu-components"
                  aria-expanded="{{ Route::is('siswa.index') || Route::is('siswa.create') || Route::is('siswa.edit') || Route::is('guru.index') || Route::is('guru.create') || Route::is('guru.edit') || Route::is('user.index') || Route::is('admin.index') || Route::is('admin.create') || Route::is('admin.edit') ? 'true' : 'false' }}">
                  <span class="d-flex align-items-center">
                     <ion-icon name="people-outline" class="fs-5 me-3"></ion-icon>
                     <span class="sidebar-text">User</span>
                  </span>
                  <span class="link-arrow">
                     <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                           d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                           clip-rule="evenodd"></path>
                     </svg>
                  </span>
               </span>
               <div
                  class="multi-level collapse {{ Route::is('siswa.index') || Route::is('siswa.create') || Route::is('siswa.edit') || Route::is('guru.index') || Route::is('guru.create') || Route::is('guru.edit') || Route::is('user.index') || Route::is('admin.index') || Route::is('admin.create') || Route::is('admin.edit') ? 'show' : '' }}"
                  role="list"
                  id="submenu-components" aria-expanded="false">
                  <ul class="flex-column nav">
                     <li class="nav-item {{ Route::is('user.index') ? 'active' : '' }}">
                        <a class="nav-link" href="/dashboard/user/">
                           <span class="sidebar-text">All User</span>
                        </a>
                     </li>
                     <li class="nav-item {{ Route::is('siswa.index') || Route::is('siswa.create') || Route::is('siswa.edit') ? 'active' : '' }}">
                        <a class="nav-link" href="/dashboard/user/siswa">
                           <span class="sidebar-text">Siswa</span>
                        </a>
                     </li>
                     <li class="nav-item {{ Route::is('guru.index') || Route::is('guru.create') || Route::is('guru.edit') ? 'active' : '' }}">
                        <a class="nav-link"
                           href="/dashboard/user/guru">
                           <span class="sidebar-text">Guru</span>
                        </a>
                     </li>
                     <li class="nav-item {{ Route::is('admin.index') || Route::is('admin.create') || Route::is('admin.edit') ? 'active' : '' }}">
                        <a class="nav-link" href="/dashboard/user/admin">
                           <span class="sidebar-text">Admin</span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
         @endif
      </ul>
   </div>
</nav>
