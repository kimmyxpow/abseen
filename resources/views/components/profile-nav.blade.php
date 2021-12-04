<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
   <div class="container-fluid px-0">
      <div class="d-flex justify-content-end w-100" id="navbarSupportedContent">
         <!-- Navbar links -->
         <ul class="navbar-nav align-items-center">
            <li class="nav-item dropdown ms-lg-3">
               <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <div class="media d-flex align-items-center">
                     <img class="avatar rounded-circle" alt="{{ Auth::user()->name }}"
                        src="{{ Auth::user()->avatar }}">
                     <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                        <span class="mb-0 font-small fw-bold text-gray-900">{{ Auth::user()->name }}</span>
                     </div>
                  </div>
               </a>
               <form method="POST" action="{{ route('logout') }}"
                  class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                  @csrf
                  <a class="dropdown-item d-flex align-items-center" href="#">
                     <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                           d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                           clip-rule="evenodd"></path>
                     </svg>
                     My Profile
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                     <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                           d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                           clip-rule="evenodd"></path>
                     </svg>
                     Settings
                  </a>
                  <div role="separator" class="dropdown-divider my-1"></div>
                  <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                  this.closest('form').submit();">
                     <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                     </svg>
                     Logout
                  </a>
               </form>
            </li>
         </ul>
      </div>
   </div>
</nav>
