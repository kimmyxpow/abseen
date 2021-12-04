<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="title" content="@yield('title')">
   <meta name="author" content="Abi Noval Fauzi">
   <meta name="description" content="Abseen adalah platform absensi online yang mudah digunakan!">
   <meta name="keywords"
      content="absen, absensi, absensi online, sekolah, online, sekolah online, absen sekolah, absensi sekolah" />
   <link rel="canonical" href="https://abseen.rf.gd">

   <meta property="og:type" content="website">
   <meta property="og:url" content="http://abseen.rf.gd">
   <meta property="og:title" content="@yield('title')">
   <meta property="og:description" content="Abseen adalah platform absensi online yang mudah digunakan!">
   <meta property="og:image"
      content="{{ asset('img/brand/Abseen.png') }}">

   <meta property="twitter:card" content="summary_large_image">
   <meta property="twitter:url" content="http://abseen.rf.gd">
   <meta property="twitter:title" content="@yield('title')">
   <meta property="twitter:description" content="Abseen adalah platform absensi online yang mudah digunakan!">
   <meta property="twitter:image"
      content="{{ asset('img/brand/Abseen.png') }}">

   <!-- Volt CSS -->
   <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">

   <!-- My CSS -->
   <link href="{{ asset('css/style.css') }}" rel="stylesheet">

   <!-- Google Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;800;900&family=Kalam:wght@300;400;700&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet">

   <title>@yield('title')</title>
</head>

<body>
   @include('components.navbar')

   <main class="content" style="overflow-x: hidden;">
      @include('components.profile-nav')

      @yield('heading')

      @yield('content')
   </main>

   <!-- Core -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

   <!-- Simplebar -->
   <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>

   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
