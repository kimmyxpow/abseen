<!doctype html>
<html lang="id">

<head>
   <!-- Required meta tags -->
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="title" content="Abseen">
   <meta name="author" content="Abi Noval Fauzi">
   <meta name="description" content="Abseen adalah platform absensi online yang mudah digunakan!">
   <meta name="keywords"
      content="absen, absensi, absensi online, sekolah, online, sekolah online, absen sekolah, absensi sekolah" />
   <link rel="canonical" href="abseen.rf.gd">

   <meta property="og:type" content="website">
   <meta property="og:url" content="http://abseen.rf.gd">
   <meta property="og:title" content="Abseen">
   <meta property="og:description" content="Abseen adalah platform absensi online yang mudah digunakan!">
   <meta property="og:image"
      content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">

   <meta property="twitter:card" content="summary_large_image">
   <meta property="twitter:url" content="http://abseen.rf.gd">
   <meta property="twitter:title" content="Abseen">
   <meta property="twitter:description" content="Abseen adalah platform absensi online yang mudah digunakan!">
   <meta property="twitter:image"
      content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-pro-bootstrap-5-dashboard/volt-pro-preview.jpg">

   <!-- Bootstrap CSS -->
   <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">

   <!-- My CSS -->
   <link href="{{ asset('css/style.css') }}" rel="stylesheet">

   <!-- Google Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;800;900&family=Kalam:wght@300;400;700&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet">

   <title>Abseen</title>
</head>

<body class="bg-white">
   <div class="position-relative" id="container">
      <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white">
         <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand kalam text-primary text-capitalize" href="/">Abseen</a>
            <a class="btn btn-primary" href="@auth {{ url('dashboard') }} @else {{ url('login') }} @endauth">@auth
         Dashboard @else Login @endauth</a>
   </div>
</nav>

<section class="d-flex justify-content-center align-items-center main-section">
   <div class="container">
      <div class="row align-items-center gap-lg-0 gap-3">
         <div class="col-lg-6 order-lg-1 order-2">
            <h1 class="fs-lg-1 fs-sm-2 fs-1">Welcome to <span class="text-primary kalam">Abseen</span></h1>
            <p class="lh-lg">
               Lakukan absensi dengan mudah dan cepat bersama absensi online <span
                  class="text-primary kalam">`Abseen`</span>.
            </p>
            <a href="{{ url('dashboard') }}" class="btn btn-primary">Mulai Sekarang</a>
         </div>
         <div class="col-lg-6 order-lg-2 order-1">
            <img class="w-100 rounded-3" src="{{ asset('img/vasily-koloda-8CqDvPuo_kI-unsplash.jpg') }}"
               alt="Abseen">
         </div>
      </div>
   </div>
</section>
</div>

<script src="{{ asset('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/volt.js') }}"></script>
</body>

</html>
