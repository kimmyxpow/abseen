@extends('layouts.app')

@section('title', 'Absensi Kehadiran ' . $data->name . ' | Abseen')

@section('heading')
   <div class="pt-4 pb-2">
      <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
         <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
               <a href="/dashboard">
                  <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                     </path>
                  </svg>
               </a>
            </li>
            <li class="breadcrumb-item"><a href="/dashboard/absensi">Absensi</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/absensi/{{ $data->id }}/siswa">Data Kehadiran Absensi
                  {{ $data->name }}</a></li>
         </ol>
      </nav>
      <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
         <h1 class="h4 mb-3 mb-lg-0">Data Kehadiran Absensi
            {{ $data->name }}</h1>
         <a href="/dashboard/absensi/" class="btn btn-primary">
            &leftarrow; Kembali
         </a>
      </div>
   </div>
@endsection

@section('content')
   @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{ session('success') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   @endif
   <div class="card border-0 shadow mb-4">
      <div class="card-header">
         <div class="input-group input-group-merge search-bar">
            <span class="input-group-text" id="topbar-addon">
               <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd"
                     d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                     clip-rule="evenodd"></path>
               </svg>
            </span>
            <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Cari siswa"
               aria-label="Search" aria-describedby="topbar-addon">
         </div>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded">
               <thead class="thead-light">
                  <tr>
                     <th class="border-0 rounded-start">#</th>
                     <th class="border-0">Avatar</th>
                     <th class="border-0">Nama</th>
                     <th class="border-0">NIS</th>
                     <th class="border-0">Email</th>
                     <th class="border-0">Rayon</th>
                     <th class="border-0">Rombel</th>
                     <th class="border-0">Absen</th>
                     <th class="border-0">Pulang</th>
                     <th class="border-0">Ket</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($siswa as $row)
                     <tr>
                        <td class="text-primary fw-bold">
                           {{ ++$i }}
                        </td>
                        <td>
                           <img width="40" height="40" class="rounded-circle" src="{{ $row->user->avatar }}"
                              alt="{{ $row->user->name }}">
                        </td>
                        <td class="fw-bold">
                           {{ $row->user->name }}
                        </td>
                        <td class="fw-bold">
                           {{ $row->user->nis }}
                        </td>
                        <td class="fw-bold">
                           {{ $row->user->email }}
                        </td>
                        <td class="fw-bold">
                           {{ $row->user->rayon->name }}
                        </td>
                        <td class="fw-bold">
                           {{ $row->user->rombel->name }}
                        </td>
                        <td class="fw-bold">
                           {{ $row->absen ?? '-' }}
                        </td>
                        <td class="fw-bold">
                           {{ $row->pulang ?? '-' }}
                        </td>
                        <td class="fw-bold">
                           {!! ($row->is_present == false) ? '<button class="btn btn-primary btn-proof" data-bs-toggle="modal"
                           data-bs-target="#modal-proof" data-id="' . $row->id . '">' . $row->present . '</button>' : $row->present !!}
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <div class="modal fade" id="modal-proof" tabindex="-1" role="dialog"
      aria-labelledby="modal-proof" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h2 class="h6 modal-title">Bukti Izin Siswa</h2>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <img class="w-100 img-proof" src="" alt="">
            </div>
         </div>
      </div>
   </div>
   <div id="loader">
      <div class="lds-ring">
         <div></div>
         <div></div>
         <div></div>
         <div></div>
      </div>
   </div>
   <script>
      document.addEventListener("DOMContentLoaded", function() {

         document.querySelectorAll('.btn-proof').forEach(btn => {
            btn.addEventListener('click', function() {
               document.querySelector('#loader').style.opacity = 1;
               document.querySelector('#loader').style.pointerEvents = 'auto';

               const id = this.dataset.id;
               fetch('/dashboard/absensi/' + id + '/bukti', {
                     method: 'GET',
                     headers: {
                        'Content-Type': 'application/json',
                     }
                  })
                  .then(response => response.json())
                  .then(data => {
                     document.querySelector('.img-proof').src = data.proof;

                     document.querySelector('#loader').style.opacity = 0;
                     document.querySelector('#loader').style.pointerEvents = 'none';
                  })
                  .catch((error) => {
                     console.error('Error:', error);

                     document.querySelector('#loader').style.opacity = 0;
                     document.querySelector('#loader').style.pointerEvents = 'none';
                  });
            })
         });

      });
   </script>
@endsection
