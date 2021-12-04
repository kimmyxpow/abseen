@extends('layouts.app')

@section('title', 'Dashboard | Abseen')

@section('heading')
   <h1 class="fs-4 py-4">Absensi Hari Ini</h1>
@endsection

@section('content')
   <div class="card border-0 shadow mb-4">
      <div class="card-header">
         <h2 class="fs-5">Rombel RPL XI-1</h2>
         <form class="navbar-search form-inline" id="navbar-search-main">
            <div class="input-group input-group-merge search-bar">
               <span class="input-group-text" id="topbar-addon">
                  <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     aria-hidden="true">
                     <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                  </svg>
               </span>
               <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search"
                  aria-label="Search" aria-describedby="topbar-addon">
            </div>
         </form>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded">
               <thead class="thead-light">
                  <tr>
                     <th class="border-0 rounded-start">#</th>
                     <th class="border-0">Nama</th>
                     <th class="border-0">Rayon</th>
                     <th class="border-0">Ket</th>
                     <th class="border-0">Waktu</th>
                     <th class="border-0 rounded-end">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td class="text-primary fw-bold">
                        1
                     </td>
                     <td class="fw-bold">
                        Abi Noval Fauzi
                     </td>
                     <td>
                        Cisarua 2
                     </td>
                     <td>
                        <p class="badge bg-primary">Hadir</p>
                     </td>
                     <td>
                        07:00
                     </td>
                     <td>
                        <a class="btn btn-warning" href="#">Edit</a>
                        <a class="btn btn-danger" href="#">Hapus</a>
                     </td>
                  </tr>
                  <tr>
                     <td class="text-primary fw-bold">
                        1
                     </td>
                     <td class="fw-bold">
                        Abi Noval Fauzi
                     </td>
                     <td>
                        Cisarua 2
                     </td>
                     <td>
                        <p class="badge bg-info">Sakit</p>
                     </td>
                     <td>
                        -
                     </td>
                     <td>
                        <a class="btn btn-warning" href="#">Edit</a>
                        <a class="btn btn-danger" href="#">Hapus</a>
                     </td>
                  </tr>
                  <tr>
                     <td class="text-primary fw-bold">
                        1
                     </td>
                     <td class="fw-bold">
                        Abi Noval Fauzi
                     </td>
                     <td>
                        Cisarua 2
                     </td>
                     <td>
                        <p class="badge bg-warning">Izin</p>
                     </td>
                     <td>
                        -
                     </td>
                     <td>
                        <a class="btn btn-warning" href="#">Edit</a>
                        <a class="btn btn-danger" href="#">Hapus</a>
                     </td>
                  </tr>
                  <tr>
                     <td class="text-primary fw-bold">
                        1
                     </td>
                     <td class="fw-bold">
                        Abi Noval Fauzi
                     </td>
                     <td>
                        Cisarua 2
                     </td>
                     <td>
                        <p class="badge bg-danger">Belum Absen</p>
                     </td>
                     <td>
                        -
                     </td>
                     <td>
                        <a class="btn btn-warning" href="#">Edit</a>
                        <a class="btn btn-danger" href="#">Hapus</a>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <div class="card border-0 shadow mb-4">
      <div class="card-header">
         <h2 class="fs-5 m-0">Rombel RPL XI-2</h2>
         <small class="m-0">Oleh Abi Noval Fauzi</small>
         <form class="navbar-search form-inline mt-3" id="navbar-search-main">
            <div class="input-group input-group-merge search-bar">
               <span class="input-group-text" id="topbar-addon">
                  <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     aria-hidden="true">
                     <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                  </svg>
               </span>
               <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Cari siswa"
                  aria-label="Search" aria-describedby="topbar-addon">
            </div>
         </form>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded">
               <thead class="thead-light">
                  <tr>
                     <th class="border-0 rounded-start">#</th>
                     <th class="border-0">Nama</th>
                     <th class="border-0">Rayon</th>
                     <th class="border-0">Ket</th>
                     <th class="border-0">Waktu</th>
                     <th class="border-0 rounded-end">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td class="text-primary fw-bold">
                        1
                     </td>
                     <td class="fw-bold">
                        Abi Noval Fauzi
                     </td>
                     <td>
                        Cisarua 2
                     </td>
                     <td>
                        <p class="badge bg-primary">Hadir</p>
                     </td>
                     <td>
                        07:00
                     </td>
                     <td>
                        <a class="btn btn-warning" href="#">Edit</a>
                        <a class="btn btn-danger" href="#">Hapus</a>
                     </td>
                  </tr>
                  <tr>
                     <td class="text-primary fw-bold">
                        1
                     </td>
                     <td class="fw-bold">
                        Abi Noval Fauzi
                     </td>
                     <td>
                        Cisarua 2
                     </td>
                     <td>
                        <p class="badge bg-info">Sakit</p>
                     </td>
                     <td>
                        -
                     </td>
                     <td>
                        <a class="btn btn-warning" href="#">Edit</a>
                        <a class="btn btn-danger" href="#">Hapus</a>
                     </td>
                  </tr>
                  <tr>
                     <td class="text-primary fw-bold">
                        1
                     </td>
                     <td class="fw-bold">
                        Abi Noval Fauzi
                     </td>
                     <td>
                        Cisarua 2
                     </td>
                     <td>
                        <p class="badge bg-warning">Izin</p>
                     </td>
                     <td>
                        -
                     </td>
                     <td>
                        <a class="btn btn-warning" href="#">Edit</a>
                        <a class="btn btn-danger" href="#">Hapus</a>
                     </td>
                  </tr>
                  <tr>
                     <td class="text-primary fw-bold">
                        1
                     </td>
                     <td class="fw-bold">
                        Abi Noval Fauzi
                     </td>
                     <td>
                        Cisarua 2
                     </td>
                     <td>
                        <p class="badge bg-danger">Belum Absen</p>
                     </td>
                     <td>
                        -
                     </td>
                     <td>
                        <a class="btn btn-warning" href="#">Edit</a>
                        <a class="btn btn-danger" href="#">Hapus</a>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
@endsection
