@extends('layouts.app')

@section('title', 'Dashboard | Abseen')

@section('heading')
   <h1 class="fs-4 py-4">Absensi {{ Auth::user()->role == 'Siswa' ? 'Untukmu' : '' }} Hari Ini</h1>
@endsection

@section('content')
   @if (Auth::user()->role == 'Siswa')
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
               <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Cari absensi..."
                  aria-label="Search" aria-describedby="topbar-addon">
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-centered table-nowrap mb-0 rounded">
                  <thead class="thead-light">
                     <tr>
                        <th class="border-0 rounded-start">#</th>
                        <th class="border-0">Nama</th>
                        <th class="border-0">Untuk</th>
                        <th class="border-0">Oleh</th>
                        <th class="border-0">Dibuat Di</th>
                        <th class="border-0 rounded-end">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if (count($data))
                        @foreach ($data as $row)
                           <tr>
                              <td class="text-primary fw-bold">
                                 {{ ++$i }}
                              </td>
                              <td class="fw-bold">
                                 {{ $row->name }}
                              </td>
                              <td class="fw-bold">
                                 {{ $row->rombel->name ?? $row->rayon->name }}
                              </td>
                              <td class="fw-bold">
                                 {{ $row->user->name }}
                              </td>
                              <td class="fw-bold">
                                 {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->toDayDateTimeString() }}
                              </td>
                              <td class="btn-column">
                                 @if (count($row->presence->where('user_id', Auth::id())))
                                    @if (is_null($row->presence->Where('user_id', Auth::id())[0]->datang))
                                       <form action="/dashboard/absensi/{{ $row->id }}/hadir" method="POST" class="d-inline-block">
                                          @csrf
                                          <button type="submit" data-id="{{ $row->id }}"
                                             class="btn btn-primary btn-hadir">Hadir!</button>
                                       </form>
                                       <button type="button" data-id="{{ $row->id }}"
                                          class="btn btn-warning btn-izin">Izin</button>
                                       <button type="button" data-id="{{ $row->id }}"
                                          class="btn btn-info btn-sakit">Sakit</button>
                                    @else
                                       @if (is_null($row->presence->Where('user_id', Auth::id())[0]->pulang))
                                          <button type="button" data-id="{{ $row->id }}"
                                             class="btn btn-primary btn-hadir" disabled>Hadir!</button>
                                          <form action="/dashboard/absensi/{{ $row->id }}/pulang" method="POST" class="d-inline-block">
                                             @csrf
                                             <button type="submit" data-id="{{ $row->id }}"
                                                class="btn btn-info btn-pulang">Pulang</button>
                                          </form>
                                       @else
                                          <button type="button" data-id="{{ $row->id }}"
                                             class="btn btn-primary btn-hadir" disabled>Datang : {{ $row->presence->Where('user_id', Auth::id())[0]->datang }}</button>
                                          <button type="button" data-id="{{ $row->id }}"
                                             class="btn btn-primary btn-info" disabled>Pulang : {{ $row->presence->Where('user_id', Auth::id())[0]->pulang }}</button>
                                       @endif
                                    @endif
                                 @else
                                    <form action="/dashboard/absensi/{{ $row->id }}/hadir" method="POST" class="d-inline-block">
                                       @csrf
                                       <button type="submit" data-id="{{ $row->id }}"
                                          class="btn btn-primary btn-hadir">Hadir!</button>
                                    </form>
                                    <button type="button" data-id="{{ $row->id }}"
                                       class="btn btn-warning btn-izin">Izin</button>
                                    <button type="button" data-id="{{ $row->id }}"
                                       class="btn btn-info btn-sakit">Sakit</button>
                                 @endif
                              </td>
                           </tr>
                        @endforeach
                     @else
                        <tr>
                           <td colspan="7">
                              Data Kosong
                           </td>
                        </tr>
                     @endif
                  </tbody>
               </table>
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
      {{-- <script>
         document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll('.btn-hadir').forEach(btn => {
               btn.addEventListener('click', function() {
                  document.querySelector('#loader').style.opacity = 1;
                  document.querySelector('#loader').style.pointerEvents = 'auto';

                  const id = this.dataset.id;
                  fetch('http://lara-absensi.test/dashboard/absensi/' + id + '/hadir', {
                        method: 'POST',
                        headers: {
                           'Content-Type': 'application/json',
                        }
                     })
                     .then(response => response.json())
                     .then(data => {
                        this.setAttribute('disabled', 'disabled');
                        const btnColumn = this.parentElement;
                        btnColumn.querySelector('.btn-izin').classList.add('d-none');
                        btnColumn.querySelector('.btn-sakit').classList.add('d-none');
                        btnColumn.querySelector('.btn-pulang').classList.remove('d-none');
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
      </script> --}}
   @endif
@endsection
