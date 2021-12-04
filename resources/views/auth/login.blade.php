<!DOCTYPE html>
<html lang="id">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

   <title>Abseen - Login page</title>
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="title" content="Abseen - Login page">
   <meta name="author" content="Abi Noval Fauzi">
   <meta name="description" content="Abseen adalah platform absensi online yang mudah digunakan!">
   <meta name="keywords"
      content="absen, absensi, absensi online, sekolah, online, sekolah online, absen sekolah, absensi sekolah" />
   <link rel="canonical" href="http://abseen.rf.gd">

   <meta property="og:type" content="website">
   <meta property="og:url" content="http://abseen.rf.gd">
   <meta property="og:title" content="Abseen - Login page">
   <meta property="og:description" content="Abseen adalah platform absensi online yang mudah digunakan!">
   <meta property="og:image"
      content="{{ asset('img/Abseen.png') }}">

   <meta property="twitter:card" content="summary_large_image">
   <meta property="twitter:url" content="http://abseen.rf.gd">
   <meta property="twitter:title" content="Abseen - Login page">
   <meta property="twitter:description" content="Abseen adalah platform absensi online yang mudah digunakan!">
   <meta property="twitter:image"
      content="{{ asset('img/Abseen.png') }}">

   <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">
</head>

<body class="bg-primary">
   <main>
      <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
         <div class="container">
            <div class="row justify-content-center form-bg-image">
               <div class="col-12 d-flex align-items-center justify-content-center">
                  <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                     <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h3">Login</h1>
                     </div>
                     @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                           Login gagal, silakan coba lagi!
                           <button type="button" class="btn-close" data-bs-dismiss="alert"
                              aria-label="Close"></button>
                        </div>
                     @endif
                     <form action="{{ route('login.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="form-group mb-4">
                           <label for="username">Username Anda</label>
                           <div class="input-group">
                              <span class="input-group-text" id="basic-addon1">
                                 <ion-icon name="person-circle-outline" class="fs-4"></ion-icon>
                              </span>
                              <input type="text" value="{{ old('username') }}" class="form-control"
                                 placeholder="Username Anda..." id="username"
                                 name="username" autocomplete="off" autofocus required>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="form-group mb-4">
                              <label for="password">Password Anda</label>
                              <div class="input-group">
                                 <span class="input-group-text" id="basic-addon2">
                                    <ion-icon name="lock-closed-outline" class="fs-5"></ion-icon>
                                 </span>
                                 <input type="password" placeholder="Password Anda..." class="form-control"
                                    name="password" id="password" autocomplete="off" required>
                              </div>
                           </div>
                           <div class="mb-4">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" name="remember_me" id="remember">
                                 <label class="form-check-label mb-0" for="remember">
                                    Ingat Saya
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="d-grid">
                           <button type="submit" class="btn btn-gray-800">Log in</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>

   <script src="{{ asset('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
   <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

   <script src="{{ asset('js/volt.js') }}"></script>

   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
